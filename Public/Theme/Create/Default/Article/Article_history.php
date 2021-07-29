<?php foreach($history as $key => $value): ?>
<tr>
    <td class="am-text-middle"><?= $value['history_id'] ?></td>
    <td class="am-text-middle"><?= $value['history_date'] ?><br/><?= $value['history_time'] ?></td>
    <td class="am-text-middle">
        <a href="<?= $label->url('Create-Article-compare', ['id' => $value['history_id']]) ?>" class="history-wp" data-id="<?= $value['article_id'] ?>">对比</a>
        <a href="<?= $label->url('Create-Article-history', ['id' => $value['history_id'], 'method' => 'DELETE']) ?>" class="remove-history" msg="确定删除吗？将无法恢复的！">删除</a>
    </td>
</tr>
<?php endforeach; ?>
