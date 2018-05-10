<div class="am-g">
    <div class="am-u-sm-12 am-u-lg-11 am-u-lg-centered ">
        <ul data-am-widget="gallery" class="am-gallery am-gallery-bordered am-text-center">
            <?php foreach ($treeList as $key => $value): ?>
                <?php if ($value['tree_parent'] == '0'): ?>
                    <li class="am-text-center am-inline-block">
                        <div class="am-gallery-item am-radius">
                            <a href="<?= $label->url("Doc-Index-home", ['tree' => $value['tree_id']]); ?>">
                                <img class="doc-cover" src="<?= $versionList[$value['tree_id']]['cover'][$value['tree_version']]; ?>" alt="<?= $versionList[$value['tree_id']]['title'][$value['tree_version']]; ?>"/>
                                <h3 class="am-gallery-title"><?= $versionList[$value['tree_id']]['title'][$value['tree_version']]; ?></h3>
                            </a>
                        </div>
                    </li>
                <?php endif;?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<style>
    .doc-cover{
        width: 20rem !important;
        transition: opacity .5s; opacity: 1;
    }
    .doc-cover:hover{
        opacity: 0.4;
    }
</style>