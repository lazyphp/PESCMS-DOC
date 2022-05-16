<form class="am-form ajax-submit" action="" method="post" data-am-validator>
    <?= $label->token() ?>
    <input type="hidden" name="back_url" value="<?= $label->xss($_GET['back_url'] ?? null) ?>">
    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">登录账号<i class="am-text-danger">*</i></label>
                <input class="form-text-input input-leng3 am-radius" name="account" placeholder="请输入您要找回密码的登录账号" type="text" value="" required="">
            </div>
        </div>
    </div>

    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">安全密钥<i class="am-text-danger">*</i></label>
                <input class="form-text-input input-leng3 am-radius" name="secret_key" placeholder="请输入您账号注册时保存的安全密钥" type="text" value="" required="">
            </div>
        </div>
    </div>

    <?php require_once __DIR__.'/Login_verify.php'?>

    <button type="submit" class="am-btn am-btn-danger am-btn-block">查找</button>
</form>
<div class="am-text-left am-margin-top am-margin-left-lg pes-login-split">
    <a href="<?= $label->url('Doc-Login-index') ?>"><< 返回登录</a>
</div>