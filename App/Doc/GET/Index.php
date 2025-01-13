<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\GET;

class Index extends \Core\Controller\Controller {

    /**
     * 首页
     * @return void
     */
    public function index() {
        $doc = \Model\Doc::getDocList();
        $this->assign('doc', $doc);
        $this->docWithAttr($doc);

        $this->assign('indexSetting', \Model\Theme::getThemeIndexSetting());

        $this->layout();
    }

    /**
     * 重组文档，按照文档属性归档
     * @param $doc
     * @return void
     */
    private function docWithAttr($doc) {
        $attrList = \Model\Content::listContent([
            'table'     => 'attr',
            'condition' => 'attr_status = 1',
            'order'     => 'attr_listsort ASC, attr_id DESC',
        ]);

        $attr = [];
        $list = [];
        foreach ($attrList as $key => $item) {
            $attr[$key] = $item;
            $list[$item['attr_id']] = [];
        }

        foreach ($doc as $item) {
            unset($item['doc_content'], $item['doc_content_md']);
            if (empty($item['doc_attr'])) {
                if (!isset($list[0])) {
                    array_unshift($attr, [
                        'attr_id' => 0,
                    ]);
                    array_unshift($list, []);
                }
                $list[0][] = $item;
            } else {
                $splitAttr = explode(',', $item['doc_attr']);
                foreach ($splitAttr as $value) {
                    $list[$value][] = $item;
                }
            }
        }

        $this->assign('attr', $attr);
        $this->assign('list', $list);
    }

    /**
     * 全局搜索
     * @return void
     */
    public function search() {
        $keyword = $this->isG('keyword', '请提交您要搜索的内容');
        $param = [
            'article_title'      => "%{$keyword}%",
            'article_content'    => "%{$keyword}%",
            'article_content_md' => "%{$keyword}%",
        ];
        
        $member = $this->session()->get('doc');
        $condition = "";
        if (empty($member)) {
            $condition .= "AND d.doc_open = 0";
        } else {
            $condition .= " AND (
            d.doc_read_organize = '' OR 
            ( concat(',', concat(d.doc_read_organize, ',')) LIKE :member_organize_id  )
            )";
            $param['member_organize_id'] = "%,{$member['member_organize_id']},%";
        }


        $sql = "SELECT %s FROM {$this->prefix}doc AS d
                LEFT JOIN {$this->prefix}article AS a ON d.doc_id = a.article_doc_id
                LEFT JOIN {$this->prefix}article_content AS ac ON a.article_id = ac.article_id
                WHERE a.article_node = 0 AND d.doc_version = a.article_version AND (a.article_title LIKE :article_title OR ac.article_content LIKE :article_content OR ac.article_content_md LIKE :article_content_md  ) {$condition}
                ORDER BY a.article_update_time DESC, a.article_time DESC

                ";

        $res = \Model\Content::quickListContent([
            'count'  => sprintf($sql, 'count(*)'),
            'normal' => sprintf($sql, 'd.doc_title, d.doc_id, d.doc_cover, d.doc_version,a.article_view, a.article_like, a.article_mark, a.article_title, a.article_time, a.article_update_time, a.article_doc_id, ac.article_content'),
            'param'  => $param,
        ]);

        $this->assign('title', "全局搜索「{$keyword}」相关的内容");
        $this->assign('list', $res['list']);
        $this->assign('page', $res['page']);
        $this->assign('pageObj', $res['pageObj']);
        $this->assign('keyword', $keyword);
        $this->layout('Article/Article_search');
    }

    /**
     * 验证码
     */
    public function verify() {
        $verify = new \Expand\Verify();
        if (!empty($_GET['height'])) {
            $verify->height = intval($this->g('height'));
        }
        $verifyLength = \Core\Func\CoreFunc::$param['system']['verifyLength'];
        $verify->createVerify(empty($verifyLength) ? '4' : $verifyLength);
    }

}