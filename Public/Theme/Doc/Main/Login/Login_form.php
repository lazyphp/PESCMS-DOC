<div class="am-u-md-8 am-u-sm-centered" style="padding-top: 8rem;min-height: 35rem">
    <form action="" method="POST" class="ajax-submit" data-am-validator>
        <input type="hidden" name="back_url" value="<?= empty($_GET['back_url']) ? '' : $_GET['back_url']; ?>">
        <ul class="am-list am-list-border">
            <li class="am-padding-sm am-text-xs">
                <a href="/" class="am-inline tm-remove-a-background-color-hover am-padding-0"><?= $system['sitetitle']; ?></a> > <?= $title; ?>
            </li>
            <li class="am-padding-xs am-text-sm">
                帐号
            </li>
            <li>
                <input name="account" class="tm-remove-border tm-input-background-color am-form-field" type="text" placeholder="登录用的帐号" required>
            </li>
            <li class="am-padding-xs am-text-sm">
                密码
            </li>
            <li>
                <input name="passwd" class="tm-remove-border tm-input-background-color am-form-field" type="password" placeholder="登录用的密码" required>
            </li>
            <?php if ($system['verify'] == '1'): ?>
                <li class="am-padding-xs am-text-sm">
                    验证码
                    <span class="am-text-xs">(不分大小写)</span><img src="<?= $label->url('Doc-Login-verify', ['time' => rand(0, 999)]); ?>" class="am-margin-left refresh-verify" height="20"/>
                </li>
                <li>
                    <input name="verify" class="tm-remove-border tm-input-background-color am-form-field" type="text" placeholder="验证码" required>
                </li>
            <?php endif; ?>
            <li class="am-padding-xs am-text-center">
                <button class="am-btn  am-btn-xs am-btn-primary">提交</button>
            </li>
        </ul>
    </form>
</div>