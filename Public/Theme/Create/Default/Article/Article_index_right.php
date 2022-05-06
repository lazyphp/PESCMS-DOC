<div class="pes-article-right-sidebar-move"></div>
<a href="javascript:;" class="pes-article-save am-btn am-btn-default"><i class="am-icon-save"></i> 保存
    <small class="am-text-secondary">[Ctrl + 回车]</small></a>
<a href="javascript:;" class="pes-article-delete am-btn am-btn-danger am-hide ajax-click ajax-dialog " msg="确认要删除本文档吗？数据将无法恢复!"><i class="am-icon-remove"></i>
    删除</a>
<div class="am-margin-top-xs pes-article-preview">
    <a href="<?= $label->url('Doc-Article-index', ['id' => $doc['doc_id']]) ?>" class="am-btn am-btn-success" target="_blank"><i class="am-icon-newspaper-o"></i>
        预览</a>
</div>

<div class="pes-sidebar-tool pes-doc-index-tool">

    <table class="am-table am-table-bordered">
        <tr>
            <td colspan="2">版本号</td>
        </tr>
        <?php foreach ($docVersion as $key => $value): ?>
            <tr>
                <td><?= $value['version_number'] ?></td>
                <td>
                    <?php if ($value['version_number'] == $doc['doc_version']): ?>
                        当前
                    <?php else: ?>
                        <a href="javascript:;" data="<?= $label->url('Create-Doc-version', ['vid' => $value['version_id'], 'id' => $doc['doc_id'], 'method' => 'PUT']) ?>" class="ajax-click ajax-dialog" msg="确认要切换至'<?= $value['version_number'] ?>'版本吗？"><i class="am-icon-check"></i></a>

                        <a href="javascript:;" data="<?= $label->url('Create-Doc-version', ['vid' => $value['version_id'], 'id' => $doc['doc_id'], 'method' => 'DELETE']) ?>" class="ajax-click ajax-dialog" msg="确认要移除至'<?= $value['version_number'] ?>'版本吗？数据无法恢复!"><i class="am-icon-remove"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
        <tr>
            <th class="am-text-center" colspan="2">新版号</th>
        </tr>
        <tr>
            <td colspan="2" data-am-popover="{content: '勾选此选项，新版的文档首页和目录将为空。', trigger: 'hover focus'}">
                <div class="am-form-group am-margin-0">
                    <label class="am-checkbox-inline">
                        <input type="checkbox" class="empty-version" value="1"> 空文档
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="am-padding-horizontal-0" colspan="2">
                <input type="text" class="version-number am-margin-bottom" >
                <button class="am-btn am-btn-primary am-btn-xs submit-version"><i class="am-icon-plus"></i> 创建</button>
            </td>
        </tr>
        </tfoot>

    </table>
</div>

<div class="pes-sidebar-tool pes-doc-article-tool">
    <input type="hidden" id="history-result">

    <div class="pes-history-list"></div>


</div>