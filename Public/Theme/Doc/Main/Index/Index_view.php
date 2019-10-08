<section class="content">
    <article class="am-article">
        <div class="am-article-hd">
            <h1 class="am-article-title am-text-center display-doc-title"><?= $doc_title; ?></h1>
            <?php require 'Index_edit_title.php'?>

            <?php foreach ($content as $key => $value) : ?>

                <!--时间栏目-->
                <div class="am-article-hd">
                    <p class="am-article-meta">
                        <span><?= $value['user_name']; ?></span>
                        <time datetime="<?= date('Y-m-d H:i', $value['doc_content_createtime']); ?>" title="<?= date('Y-m-d H:i', $value['doc_content_createtime']); ?>">
                            发表于 <?= $label->timing($value['doc_content_createtime']); ?></time>
                        <?php if (!empty($value['doc_content_updatetime'])): ?>
                            <time datetime="<?= date('Y-m-d H:i', $value['doc_content_updatetime']); ?>" title="<?= date('Y-m-d H:i', $doc_updatetime); ?>">
                                最后更新 <?= $label->timing($value['doc_content_updatetime']); ?></time>
                        <?php endif; ?>
                        <?php if ($this->session()->get('user')['user_id']): ?>
                            <a href="javascript:;" id="update-button_<?= $value['doc_content_id'] ?>" data="<?= $value['doc_content_id'] ?>" class="am-hide am-badge am-badge-primary update-button " >更新</a>
                            <a href="javascript:;" id="history-button_<?= $value['doc_content_id'] ?>" data="<?= $value['doc_content_id'] ?>" class="am-hide am-badge am-badge-primary history-button">版本历史</a>
                            <a href="<?= $label->url("Doc-Article-deleteContent", ['id' => $value['doc_content_id'], 'method' => 'DELETE']); ?>" id="delete-content-button_<?= $value['doc_content_id'] ?>" class="am-hide am-badge am-badge-danger delete-content-button ajax-click ajax-dialog">删除文档</a>
                        <?php endif; ?>
                    </p>
                </div>
                <!--时间栏目-->

                <?php $tagArray = $label->listtag($value['doc_content_id']); ?>
                <div class="am-article-bd tm-article" data="<?= $value['doc_content_id'] ?>">
                    <?php require 'Index_edit_content.php'?>
                    <div class="content_html">
                        <?= htmlspecialchars_decode($value['doc_content']); ?>

                        <?php if (!empty($tagArray)): ?>
                            <p class="am-article-meta">
                                Tag :
                                <?php foreach ($tagArray as $tag): ?>
                                    <span class="am-badge"><?= $tag; ?></span>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php require 'Index_add_content.php'?>
    </article>



</section>

<script>
    $(function(){
        $('table').each(function(){
            console.dir('ddd')
            $(this).attr('class', 'am-table am-table-bordered am-table-radius am-table-striped')
        })
    })
</script>

<?php if ($this->session()->get('user')['user_id']): ?>
    <script type="text/javascript">
        $(function () {
            /**
             * 选择分类
             */
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

            /**
             * 记录已经生成的编辑器
             */
            var editor = {}
            /**
             * 任意点击解除编辑器
             * 否则将导致绑定body事件误触发
             */
            var currentUse = false;
            $(".tm-article").on("dblclick", function () {
                currentUse = true;
                var data = $(this).attr("data");
                //记录启用过和初始化编辑器
                if (!editor[data]) {
                    editor[data] = UE.getEditor('content_' + data, {textarea: 'content'});
                } else {
                    editor[data].setShow()
                }

                //移除所有隐藏得元素
                $(".update-button, .history-button, .delete-content-button").addClass("am-hide");
                $(".content_html").removeClass("am-hide");
                //显示标签输入框
                $(".content_tag_" + data).removeClass("am-hide");
                //隐藏当前内容
                $(this).children(".content_html").addClass("am-hide");
                $("#update-button_" + data + ", #history-button_" + data + ", #delete-content-button_" + data).removeClass("am-hide");
                for (var key in editor) {
                    if (key != data) {
                        editor[key].setHide();
                    }
                }
            })


            /**
             * 更新标题
             */
            $(".display-doc-title").on("dblclick", function () {
                currentUse = true;
                $(".update-title-form").removeClass("am-hide");
                $(this).addClass("am-hide");
            })

            /**
             * 解除编辑功能
             */
            $("body").on("dblclick", function () {
                if (editor && currentUse == false) {
                    $(".content_html, .display-doc-title").removeClass("am-hide");
                    for (var key in editor) {
                        $(".update-button, .history-button, .delete-content-button").addClass("am-hide");
                        editor[key].setHide();
                        $(".content_tag_" + key).addClass("am-hide");
                    }
                    $(".update-title-form").addClass("am-hide");
                }
                if (currentUse == true) {
                    currentUse = false
                }
            })

            /**
             * 提交更新内容
             */
            $(".update-button").on("click", function () {
                var id = $(this).attr("data");
                $("#submit_" + id).submit();
                return false;
            })

            /**
             * 查看版本历史
             */
            $(".history-button").on("click", function () {
                var id = $(this).attr("data");
                var d = dialog({
                    title : '版本历史操作提示',
                    fixed : true
                });
                $.ajaxsubmit({
                    url: path + '/?g=Doc&m=History&a=getHistory&method=GET&id=' + id,
                    'type': 'GET',
                    'dialog': false
                }, function (data) {
                    if (data.status == 0) {
                        d.content(data.msg).showModal();
                        setTimeout(function () {
                            d.close().remove();
                        }, '1200');
                    } else if (data.status == 200) {
                        $('#history-modal').modal();
                        var trStr = "";
                        for (var key in data.data) {
                            var use = data['data'][key]['doc_content_current'] == '1' ? '<a class="am-btn am-btn-danger am-btn-xs" disabled="disabled">当前版本</a>' : '<a class="am-btn am-btn-default am-btn-xs" href="' + path + '?g=Doc&m=History&a=view&id=' + data['data'][key]['doc_content_history_id'] + '" target="_blank">预览</a><a class="am-btn am-btn-warning am-btn-xs" href="' + path + '?g=Doc&m=History&a=compare&id=' + data['data'][key]['doc_content_history_id'] + '" target="_blank">对比</a><a class="am-btn am-btn-success am-btn-xs ajax-click" href="' + path + '?g=Doc&m=History&a=useVersion&method=GET&id=' + data['data'][key]['doc_content_history_id'] + '">使用此版本</a>';
                            trStr += '<tr><td>' + data['data'][key]['doc_content_history_id'] + '</td><td>' + data['data'][key]['user_name'] + '</td><td>' + data['data'][key]['doc_content_createtime'] + '</td><td>' + use + '</td></tr>';
                        }
                        $(".history-list").html(trStr)
                        d.width('65rem').content($('#am-modal-bd')[0]).showModal();
                    }

                })
            })
        })
    </script>

    <div id="am-modal-bd" style="height: 250px;overflow-y: scroll;display: none">
        <table class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
            <tr>
                <th>版本序号</th>
                <th>操作者</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="history-list">
            </tbody>
        </table>
    </div>
<?php endif; ?>