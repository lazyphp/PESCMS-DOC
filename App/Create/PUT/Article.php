<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\PUT;

class Article extends \Core\Controller\Controller {

    public function __init() {
        parent::__init();
        $this->checkToken();
    }

    public function index(){

        $aid = $this->isP('aid', '请提交要修改的文档ID');
        $article = \Model\Content::findContent(['article', true], $aid, 'article_id')->emptyTips('更新的文档不存在，请重新点击侧栏读取内容.');

        $articleContent = \Model\Content::findContent('article_content', $aid, 'article_id');


        $data = \Model\Article::baseForm();
        $data['article_update_time'] = time();
        $data['noset']['aid'] = $aid;

        $content = \Model\Article::baseContentForm($aid, $data);
        $content['noset']['aid'] = $aid;

        $this->db()->transaction();

        $this->db('article')->where('article_id = :aid')->update($data);

        $this->db('article_content')->where('article_id = :aid')->update($content);

        //生成历史记录
        $this->db('article_content_history')->insert([
            'article_id' => $aid,
            'article_json' => json_encode($article),
            'article_content' => $articleContent['article_content'],
            'article_content_md' => $articleContent['article_content_md'],
            'article_content_editor' => $articleContent['article_content_editor'],
            'article_content_time' => $articleContent['article_content_time'],
            'article_keyword' => $articleContent['article_keyword'],
            'article_description' => $articleContent['article_description'],
            'history_time' => time()
        ]);

        $this->db()->commit();

        $this->success([
            'msg' => '文档更新完成',
            'data' => [
                'aid' => $aid,
                'url' => $this->url('Doc-Article-index', ['id' => $article['article_doc_id'], 'aid' => $article['article_mark']])
            ]
        ]);

    }

    /**
     * 更新文档首页内容
     */
    public function doc(){

        $doc = \Model\Doc::findDocWithID('isP');

        $data['noset']['doc_id'] = $doc['doc_id'];
        $data['doc_content_editor'] = $this->p('editor');
        if(!in_array($data['doc_content_editor'], ['0', '1'])){
            $this->error('请提交正确的编辑器');
        }
        $data['doc_content'] = $this->isP($data['doc_content_editor'] == 0 ? 'content' : 'html', '请提交文档内容', false);
        if($data['doc_content_editor'] == 1){
            $data['doc_content_md'] = $this->isP('md', '请提交文档内容', false);
        }

        $data['doc_keyword'] = $this->p('doc_keyword');
        $data['doc_description'] = $this->p('doc_description');

        $this->db('doc')->where('doc_id = :doc_id')->update($data);

        $this->success([
            'msg' => '文档首页内容更新完成',
            'data' => [
                'url' => $this->url('Doc-Article-index', ['id' => $doc['doc_id']])
            ]
        ]);

    }

    /**
     * 从历史版本切换到版本
     */
    public function history(){
        $hid = $this->isG('hid', '请提交要查询历史的文档ID ');
        $result = \Model\Article::historyCompare($hid);

        $aid = $result['history']['article_base']['article_id'];

        $this->db()->transaction();
        //切换历史
        $baseArticle = $result['history']['article_base'];
        $baseArticle['noset']['article_id'] = $aid;
        unset($baseArticle['article_id']);

        $this->db('article')->where('article_id = :article_id')->update($baseArticle);

        $articleContent = $result['history']['content'];
        $articleContent['noset']['article_id'] = $aid;
        foreach ([
            'history_id',
            'article_id',
            'article_json',
            'history_time',
            'history_version',
            'history_version_listsort',
                 ] as $item){
            unset($articleContent[$item]);
        }

        $this->db('article_content')->where('article_id = :article_id')->update($articleContent);

        //生成历史记录
        $article_json = $result['current'];
        //移除非基础表的内容
        foreach ([
            'article_content',
            'article_content_md',
            'article_content_editor',
            'article_content_time',
            'content_id',
            'article_keyword',
            'article_description',
                 ] as $item){
            unset($article_json[$item]);
        }
        $this->db('article_content_history')->insert([
            'article_id' => $aid,
            'article_json' => json_encode($article_json),
            'article_content' => $result['current']['article_content'],
            'article_content_md' => $result['current']['article_content_md'],
            'article_content_editor' => $result['current']['article_content_editor'],
            'article_content_time' => $result['current']['article_content_time'],
            'article_keyword' => $result['current']['article_keyword'],
            'article_description' => $result['current']['article_description'],
            'history_time' => time()
        ]);

        //切换成功，删除历史版本
        $this->db('article_content_history')->where('history_id = :history_id')->delete([
            'history_id' => $hid
        ]);

        $this->db()->commit();

        $this->success('切换历史版本成功', $this->url('Create-Article-index', ['id' => $aid]));

    }

    /**
     * 页内版本权重排序
     * @return void
     */
    public function pageVersionSort(){
        if(empty($_POST['history_id']) || count($_POST['history_id']) == 0 ){
            $this->error('请提交要排序的页内版本');
        }
        foreach ($_POST['history_id'] as $id => $value) {
            $this->db('article_content_history')->where('history_id = :history_id')->update([
                'noset' => [
                    'history_id' => $id
                ],
                'history_version_listsort' => $value
            ]);
        }

        $this->success('页内版本权重排序完成');

    }

}