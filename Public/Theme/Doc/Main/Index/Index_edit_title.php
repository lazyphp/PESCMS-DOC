<?php if (!empty($this->session()->get('user')['user_id'])): ?>
    <div class="am-form-inline am-padding-bottom-sm update-title-form am-hide">
        <form action="<?= $label->url('Doc-Doc-action') ?>" class="ajax-submit" method="POST">
            <input type="hidden" name="method" value="PUT">
            <input type="hidden" name="id" value="<?= $doc_id; ?>">

            <div class="am-form-group" style="width:40%">
                <input type="text" name="title" value="<?= $doc_title; ?>" class="am-form-field" placeholder="标题" style="width:100%;padding:0.5rem">
            </div>

            <div class="am-form-group">
                <select id="tree-parent" data-am-selected="{maxHeight: 200, btnSize: 'sm'}">
                    <option value="">请选择</option>
                    <?php foreach ($treeList as $key => $value) : ?>
                        <?php if ($value['tree_parent'] == 0): ?>
                            <option value="<?= $value['tree_id']; ?>" <?= $treeList[$doc_tree_id]['tree_parent'] == $value['tree_id'] ? 'selected="selected"' : '' ?> ><?= $value['tree_title']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="am-form-group">
                <select id="tree-child" name="tree_id" data-am-selected="{maxHeight: 200, btnSize: 'sm'}">
                    <option value="">请选择</option>
                    <?php foreach ($treeList as $key => $value) : ?>
                        <?php if ($value['tree_parent'] == $treeList[$doc_tree_id]['tree_parent']): ?>
                            <option value="<?= $value['tree_id']; ?>" <?= $doc_tree_id == $value['tree_id'] ? 'selected="selected"' : '' ?> ><?= $value['tree_title']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="am-btn am-btn-default" style="padding:0.51rem">更新标题</button>
            <a href="<?= $label->url("Doc-Article-Action", ['id' => $doc_id, 'method' => 'DELETE']); ?>" class="am-btn am-btn-danger ajax-click ajax-dialog" onclick="return confirm('确定删除吗?文档将无法恢复的!')" style="padding:0.51rem">删除文档</a>
        </form>
    </div>
<?php endif; ?>