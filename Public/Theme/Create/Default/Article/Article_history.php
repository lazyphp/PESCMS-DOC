<form action="<?= $label->url('Create-Article-pageVersionSort') ?>" method="POST">
    <input type="hidden" name="method" value="PUT" >
    <table class="am-table am-table-bordered am-text-center">
        <tr class="am-active">
            <td colspan="3">页内版本管理</td>
        </tr>

        <tr class="am-active">
            <td class="am-text-center">页内版号</td>
            <td class="am-text-center" colspan="2"><input type="text" class="article-version-number" size="5"></td>
        </tr>
        <tr class="am-active">
            <td class="am-text-center">权重</td>
            <td class="am-text-center" colspan="2"><input type="text" class="article-version-sort" size="5"></td>
        </tr>
        <tr class="am-active">
            <td class="am-padding-horizontal-0" colspan="3">
                <button class="am-btn am-btn-primary am-btn-xs submit-article-version" data="<?= (int) $_GET['aid'] ?>"><i class="am-icon-plus"></i> 创建</button>
            </td>
        </tr>


        <?php if (!empty($version)): ?>
            <tr>
                <th class="am-text-middle am-text-center">权重</th>
                <th class="am-text-middle am-text-center">版本号</th>
                <th class="am-text-middle am-text-center">操作</th>
            </tr>

            <?php foreach ($version as $key => $value): ?>
                <?php if(empty($value['history_version'])){continue;}  ?>
                <tr>
                    <td class="am-text-middle"><input type="text" name="history_id[<?= $value['history_id'] ?>]" value="<?= $value['history_version_listsort'] ?>" size="1"></td>
                    <td class="am-text-middle"><?= $value['history_version'] ?></td>
                    <td class="am-text-middle">
                        <a href="<?= $label->url('Create-Article-compare', ['id' => $value['history_id']]) ?>" class="history-wp" data-id="<?= $value['article_id'] ?>">对比</a>
                        <a href="<?= $label->url('Create-Article-history', ['id' => $value['history_id'], 'method' => 'DELETE']) ?>" class="remove-history" msg="确定删除吗？将无法恢复的！">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td class="am-padding-horizontal-0" colspan="3">
                    <button class="am-btn am-btn-primary am-btn-xs submit-article-version-sort" data="<?= (int) $_GET['aid'] ?>"><i class="am-icon-plus"></i> 排序</button>
                </td>
            </tr>

        <?php else: ?>
            <tr>
                <td colspan="3">暂无</td>
            </tr>
        <?php endif; ?>

    </table>
</form>


<table class="am-table am-table-bordered am-text-xs pes-history">
    <tr>
        <td colspan="3">文档操作历史</td>
    </tr>
    <tr class="pes-history-title">
        <td>历史</td>
        <td>时间</td>
        <td>操作</td>
    </tr>
    <?php if (!empty($history)): ?>
        <?php foreach ($history as $key => $value): ?>
            <?php if(!empty($value['history_version'])){continue;}  ?>
            <tr>
                <td class="am-text-middle"><?= $value['history_id'] ?></td>
                <td class="am-text-middle"><?= $value['history_date'] ?><br/><?= $value['history_time'] ?></td>
                <td class="am-text-middle">
                    <a href="<?= $label->url('Create-Article-compare', ['id' => $value['history_id']]) ?>" class="history-wp" data-id="<?= $value['article_id'] ?>">对比</a>
                    <a href="<?= $label->url('Create-Article-history', ['id' => $value['history_id'], 'method' => 'DELETE']) ?>" class="remove-history" msg="确定删除吗？将无法恢复的！">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">暂无</td>
        </tr>
    <?php endif; ?>
</table>


