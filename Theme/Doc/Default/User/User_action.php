<?php include THEME_PATH.'/header.php'; ?>
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->url('User-index') ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <form class="am-form" action="<?= $label->url('User-action'); ?>" method="post" data-am-validator>
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="id" value="<?= $id ?>" />
        <input type="hidden" name="back_url" value="<?= $label->url('User-index') ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            会员帐号
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="account" value="<?= $user_account ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            会员密码
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="password" value="" <?= $method == 'POST' ? 'required' : '' ?> >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"><?= $method == 'POST' ? '' : '为空则不修改密码' ?></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            确认密码
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="confirm_password" value="" <?= $method == 'POST' ? 'required' : '' ?> >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            邮箱地址
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="email" class="am-input-sm" name="mail" value="<?= $user_mail ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            姓名
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="name" value="<?= $user_name ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">状态</div>
                        <div class="am-u-sm-8 am-u-md-10">
                            <div class="am-form-group am-margin-bottom-0">
                                <label class="am-radio-inline">
                                    <input type="radio"  value="1" name="status" <?= $user_status == '1' ? 'checked="checked"' : '' ?> required> 是
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" value="0" name="status" <?= $user_status == '0' ? 'checked="checked"' : '' ?>> 否
                                </label>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Team-User-index'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>
<?php include THEME_PATH.'/footer.php'; ?>