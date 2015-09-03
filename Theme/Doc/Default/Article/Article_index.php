<?php $this->header(); ?>
<!-- content start -->
<div class="admin-content am-padding-top">

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-7">
            <form action="/d/tree/action" method="POST" class="am-form am-form-inline">
                <div class="am-form-group">
                    <input type="text" name="title" class="am-form-field" placeholder="树名称">
                </div>

                <div class="am-form-group">
                    <input type="text" name="listsort" class="am-form-field" placeholder="排序值">
                </div>
                <button class="am-btn am-btn-default">
                    <i class="am-icon-sitemap"></i> 新建树
                </button>
                <a class="am-btn am-btn-primary" data-am-collapse="{target: '#collapse-nav'}">管理树 <i class="am-icon-bars"></i></a>
                <nav>
                    <ul id="collapse-nav" class="am-nav am-collapse">
                        <?php foreach ($treeList as $key => $value) : ?>
                            <li><a href="/d/tree/action/<?= $value['tree_id'] ?>/DELETE" onclick="return confirm('确定删除吗?')"><?= $value['tree_title']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </form>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form" action="/d/tree/listsort" method="POST">
                <input type="hidden" name="method" value="PUT" />
                <table class="am-table am-table-striped am-table-hover table-main">
                    <tbody>
                        <?php foreach ($tree as $tk => $tv) : ?>
                            <tr>
                                <td class="table-sort am-text-middle">
                                    <input type="text" name="tree[<?= $tk; ?>]" value="<?= $tv['listsort']; ?>" >
                                </td>
                                <td class="am-text-middle">
                                    <span class="display-tree-<?= $tk; ?>"><?= $tv['title']; ?></span>
                                    <input class="am-hide update-tree-input update-tree-<?= $tk; ?>" type="text" name="title" value="<?= $tv['title']; ?>" data="<?= $tk; ?>" >
                                </td>
                                <td class="am-text-middle">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-secondary update-tree-button" href="javascript:;" data="<?= $tk; ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                            <a class="am-btn am-btn-danger" href="/d/tree/action/<?= $tk ?>/DELETE" onclick="return confirm('确定删除吗?')"><span class="am-icon-trash-o"></span> 删除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php if (!empty($tv['child'])): ?>
                                <?php foreach ($tv['child'] as $key => $value) : ?>
                                    <tr>
                                        <td class="am-text-middle">
                                            <input type="text" name="doc[<?= $key; ?>]" value="<?= $value['listsort']; ?>" >
                                        </td>
                                        <td class="am-text-middle"><span class="plus_icon plus_end_icon"></span><?= $value['title']; ?></td>
                                        <td class="am-text-middle">
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a class="am-btn am-btn-secondary" href="/d/<?= $key ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                                    <a class="am-btn am-btn-danger" href="/d/action/<?=$key?>/DELETE" onclick="return confirm('确定删除吗?')"><span class="am-icon-trash-o"></span> 删除</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
            var progress = $.AMUI.progress;
            progress.start();
            $.ajax({
                url: '/d/tree/action',
                data: {title: title, id: id, method: 'PUT'},
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    $('#am-alert').modal();
                    if (data.status == '200') {
                        $(".alert-tips").html(data.msg);
                        dom.addClass("am-hide");
                        $(".display-tree-" + id).removeClass("am-hide").html(title)
                    } else {
                        $(".alert-tips").html(data.msg);
                    }
                    
                    setTimeout(function () {
                        $('#am-alert').modal('close');
                    }, '1000')
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
        })
    })
</script>
<!-- content end -->
<?php $this->footer(); ?>