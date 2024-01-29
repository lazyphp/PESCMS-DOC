<div class="am-container am-margin-top">
    <div class="am-u-sm-12 am-u-lg-centered pes-doc-search">
        <div class="am-g am-margin-bottom-lg am-g-collapse">
            <?php if (MODULE == 'Article'): ?>
                <div class="am-u-lg-12">
                    <h1><?= $title ?></h1>
                    <hr/>
                </div>
            <?php endif; ?>
            <form data-am-validator>
                <div class="am-u-lg-12">

                    <input type="hidden" name="g" value="Doc">
                    <input type="hidden" name="m" value="<?= MODULE ?>">
                    <input type="hidden" name="a" value="<?= ACTION ?>">
                    <?php if (MODULE == 'Article'): ?>
                        <input type="hidden" name="id" value="<?= (int)($_GET['id'] ?? null) ?>">
                    <?php endif; ?>

                    <div class="search-form">
                        <input type="text" name="keyword" class="am-form-field" value="<?= $label->xss($keyword ?? '') ?>" required>
                        <button class="am-btn am-btn-default" type="submit"><span class="am-icon-search"></span> 搜索
                        </button>
                    </div>
                </div>
        </div>
        </form>

        <div class="am-panel am-panel-default pes-search-panel">
            <?php if (empty($list)): ?>
                <div class="am-g">
                    <div class="am-u-sm-12 am-text-center">
                        没有找到与' <?= $label->xss($keyword ?? '') ?> '匹配的结果，请更换其他关键词再试。
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($list as $key => $value): ?>
                    <div class="am-g">
                        <div class="am-u-lg-2 am-text-center">
                            <div class="pes-search-tool">
                                <div>
                                    <i class="am-icon-desktop am-text-warning"></i>
                                    <span class="am-block"><?= $value['article_view'] ?></span>
                                </div>
                            </div>
                            <div class="pes-search-tool">
                                <div>
                                    <i class="am-icon-thumbs-o-up am-text-success"></i>
                                    <span class="am-block"><?= $value['article_like'] ?></span>
                                </div>
                            </div>

                        </div>
                        <div class="am-u-lg-10">
                            <a href="<?= $label->url('Doc-Article-index', ['id' => $value['article_doc_id'], 'aid' => $value['article_mark']]) ?>" target="_blank">
                                <h2 class="am-margin-bottom-sm"><?= $value['article_title'] ?></h2>

                                <div class="pes-search-content"><?= $label->strCut(strip_tags($value['article_content']), 300) ?></div>
                            </a>


                            <div class="am-margin-top am-text-xs">
                                <?php if (MODULE != 'Article'): ?>
                                    <i class="am-icon-book"></i> 「<?= $value['doc_title'] ?>」/
                                <?php endif; ?>

                                <i class="am-icon-calendar"></i> 创建于 <?= date('Y-m-d', $value['article_time']) ?>
                                <?php if ($value['article_update_time'] > 0): ?>
                                    /
                                    <i class="am-icon-edit"></i> 最近更新于 <?= date('Y-m-d', $value['article_update_time']) ?>
                                <?php endif; ?>

                                <?= (new \Core\Plugin\Plugin())->event('searchInfoBar', $value); ?>

                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="am-g">
                    <div class="am-u-sm-12">
                        <ul class="am-pagination am-pagination-left am-margin-0">
                            <?= $page ?? ''; ?>
                        </ul>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>

</div>

