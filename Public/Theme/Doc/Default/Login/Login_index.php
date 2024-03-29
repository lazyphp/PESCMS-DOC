<form class="am-form  ajax-submit" action="" method="post" data-am-validator>
    <?= $label->token() ?>
    <?= $label->backTo(); ?>
    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">登录账号<i class="am-text-danger">*</i></label>
                <input class="form-text-input input-leng3 am-radius" name="account" placeholder="登录账号" type="text" value="" required="">
            </div>
        </div>
    </div>

    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">登录密码 <i class="am-text-danger">*</i></label>
                <input class="form-text-input input-leng3 am-radius" name="password" placeholder="登录密码" type="password" value="" required="">
            </div>
        </div>
    </div>

    <?php require_once __DIR__.'/Login_verify.php'?>

    <button type="submit" class="am-btn am-btn-success am-btn-block">登录</button>
</form>
<div class="am-text-center am-margin-top pes-login-split">
    <a href="<?= $label->url('Doc-Login-findpw') ?>">找回密码</a>
    <?php if($system['open_register'] == 1): ?>
        <i class="am-margin-horizontal-xs">|</i>
        <a href="<?= $label->url('Doc-Login-signup') ?>">账号注册</a>
    <?php endif; ?>
</div>