<?php

/**
 * 自定义路由规则说明：
 * 路由以数组的形式定义。 
 * 路由名称 => 控制器
 * 若路由器需要带上参数，那么用大括号括着参数名称则可。
 * 如下路由：
 * 'new/{ddd}' => 'Article-action' ，
 * 访问访问 http://domain/new/1 将会转化为: Article-action-ddd-1
 */
return array(
    //注册帐号
    'd/signup' => 'Doc-Login-signup',
    //登录帐号
    'd/login' => 'Doc-Login-login',
    //注销登录
    'd/logout' => 'Doc-Login-logout',
    //文档首页
    'd/index' => 'Doc-Article-index',
    //文档首页切换文档
    'd/index/{tree}' => 'Doc-Article-index',
    //发表新文档
    'd/new' => 'Doc-Article-action',
    //更新标题(PUT)
    'd/updateTitle' => 'Doc-Doc-action',
    //文档列表
    'd/manage' => 'Doc-Article-manage',
    //文档详情
    'd/v/{tree}/{id}' => 'Doc-Article-view',
    //文档操作
    'd/action/{id}/{method}' => 'Doc-Article-Action',
    //添加文档内容
    'd/addContent/{id}' => 'Doc-Article-addContent',
    //更新内容
    'd/edit/{id}' => 'Doc-Article-updateContent',
    //UE编辑器上传地址
    'd/uedition/{all}' => 'Doc-Uedtior-index',
    //验证码
    'd/verify/{rand}' => 'Doc-Index-verify',
    //树操作
    'd/tree/action' => 'Doc-Tree-action',
    'd/tree/action/{id}/{method}' => 'Doc-Tree-action',
    //树排序
    'd/tree/listsort' => 'Doc-Tree-listsort',
);
