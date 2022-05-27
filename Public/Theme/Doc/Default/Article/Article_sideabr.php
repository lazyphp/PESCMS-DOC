<!--侧栏-->
<aside class="sidebar">
    <div class="search">
        <form class="" method="GET" action="<?= DOCUMENT_ROOT ?>/" role="search">
            <input type="hidden" name="g" value="Doc">
            <input type="hidden" name="m" value="Article">
            <input type="hidden" name="a" value="search">
            <input type="hidden" name="id" value="<?= $doc['doc_id']; ?>">

            <div class="am-form-group am-input-group">
                <input type="text" class="am-form-field" name="keyword" value="<?= $label->xss($_GET['keyword'] ?? ''); ?>" placeholder="搜索">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default search-article" type="submit"><span class="am-icon-search"></span></button>
                </span>
            </div>
        </form>
    </div>

    <h2 class="am-text-center">
        <a class="app-name-link" data-nosearch="" href="<?= $label->url('Doc-Article-index', ['id' => $doc['doc_id']]) ?>"><?= $doc['doc_title'] ?></a></h2>

    <?php if(!empty($docVersion)): ?>
        <select name="version" class="version" data-am-selected="{btnWidth: '100%'}">
            <option value="">选择版本</option>
            <?php foreach ($docVersion as $key => $value): ?>
                <option value="<?= $value['version_number'] ?>"<?= $doc['doc_version'] == $value['version_number'] ? 'selected="selected"' : '' ?> ><?= $value['version_number'] ?><?= !empty($value['default']) && $value['default'] == 1 ? '(当前版本)' : '' ?> </option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>

    <!--无限层目录-->
    <div class="sidebar-nav">
        <?= $path ?>
    </div>
    <!--无限层目录-->

</aside>
<aside class="mask-layer"></aside>
<!--侧栏-->