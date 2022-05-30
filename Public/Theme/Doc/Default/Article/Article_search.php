<div class="am-container am-margin-top">
    <div class="am-u-sm-12 am-u-lg-centered pes-doc-index">
        <form>
            <div class="am-g am-margin-bottom-lg am-g-collapse">
                <div class="am-u-lg-12">
                    <h1><?= $doc['doc_title'] ?></h1>
                    <hr/>
                </div>
                <div class="am-u-lg-12 am-u-sm-centered">

                    <input type="hidden" name="g" value="Doc">
                    <input type="hidden" name="m" value="Article">
                    <input type="hidden" name="a" value="search">
                    <input type="hidden" name="id" value="<?= $label->xss((int) $_GET['id']); ?>">

                    <div class="am-input-group">
                        <input type="text" name="keyword" class="am-form-field" value="<?= $label->xss($keyword) ?>">
                        <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="button"><span class="am-icon-search"></span> </button>
                    </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="am-panel am-panel-default pes-search-panel">
            <?php if (empty($list)): ?>
                <div class="am-g">
                    <div class="am-u-sm-12 am-text-center">
                        没有找到与' <?= $label->xss($keyword) ?> '匹配的结果，请更换其他关键词再试。
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
                                <h2><?= $value['article_title'] ?></h2>

                                <div class="pes-search-content"><?= $label->strCut(strip_tags($value['article_content']), 300) ?></div>
                            </a>


                            <div class="am-margin-top am-text-xs">
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
            <?php endif; ?>
        </div>
    </div>

</div>

