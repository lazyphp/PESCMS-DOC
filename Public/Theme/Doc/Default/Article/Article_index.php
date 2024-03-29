<main>
    <?php require __DIR__ . '/Article_sideabr.php' ?>

    <!--内容区-->
    <section class="content">
        <article class="am-article">
            <div class="am-article-hd">
                <h1 class="am-article-title ">
                    <?= empty($_GET['aid']) ? $doc['doc_title'] : $article_title ?>
                    <i class="am-icon-link article-copy-link" title="复制链接"></i>
                </h1>
                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-lg-9"><small>
                            <i class="am-icon-calendar"></i>
                            创建于 <?= date('Y-m-d', $article_time ?? $doc['doc_createtime']) ?>
                            <?php if (!empty($article_update_time) && $article_update_time > 0): ?>
                                / <i class="am-icon-edit"></i> 最近更新于 <?= date('Y-m-d', $article_update_time) ?>
                            <?php endif; ?>
                            /
                            <i class="am-icon-desktop"></i> <?= isset($article_view) ? $article_view : $doc['doc_view'] ?>

                            <?php if (!empty($articleVersion)): ?>
                                / <span class="am-text-warning"><i class="am-icon-lightbulb-o"></i> 本页文档可切换别的版本</span>
                                <select class="switch-article-version" style="margin-top: -2px"
                                        data-aid="<?= $article_mark ?>" data-id="<?= $doc['doc_id'] ?>">
                                    <option>当前版本</option>
                                    <?php foreach ($articleVersion as $value): ?>
                                        <option value="<?= $value['history_version'] ?>" <?= !empty($_GET['version']) && $_GET['version'] == $value['history_version'] ? 'selected="selected"' : '' ?> ><?= $value['history_version'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>

                            <?php if (!empty(self::session()->get('doc')['member_id']) && $label->checkAuth('Create-GET-Article-index') === true): ?>
                                /
                                <a href="<?= $label->url('Create-Article-index', ['id' => $doc['doc_id'], 'aid' => $article_id ?? '']) ?>">[编辑本文档]</a>
                            <?php endif; ?>

                            <?= (new \Core\Plugin\Plugin())->event('articleColumn', NULL); ?>

                        </small></div>
                    <div class="am-u-sm-12 am-u-lg-3 am-text-right">
                        <i class="am-icon-font"></i>字体：
                        <span class="font-set" data="0">[默认]</span>
                        <span class="font-set" data="3">[大]</span>
                        <span class="font-set" data="6">[更大]</span>
                    </div>
                </div>

            </div>

            <?php if ($currentVersion != $doc['doc_version']): ?>
                <div class="am-alert am-alert-warning am-text-xs">
                    您当前正在浏览"<b class="am-text-black"><?= $doc['doc_version'] ?></b>"版本文档内容，此版本不是文档正在使用的版本，查阅过程请注意文档内容的时效性。
                </div>
            <?php endif; ?>

            <?= (new \Core\Plugin\Plugin())->event('articleContentBefore', NULL); ?>

            <div class="am-article-bd"><?= (str_replace($articleTemplate['replace'], $articleTemplate['ue'], empty($article_content) ? $doc['doc_content'] : $article_content)) ?></div>

            <?= (new \Core\Plugin\Plugin())->event('articleContentAfter', NULL); ?>

            <input type="hidden" class="use-md" value="<?= $article_content_editor ?? $doc['doc_content_editor'] ?>"
                   data="<?= $article_content_editor ?? '' ?>">


            <div class="pes-like am-text-center am-margin-top">
                <i class="am-icon-thumbs-o-up am-icon-sm am-text-primary"></i>
                <div class="am-margin-xs">
                    <span class="pes-like-num"><?= $article_like ?? $doc['doc_like'] ?></span> 人点赞过
                </div>
            </div>

            <?php if (!empty($doc['doc_copyright'])): ?>
                <div class="pes-doc-copyright">
                    <?= htmlspecialchars_decode($doc['doc_copyright']) ?>
                </div>
            <?php endif; ?>

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

    <nav class="title-nav am-show-lg-only" data="<?= $doc['doc_open_nav'] ?>">
        <div class="title-nav-hide" title="<?= $doc['doc_open_nav'] == '0' ? '展开标题导航' : '收起标题导航' ?>"
             data="<?= $doc['doc_open_nav'] == '0' ? '1' : '0' ?>">
            <i class="am-icon-angle-double-left"></i></div>
        <div class="title-nav-content">
            <ul>

            </ul>
        </div>
    </nav>

</main>
<?php if (($article_content_editor ?? $doc['doc_content_editor']) == 0): ?>
    <link rel="stylesheet"
          href="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/highlight.js/styles/github.css?v=<?= $resources ?>">
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/highlight.js/highlight.pack.js?v=<?= $resources ?>"></script>
    <script>
        document.querySelectorAll('pre').forEach((el) => {
            //代码高亮
            hljs.highlightElement(el);

            //设置父层定位属性
            el.setAttribute('style', 'position: relative;');
            //追加一层dev元素，复制按钮
            var divElement = document.createElement("div");
            divElement.setAttribute('style', 'position: absolute; top: 15px; right: 20px');
            divElement.className = "pes-code-copy";

            //复制代码相关按钮
            divElement.innerHTML = '<i class="am-icon-copy" title="复制" onclick="this.previousElementSibling.select();document.execCommand(\'copy\')"></i>';

            //创建保存复制内容的文本框
            var textarea = document.createElement("textarea");
            textarea.setAttribute('style', 'position: absolute; left: -999999px')
            //写入复制内容的版本
            textarea.value = el.innerText
            divElement.insertAdjacentElement("afterbegin", textarea);

            //将复制按钮相关元素追加到代码块内
            el.insertAdjacentElement("afterbegin", divElement);
        });

        $(document).on('click', '.pes-code-copy', function () {
            let copyDialog = dialog({
                align: 'left',
                content: '已复制',
                skin: 'submit-warning',
                quickClose: true
            })
            copyDialog.show($(this)[0]);
        })

    </script>
<?php endif; ?>
<?php require_once __DIR__ . '/Article_indexjs.php' ?>