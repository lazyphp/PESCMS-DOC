<?php foreach ($result as $key => $value): ?>

    <option value="<?= $value['menu_id'] ?>" <?= $value['menu_type'] == 2 ? 'disabled="disabled"' : '' ?> >
        <?= $space == '' ? '' : $space.($value['menu_id'] == end($result)['menu_id'] ? '└─' : '├─')  ?>
        
        <?= $value['menu_name'] ?>
    </option>

    <?php \Model\Menu::recursion($value['menu_id'], $template, $space . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
<?php endforeach; ?>
