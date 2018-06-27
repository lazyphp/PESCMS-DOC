<div class="tm-content am-margin">
    <div class="am-g">
        <div class="am-u-sm-11 am-u-lg-centered">
	        <div class="am-alert am-alert-secondary">
		        <h2><font color="#0BB54B" class="am-padding-right-xs"><?= htmlentities($_GET['keyword']); ?></font>的搜索结果:
		        </h2>
	        </div>
	        <?php if (empty($list)): ?>
                <ul class="am-list am-list-static">
                    <li>
                        <p>您的搜索词太难理解了，在下无能为力!</p>
                    </li>
                </ul>
            <?php else: ?>

                <?php foreach ($list as $version => $item): ?>
		            <div class="am-margin-bottom-xl">
			            <div class="am-margin-bottom">
				            <strong>
					            <?= $versionList[current($item)['tree_parent']]['title'][explode('|', $version)[0]] ?>
				            </strong>
                            <small>(<?= explode('|', $version)[0] ?>)</small>
			            </div>
			            <ul class="am-list am-list-static">
				            <?php foreach($item as $value ): ?>
					            <li>
						            <a href="<?= $label->url("Doc-Index-view", ['tree' => $value['tree_parent'], 'id' => $value['doc_id'], 'version' => $value['tree_version']]); ?>" class="am-padding-0" target="_blank"><?= $value['doc_title']; ?></a>
					            </li>
				            <?php endforeach; ?>
			            </ul>
		            </div>
                <?php endforeach; ?>

                <ul class="am-pagination am-pagination-right am-text-sm">
                    <?= $page; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

</div>