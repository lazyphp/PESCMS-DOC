<?php foreach ($result as $key => $value): ?>
    <tr class="<?= $value['node_is_menu'] == 1 ? 'am-success' : '' ?>">
        <td class="am-text-middle">
            <input type="checkbox" class="checkbox-all-children" name="id[<?= $value["node_id"]; ?>]" value="<?= $value["node_id"]; ?>">
        </td>
        <td class="am-text-middle">
            <input type="text" class="am-input-sm" name="id[<?= $value["node_id"]; ?>]"
                   value="<?= $value["node_listsort"]; ?>">
        </td>

        <td>
            <?= $space == '' ? '' : $space . '<span class="plus_icon ' . ($value['node_id'] == end($result)['node_id'] ? 'plus_end_icon' : '') . ' "></span>' ?>
            <?php if($value['node_is_menu'] == 1): ?>
                <i class="<?= $value['node_menu_icon'] ?>"></i>
            <?php endif; ?>
            <?= $value['node_name'] ?>
            <?php if(!empty($value['node_value'])): ?>
            <sup class="am-text-primary">[<?= $value['node_value'] ?>]</sup>
            <?php endif; ?>
        </td>

        <td><?= $value['node_link'] ?></td>
        <td>
            <?= $value['node_verify'] == 0 ? '否' : '是' ?>
        </td>

        <td class="am-text-middle">
            <a class="am-text-primary" href="<?= $label->url(GROUP . '-' . MODULE . '-action', array('id' => $label->xss($value["node_id"]), 'back_url' => base64_encode($_SERVER['REQUEST_URI']))) ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>

            <i class="am-margin-left-xs am-margin-right-xs">|</i>
            <a class="am-text-danger ajax-click ajax-dialog"  msg="确定删除吗？将无法恢复的！" href="javascript:;" data="<?= $label->url(GROUP . '-' . MODULE . '-action', array('id' => $label->xss($value["node_id"]), 'method' => 'DELETE', 'back_url' => base64_encode($_SERVER['REQUEST_URI']))); ?>"><span class="am-icon-trash-o"></span> 删除</a>
        </td>

    </tr>

    <?php \Model\Node::recursion($value['node_id'], $template, $space . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
<?php endforeach; ?>