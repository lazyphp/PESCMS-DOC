<?php $this->header(); ?>
    <!-- content start -->
    <div class="admin-content am-padding-top">

        <div class="am-g">
            <div class="am-u-sm-12">
                <form action="/d/tree/action" method="POST" class="am-form am-form-inline">
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
                    <a class="am-btn am-btn-primary" data-am-collapse="{target: '#collapse-nav'}">管理树 <i
                            class="am-icon-bars"></i></a>
                    <nav>
                        <ul id="collapse-nav" class="am-nav am-collapse">
                            <?php foreach ($treeList as $key => $value) : ?>
                                <li><a href="/d/tree/action/<?= $value['tree_id'] ?>/DELETE"
                                       onclick="return confirm('确定删除吗?')"><?= $value['tree_title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </form>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form" action="/d/tree/listsort" method="POST">
                    <input type="hidden" name="method" value="PUT"/>
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <tbody>
                        <?php foreach ($treeList as $value) : ?>
                            <tr>
                                <td class="table-sort am-text-middle">
                                    <input type="text" name="tree[<?= $value['tree_id']; ?>]"
                                           value="<?= $value['tree_listsort']; ?>">
                                </td>
                                <td class="am-text-middle">
                                    <span
                                        class="display-tree-<?= $value['tree_id']; ?>"><?= $value['tree_title']; ?></span>
                                    <input class="am-hide update-tree-input update-tree-<?= $value['tree_id']; ?>"
                                           type="text"
                                           name="title" value="<?= $value['tree_title']; ?>"
                                           data="<?= $value['tree_id']; ?>">
                                </td>
                                <td class="am-text-middle">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-secondary update-tree-button" href="javascript:;"
                                               data="<?= $value['tree_id']; ?>"><span
                                                    class="am-icon-pencil-square-o"></span> 编辑</a>
                                            <a class="am-btn am-btn-danger"
                                               href="/d/tree/action/<?= $value['tree_id'] ?>/DELETE"
                                               onclick="return confirm('确定删除吗?')"><span class="am-icon-trash-o"></span>
                                                删除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
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
            $(".update-tree-button").on("click", function () {
                var tree_id = $(this).attr("data");
                $(".display-tree-" + tree_id).addClass("am-hide");
                $(".update-tree-" + tree_id).removeClass("am-hide");
            })

            $(".update-tree-input").on("blur", function () {
                var dom = $(this)
                var title = $(this).val();
                var id = $(this).attr("data")
                if (title == '') {
                    alert("请填写名称");
                    return false;
                }

                ajax({url:'', data:{title: title, id: id, method: 'PUT'}}, function(data){
                    if (data.status == '200') {
                        dom.addClass("am-hide");
                        $(".display-tree-" + id).removeClass("am-hide").html(title)
                    }
                })

            })


            function ajax(data, callback) {
                var obj = {type:'POST', 'dataType':'JSON'};
                Object.assign(obj,data)
                console.dir(obj);
                return true;
                var progress = $.AMUI.progress;
                progress.start();
                $.ajax({
                    url: '/d/tree/action',
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#am-alert').modal();
                        $(".alert-tips").html(data.msg);
                        setTimeout(function () {
                            $('#am-alert').modal('close');
                        }, '1000')

                        callback(data)
                        progress.done();
                    },
                    error: function () {
                        $('#am-alert').modal();
                        $(".alert-tips").html("数据异常");

                        setTimeout(function () {
                            $('#am-alert').modal('close');
                        }, '1000')
                        progress.done();
                        return false;
                    }
                })
            }
        })
    </script>
    <!-- content end -->
<?php $this->footer(); ?>