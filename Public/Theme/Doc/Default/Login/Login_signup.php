<form class="am-form  ajax-submit" action="" method="post" data-am-validator>
    <?= $label->token() ?>
    <input type="hidden" name="back_url" value="<?= $label->xss($_GET['back_url'] ?? '') ?>">
    <?php foreach ($field as $key => $value) : ?>
        <div class="am-g am-g-collapse">
            <div class="am-u-sm-12 am-u-sm-centered">
                <div class="am-form-group">
                    <label class="am-block"><?= $value['field_display_name'] ?><?= $value['field_required'] == '1' ? '<i class="am-text-danger">*</i>' : '' ?></label>
                    <?= $form->formList($value); ?>
                    <?php if (!empty($value['field_explain'])): ?>
                        <div class="pes-alert pes-alert-info">
                            <i class="am-icon-lightbulb-o"></i> <?= $value['field_explain'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($value['field_name'] == 'account'): ?>
            <div class="am-g am-g-collapse">
                <div class="am-u-sm-12 am-u-sm-centered">
                    <div class="am-form-group">
                        <label class="am-block"><?= $password['field_display_name'] ?><i class="am-text-danger">*</i></label>
                        <input class="form-text-input input-leng3 am-radius" name="password" placeholder="<?= $password['field_display_name'] ?>" type="password" value="" required="">
                    </div>
                </div>
            </div>
            <div class="am-g am-g-collapse">
                <div class="am-u-sm-12 am-u-sm-centered">
                    <div class="am-form-group">
                        <label class="am-block">确认密码<i class="am-text-danger">*</i></label>
                        <input class="form-text-input input-leng3 am-radius" name="repassword" placeholder="确认密码" type="password" value="" required="">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php require_once __DIR__.'/Login_secret_key.php'?>

    <?php require_once __DIR__.'/Login_verify.php'?>

    <button type="submit" class="am-btn am-btn-success am-btn-block">注册</button>
</form>
<div class="am-text-left am-margin-top am-margin-left-lg pes-login-split">
    <a href="<?= $label->url('Doc-Login-index') ?>"><< 返回登录</a>
</div>