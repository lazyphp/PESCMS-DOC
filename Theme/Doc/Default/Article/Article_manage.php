
    <!-- content start -->
    <div class=" am-padding-top">

        <div class="am-g">
            <div class="am-u-sm-12">
                <form action="<?= $label->url('Doc-Tree-action'); ?>" method="POST" class="am-form am-form-inline ajax-submit">
                    <div class="am-form-group">
                        <input type="text" name="title" class="am-form-field" placeholder="树名称">
                    </div>

                    <div class="am-form-group">
                        <select name="parent" data-am-selected>
                            <option value="0">顶层文档树</option>
                            <?php foreach ($treeList as $value) : ?>
                                <?php if ($value['tree_parent'] == '0'): ?>
                                    <option value="<?= $value['tree_id']; ?>"><?= $value['tree_title']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="am-form-group">
                        <input type="text" name="listsort" class="am-form-field" placeholder="排序值">
                    </div>

                    <button class="am-btn am-btn-default">
                        <i class="am-icon-sitemap"></i> 新建树
                    </button>

                    <a href="<?= $label->url('User-index') ?>" class="am-btn am-btn-warning"><i class="am-icon-user"></i> 管理帐号</a>
                </form>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form ajax-submit" action="<?= $label->url('Doc-Tree-listsort'); ?>"  method="POST">
                    <input type="hidden" name="method" value="PUT"/>
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <?php foreach ($treeList as $value) : ?>
                            <?php if ($value['tree_parent'] == 0): ?>
                                <tr>
                                    <td class="table-sort am-text-middle">
                                        <input type="text" name="tree[<?= $value['tree_id']; ?>]" value="<?= $value['tree_listsort']; ?>">
                                    </td>
                                    <td class="am-text-middle">
                                        <span class="display-tree-<?= $value['tree_id']; ?>"><?= $value['tree_title']; ?></span>

                                        <div class="am-form am-form-inline am-hide update-tree-<?= $value['tree_id']; ?>">
                                            <div class="am-form-group">
                                                <input class="update-tree-input-<?= $value['tree_id']; ?>  am-form-field" type="text" name="title" value="<?= $value['tree_title']; ?>">
                                            </div>
                                            <div class="am-form-group">
                                                <select name="parent" class="parent-<?= $value['tree_id']; ?>" data-am-selected>
                                                </select>
                                            </div>
                                            <div class="am-form-group">
                                                <a class="am-btn am-btn-secondary submit-tree" data="<?= $value['tree_id']; ?>" href="javascript:;">提交</a>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="am-text-middle">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-secondary update-tree-button" href="javascript:;" data="<?= $value['tree_id']; ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                                <a class="am-btn am-btn-primary show-child" data="#tree-child-<?= $value['tree_id']; ?>"><i class="am-icon-bars"></i> 查看子树</a>
                                                <a class="am-btn am-btn-danger" href="<?= $label->url("Doc-Tree-action", ['id' => $value['tree_id'], 'method' => 'DELETE']); ?>" onclick="return confirm('确定删除吗?')"><span class="am-icon-trash-o"></span> 删除</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tbody id="tree-child-<?= $value['tree_id']; ?>" class="am-hide">
                                <?php foreach ($treeList as $child): ?>
                                    <?php if ($child['tree_parent'] == $value['tree_id']): ?>
                                        <tr>
                                            <td class="table-sort am-text-middle">
                                                <input type="text" name="tree[<?= $child['tree_id']; ?>]"
                                                       value="<?= $child['tree_listsort']; ?>">
                                            </td>
                                            <td class="am-text-middle">
                                                <div class="am-form am-form-inline">
                                                    <div class="am-form-group">
                                                        <span class="plus_icon plus_end_icon"></span>
                                                        <span class="display-tree-<?= $child['tree_id']; ?>"><?= $child['tree_title']; ?></span>
                                                    </div>

                                                    <div class="am-form-group am-hide update-tree-<?= $child['tree_id']; ?>">
                                                        <div class="am-form-group">
                                                            <input class="update-tree-input-<?= $child['tree_id']; ?>  am-form-field" type="text" name="title" value="<?= $child['tree_title']; ?>">
                                                        </div>
                                                        <div class="am-form-group">
                                                            <select name="parent" data="<?= $child['tree_parent']; ?>" class="parent-<?= $child['tree_id']; ?>" data-am-selected>
                                                            </select>
                                                        </div>
                                                        <div class="am-form-group">
                                                            <a class="am-btn am-btn-secondary submit-tree" data="<?= $child['tree_id']; ?>" href="javascript:;">提交</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="am-text-middle">
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs">
                                                        <a class="am-btn am-btn-secondary update-tree-button" href="javascript:;" data="<?= $child['tree_id']; ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                                        <a class="am-btn am-btn-danger" href="<?= $label->url("Doc-Tree-action", ['id' => $child['tree_id'], 'method' => 'DELETE']); ?>" onclick="return confirm('确定删除吗?')"><span class="am-icon-trash-o"></span> 删除</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            <?php endif; ?>
                        <?php endforeach; ?>


                    </table>
                    <div class="am-margin">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">排序</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        $(function () {

            //初始化树目录
            var treeList = eval('(' + '<?= json_encode($treeList) ?>' + ')');

            /**
             * 显示子树
             */
            $(".show-child").on("click", function(){
                var data = $(this).attr("data");
                $("tbody[id*='tree-child']").addClass("am-hide")
                $(data).removeClass("am-hide")
            })

            /**
             * 显示编辑树结构的表单
             */
            $(".update-tree-button").on("click", function () {
                var tree_id = $(this).attr("data");
                var tree_parent = $(".parent-" + tree_id).attr("data");
                var optionStr = '<option value="0">顶层文档树</option>';
                for (var key in treeList) {
                    if (treeList[key]['tree_parent'] == '0') {
                        var disabled = treeList[key]['tree_id'] == tree_id ? 'disabled' : ''
                        var selected = treeList[key]['tree_id'] == tree_parent ? 'selected' : ''
                        optionStr += '<option value="' + treeList[key]['tree_id'] + '" ' + disabled + selected + ' >' + treeList[key]['tree_title'] + '</option>';
                    }
                }
                $(".parent-" + tree_id).html(optionStr);
                $("div[class*='update-tree']").addClass("am-hide")
                $("span[class*='display-tree']").removeClass("am-hide");

                $(".display-tree-" + tree_id).addClass("am-hide");
                $(".update-tree-" + tree_id).removeClass("am-hide");
            })

            /**
             * 输入框表单离开，表示更新树
             */
            $(".submit-tree").on("click", function () {
                var id = $(this).attr('data');
                var title = $(".update-tree-input-" + id).val()
                var parent = $(".parent-" + id).val();
                var listsort = $('input[name="tree['+id+']"]').val()
                if (title == '') {
                    alert("请填写名称");
                    return false;
                }

                var actionUrl = '<?=$label->url('Doc-Tree-action') ?>';

                $.ajaxsubmit({
                    url: actionUrl, data: {title: title, id: id, parent: parent, listsort:listsort, method: 'PUT'}
                }, function (data) {
                    if (data.status == '200') {
                        setTimeout(function () {
                            location.reload()
                        }, 1200)
                    }
                })

            })

        })
    </script>
    <!-- content end -->
