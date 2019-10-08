<div class="am-padding am-padding-top">
    <div class="am-cf">
        <div class="am-fl am-cf">
            <?php if (!empty($_GET['back_url'])): ?>
                <a href="<?= base64_decode($_GET['back_url']) ?>" class="am-margin-right-xs am-text-danger"><i
                            class="am-icon-reply"></i>返回</a>
            <?php endif; ?>
            <strong class="am-text-primary am-text-lg"><a href="javascript:;">版本管理</a>
            </strong> /
            <small>列表</small>
        </div>
    </div>
    <hr />
    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12">
            <table class="am-table am-table-bordered am-table-striped am-table-hover am-padding-left-0 am-text-sm">
                <?php foreach($treeVersion as $item): ?>
                    <?php if($item['tree_parent'] == 0): ?>
                    <tr class="am-active">
                        <th class="am-text-middle">版本: <?= $item['tree_version'] ?> <?= $item['tree_version'] == $item['current_version'] ? '(当前版本)' : '' ?> </th>
                        <th class="am-text-middle">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="javascript:;" class="am-btn am-btn-warning create-version" data="<?= $item['tree_version'] ?>"><span class="am-icon-clone"></span> 基于此版创建新版本</a>
                                    <a href="<?= $label->url('Doc-Version-cover', ['id' => $item['tree_id'], 'version' => $item['tree_version'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>" class="am-btn am-btn-secondary"><span class="am-icon-book"></span> 设置封面</a>
                                    
                                    <?php if($item['tree_version'] != $item['current_version']): ?>
                                        <a href="<?= $label->url('Doc-Version-setDefault', ['id' => $item['tree_id'], 'version' => $item['tree_version'], 'method' => 'PUT']) ?>" class="am-btn am-btn-success ajax-click ajax-dialog" msg="确认要设置此版本为默认版本吗?"><span class="am-icon-check-square-o"></span> 设为默认版本</a>
                                        <a class="am-btn am-btn-danger ajax-click ajax-dialog" msg="确实要移除此版本吗?数据将被彻底删除!" href="<?= $label->url('Doc-Version-remove', ['id' => $item['tree_id'], 'version' => $item['tree_version'], 'method' => 'DELETE']) ?>" ><span class="am-icon-trash-o"></span> 移除此版本</a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td class="am-text-middle" colspan="2"><?= $item['tree_version_title'] ?></td>
                    </tr>
                        <?php foreach($treeVersion as $key => $value): ?>
                            <?php if($value['tree_version'] == $item['tree_version'] && $value['tree_parent'] == $item['tree_id']): ?>
                            <tr>
                                <td class="am-text-middle" colspan="2"><span class="plus_icon plus_end_icon"></span><?= $value['tree_version_title'] ?></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<form id="create-version" class="ajax-submit" action="<?= $label->url('Doc-Version-_new', ['id' => $_GET['id']]) ?>" method="POST">
    <input type="hidden" name="use_version" value="">
    <input type="hidden" name="new_version" value="">
</form>
<script>
    $(function(){
        $('body').on('click', '.create-version', function(){
            var use_version = $(this).attr('data');
            var d = dialog({
                width: '25rem',
                title: '请输入新的版本号',
                content: '<p>当前基于'+use_version+'版本号创建新版</p><p><input class="am-form-field" type="text" name="new_version_dialog" maxlength="12" /></p><p class="am-text-warning am-text-xs">注：版本号中，请勿填写符号“|”，否则将影响部分功能<p>',
                okValue: '确定',
                ok: function () {
                    var new_version = $('input[name=new_version_dialog]').val();
                    if(new_version == ''){
                        alert('请输入版本号');
                        return false;
                    }

                    $('input[name=use_version]').val(use_version)
                    $('input[name=new_version]').val(new_version)
                    $('#create-version').submit();
                },
                cancelValue: '取消',
                cancel: function () {}
            });
            d.showModal();
        })
    })
</script>