<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice;

/**
 * 赋予全站的选项
 */
class Option extends \Core\Slice\Slice{

    public function before() {
        $list = \Model\Content::listContent([
            'table' => 'option',
            'condition' => "option_range = 'system'"
        ]);
        $system = [];
        foreach($list as $value){
            $system[$value['option_name']] = $value['value'];
        }


        $this->assign('resources', substr(md5($system['siteTitle'].substr(md5(self::$config['USER_KEY']), 5, 10). $system['version']), 4, 10));

        $this->assign('system', $system);
    }


    public function after() {
        // TODO: Implement after() method.
    }


}