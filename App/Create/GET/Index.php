<?php

/**
 * 版权所有 2023 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\GET;

class Index extends \Core\Controller\Controller {

    public function clean() {
        $result = \Model\Extra::clearDirAllFile();
        if ($result['status'] == 200) {
            $this->success('缓存已清空完毕');
        } else {
            $this->error($result['msg']);
        }
    }

}