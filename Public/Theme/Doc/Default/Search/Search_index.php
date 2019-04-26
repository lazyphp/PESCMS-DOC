<div class="tm-content am-margin-top" style="overflow: initial">
    <div class="am-g">
        <div class="am-u-sm-12">

	        <div class="am-alert am-alert-secondary">
		        <h2><font color="#0BB54B" class="am-padding-right-xs"><?= $label->xss($_GET['keyword']); ?></font>的搜索结果:
		        </h2>
	        </div>

            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <form class="am-form am-form-inline">
                        <input type="hidden" name="m" value="Search">
                        <input type="hidden" name="a" value="index">
                        <span class="search-tool">
                            文档列表:
                            <select name="tree" data-am-selected="{btnSize: 'sm'}">
                            <?php foreach ($topBar as $key => $value): ?>
                                <option value="<?= $value['tree_id'] ?>" <?= $value['tree_id'] == $_GET['tree'] ? 'selected="selected"' : '' ?> ><?= $value['tree_title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        </span>

                        <?php if($system['change_version'] == 1): ?>
                        <span class="search-tool">
                            选择版本:
                            <select name="version" data-am-selected="{btnSize: 'sm'}" data="<?= $label->xss($_GET['tree']) ?>">
                            <option value="0">请选择版本</option>
                            <?php foreach($versionList[$_GET['tree']]['version'] as $key => $value): ?>
                                <option value="<?= $value ?>" <?= $searchVersion == $value ? 'selected="selected"' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php endif; ?>

                        </span>
                        <div class="am-form-group search-tool">
                            <input type="text" class="am-input-sm" name="keyword" value="<?= $label->xss($_GET['keyword']); ?>" placeholder="搜索">
                        </div>
                        <button type="submit" class="am-btn am-btn-sm am-btn-default am-radius">筛选</button>

                    </form>
                </div>
            </div>

	        <?php if (empty($list)): ?>
                <ul class="am-list am-list-static">
                    <li class="am-text-center">
                        <p>您的搜索词太难理解了，在下无能为力!</p>
                    </li>
                </ul>
            <?php else: ?>

                <div class="am-margin-bottom-xl">
                    <ul class="am-list am-list-static">
                        <?php foreach($list as $value ): ?>
                            <li>
                                <a href="<?= $label->url("Doc-Index-view", ['tree' => $label->xss($_GET['tree']), 'id' => $value['doc_id'], 'version' => $value['tree_version'] ]); ?>" class="am-padding-0" target="_blank"><?= $value['doc_title']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <ul class="am-pagination am-pagination-right am-text-sm">
                    <?= $page; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

</div>
<script>
    $(function(){
        $('select[name=tree]').on('change', function(){
            var tree = $(this).val();
            var version_tree = $('select[name=version]').attr('data')
            if(tree != version_tree){
                $('select[name=version]').val(0)
                $('select[name=version]').parent().hide()
            }else{
                $('select[name=version]').val('<?= $searchVersion ?>')
                $('select[name=version]').parent().show()
            }
        })
    })
</script>