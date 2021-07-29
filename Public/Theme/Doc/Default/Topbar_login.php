<div class="am-topbar-right">
    <?php if (empty(self::session()->get('doc'))): ?>
        <a href="<?= $label->url('Doc-Login-index') ?>" class="am-btn am-btn-default am-topbar-btn am-btn-sm">登录</a>
        <?php if($system['open_register'] == 1): ?>
        <a href="<?= $label->url('Doc-Login-signup') ?>" class="am-btn am-btn-success am-topbar-btn am-btn-sm am-text-white">注册账号</a>
        <?php endif; ?>
    <?php else: ?>
        <ul class="am-nav am-nav-pills am-topbar-nav">
            <?php if ($label->checkAuth('Create-GET-Doc-index') === true): ?>
                <li>
                    <a href="<?= $label->url('Create-Doc-index') ?>"><i class="am-icon-pencil-square-o am-success"></i> 创作空间</a>
                </li>
            <?php endif; ?>
            <li class="am-dropdown am-dropdown-flip">
                <a class="am-dropdown-toggle" href="javascript:;">
                    <i class="am-icon-btn am-icon-btn-sm am-icon-user"></i>
                    <span class="am-icon-caret-down am-margin-left-xs"></span>
                </a>
                <div class="am-dropdown-layer">
                    <ul class="am-dropdown-content">
                        <li class="am-dropdown-header ">
                            <span class="am-text-default"><?= self::session()->get('doc')['member_name'] ?>, 你好</span>
                        </li>
                        <li class="am-divider"></li>
                        <li><a href="<?= $label->url('Doc-Member-index') ?>"><i class="am-icon-gear"></i> 账号设置</a></li>
                        <li><a href="<?= $label->url('Doc-Login-logout') ?>"><i class="am-icon-sign-out"></i> 退出登录</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    <?php endif; ?>
</div>