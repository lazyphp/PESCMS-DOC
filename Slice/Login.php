<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice;

class Login extends \Core\Slice\Slice{

    public function before() {
        $mid = $this->session()->get('doc')['member_id'] ?? null;

        if(empty($mid) && MODULE != 'Login' ){

            /**
             * ajax 请求不能带上back_url。因为这些请求不一定是模板渲染界面
             * 重定向过去会提示很别扭的信息，或者404页面之类的。
             */
            $url = \Core\Func\CoreFunc::X_REQUESTED_WITH() == true ? '' : base64_encode($_SERVER['REQUEST_URI']);

            $this->jump($this->url('Doc-Login-index', ['back_url' => $url]), '未登录或登录状态已失效，系统将您为引导到登录页面。');
        }
        //已登录却停留在登录页相关的，强制跳转至账号设置
        elseif(!empty($mid) && MODULE == 'Login' && ACTION !='logout' ){
            $this->jump($this->url('Doc-Member-index'), '您已登录系统，系统将为重定向首页。');
        }
    }

    public function after() {
    }


}