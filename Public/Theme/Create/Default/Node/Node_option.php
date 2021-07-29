<?php foreach ($result as $key => $value): ?>

    <option value="<?= $value['node_id'] ?>"><?= $space == '' ? '' : $space.($value['node_id'] == end($result)['node_id'] ? '└─' : '├─')  ?><?= $value['node_name'] ?></option>

    <?php \Model\Node::recursion($value['node_id'], $template, $space . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
<?php endforeach; ?>
