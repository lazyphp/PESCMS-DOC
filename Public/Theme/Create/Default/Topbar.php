<header class="am-topbar">
    <h1 class="am-topbar-brand">
        <a href="<?= DOCUMENT_ROOT ?>"><?= $system['siteTitle'] ?></a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#doc-topbar-collapse'}">
        <span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse am-topbar-hover " id="doc-topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav">
            <?php if (!empty($menu)): ?>
                <?php foreach ($menu as $item): ?>
                    <?php if (empty($item['child'])): ?>
                        <li>
                            <a href="<?= empty($item['node_link']) ? 'javascript:;' : ($item['node_link_type'] == 0 ? $label->url($item['node_link']) : $item['node_link']) ?>"><i
                                        class="<?= $item['node_menu_icon'] ?>"></i> <?= $item['node_name'] ?></a>
                        </li>
                    <?php else: ?>
                        <li class="am-dropdown">
                            <a class="am-dropdown-toggle" href="javascript:;">
                                <i class="<?= $item['node_menu_icon'] ?>"></i> <?= $item['node_name'] ?> <span
                                        class="am-icon-caret-down"></span>
                            </a>
                            <div class="am-dropdown-layer">
                                <ul class="am-dropdown-content">
                                    <?php foreach ($item['child'] as $key => $value): ?>
                                        <li>
                                            <a href="<?= $value['node_link_type'] == 0 ? $label->url($value['node_link']) : $value['node_link'] ?>"><i
                                                        class="<?= $value['node_menu_icon'] ?>"></i> <?= $value['node_name'] ?>
                                            </a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php elseif(MODULE == 'Setting' && in_array(ACTION, ['atUpgrade', 'mtUpgrade']) ): ?>
                <li>
                    <a class="am-dropdown-toggle" href="<?= $label->url('Create-Setting-upgrade') ?>">
                        <i class="am-icon-reply"></i> 返回检查升级
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="am-topbar-right">
            <ul class="am-nav am-nav-pills am-topbar-nav">
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
                            <li><a href="<?= $label->url('Doc-Member-index') ?>"><i class="am-icon-gear"></i> 账号设置</a>
                            </li>
                            <li><a href="<?= $label->url('Doc-Login-logout') ?>"><i class="am-icon-sign-out"></i>
                                    退出登录</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>