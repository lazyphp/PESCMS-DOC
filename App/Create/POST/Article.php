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
//        $this->checkToken();
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

    public function api(){
        $api_method = $this->isP('api-method', '请提交您要链接API的请求方式');
        $api_url = $this->isP('api-url', '请提交您要链接API的地址', false);


        $data = [];
        $send = [];

        foreach (['get', 'header', 'body'] as $item){
            if(!empty($_POST["{$item}_key"]) && !empty($_POST["{$item}_value"]) ){
                $array = [];
                foreach ($_POST["{$item}_key"] as $key => $value){

                    $_key = $this->handleData($value);
                    $_value = $this->handleData($_POST["{$item}_value"][$key]);
                    $_type = $this->handleData($_POST["{$item}_type"][$key]);
                    $_default = $this->handleData($_POST["{$item}_default"][$key]);
                    $_require = (int) $this->handleData($_POST["{$item}_require"][$key]);
                    $_desc = $this->handleData($_POST["{$item}_desc"][$key]);

                    if(empty($_value) && empty($_key)){
                        continue;
                    }

                    $data[$item][] = [
                        'key' => $_key,
                        'value' => $_value,
                        'type' => $_type,
                        'default' => $_default,
                        'require' => $_require,
                        'desc' => $_desc,
                    ];



                    if(empty($_POST["{$item}_send"][$key])){
                        continue;
                    }
                    //组装header数组
                    $array[] = "{$_key}: {$_value}";
                    //组装发送的数据
                    $send[$item][$_key] = $_value;
                }

                if($item == 'header' && !empty($array)){
                    $send[$item] = [
                        CURLOPT_HTTPHEADER => $array
                    ];
                }
            }
        }

        $res = (new \Expand\cURL())->init($api_url, $send['body'], $send['header']);
        echo '<pre>';
        print_r($res);
        echo '</pre>';
        echo '<br/>';
        exit;


        $this->assign('data', $data);
        $this->assign('api_method', $api_method);
        $this->assign('api_url', $api_url);

        $this->display('Article_api_content_example');

        echo '<pre>';
        print_r($data);
        print_r($send);
        echo '</pre>';
        echo '<br/>';
        exit;


    }
}