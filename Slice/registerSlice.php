<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

/*
| 切片注册
| 程序提供五个方法声明切片绑定的请求类型: any, get, post, put, delete
| 参数一：绑定控制器路由规则。
          依次填写 组-控制器-方法。若为泛匹配，提供3个对应的占位符。
           :g-:m-:a 。如：Create-:m-:a 泛匹配组Create下任意的控制器以及方法
|         参数可以为字符串或者数组
| 参数二：
|         切片的命名空间。相对于当前Slice目录。不需要填写空间名Slice,如：\Slice\Common\Auto，则填写\Common\Auto
|         注：切片是按照由上至下的顺序进行注册。
|         参数必须为数组
| 参数三:
|         不参与绑定的路由规则。和参数一一样。可以不填写
|         参数可以为字符串或者数组
| 示例代码：
|
| InitSlice::any(['Home', 'Home-Index'], ['\Common\Authenticate']); //路由Home, Home-index 绑定 \Common\Authenticate
|
| InitSlice::any('Admin-Setting-index', ['\Common\Authenticate']); //路由Admin-Setting-index 绑定\Common\Authenticate
|
| InitSlice::any('Admin', ['\Admin\Login'], ['Admin-Login']); //路由Admin 绑定\Admin\Login 但Admin-login不会被绑定
|
|--------------------------------------------------------------------------
|
*/

use \Core\Slice\InitSlice as InitSlice;

$SLICE_ARRYR = [

    'SYSTEM-SETTING' => [
        'any',
        ['Doc-:m-:a', 'Create-:m-:a'],
        ['\Option']
    ],

    //登录状态判断
    'GLOBAL-LOGIN' => [
        'any',
        ['Create-:m-:a', 'Doc-Member-:a', 'Doc-Login-:a'],
        ['\Login']
    ],

    //校验权限
    'CREATE-SLICE' => [
        'any',
        ['Create-:m-:a'],
        ['\Create\Auth']
    ],
    //获取后台菜单
    'CREATE-MENU' => [
        'get',
        ['Create-:m-:a'],
        ['\Create\Menu']
    ],

    //注册自动更新客户分组字段的信息
    'CREATE-UPDATE-MEMBERORGANIZE' => [
        'any',
        ['Create-Member-:a', 'Create-Member_organize-:a'],
        ['\Create\UpdateField\UpdateMemberOrganizeField']
    ],

    //注册理路由规则 添加/编辑 提交的表单内容
    'CREATE-ROUTE-ACTION' => [
        'any',
        ['Create-Route-action'],
        ['\Create\HandleForm\HandleRoute', '\Create\UpdateRoute']
    ],

    //注册自动处理后台会员提交的会员密码表单
    'CREATE-UPDATE-MEMBER-PWD' => [
        'any',
        ['Create-Member-action'],
        ['\Create\HandleForm\HandleMember']
    ],

    //文章前后置方法
    'DOC-ARTICLE-FUNC' => [
        'get',
        ['Doc-Article-index'],
        ['\Doc\Article']
    ],

    'DOC-ARTICLETEMPLATE' => [
        'get',
        ['Doc-Article-index'],
        ['\Doc\ArticleTemplate']
    ],

    //注册全局插件访问入口
    'GLOBAL-APPLICATION-PLUGIN' => [
        'any',
        [':g-Application-Plugin'],
        ['\ApplicationPlugin']
    ],

    //注册插件初始化入口
    'Create-APPLICATION-Init' => [
        'any',
        ['Create-Application-Init'],
        ['\Create\ApplicationInit']
    ],

    //插件全局事件
    'APPLICATION-GLOBAL-EVENT' => [
        'any',
        ['Create-:m-:a', 'Doc-:m-:a'],
        ['\ApplicationGlobalEvent'],
    ],

];

//执行切片注册
foreach ($SLICE_ARRYR as $item){
    $method = $item['0'];
    $exclude = empty($item['3']) ? [] : $item['3'];
    InitSlice::$method($item[1], $item[2], $exclude);
}