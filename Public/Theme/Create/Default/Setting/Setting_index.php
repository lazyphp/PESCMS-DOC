<div class="admin-content am-padding-xs am-padding-top-0 am-padding-bottom-0">

    <form class="am-form am-form-horizontal ajax-submit" action="" method="post" data-am-validator>
        <?= $label->token() ?>
        <input type="hidden" name="method" value="PUT">

        <div class="am-tabs" data-am-tabs="{noSwipe: 1}">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <?php foreach(array_keys($option) as $k => $name): ?>
                    <li class="<?= $k == 0 ? 'am-active' : '' ?>"><a href="#tab_<?=$name?>"><?= $name ?></a></li>
                <?php endforeach; ?>
                <li class="am-active">
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius" ><i class="am-icon-save"></i> 保存设置</button>
                </li>
            </ul>

            <div class="am-tabs-bd">
                <?php foreach ($option as $subtitle => $item): ?>
                    <div class="am-tab-panel am-fade <?= $subtitle == '网站信息' ? 'am-in am-active' : ''?>" id="tab_<?= $subtitle ?>">

                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                <?php foreach ($item as $key => $value): ?>
                                    <div class="am-g am-g-collapse">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block"><?= $value['field_display_name'] ?><?= $value['field_required'] == '1' ? '<i class="am-text-danger">*</i>' : '' ?></label>
                                                <?= $form->formList($value); ?>
                                                <?php if (!empty($value['field_explain'])): ?>
                                                    <div class="am-alert am-alert-warning">
                                                        <i class="am-icon-lightbulb-o"></i> <?= $value['field_explain'] ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($value['field_name'] == 'authorize'): ?>
                                                    <div class="am-alert">
                                                        当前域名：<?= empty($_SERVER['HTTP_HOST']) ? '获取当前域名失败' : $_SERVER['HTTP_HOST'] ?>，请确认您的授权码绑定的域名和当前程序显示的域名一致，否则授权校验会失败。
                                                        <?php if(!empty($value['value'])): ?>
                                                            | 授权校验结果：
                                                            <?php if($system['is_authorize'] == 'right'): ?>
                                                                <span><i class="am-icon-check"></i></span>
                                                            <?php else: ?>
                                                                <span id="authorize_result"><i class="am-icon-spinner am-icon-spin"></i></span>
                                                            <?php endif; ?>

                                                        <?php endif; ?>
                                                    </div>
                                                <?php elseif($value['field_name'] == 'max_upload_size'): ?>
                                                    <div class="am-alert am-alert-success">
                                                        当前PHP.ini配置最大上传容量: <?= ini_get('max_file_uploads') ?>M
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <button type="submit" class="am-btn am-btn-default am-radius" ><i class="am-icon-save"></i> 保存设置</button>

                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>



    </form>

</div>
<script>
    $(function (){
        $('#authorize_result').each(function (){
            var dom = $(this);
            $.getJSON('<?= $label->url('Create-Setting-checkAuthorize', ['t' => time()]) ?>&tt='+Math.random(), function (res){
                if(res.status == 200){
                    dom.html('<i class="am-icon-check"></i>')
                }else{
                    dom.html('<i class="am-icon-remove"></i> '+res.msg)
                }
            })
        })
    })
</script>