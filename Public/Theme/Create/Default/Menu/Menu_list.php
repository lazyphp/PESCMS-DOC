<?php foreach ($result as $key => $value): ?>
    <tr>
        <td class="am-text-middle">
            <input type="checkbox" class="checkbox-all-children" name="id[<?= $value["menu_id"]; ?>]" value="<?= $value["menu_id"]; ?>">
        </td>
        <td class="am-text-middle">
            <input type="text" class="am-input-sm" name="id[<?= $value["menu_id"]; ?>]"
                   value="<?= $value["menu_listsort"]; ?>">
        </td>

        <td><?= $space == '' ? '' : $space . '<span class="plus_icon ' . ($value['menu_id'] == end($result)['menu_id'] ? 'plus_end_icon' : '') . ' "></span>' ?><?= $value['menu_name'] ?></td>

        <td><?= $value['menu_link'] ?></td>
        <td><?= $label->getFieldOptionToMatch(25, $value['menu_type']); ?></td>

        <td class="am-text-middle">
            <a class="am-text-primary" href="<?= $label->url(GROUP . '-' . MODULE . '-action', array ('id' => $label->xss($value["menu_id"]), 'back_url' => base64_encode($_SERVER['REQUEST_URI']))) ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>

            <i class="am-margin-left-xs am-margin-right-xs">|</i>
            <a class="am-text-danger ajax-click ajax-dialog" msg="确定删除吗？将无法恢复的！" href="javascript:;" data="<?= $label->url(GROUP . '-' . MODULE . '-action', array ('id' => $label->xss($value["menu_id"]), 'method' => 'DELETE', 'back_url' => base64_encode($_SERVER['REQUEST_URI']))); ?>"><span class="am-icon-trash-o"></span> 删除</a>
        </td>

    </tr>

    <?php if ($value['menu_type'] == 2): ?>
        <?php foreach (\Model\Doc::getDocList() as $doc): ?>
            <tr>
                <td></td>
                <td></td>
                <td colspan="4">
                    <?= $space ?><span class="plus_icon <?= end(\Model\Doc::getDocList()) == $doc ? 'plus_end_icon' : '' ?>"></span><?= $doc['doc_title'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <?php \Model\Menu::recursion($value['menu_id'], $template, $space . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
    <?php endif; ?>


<?php endforeach; ?>