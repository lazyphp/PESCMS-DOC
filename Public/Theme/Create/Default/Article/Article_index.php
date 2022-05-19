<div class="pes-article-left-sidebar">
    <div class="am-text-center am-margin-top">
        <a href="javascript:;" data-link="<?= $label->url('Create-Article-index', ['id' => $doc['doc_id'], 'aid' => 'new', 'back_url' => $label->xss($_GET['back_url'] ?? '')]) ?>" data-id="new" class="am-btn am-btn-default pes-add-article"><i class="am-icon-plus"></i> 新文档</a>
        <a href="<?= $label->url('Create-Article-index', ['id' => $doc['doc_id']]) ?>" class="am-btn am-btn-default"><i class="am-icon-home"></i> 文档首页</a>
    </div>
    <hr/>
    <div class="pes-doc-path-container">
        <?= $path ?>
    </div>

</div>
<div class="mask-layer"></div>
<div class="pes-article-paper" >
    <div class="pes-article-tips am-alert am-margin-bottom-0 am-hide" ></div>
    <h1><i class="am-icon-edit"></i> <?= $doc['doc_title'] ?> - 文档首页</h1>
    <form action="<?= empty($_GET['aid']) ? $label->url('Create-Article-doc') : '' ?>" id="pes-article-submit" class="am-form" method="post" data-am-validator>
        <?= $label->token() ?>
        <input type="hidden" name="id" value="<?= $doc['doc_id'] ?>">
        <div class="pes-form-wrapper">
            <?php if (empty($_GET['aid'])): ?>
                <?php require_once __DIR__ . '/Article_doc.php' ?>
            <?php else: ?>
                <?php require_once __DIR__ . '/Article_write.php' ?>
            <?php endif; ?>
        </div>
        <div class="am-hide-sm-only">
            <a href="javascript:;" class="pes-article-save am-btn am-btn-default "><i class="am-icon-save"></i> 保存 <small class="am-text-secondary">[Ctrl + 回车]</small></a>
        </div>

    </form>
</div>
<div class="pes-article-right-sidebar am-text-center">
    <?php require_once __DIR__.'/Article_index_right.php'?>
</div>

<div class="mobile-button">
    <a href="javascript:;" title="打开左侧栏" class="am-icon-btn am-success am-icon-exchange"></a>
    <a href="javascript:;" title="保存文档" class="am-icon-btn am-success am-icon-save pes-article-save"></a>
</div>

<?php require_once __DIR__.'/Article_indexjs.php'?>