<header class="topbar article-topbar">
    <div class="topbar-container">

        <ul class="topbar-menu">

            <li>
                <a href="/"><?= $system['siteTitle'] ?></a>
            </li>


            <li>
                <a href="javascript:;"><?= $doc['doc_title'] ?></a>
            </li>

            <li class="" data-am-dropdown="">
                <a class="am-dropdown-toggle" href="javascript:;"><i class="am-icon-book"></i> 文档列表</a>

                <div class="am-dropdown-content topbar-submenu">
                    <ul>
                        <?php foreach (\Model\Doc::getDocList() as $item): ?>
                            <li class="<?= $item['doc_id'] == $doc['doc_id'] ? 'am-active' : '' ?>">
                                <a href="<?= $label->url('Doc-Article-index', ['id' => $item['doc_id']]) ?>">
                                    <img src="<?= $item['doc_cover'] ?>">
                                    <?= $item['doc_title'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </li>



        </ul>
        <button id="pes-show-article-path" class="am-btn am-btn-sm am-btn-success am-show-sm-only"> <i class="am-icon-bars"></i> 文档目录</button>
        <a href="/" class="am-margin-left-xs am-btn am-btn-sm am-btn-default am-show-sm-only"> <i class="am-icon-home"></i></a>
        <?php require_once THEME_PATH . '/Topbar_login.php' ?>
    </div>
</header>
