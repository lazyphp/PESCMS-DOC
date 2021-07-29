<?php
/**
 * 本模板为智能表单的列表输出操作
 * 若没有特殊的需求，请加载本列表代码。
 */
?>

        <?php if (empty($list)): ?>
            <div class="pes-alert pes-alert-info am-margin-top am-margin-bottom am-text-center" >
                <p class="am-margin-0">本页面没有数据 :-(</p>
            </div>
        <?php else: ?>
            <form class="am-form ajax-submit" action="<?= $label->url(GROUP . '-' . MODULE . '-listsort'); ?>" method="POST">
                <input type="hidden" name="method" value="PUT"/>
                <?= $label->token() ?>
                <table class="am-table am-table-bordered am-table-striped am-table-hover">
                    <tr>
                        <th class="table-checked"><input type="checkbox" class="checkbox-all"></th>
                        <?php if ($listsort): ?>
                            <th class="table-sort">排序</th>
                        <?php endif; ?>
                        <th class="table-set">ID</th>
                        <?php foreach ($field as $value) : ?>
                            <?php if ($value['field_name'] == 'status'): ?>
                                <?php $class = 'table-set'; ?>
                            <?php else: ?>
                                <?php $class = 'table-title'; ?>
                            <?php endif; ?>
                            <th class="<?= $class ?>"><?= $value['field_display_name']; ?></th>
                        <?php endforeach; ?>
                        <th class="table-set">操作</th>
                    </tr>
                    <?php foreach ($list as $key => $value) : ?>
                        <tr>
                            <td class="am-text-middle">
                                <input type="checkbox" class="checkbox-all-children" name="id[<?= $value["{$fieldPrefix}id"]; ?>]" value="<?= $value["{$fieldPrefix}id"]; ?>" >
                            </td>
                            <?php if ($listsort): ?>
                                <td class="am-text-middle">
                                    <input type="text" class="am-input-sm" name="id[<?= $value["{$fieldPrefix}id"]; ?>]"
                                           value="<?= $value["{$fieldPrefix}listsort"]; ?>">
                                </td>
                            <?php endif; ?>
                            <td class="am-text-middle"><?= $value["{$fieldPrefix}id"]; ?></td>
                            <?php foreach ($field as $fv) : ?>
                                <td class="am-text-middle">
                                    <?= $label->valueTheme($fv, $fieldPrefix, $value); ?>
                                </td>
                            <?php endforeach; ?>


                            <td class="am-text-middle">
                                <?php /* 若要实现自定义的操作按钮，请更改本变量 */ ?>
                                <?php $operate = empty($operate) ? '/Content/Content_index_operate.php' : $operate;  ?>
                                <?php include THEME_PATH . $operate; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-lg-6">
                        <?php if ($listsort && $label->checkAuth(GROUP.'-DELETE-'.MODULE.'-listsort') === true ): ?>
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius">排序</button>
                        <?php endif; ?>

                        <?php if ($label->checkAuth(GROUP.'-DELETE-'.MODULE.'-action') === true): ?>
                        <button type="button" class="am-btn am-btn-danger am-btn-xs am-radius delete-batch" data="<?= $label->url(GROUP . '-' . MODULE . '-action', ['method' => 'DELETE']) ?>">删除</button>
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
