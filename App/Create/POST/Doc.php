<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\POST;

class Doc extends Content {

    public function __init() {
        parent::__init();
        if(ACTION != 'action'){
            $this->checkToken();
        }

    }

    public function action($jump = false, $commit = false) {
        parent::action($jump, $commit);
        $id = $this->db()->getLastInsert;
        $version = $this->p('version');
        $this->db('doc_version')->insert([
            'version_number' => $version,
            'doc_id' => $id,
            'version_time' => time()
        ]);

        $this->db()->commit();

        if (!empty($_POST['back_url'])) {
            $url = base64_decode($_POST['back_url']);
        } else {
            $url = $this->url(GROUP . '-' . MODULE . '-index');
        }

        $this->success('添加内容成功', $url);
    }

    /**
     * 创建新版本
     */
    public function version(){
        $doc = \Model\Doc::findDocWithID('isP');
        $empty = $this->isP('empty', '请提交创建新版号的属性');
        $number = $this->isP('number', '请提交要创建的版号');

        $checkVersion = $this->db('doc_version')->where('doc_id = :doc_id AND version_number = :version_number ')->find([
            'doc_id' => $doc['doc_id'],
            'version_number' => $number
        ]);
        if(!empty($checkVersion)){
            $this->error("{$number}版号已存在，请更换");
        }

        $this->db()->transaction();

        //新建文档版本记录
        $this->db('doc_version')->insert([
            'version_number' => $number,
            'doc_id' => $doc['doc_id'],
            'version_time' => time()
        ]);

        //将当前版号的文档首页记录到doc_json存储。用于历史版本查询用
        \Model\Doc::saveCurrentDocInDocVersionJsonField($doc);

        //将当前文档的版号切换为新建的版号
        $docParam = [
            'noset' => [
                'doc_id' => $doc['doc_id']
            ],
            'doc_version' => $number,
            'doc_createtime' => time(),
        ];
        if($empty == 'true'){
            $docParam['doc_content'] = '';
            $docParam['doc_content_md'] = '';
        }

        $this->db('doc')->where('doc_id = :doc_id')->update($docParam);

        //创建非空文档
        if($empty != 'true'){
            $this->handleArticlePath($doc, $number);
        }

        $this->db()->commit();


        $this->success('创建新版完成');
    }

    /**
     * 处理文档目录结构
     * @param $doc
     * @param $number
     */
    private function handleArticlePath($doc, $number){
        $articleQueue = $this->db('article')->where('article_doc_id = :article_doc_id AND article_version = :article_version')->select([
            'article_doc_id' => $doc['doc_id'],
            'article_version' => $doc['doc_version']
        ]);
        if(!empty($articleQueue)){
            $articleContentFieldResult = $this->db()->getAll("DESC {$this->prefix}article_content");
            foreach ($articleContentFieldResult as $item){
                if($item['Field'] == 'content_id'){
                    $articleContentField['content_id'] = 'NULL';
                }else{
                    $articleContentField[$item['Field']] = $item['Field'];
                }
            }

            foreach ($articleQueue as $item){
                $tmpParam = $item;
                $tmpParam['article_version'] = $number;
                unset($tmpParam['article_id']);

                //创建对应的文档目录，旧的父类字段ID和新创建的ID 记录起来
                $reference[$item['article_id']] = $this->db('article')->insert($tmpParam);

                $articleContentField['article_id'] = $reference[$item['article_id']];

                //复制文档内容并对应新的目录结构
                $this->db()->query("INSERT INTO {$this->prefix}article_content SELECT ".implode(', ', $articleContentField)." FROM {$this->prefix}article_content WHERE article_id = :article_id", [
                    'article_id' => $item['article_id']
                ]);
            }

            //更新新版本文档目录的父子结构
            if(!empty($reference)){
                foreach ($reference as $oldID => $newID){
                    $this->db('article')->where('article_doc_id = :article_doc_id AND article_parent = :oldID AND article_version = :article_version ')->update([
                        'noset' => [
                            'article_doc_id' => $doc['doc_id'],
                            'oldID' => $oldID,
                            'article_version' => $number
                        ],
                        'article_parent' => $newID
                    ]);
                }
            }


        }
    }

}