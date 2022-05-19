<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\GET;

class Article extends \Core\Controller\Controller {

    private $version = [];

    public function __init() {
        parent::__init();
        $this->version = $this->session()->get('version');
    }

    /**
     * 文档页
     */
    public function index() {
        $doc = \Model\Doc::findDocWithID();
        $currentVersion = $doc['doc_version'];
        $docVersion = \Model\Doc::getDocVersionList($doc);

        if (\Model\Doc::checkReadAuth($doc) === false) {
            $this->_404();
        }

        //查阅历史文档，覆盖原由的doc变量
        if (!empty($this->version[$doc['doc_id']]) && $this->version[$doc['doc_id']] != $doc['doc_version']) {
            $getVersionContent = $docVersion[$this->version[$doc['doc_id']]];
            $doc = json_decode($getVersionContent['doc_json'], true);
        }

        \Model\Article::$openSidebar = $doc['doc_open_sidebar'];
        $path = \Model\Article::obArticle($doc['doc_id'], $doc['doc_version']);

        if (!empty($_GET['aid'])) {


            $article = \Model\Article::getDetail($doc, $this->g('aid'), 'article_mark');
            $this->assign($article);
            $this->pageNextAndPrev($doc, $article);
            $this->assign('docKeyword', $article['article_keyword']);
            $this->assign('docDescription', $article['article_description']);

            $this->switchPageVersion($article['article_id']);
            $this->assign('articleVersion', \Model\Article::getHistoryVersion($article['article_id']));
        } else {
            $this->assign('docKeyword', $doc['doc_keyword']);
            $this->assign('docDescription', $doc['doc_description']);
        }


        $this->assign('path', $path);
        $this->assign('doc', $doc);
        $this->assign('docVersion', $docVersion);
        $this->assign('currentVersion', $currentVersion);
        $this->assign('title', !empty($_GET['aid']) ? "{$article['article_title']} - {$doc['doc_title']}" : $doc['doc_title']);
        $this->layout('', 'Article_layout');
    }

    /**
     * 文章上下篇章
     * @param $doc
     * @param $article
     */
    private function pageNextAndPrev($doc, $article) {

        //@todo 我觉得这里生成文件缓存会更加好
        $result = \Model\Article::article($doc['doc_id'], $doc['doc_version'], 0, PES_CORE . '/Model/Article_recursion.php');

        $position = array_search($article['article_id'], array_keys($result));


        if ($position > 0) {
            $page['prev'] = array_slice($result, $position - 1, 1)[0];
        }
        $page['next'] = array_slice($result, $position + 1, 1)[0] ?? '';

        $this->assign('page', $page);
    }

    /**
     * 搜索功能
     */
    public function search() {

        $doc = \Model\Doc::findDocWithID();

        if (\Model\Doc::checkReadAuth($doc) === false) {
            $this->_404();
        }

        $keyword = '%' . $this->g('keyword') . '%';

        $list = $this->db('article AS a')
            ->join("{$this->prefix}article_content AS ac ON ac.article_id = a.article_id")
            ->where(' a.article_doc_id = :article_doc_id AND a.article_version = :article_version AND a.article_node = 0 AND  (article_title LIKE :article_title OR ac.article_content LIKE :article_content)')
            ->select([
                'article_doc_id'  => $doc['doc_id'],
                'article_version' => $doc['doc_version'],
                'article_title'   => $keyword,
                'article_content' => $keyword,
            ]);

        $this->assign('doc', $doc);
        $this->assign('list', $list);
        $this->assign('keyword', $this->g('keyword'));
        $this->layout();

    }

    /**
     * 切换文档到别的大版本
     */
    public function switchVersion() {
        $id = $this->isG('id', '请提交您要切换版本的文档');
        $version = $this->isG('version', '请提交您要切换的版本');

        $getVersionContent = $this->db('doc_version')->where('doc_id = :doc_id AND version_number = :version_number ')->find([
            'doc_id'         => $id,
            'version_number' => $version,
        ]);

        if (empty($getVersionContent)) {
            $this->error('切换的版本不存在!');
        }

        if (empty($this->version)) {
            $versionArray = [$id => $version];
        } else {
            $versionArray = [$id => $version] + $this->version;
        }

        $this->session()->set('version', $versionArray);

        $this->success('版本切换完成');
    }

    /**
     * 切换页内文档版本
     * @return void
     */
    public function switchPageVersion($aid) {
        $version = $this->g('version');

        $articleHistoryVersion = $this->db('article_content_history')->where('article_id = :article_id AND history_version = :history_version ')->find([
            'article_id'      => $aid,
            'history_version' => $version,
        ]);

        if (empty($version) || empty($articleHistoryVersion)) {
            return true;
        }


        $base = json_decode($articleHistoryVersion['article_json'], true);

        //移除一些非必要字段
        unset($articleHistoryVersion['history_id'], $articleHistoryVersion['history_time'], $articleHistoryVersion['history_version'], $articleHistoryVersion['article_json']);

        $this->assign(array_merge($base, $articleHistoryVersion));
        $this->assign('docKeyword', $articleHistoryVersion['article_keyword']);
        $this->assign('docDescription', $articleHistoryVersion['article_description']);


    }
}