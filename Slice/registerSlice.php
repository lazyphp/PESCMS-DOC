<?php
/*
| PESCMS for PHP 5.4+
| @version 2.6
| For the full copyright and license information, please view
| the file LICENSE.md that was distributed with this source code.
|--------------------------------------------------------------------------
| 切片注册
| 程序提供五个方法声明切片绑定的请求类型: any, get, post, put, delete
| 参数一：绑定控制器路由规则。为空则对全局控制器路由生效。
|         不为空，则依次填写 组-模型-方法。 填写组，则绑定组路由下所有方法。如此类推
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

    //全局切片
    'GLOBAL-SLICE' => [
        'any',
        ['Doc-:m-:a'],
        ['\Doc\Option', '\Doc\Tree']
    ],

    //登录切片
    'LOGIN-SLICE' => [
        'any',
        ['Doc-:m-:a'],
        ['\Doc\Login'],
        ['Doc-Login-:a']
    ],

    //注册自动更新路由规则
    'DOC-ROUTE-ACTION' => [
        'get',
        ['Doc-Route-action'],
        ['\Doc\HandleForm\HandleRoute', '\Doc\UpdateRoute']
    ],

    //注册自动处理用户提交的用户密码表单
    'DOC-USER-ACTION' => [
        'any',
        ['Doc-User-action'],
        ['\Doc\HandleForm\HandleUser']
    ],

    //更新UE模板
    'DOC-UETEMPLATE-INDEX' => [
        'get',
        ['Doc-Uetemplate-index'],
        ['\Doc\Uetemplate']
    ],
    
];

//执行切片注册
foreach ($SLICE_ARRYR as $item){
    $method = $item['0'];
    $exclude = empty($item['3']) ? [] : $item['3'];
    InitSlice::$method($item[1], $item[2], $exclude);
}