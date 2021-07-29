<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

/**
 * 文档模型
 */
class Article extends \Core\Model\Model {

    public static $selectedID;

    /**
     * 打开输出控制缓冲文档目录
     * @param int $docID
     * @param string $version
     * @param int $parent
     * @param string $template
     * @param string $space
     * @return false|string
     */
    public static function obArticle(int $docID, string $version, int $parent = 0, string $template = '', string $space = '') {
        ob_start();
        self::article($docID, $version, $parent, $template);
        $content = ob_get_contents();
        ob_clean();
        return $content;

    }

    /**
     * 递归文档目录
     * @param int $docID
     * @param string $version
     * @param int $parent
     * @param string $template
     * @param string $space
     */
    public static function article(int $docID, string $version, int $parent = 0, string $template = '', string $space = '') {

        static $label;
        if(empty($label)){
            $label = new \Expand\Label();
        }

        if (empty($template)) {
            $template = GROUP == 'Create' ? THEME_PATH . '/Article/Article_menu.php' : THEME_PATH . '/Article/Article_menu.php';
        }

        $condition = "article_doc_id = :article_doc_id AND article_parent = :article_parent AND article_version = :article_version AND article_status = 1 AND article_time <= :article_time  ";
        $param['article_doc_id'] = $docID;
        $param['article_parent'] = $parent;
        $param['article_version'] = $version;
        $param['article_time'] = time();

        $result = self::db('article')
            ->where($condition)
            ->order('article_listsort ASC, article_id DESC')
            ->select($param);

        $article = [];
        if (!empty($result)) {
            require $template;
        }
        return $article;
    }

    public static function aaa(){}

    /**
     * 获取文档详情
     * @param $doc
     * @param $aid
     */
    public static function getDetail($doc, $aid, $field = 'article_id') {
        $articel = self::db('article AS a')
            ->join(self::$modelPrefix . "article_content AS ac ON ac.article_id = a.article_id")
            ->where("a.{$field} = :{$field} AND a.article_version = :article_version AND a.article_doc_id = :article_doc_id")
            ->find([
                $field            => $aid,
                'article_version' => $doc['doc_version'],
                'article_doc_id'  => $doc['doc_id'],
            ]);
        if (empty($articel)) {
            self::error('文档不存在');
        }
        return $articel;
    }

    /**
     * 获取文档的历史记录
     * @param $aid 文章ID
     * @param $field 输出指定字段
     * @return mixed
     */
    public static function getHistory($aid, $field = '*') {
        return self::db('article_content_history')->field($field)->where('article_id = :article_id')->order('history_id DESC')->select([
            'article_id' => $aid,
        ]);
    }

    public static function historyCompare($hid) {
        $history = \Model\Content::findContent('article_content_history', $hid, 'history_id');
        $articleHistory = json_decode($history['article_json'], true);

        $article = self::getDetail(['doc_id' => $articleHistory['article_doc_id'], 'doc_version' => $articleHistory['article_version']], $history['article_id']);

        return [
            'history' => [
                'article_base' => $articleHistory,
                'content'      => $history,
            ],
            'current' => $article,
        ];

    }

    public static function baseForm() {
        $doc = \Model\Doc::findDocWithID('isP', ['请提交文档ID', '提交的文档不存在']);
        $data['article_doc_id'] = $doc['doc_id'];
        $data['article_title'] = self::isP('article_title', '请输入文档标题');
        $data['article_parent'] = self::isP('article_parent', '请选择文档所属目录');
        $data['article_node'] = self::isP('article_node', '请选择文档属性');
        if (!in_array($data['article_node'], ['0', '1', '2'])) {
            self::error('请提交正确的文档属性');
        }

        if($data['article_node'] == 2){
            $data['article_external_link'] = self::isP('article_external_link', '请填写外链地址');
        }

        $data['article_version'] = $doc['doc_version'];
        $data['article_listsort'] = (int)self::p('article_listsort');
        $data['article_status'] = 1;
        $mark = self::p('article_mark');
        $data['article_mark'] = empty($mark) ? (new \Godruoyi\Snowflake\Snowflake)->id() : $mark;
        return $data;
    }

    public static function baseContentForm($aid, $data) {
        $content['article_id'] = $aid;
        $content['article_content_time'] = time();

        if ($data['article_node'] == 0) {

            $content['article_content_editor'] = self::isP('editor', '请提交编辑器类型');
            if (!in_array($content['article_content_editor'], ['0', '1'])) {
                self::error('请提交正确的编辑器类型');
            }

            $content['article_content'] = self::isP($content['article_content_editor'] == 0 ? 'content' : 'html', '请提交文档内容', false);
            if ($content['article_content_editor'] == 1) {
                $content['article_content_md'] = self::isP('md', '请提交文档内容', false);
            }

            $content['article_keyword'] = self::p('article_keyword');
            $content['article_description'] = self::p('article_description');

        }

        return $content;

    }

}