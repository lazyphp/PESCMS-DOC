<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\GET;

class Article extends \Core\Controller\Controller {

    /**
     * 文档目录
     */
    public function index() {
        $doc = \Model\Doc::findDocWithID();
        $path = \Model\Article::obArticle($doc['doc_id'], $doc['doc_version']);

        $pathOption = \Model\Article::obArticle($doc['doc_id'], $doc['doc_version'], 0, THEME_PATH . '/Article/Article_pathOption.php');

        $this->assign('pathOption', $pathOption);

        $this->assign('path', $path);
        $this->assign('doc', $doc);

        $this->assign('docVersion', \Model\Doc::getDocVersionList($doc));
        $this->assign('title', "编写《{$doc['doc_title']}》文档");
        $this->layout('Article_index', 'Article_index_layout');
    }

    /**
     * 写文章
     */
    public function write() {
        $doc = \Model\Doc::findDocWithID();
        $aid = $this->g('aid');
        if (!empty($aid) && $aid != 'new') {
            $articel = \Model\Article::getDetail($doc, $aid);
            $this->assign($articel);
            $this->assign('method', 'PUT');
            \Model\Article::$selectedID = $articel['article_parent'];
        }
        
        $pathOption = \Model\Article::obArticle($doc['doc_id'], $doc['doc_version'], 0, THEME_PATH . '/Article/Article_pathOption.php');

        $this->assign('pathOption', $pathOption);

        ob_start();
        $this->display();
        $content = ob_get_contents();
        ob_clean();
        $this->success([
            'msg'  => '读取数据成功',
            'data' => [
                'html' => $content,
                'url' => !empty($aid) && $aid != 'new' && $articel['article_node'] == 0 ? $this->url('Doc-Article-index', ['id' => $articel['article_doc_id'], 'aid' => $articel['article_mark']]) : ''
            ],
        ]);
    }

    /**
     * 对比历史版本
     */
    public function compare() {
        $id = $this->isG('id', '请提交对比的历史');
        $result = \Model\Article::historyCompare($id);

        $this->assign('article', $result['current']);
        $this->assign('history', $result['history']);
        $this->display();
    }

    /**
     * 获取文档历史
     */
    public function history() {
        $aid = $this->isG('aid', '请提交要查询历史的文档ID ');
        $history = \Model\Article::getHistory($aid, 'history_id, FROM_UNIXTIME(history_time, "%Y-%m-%d") AS history_date, FROM_UNIXTIME(history_time, "%H:%i:%s") AS history_time, article_id, history_version');

        $this->assign('version', \Model\Article::getHistoryVersion($aid));
        $this->assign('history', $history);

        ob_start();
        $this->display('Article_history');
        $content = ob_get_contents();
        ob_clean();

        $this->success([
            'msg'  => '读取文档历史完成',
            'data' => [
                'list' => $history,
                'html' => $content,
            ],
        ]);
    }

    /**
     * 刷新目录
     */
    public function refreshPath(){
        $doc = \Model\Doc::findDocWithID();
        $path = \Model\Article::obArticle($doc['doc_id'], $doc['doc_version']);
        $this->success(['msg' => '获取新目录成功', 'data' => $path]);
    }


}
