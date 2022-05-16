<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\POST;

class Article extends \Core\Controller\Controller {

    public function __init() {
        parent::__init();
        $this->checkToken();
    }

    /**
     * 新增文档
     */
    public function index() {
        $data = \Model\Article::baseForm();
        $data['article_time'] = time();

        $this->db()->transaction();

        $aid = $this->db('article')->insert($data);

        $content = \Model\Article::baseContentForm($aid, $data);

        $this->db('article_content')->insert($content);

        $this->db()->commit();

        $this->success([
            'msg' => '新增文档完成',
            'data' => [
                'refresh' => 1,
                'aid' => $aid,
                'mark' => $data['article_mark'],
                'url' => $this->url('Doc-Article-index', ['id' => $data['article_doc_id'], 'aid' => $data['article_mark']])
            ]
        ]);
    }

    /**
     * 创建页内版本
     * @return void
     */
    public function version(){
        $aid = $this->isP('aid', '请提交要生成页内版本的文档');
        $version = $this->isP('version', '请提交您的页内版本号');
        $sort = $this->p('sort');
        $article = \Model\Content::findContent(['article', true], $aid, 'article_id')->emptyTips('更新的文档不存在，请重新点击侧栏读取内容.');

        $articleContent = \Model\Content::findContent('article_content', $aid, 'article_id');

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
            'history_time' => time(),
            'history_version' => $version,
            'history_version_listsort' => $sort,
        ]);

        $this->success('页内版本号添加完成');

    }
}