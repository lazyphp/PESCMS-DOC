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
}