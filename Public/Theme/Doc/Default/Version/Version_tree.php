<div class=" am-padding-top">

    <div class="am-g">
        <div class="am-u-sm-12">
            <table class="am-table am-table-bordered am-table-striped am-table-hover am-padding-left-0 am-text-sm">
                <?php foreach($treeVersion as $item): ?>
                    <?php if($item['tree_parent'] == 0): ?>
                    <tr class="am-active">
                        <th class="am-text-middle">版本: <?= $item['tree_version'] ?> <?= $item['tree_version'] == $item['current_version'] ? '(当前版本)' : '' ?> </th>
                        <th class="am-text-middle">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <?php if($item['tree_version'] != $item['current_version']): ?>
                                        <a class="am-btn am-btn-success" href=""><span class="am-icon-check-square-o"></span> 设为默认版本</a>
                                    <?php endif; ?>
                                    <a class="am-btn am-btn-warning" href=""><span class="am-icon-clone"></span> 基于此版创建新版本</a>

                                    <a class="am-btn am-btn-secondary update-tree-button" href="javascript:;"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                    <a class="am-btn am-btn-danger ajax-click ajax-dialog" href="" ><span class="am-icon-trash-o"></span> 删除</a>

                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td class="am-text-middle" colspan="2"><?= $item['tree_title'] ?></td>
                    </tr>
                        <?php foreach($treeVersion as $key => $value): ?>
                            <?php if($value['tree_version'] == $item['tree_version'] && $value['tree_parent'] == $item['tree_id']): ?>
                            <tr>
                                <td class="am-text-middle"><span class="plus_icon plus_end_icon"></span><?= $value['tree_title'] ?></td>
                                <td class="am-text-middle">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-secondary update-tree-button" href="javascript:;"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                            <a class="am-btn am-btn-danger ajax-click ajax-dialog" href="" ><span class="am-icon-trash-o"></span> 删除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>