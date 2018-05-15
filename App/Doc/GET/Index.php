<?php

namespace App\Doc\GET;

class Index extends \Core\Controller\Controller {


    /**
     * 在首页显示的文档树
     */
    protected $indexTreeID;

    /**
     * 在首页显示的文档树
     */
    protected $treeVersion;

    /**
     * 在首页显示的文档ID
     */
    protected $indexPageID;

    protected $currentTree;


    public function __init() {
        parent::__init();
        $this->tree();
    }

    /**
     * 输出侧栏的文档树结构
     */
    public function tree() {
        $this->indexTreeID = !empty($_GET['tree']) ?
            $this->g('tree') : current(\Core\Func\CoreFunc::$param['treeList'])['tree_id'];

        //获取当前目录信息
        $this->currentTree = \Model\Content::findContent('tree', $this->indexTreeID, 'tree_id');
        //没有指定版本，则使用默认目录的当前版本号
        $this->treeVersion = !empty($_GET['version']) ? $this->g('version') : $this->currentTree['tree_version'];

        $tree = \Model\Doc\Tree::catalog($this->indexTreeID, $this->treeVersion);
        $this->indexPageID = !empty($_GET['id']) ? $this->g('id') : $tree['id'];

        $this->assign('version', \Model\Doc\Tree::getTreeVersions($this->indexTreeID));
        $this->assign('currentTree', $this->currentTree);
        $this->assign('tree', $tree['tree']);
    }

    /**
     * 首页
     */
    public function index(){
        $this->layout();
    }

    public function home(){
        $_GET['tree'] = (string) $this->indexTreeID;
        $_GET['id'] = (string) $this->indexPageID;
        $_GET['version'] = (string) $this->treeVersion;
        $this->view();
    }

    /**
     * 文档详情
     */
    public function view() {
        $id = $this->g('id');
        $treeID = $this->g('tree');
        if(empty($id) || empty($treeID)){
            $this->layout('404');
            exit;
        }

        //查找文档的基础表是否有内容存在
        $base = $this->db('doc AS d')
            ->join("{$this->prefix}tree AS t ON t.tree_id = d.doc_tree_id")
            ->where('d.doc_delete = 0 AND t.tree_parent = :tree_parent AND d.doc_id = :doc_id AND d.tree_version = :tree_version')
            ->find(array(
                'tree_parent' => $treeID,
                'doc_id' => $id,
                'tree_version' => $this->treeVersion
            ));

        if (empty($base)) {
            $this->layout('404');
            exit;
        }
        $this->assign($base);
        $this->assign('title', $base['doc_title']);

        $condition = "doc_id = :doc_id AND doc_content_delete = 0 ";
        $param = array('doc_id' => $id);

        //内容层数
        $content = $this->db('doc_content AS tc')->field('tc.*, u.user_id, u.user_name')->join("{$this->prefix}user AS u ON u.user_id =  tc.user_id")->where($condition)->order('tc.doc_content_listsort ASC, tc.doc_content_id ASC')->select($param);
        $this->assign('content', $content);

        $this->layout('Index_view', 'layout_sidebar');
    }

}
