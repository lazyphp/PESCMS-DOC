<?php foreach ($result as $key => $value): ?>
    <tr class="<?= $value['node_is_menu'] == 1 ? 'am-success' : '' ?>">
        <td>
            <label class="am-margin-0" style="font-weight: normal;display: block">
                <?= $space == '' ? '' : $space . '<span class="plus_icon ' . ($value['node_id'] == end($result)['node_id'] ? 'plus_end_icon' : '') . ' "></span>' ?>
                <input type="checkbox" class="checkbox-all-children" name="id[<?= $value["node_id"]; ?>]" value="<?= $value["node_id"]; ?>" data-parent="<?= $value['node_parent'] ?>" data-id="<?= $value['node_id'] ?>" >
                <?= $value['node_name'] ?>
                <?php if(!empty($value['node_value'])): ?>
                    <sup class="am-text-primary">[<?= $value['node_value'] ?>]</sup>
                <?php endif; ?>
            </label>
        </td>

        <td><?= $value['node_link'] ?></td>

    </tr>

    <?php \Model\Node::recursion($value['node_id'], $template, $space . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
<?php endforeach; ?>