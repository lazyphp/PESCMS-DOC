<div class="am-topbar-right am-text-sm">
    <ul class="am-nav am-nav-pills am-topbar-nav">

        <li>
            <a href="/d/index.html"><i class="am-icon-home"></i> 文档首页</a>
        </li>

        <li class="am-dropdown article-tree" data-am-dropdown>
            <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                <i class="am-icon-list"></i> 文档列表 <span class="am-icon-caret-down"></span>
            </a>
            <ul class="am-dropdown-content">
                <?php foreach ($topBar as $key => $value): ?>
                    <?php if ($value['tree_parent'] == '0'): ?>
                        <li class="<?= ($key == 0 && empty($_GET['tree'])) || $_GET['tree'] == $value['tree_id'] ? 'am-active' : ''; ?>">
                            <a href="<?= $label->url("Doc-Index-home", ['tree' => $value['tree_id']]); ?>"><?= $value['tree_title']; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </li>

        <?php if ($login == false): ?>
            <li>
                <a href="<?= $label->url('Doc-Login-index'); ?>"><i class="am-icon-sign-in"></i> 管理</a>
            </li>
        <?php else: ?>
            <li>
                <a href="<?= $label->url('Doc-Article-action'); ?>"><i class="am-icon-edit"></i> 新文档</a>
            </li>
            <li>
                <a href="<?= $label->url('Doc-Article-manage'); ?>"><i class="am-icon-code-fork"></i> 管理文档</a>
            </li>
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <i class="am-icon-plus"></i> 管理 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li>
                        <a href="<?= $label->url('Doc-User-index'); ?>"><i class="am-icon-user"></i> 用户管理</a>
                    </li>
                    <li>
                        <a href="<?= $label->url('Doc-Route-index'); ?>"><i class="am-icon-map-o"></i> 路由规则</a>
                    </li>
                    <li>
                        <a href="<?= $label->url('Doc-Uetemplate-index'); ?>"><i class="am-icon-television"></i> UE格式模板</a>
                    </li>
                    <li>
                        <a href="<?= $label->url('Doc-Setting-action'); ?>"><i class="am-icon-wrench"></i> 系统设置</a>
                    </li>
                    <li>
                        <a href="https://forum.pescms.com/list/21.html" target="_blank"><i class="am-icon-question"></i> 反馈问题</a>
                    </li>
                    <li>
                        <a href="https://www.pescms.com/Page/Authorization.html" target="_blank"><i class="am-icon-paste"></i> 软件协议</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= $label->url('Doc-Login-logout', ['method' => 'GET']); ?>" class="ajax-click"><i class="am-icon-power-off"></i> 退出帐号</a>
            </li>
        <?php endif; ?>
    </ul>
</div>