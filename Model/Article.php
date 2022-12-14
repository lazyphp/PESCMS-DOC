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

    public static $openSidebar = 0;

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
        if (empty($label)) {
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
            //如果是前台，跳转历史版本可能因为改版本没有此文档，所以直接重定向到文档首页。
            if (GROUP == 'Doc') {
                self::jump(self::url('Doc-Article-index', ['id' => $doc['doc_id']]));
            } else {
                self::error('文档不存在');
            }


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

    /**
     * 历史对比
     * @param $hid 历史ID
     * @return array
     */
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

    public static function getHistoryVersion($aid) {
        return self::db('article_content_history')->field('history_id, history_version, history_version_listsort')->where('article_id = :article_id AND history_version != "" ')->order('history_version_listsort ASC, article_content_time DESC')->select([
            'article_id' => $aid,
        ]);
    }

    /**
     * 基础信息
     * @return array
     */
    public static function baseForm() {
        $doc = \Model\Doc::findDocWithID('isP', ['请提交文档ID', '提交的文档不存在']);
        $data['article_doc_id'] = $doc['doc_id'];
        $data['article_title'] = self::isP('article_title', '请输入文档标题');
        $data['article_parent'] = self::isP('article_parent', '请选择文档所属目录');
        $data['article_node'] = self::isP('article_node', '请选择文档属性');
        if (!in_array($data['article_node'], ['0', '1', '2'])) {
            self::error('请提交正确的文档属性');
        }

        if ($data['article_node'] == 2) {
            $data['article_external_link'] = self::isP('article_external_link', '请填写外链地址');
        }


        $data['article_using_api_tool'] = self::p('using_api_tool');
        if($data['article_using_api_tool'] == 1 && $data['article_node'] == 0){
            $data['article_api_params'] = json_encode(self::apiForm());
        }

        $data['article_version'] = $doc['doc_version'];
        $data['article_listsort'] = (int)self::p('article_listsort');
        $data['article_status'] = 1;
        $mark = self::p('article_mark');
        $data['article_mark'] = empty($mark) ? (new \Godruoyi\Snowflake\Snowflake)->id() : $mark;
        return $data;
    }

    /**
     * 基础信息内容
     * @param $aid 文档ID
     * @param $data 数据内容
     * @return array
     */
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

    public static function apiForm(): array {
        $api_method = self::isP('api-method', '请提交您要链接API的请求方式');
        $api_url = self::isP('api-url', '请提交您要链接API的地址', false);

        $data = [];
        $send = [];

        foreach (['get', 'header', 'body'] as $item) {
            if (!empty($_POST["{$item}_key"]) && !empty($_POST["{$item}_value"])) {
                $array = [];
                foreach ($_POST["{$item}_key"] as $key => $value) {

                    $_key = self::handleData($value);
                    $_send = self::handleData($_POST["{$item}_send"][$key]);
                    $_value = self::handleData($_POST["{$item}_value"][$key]);
                    $_type = self::handleData($_POST["{$item}_type"][$key]);
                    $_default = self::handleData($_POST["{$item}_default"][$key]);
                    $_require = (int)self::handleData($_POST["{$item}_require"][$key]);
                    $_desc = self::handleData($_POST["{$item}_desc"][$key]);

                    if (empty($_value) && empty($_key)) {
                        continue;
                    }

                    $data[$item][] = [
                        'send'     => $_send,
                        'key'     => $_key,
                        'value'   => $_value,
                        'type'    => $_type,
                        'default' => $_default,
                        'require' => $_require,
                        'desc'    => $_desc,
                    ];


                    if (empty($_send)) {
                        continue;
                    }
                    //组装header数组
                    $array[] = "{$_key}: {$_value}";
                    //组装发送的数据
                    $send[$item][$_key] = $_value;
                }

                if ($item == 'header' && !empty($array)) {
                    $send[$item] = [
                        CURLOPT_HTTPHEADER => $array,
                    ];
                }

                if($item == 'get' && $_send == 1 ){
                    $send[$item][$_key] = $_value;
                }

            }
        }

        if(!empty($send['get'])){
            if(empty(parse_url($api_url)['query'])){
                $api_url = $api_url.'?'.http_build_query($send['get']);
            }else{
                $api_url = str_replace(parse_url($api_url)['query'], http_build_query($send['get']), $api_url);
            }
        }


        switch ($_POST['post-type']) {
            case 'raw';
                $send['body'] = $raw = self::p('raw');
                $rawType = strtolower($_POST['raw-type']);
                switch ($rawType) {
                    case 'text':
                        $accept = "text/plain";
                        break;
                    case 'html':
                        $accept = "text/html";
                        break;
                    case 'json':
                    case 'xml':
                        $accept = "application/{$rawType}";
                        break;
                }

                $send['header'][CURLOPT_HTTPHEADER] = array_merge($send['header'][CURLOPT_HTTPHEADER], ['Content-Type:' . $accept, 'Accept:' . $accept]);
                break;
        }

        $response = [];
        foreach (['success', 'error'] as $item) {
            if (empty($_POST["{$item}_content"])) {
                continue;
            }

            $response[$item]['content'] = self::handleData($_POST["{$item}_content"]);

            foreach ($_POST["{$item}_key"] as $key => $value) {
                if (empty($value)) {
                    continue;
                }
                $_key = self::handleData($value);
                $_type = self::handleData($_POST["{$item}_type"][$key]);
                $_desc = self::handleData($_POST["{$item}_desc"][$key]);

                $response[$item]['detail'][] = [
                    'key'  => $_key,
                    'type' => $_type,
                    'desc' => $_desc,
                ];

            }
        }


        return [
            'api_method' => $api_method,
            'api_url'    => $api_url,
            'data'       => $data,
            'send'       => $send,
            'response'   => $response,
            'rawType'    => $rawType,
            'raw'        => $raw,
            'postType'   => self::p('post-type'),
        ];


    }

}