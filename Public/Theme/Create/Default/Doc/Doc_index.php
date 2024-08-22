<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include $tool_column; ?>
<form class="ajax-submit" action="<?= $label->url(GROUP . '-' . MODULE . '-listsort'); ?>" method="POST">
    <input type="hidden" name="method" value="PUT"/>
    <?= $label->token() ?>
    <ul class="am-avg-sm-1 am-avg-lg-5 am-thumbnails pes-doc-table">
        <?php foreach ($list as $key => $value): ?>
            <li>
                <div class="am-panel am-panel-default ">
                    <div class="am-panel-bd">
                        <div class="am-checkbox pes-doc-title-column">
                            <label>
                                <input class="checkbox-all-children" type="checkbox" name="id[<?= $value["doc_id"]; ?>]"
                                       value="<?= $value["doc_id"]; ?>">
                                <?= $value['doc_title'] ?> <?= $value['doc_open'] == 1 ? '<i class="am-icon-users" data-am-popover="{content: \'本文档需要登录查询\', trigger: \'hover\'}"></i>' : '' ?>
                            </label>
                            <a href="<?= $label->url('Doc-Article-index', ['id' => $value['doc_id']]) ?>"
                               target="_blank"><i class="am-icon-external-link"></i> 预览</a>
                        </div>
                        <hr/>
                        <div class="am-text-center">
                            <div class="pes-doc-cover"
                                 style="background-image: url('<?= $value['doc_cover'] ?>')"></div>
                        </div>
                    </div>

                    <div class="am-padding">
                        <hr/>
                        <div class="am-g am-g-collapse">
                            <div class="am-u-sm-4">
                                <time class="time am-text-middle"><?= date('Y-m-d', $value['doc_createtime']) ?></time>
                            </div>
                            <div class="am-u-sm-8 am-text-right">

                                <div class="am-dropdown" data-am-dropdown>
                                    <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle"
                                            data-am-dropdown-toggle>管理文档
                                        <span class="am-icon-caret-down"></span></button>
                                    <ul class="am-dropdown-content">
                                        <?php if ($label->checkAuth('Create-GET-Doc-action') === true): ?>
                                            <li>
                                                <a href="<?= $label->url('Create-Doc-action', ['id' => $value['doc_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>"><i class="am-icon-cogs"></i>
                                                    基础信息设置</a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($label->checkAuth('Create-GET-Article-index') === true): ?>
                                            <li>
                                                <a href="<?= $label->url('Create-Article-index', ['id' => $value['doc_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>"><i class="am-icon-pencil"></i>
                                                    开始编辑文档</a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($label->checkAuth('Create-POST-Article-copy') === true): ?>
                                            <li>
                                                <a href="javascript:;" class="ajax-click ajax-dialog" msg="复制《<?= $value['doc_title'] ?>》文档，只会复制当前启用的版本。历史信息不会被复制。" data="<?= $label->url('Create-Doc-copy', ['id' => $value['doc_id'], 'method' => 'POST', 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>"><i class="am-icon-copy"></i>
                                                    复制文档</a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($label->checkAuth('Create-DELETE-Doc-action') === true): ?>
                                            <li>
                                                <a class="am-text-danger ajax-click ajax-dialog" msg="确定删除吗？将无法恢复的！"
                                                   href="javascript:;"
                                                   data="<?= $label->url(GROUP . '-' . MODULE . '-action', ['id' => $label->xss($value["doc_id"]), 'method' => 'DELETE', 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>"><i
                                                            class="am-icon-remove"></i> 删除文档</a>
                                            </li>
                                        <?php endif; ?>

                                        <?= (new \Core\Plugin\Plugin())->event('docManageButton', $value); ?>

                                    </ul>
                                </div>


                            </div>
                        </div>

                        <?php if (!empty($value['doc_attr'])): ?>
                            <div class="am-margin-top">
                                <?php foreach (explode(',', $value['doc_attr']) as $attr): ?>
                                    <?php $attrName = $label->getFieldOptionToMatch('101', $attr); ?>
                                    <span class="am-badge am-badge-primary"><?= $attrName ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <footer class="am-panel-footer am-cf">

                        <div class="am-g am-g-collapse">
                            <div class="am-u-sm-6">
                                版本号：v <?= $value['doc_version'] ?>
                            </div>
                            <div class="am-u-sm-6 am-text-right">
                                <input type="text" class="am-text-center" name="id[<?= $value["doc_id"]; ?>]"
                                       value="<?= $value['doc_listsort'] ?>" size="1">
                            </div>
                        </div>
                    </footer>
                </div>
            </li>

        <?php endforeach; ?>
    </ul>

    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-lg-6">

            <?php if ($label->checkAuth('Create-PUT-Doc-listsort') === true): ?>
                <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius">排序</button>
            <?php endif; ?>

            <?php if ($label->checkAuth('Create-DELETE-Doc-action') === true): ?>
                <button type="button" class="am-btn am-btn-danger am-btn-xs am-radius delete-batch"
                        data="<?= $label->url(GROUP . '-' . MODULE . '-action', ['method' => 'DELETE']) ?>">
                    删除
                </button>
            <?php endif; ?>
        </div>
        <div class="am-u-sm-12 am-u-lg-6">
            <ul class="am-pagination am-pagination-right am-margin-0">
                <?= $page ?? ''; ?>
            </ul>
        </div>
    </div>

</form>


<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>
