<div class="am-g am-g-collapse">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-alert am-alert-secondary am-text-center am-margin-vertical-xs">
            <span class="am-text-xs am-block am-margin-bottom-xs">请将图中的字符输入在验证码输入框</span>
            <img src="<?= $label->url('Index-verify') ?>" class="refresh-verify am-text-center">
        </div>
        <div class="am-form-group">
            <input class="form-text-input input-leng3 am-radius" name="verify" placeholder="验证码" type="text"  maxlength="<?= $system['verifyLength'] ?>" autocomplete="off"  required="">
        </div>
    </div>
</div>