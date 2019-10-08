<aside class="sidebar">
    <div class="search">
        <form class="" method="GET" action="<?= DOCUMENT_ROOT ?>/" role="search">
            <input type="hidden" name="m" value="Search">
            <input type="hidden" name="a" value="index">
            <input type="hidden" name="tree" value="<?= (int)$_GET['tree']; ?>">

            <div class="am-form-group am-input-group">
                <input type="text" class="am-form-field" name="keyword" value="<?= $label->xss($_GET['keyword']); ?>" placeholder="搜索">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default search-article" type="submit"><span class="am-icon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
    <h2 class="am-text-center"><a class="app-name-link" data-nosearch="" href="javascript:;"><?= $treeList[$_GET['tree']]['tree_title'] ?></a></h2>

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
    <?php endif; ?>

    <div class="sidebar-nav">
        <ul>
            <?php foreach ($tree as $tk => $tv) : ?>
                <li>
                    <?= $tv['title']; ?>
                    <ul>
                        <?php foreach ($tv['child'] as $key => $value) : ?>

                            <li class="<?= $_GET['id'] == $key ? 'am-active' : '' ?>">
                                <a href="<?= $label->url("Doc-Index-view", ['id' => $key, 'tree' => $_GET['tree'], 'version' => $_GET['version']]); ?>"><?= $value['title']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>