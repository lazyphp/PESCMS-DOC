
    <div class="tm-content am-g-fixed am-container am-padding-top am-padding-bottom">
        <form action="" method="POST" class="ajax-submit" data-am-validator>
            <ul class="am-list am-list-border">
                <li class="am-padding-xs">
                    <ol class="am-breadcrumb am-margin-0 am-padding-0">
                        <li><a href="/">首页</a></li>
                        <li class="am-active">
                            新文档
                        </li>
                    </ol>
                </li>
                <li class="am-padding-xs am-text-sm">
                    标题
                </li>
                <li>
                    <input name="title" class="tm-remove-border tm-input-background-color am-form-field" type="text" placeholder="填写标题" required>
                </li>
                <li class="am-padding-xs am-text-sm">
                    内容
                </li>
                <li class="">
                    <script id="editor" type="text/plain" style="height:250px;"></script>
                </li>
                <li class="am-padding-sm">
                    <select id="tree-parent" data-am-selected="{maxHeight: 200, btnSize: 'sm', dropUp: 1}">
                        <option value="">请选择</option>
                        <?php foreach ($treeList as $key => $value) : ?>
                            <?php if ($value['tree_parent'] == '0'): ?>
                                <option value="<?= $value['tree_id']; ?>"><?= $value['tree_title']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <select id="tree-child" name="tree" data-am-selected="{maxHeight: 200, btnSize: 'sm', dropUp: 1}">
                        <option value="">请选择</option>
                    </select>
                </li>
                <li>
                    <input type="text" class="tm-remove-border tm-input-background-color am-form-field" name="tag" value="" placeholder="填写标签，有利于用户检索内容，标签用英文逗号“,”作为分隔符。">
                    <div class="am-alert am-alert-secondary am-text-xs" data-am-alert>
                        填写标签，有利于用户检索内容，标签用英文逗号“,”作为分隔符。
                    </div>
                </li>
                <li>
                <input type="text" class="tm-remove-border tm-input-background-color am-form-field" name="listsort" value="" placeholder="文档排序值">
                </li>
                <li class="am-padding-xs am-text-center">
                    <button class="am-btn  am-btn-xs am-btn-primary">提交</button>
                </li>
            </ul>
        </form>
    </div>
    <script type="text/javascript">
        var ue = UE.getEditor('editor', {
            textarea: 'content'
        });
        var treeList = eval('(' + '<?= json_encode($treeList) ?>' + ')');
        $("#tree-parent").on("change", function () {
            var tree_parent = $(this).val();
            var optionStr = '<option value="">请选择</option>';
            for (var key in treeList) {
                if (tree_parent == treeList[key]['tree_parent']) {
                    optionStr += '<option value="' + treeList[key]['tree_id'] + '">' + treeList[key]['tree_title'] + '</option>';
                }
            }
            $("#tree-child").html(optionStr);
        })

    </script>