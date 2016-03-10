<header class="am-topbar am-margin-bottom-0 tm-background-color-white">
    <h1 class="am-topbar-brand">
        <a href="<?= DOCUMENT_ROOT; ?>/"><?= $siteTitle; ?></a>
    </h1>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
            class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    文档列表 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <?php foreach ($treeList as $key => $value): ?>
                        <?php if ($value['tree_parent'] == '0'): ?>
                            <li class="<?= ($key == 0 && empty($_GET['tree'])) || $_GET['tree'] == $value['tree_id'] ? 'am-active' : ''; ?>">
                                <a href="<?= $label->url("Doc-Index-index", ['tree' => $value['tree_id']]); ?>"><?= $value['tree_title']; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
        <form class="am-topbar-form am-topbar-left am-form-inline" method="GET" action="<?= DOCUMENT_ROOT ?>/" role="search">
            <input type="hidden" name="m" value="Search">
            <input type="hidden" name="a" value="index">
            <input type="hidden" name="tree" value="<?= (int) $_GET['tree']; ?>">
            <div class="am-form-group am-input-group">
                <input type="text" class="am-form-field" name="keyword" value="<?= htmlspecialchars($_GET['keyword']); ?>" placeholder="搜索">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="submit"><span class="am-icon-search"></span></button>
                </span>
            </div>
        </form>

        <div class="am-topbar-right">
            <?php if ($login === false): ?>
                <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('Doc-Login-index'); ?>">管理</a>
            <?php else: ?>
                <a class="am-btn am-btn-success am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('Doc-Article-action'); ?>"><i
                        class="am-icon-edit"></i> 新文档</a>
                <a class="am-btn am-btn-warning am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('Doc-Article-manage'); ?>"><i
                        class="am-icon-code-fork"></i> 管理文档</a>
                <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('Doc-Login-logout'); ?>"><i
                        class="am-icon-power-off"></i> 注销</a>
            <?php endif; ?>
        </div>
    </div>
</header>