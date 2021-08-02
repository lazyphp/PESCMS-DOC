<main>
    <?php require __DIR__ . '/Article_sideabr.php' ?>

    <!--内容区-->
    <section class="content">
        <article class="am-article">
            <div class="am-article-hd">
                <h1 class="am-article-title"><?= empty($_GET['aid']) ? $doc['doc_title'] : $article_title ?></h1>
                <small>
                    <i class="am-icon-calendar"></i> 创建于 <?= date('Y-m-d', $article_time ?: $doc['doc_createtime']) ?>
                    <?php if ($article_update_time > 0): ?>
                        / <i class="am-icon-edit"></i> 最近更新于 <?= date('Y-m-d', $article_update_time) ?>
                    <?php endif; ?>
                    / <i class="am-icon-desktop"></i> <?= isset($article_view) ? $article_view : $doc['doc_view'] ?>
                </small>
            </div>

            <?php if ($currentVersion != $doc['doc_version']): ?>
                <div class="am-alert am-alert-warning am-text-xs">
                    您当前正在浏览"<b class="am-text-black"><?= $doc['doc_version'] ?></b>"版本文档内容，此版本不是文档正在使用的版本，查阅过程请注意文档内容的时效性。
                </div>
            <?php endif; ?>

            <div class="am-article-bd"><?= empty($article_content) ? $doc['doc_content'] : $article_content ?></div>
            <input type="hidden" class="use-md" value="<?= isset($article_content_editor) ?  $article_content_editor : $doc['doc_content_editor']?>" data="<?= $article_content_editor ?>">

            <div class="pes-like am-text-center am-margin-top">
                <i class="am-icon-thumbs-o-up am-icon-sm am-text-primary"></i>
                <div class="am-margin-top">
                    <span class="pes-like-num"><?= isset($article_like) ? $article_like : $doc['doc_like'] ?></span> 人点赞过
                </div>
            </div>

            <?php if (!empty($page)): ?>
                <hr/>
                <ul class="am-pagination">
                    <?php foreach ($page as $key => $value): ?>
                        <?php if (!empty($value)): ?>
                            <li class="<?= $key == 'next' ? 'am-pagination-next' : 'am-pagination-prev' ?>">
                                <a href="<?= $label->url('Article-index', ['id' => $value['article_doc_id'], 'aid' => $value['article_mark']]) ?>"><?= $key == 'next' ? '下一篇：' : '上一篇：' ?><?= $value['article_title'] ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </article>

    </section>
    <!--内容区-->

    <nav class="title-nav am-show-lg-only">
        <div class="title-nav-hide" title="收起标题导航" data="0"><i class="am-icon-angle-double-left"></i></div>
        <div class="title-nav-content">
            <ul>

            </ul>
        </div>
    </nav>

</main>
<?php require_once __DIR__ . '/Article_indexjs.php' ?>