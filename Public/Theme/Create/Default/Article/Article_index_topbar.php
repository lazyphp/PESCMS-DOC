<header class="am-topbar">
    <h1 class="am-topbar-brand">
        <a href="/"><?= $system['siteTitle'] ?></a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}">
        <span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse am-topbar-hover " id="doc-topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li>
                <a class="am-dropdown-toggle" href="<?= empty($_GET['back_url']) ? $label->url('Create-Doc-index') : base64_decode($_GET['back_url']) ?>">
                    <i class="am-icon-reply"></i> 返回文档管理
                </a>
            </li>

            <li class="am-dropdown">
                <a class="am-dropdown-toggle" href="<?= empty($_GET['back_url']) ? $label->url('Create-Doc-index') : base64_decode($_GET['back_url']) ?>">
                    <span class="am-icon-list"></span> 文档列表 <span class="am-icon-caret-down"></span>
                </a>
                <div class="am-dropdown-layer">
                    <ul class="am-dropdown-content">
                        <?php foreach (\Model\Doc::getDocList() as $item): ?>
                            <li class="<?= $item['doc_id'] == $_GET['id'] ?>">
                                <a href="<?= $label->url('Create-Article-index', ['id' => $item['doc_id']]) ?>" target="_blank"><?= $item['doc_title'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>

            <li>
                <a class="am-dropdown-toggle" href="<?= $label->url('Create-Article_template-index') ?>" target="_blank">
                    <i class="am-icon-bookmark"></i> 文档通用模板
                </a>
            </li>

        </ul>
    </div>
</header>