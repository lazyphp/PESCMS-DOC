<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_tool.php"; ?>

<?php if (empty($list)): ?>
    <div class="pes-alert pes-alert-info am-margin-top am-margin-bottom am-text-center">
        <p class="am-margin-0">本页面没有数据 :-(</p>
    </div>
<?php else: ?>
    <form class="am-form ajax-submit" action="<?= $label->url(GROUP . '-' . MODULE . '-listsort'); ?>" method="POST">
        <input type="hidden" name="method" value="PUT"/>
        <?= $label->token() ?>
        <table class="am-table am-table-bordered am-table-striped am-table-hover">
            <tr>
                <th class="table-checked"><input type="checkbox" class="checkbox-all"></th>
                <th class="table-sort">排序</th>
                <th>菜单名称</th>
                <th>菜单地址</th>
                <th>链接类型</th>
                <th class="table-set">操作</th>
            </tr>

            <?php \Model\Menu::recursion(); ?>
        </table>

        <div class="am-g am-g-collapse">
            <div class="am-u-sm-12 am-u-lg-6">
                <?php if ($label->checkAuth(GROUP . '-DELETE-' . MODULE . '-listsort') === true): ?>
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius">排序</button>
                <?php endif; ?>

                <?php if ($label->checkAuth(GROUP . '-DELETE-' . MODULE . '-action') === true): ?>
                <button type="button" class="am-btn am-btn-danger am-btn-xs am-radius delete-batch" data="<?= $label->url(GROUP . '-' . MODULE . '-action', ['method' => 'DELETE']) ?>">
                    删除
                </button>
                <?php endif; ?>
            </div>
            <div class="am-u-sm-12 am-u-lg-6">
                <ul class="am-pagination am-pagination-right am-margin-0">
                    <?= $page; ?>
                </ul>
            </div>
        </div>
    </form>
<?php endif; ?>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>
