<form class="am-form  ajax-submit" action="" method="post" data-am-validator>
    <?= $label->token() ?>
    <input type="hidden" name="back_url" value="<?= $label->xss($_GET['back_url']) ?>">
    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">新密码<i class="am-text-danger">*</i></label>
                <input class="am-radius" name="password" placeholder="新密码" type="password" value="" required>
            </div>
        </div>
    </div>
    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">确认密码<i class="am-text-danger">*</i></label>
                <input class="am-radius" name="repassword" placeholder="确认密码" type="password" value="" required>
            </div>
        </div>
    </div>

    <?php require_once __DIR__.'/Login_secret_key.php'?>

    <?php require_once __DIR__.'/Login_verify.php'?>

    <button type="submit" class="am-btn am-btn-danger am-btn-block">重置账号密码</button>
</form>