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
        $mid = $this->session()->get('doc')['member_id'];
        if(empty($mid) && MODULE != 'Login' ){
            $this->jump($this->url('Doc-Login-index', ['back_url' => base64_encode($_SERVER['REQUEST_URI'])]));
        }
        //已登录却停留在登录页相关的，强制跳转至账号设置
        elseif(!empty($mid) && MODULE == 'Login' && ACTION !='logout' ){
            $this->jump($this->url('Doc-Member-index'));
        }
    }

    public function after() {
    }


}