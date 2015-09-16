<div class="tm-content am-margin">

    <ul class="am-list ">
        <li class="am-padding tm-remove-border">
            <h1 class="am-article-title am-margin-top-0 display-doc-title"><?= $doc_title; ?></h1>

            <div class="am-form-inline am-padding-bottom-sm update-title-form am-hide">
                <div class="am-form-group" style="width:40%">
                    <input type="text" name="title" data="<?= $doc_id; ?>" value="<?= $doc_title; ?>" class="am-form-field" placeholder="标题" style="width:100%;padding:0.5rem">
                </div>

                <div class="am-form-group">
                    <select id="tree-parent" data-am-selected="{maxHeight: 200, btnSize: 'sm'}">
                        <option value="">请选择</option>
                        <?php foreach ($treeList as $key => $value) : ?>
                            <?php if ($value['tree_parent'] == 0): ?>
                                <option value="<?= $value['tree_id']; ?>" <?= $treeList[$doc_tree_id]['tree_parent'] == $value['tree_id'] ? 'selected="selected"' : '' ?> ><?= $value['tree_title']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="am-form-group">
                    <select id="tree-child" name="tree" data-am-selected="{maxHeight: 200, btnSize: 'sm'}">
                        <option value="">请选择</option>
                        <?php foreach ($treeList as $key => $value) : ?>
                            <?php if ($value['tree_parent'] == $treeList[$doc_tree_id]['tree_parent']): ?>
                                <option value="<?= $value['tree_id']; ?>" <?= $doc_tree_id == $value['tree_id'] ? 'selected="selected"' : '' ?> ><?= $value['tree_title']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <a class="am-btn am-btn-default update-title" style="padding:0.51rem">更新标题</a>
            </div>
            <?php if (time() - $doc_updatetime > 15768000): ?>
                <div class="am-alert am-alert-secondary am-text-xs am-margin-bottom-0">
                    <p><i class="am-icon-exclamation-triangle"></i> 该文档已超过半年没有更新，可能不再具备参考价值</p>
                </div>
            <?php endif; ?>
        </li>
        <?php foreach ($content as $key => $value) : ?>
            <li class="am-padding am-nbfc">
                <article class="am-article">
                    <div class="am-article-hd">
                        <p class="am-article-meta">
                            <span><?= $value['user_name']; ?></span>
                            <time datetime="<?= date('Y-m-d H:i', $value['doc_content_createtime']); ?>" title="<?= date('Y-m-d H:i', $value['doc_content_createtime']); ?>">
                                发表于 <?= $label->timing($value['doc_content_createtime']); ?></time>
                            <?php if (!empty($value['doc_content_updatetime'])): ?>
                                <time datetime="<?= date('Y-m-d H:i', $value['doc_content_updatetime']); ?>" title="<?= date('Y-m-d H:i', $doc_updatetime); ?>">
                                    最后更新 <?= $label->timing($value['doc_content_updatetime']); ?></time>
                            <?php endif; ?>
                            <?php if ($_SESSION['user']['user_id']): ?>
                                <a href="javascript:;" id="update-button_<?= $value['doc_content_id'] ?>" data="<?= $value['doc_content_id'] ?>" class="am-hide am-badge am-badge-primary update-button">更新</a>
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="am-article-bd tm-article" data="<?= $value['doc_content_id'] ?>">
                        <?php if ($_SESSION['user']['user_id']): ?>
                            <script id="content_<?= $value['doc_content_id'] ?>" type="text/plain" style="height:250px;"><?= htmlspecialchars_decode($value['doc_content']); ?></script>
                        <?php endif; ?>
                        <div class="content_html">
                            <?= html_entity_decode($value['doc_content']); ?>
                        </div>
                    </div>
                </article>
            </li>
        <?php endforeach; ?>
        <?php if (!empty($_SESSION['user']['user_id'])): ?>
            <form action="/d/addContent/<?= $doc_id; ?>" method="POST">
                <li class="am-padding-xs am-text-sm">
                    添加内容
                </li>
                <li class="">
                    <script id="editor" type="text/plain" style="height:250px;"></script>
                </li>
                <li class="am-padding-xs am-text-center">
                    <button class="am-btn  am-btn-xs am-btn-primary">添加</button>
                </li>

            </form>
            <script>
                var ue = UE.getEditor('editor', {
                    textarea: 'content',
                    serverUrl: '/d/uedition/?method=POST'
                });
            </script>
        <?php endif; ?>
    </ul>


</div>
<?php if ($_SESSION['user']['user_id']): ?>
    <script type="text/javascript">
        $(function () {

            /**
             * 选择分类
             */
            var treeList = eval('(' + '<?= json_encode($treeList) ?>' + ')');
            $("#tree-parent").on("change", function(){
                var tree_parent = $(this).val();
                var optionStr = '<option value="">请选择</option>';
                for(var key in treeList){
                    if(tree_parent == treeList[key]['tree_parent']) {
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
                    editor[data] = UE.getEditor('content_' + data, {serverUrl: '/d/uedition/?method=POST'});
                } else {
                    editor[data].setShow()
                }

                //移除所有隐藏得元素
                $(".update-button").addClass("am-hide");
                $(".content_html").removeClass("am-hide");
                //隐藏当前内容
                $(this).children(".content_html").addClass("am-hide");
                $("#update-button_" + data).removeClass("am-hide");
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
                        $(".update-button").addClass("am-hide");
                        editor[key].setHide();
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
                var progress = $.AMUI.progress;
                if (editor[id].hasContents() != true) {
                    $('#am-alert').modal('open');
                    $(".alert-tips").html("请填写内容");
                }
                progress.start();
                $.ajax({
                    url: '/d/edit/' + id,
                    data: {content: editor[id].getContent()},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        progress.done();
                        $('#am-alert').modal('open');
                        try {
                            if (data.status == '200') {
                                setTimeout(function () {
                                    location.reload()
                                }, '1000')
                            }
                            $(".alert-tips").html(data.msg);
                        } catch (e) {
                            $(".alert-tips").html("数据异常");
                        }

                    },
                    error: function () {
                        $('#am-alert').modal('open');
                        $(".alert-tips").html("请求错误");
                        progress.done();
                    }
                })
                return false;
            })

            /**
             * 更新标题
             */
            $(".update-title").on("click", function () {
                var progress = $.AMUI.progress;
                var title = $("input[name=title]").val()
                var id = $("input[name=title]").attr("data")
                var tree = $("select[name=tree]").val()
                if (title == '') {
                    alert("请填写标题");
                    return false;
                }
                if (tree == "") {
                    alert("请选择树");
                    return false;
                }
                progress.start()
                $.ajax({
                    url: '/d/updateTitle',
                    data: {id: id, title: title, tree_id: tree, method: 'PUT'},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        progress.done();
                        $('#am-alert').modal('open');
                        try {
                            if (data.status == '200') {
                                setTimeout(function () {
                                    location.reload()
                                }, '1000')
                            }
                            $(".alert-tips").html(data.msg);
                        } catch (e) {
                            $(".alert-tips").html("数据异常");
                        }

                    },
                    error: function () {
                        $('#am-alert').modal('open');
                        $(".alert-tips").html("请求错误");
                        progress.done();
                    }
                })
            })
        })
    </script>
<?php endif; ?>