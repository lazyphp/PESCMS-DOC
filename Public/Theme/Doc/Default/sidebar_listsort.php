<?php if ($this->session()->get('user')['user_id']): ?>
    <div id="doc-oc-demo3" class="am-offcanvas">
        <div class="am-offcanvas-bar am-offcanvas-bar-flip tm-background-color-white" style="width: auto;">
            <form class="am-form ajax-submit" action="<?= $label->url('Doc-Tree-listsort'); ?>" method="POST">
                <input type="hidden" name="back_url" value="<?= $label->url("Doc-Index-view", ['id' => $_GET['id'], 'tree' => $_GET['tree']]); ?>">
                <input type="hidden" name="method" value="PUT"/>
                <button type="submit" class="am-btn am-btn-primary am-btn-xs tm-full-width">排序</button>
                <table class="am-table am-table-striped am-table-hover table-main am-margin-0">
                    <?php foreach ($tree as $tk => $tv) : ?>
                        <tr>
                            <td class="table-sort am-text-middle">
                                <input class="tm-input-sotr" type="text" name="tree[<?= $tk; ?>]" value="<?= $tv['listsort']; ?>">
                            </td>
                            <td><?= $tv['title']; ?></td>
                        </tr>
                        <?php foreach ($tv['child'] as $key => $value) : ?>
                            <tr>
                                <td class="table-sort am-text-middle">
                                    <input class="tm-input-sotr" type="text" name="doc[<?= $key; ?>]" value="<?= $value['listsort']; ?>">
                                </td>
                                <td>
                                    <span class="plus_icon plus_end_icon"></span><?= $value['title']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
                <button type="submit" class="am-btn am-btn-primary am-btn-xs tm-full-width">排序</button>
            </form>
        </div>
    </div>
<?php endif; ?>