<div class="am-article-lead am-text-center am-margin-bottom-xs"><?= $treeList[$_GET['tree']]['tree_title'] ?></div>
<?php if ($this->session()->get('user')['user_id']): ?>
    <button class="am-btn am-btn-success tm-full-width am-margin-bottom-xs" data-am-offcanvas="{target: '#doc-oc-demo3'}">排序</button>
<?php endif; ?>
<?php if($system['change_version'] == 1): ?>
<div class="">
    <select name="version" class="version" data-am-selected="{btnWidth: '100%'}">
        <option value="">选择版本</option>
        <?php foreach($version as  $v ): ?>
            <option value="<?= $label->url(GROUP.'-'.MODULE.'-home', ['tree' => $_GET['tree'], 'version' => $v['tree_version'] ]) ?>" <?= $_GET['version'] == $v['tree_version'] ? 'selected="selected"' : '' ?>>
                <?= $v['tree_version'] ?>
                <?= $currentTree['tree_version'] == $v['tree_version'] ? '(当前)' : '' ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<?php endif; ?>
<ul class="am-nav am-list-border am-text-sm am-link-muted">
    <?php foreach ($tree as $tk => $tv) : ?>
        <li class="am-nav-header"><?= $tv['title']; ?></li>
        <?php foreach ($tv['child'] as $key => $value) : ?>
            <li class="am-margin-top-0 <?= $_GET['id'] == $key ? 'am-active' : '' ?>">
                <a href="<?= $label->url("Doc-Index-view", ['id' => $key, 'tree' => $_GET['tree'], 'version' => $_GET['version']]); ?>"><?= $value['title']; ?></a>
            </li>
        <?php endforeach; ?>
    <?php endforeach; ?>
</ul>
<script>
    $(function(){
        $('body').on('change', '.version', function(){
            var url = $(this).val();
            if(url == ''){
                return false;
            }
            window.location.href = url;
        })
    })
</script>