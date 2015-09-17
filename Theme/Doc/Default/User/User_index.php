<?=$this->header(); ?>
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><a href="<?= $label->url(GROUP . '-User-index'); ?>"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong></a> / <small>列表</small></div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="<?= $label->url(GROUP . '-User-action'); ?>" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</a>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
            <form>
                <div class="am-input-group am-input-group-sm">
                    <input type="hidden" name="g" value="<?= GROUP; ?>" />
                    <input type="hidden" name="m" value="<?= MODULE ?>" />
                    <input type="hidden" name="a" value="<?= ACTION ?>" />
                    <input type="text" name="keyword" value="<?= $_GET['keyword'] ?>" class="am-form-field">
                    <span class="am-input-group-btn">
                        <input class="am-btn am-btn-default" type="submit" value="搜索"/>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <?php if (empty($list)): ?>
                <div class="am-alert am-alert-secondary am-margin-top am-margin-bottom am-text-center" data-am-alert>
                    <p>本页面没有数据 :-(</p>
                </div>
            <?php else: ?>
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-id">ID</th>
                            <th class="table-title">帐号名称</th>
                            <th class="table-title">邮箱地址</th>
                            <th class="table-type">姓名</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $key => $value) : ?>
                            <tr>
                                <td><?= $value["user_id"]; ?></td>
                                <td><?= $value["user_account"]; ?></td>
                                <td><?= $value["user_mail"]; ?></td>
                                <td><?= $value["user_name"]; ?></td>
                                <td>
                                    <?php include dirname(dirname(__FILE__)) . '/Content_operate.php'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <ul class="am-pagination am-pagination-right am-text-sm">
                    <?= $page; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>
</div>
<?=$this->footer(); ?>