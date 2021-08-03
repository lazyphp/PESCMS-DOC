<header class="am-topbar am-topbar-fixed-top pes-article-topbar">
    <h1 class="am-topbar-brand">
        <a href="javascript:;"><?= $doc['doc_title'] ?></a>
    </h1>
    <a href="/" class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-default am-show-sm-only"> <i class="am-icon-home"></i></a>
    <button id="pes-show-article-path" class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"> <i class="am-icon-bars"></i> 文档目录</button>

    <div class="am-collapse am-topbar-collapse am-topbar-hover">
        <ul class="am-nav am-nav-pills am-topbar-nav pes-article-nav">
            <li class="am-dropdown">
                <a href="/"><?= $system['siteTitle'] ?></a>
            </li>

            <li class="am-dropdown">
                <a class="am-dropdown-toggle" href="<?= $label->url('Doc-Article-index', ['id' => $doc['doc_id']]) ?>"><?= $doc['doc_title'] ?></a>
                <div class="am-dropdown-layer">
                    <ul class="am-dropdown-content">
                        <?php foreach(\Model\Doc::getDocList() as $item): ?>
                            <li class="<?= $item['doc_id'] == $doc['doc_id'] ? 'am-active' : '' ?>">
                                <a href="<?= $label->url('Doc-Article-index', ['id' => $item['doc_id']]) ?>"><?= $item['doc_title'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>

            <?php if(!empty($article_title)): ?>
                <li>
                    <a class="pes-article-nav-title" href="javascript:;"><?= $article_title ?></a>
                </li>
            <?php endif; ?>

        </ul>


        <?php require_once THEME_PATH.'/Topbar_login.php'?>
    </div>
</header>