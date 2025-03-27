<?php if ($this->session()->get('doc')['member_id'] == '1'): ?>

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/driver.css?v=<?= $resources ?>">
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/driver.js?v=<?= $resources ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let read_tips = parseInt('<?= $system['read_tips'] ?>');
            let docAlert = document.querySelector('.nothing-doc');
            let docMenu = $('.example-doc').find('.am-dropdown');

            $('.example-doc').hide();

            const driver = window.driver.js.driver;


            const driverObj = driver({
                nextBtnText: '下一步',
                prevBtnText: '上一步',
                doneBtnText: '完成',
                progressText: '{{current}} / {{total}}',
                showProgress: true,
                allowClose: false,
                steps: [
                    {
                        popover: {
                            description: '再次见面了，接下来我们将简单介绍文档管理列表页。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.am-btn-group-xs > .am-btn-default',
                        popover: {
                            description: '点击新增按钮，按照表单说明填写好内容即可完成文档的基础信息创建。',
                            side: "bottom",
                            align: 'start',
                            onNextClick: () => {
                                if (docAlert) {
                                    docAlert.style.display = 'none';
                                }

                                $('.example-doc').show();

                                driverObj.moveNext();
                            },
                        }
                    },
                    {
                        element: '.example-doc',
                        popover: {
                            description: '时间关系，我们创建了一个示例文档。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: docMenu[0],
                        popover: {
                            description: '此按钮为本文档的管理菜单',
                            side: "bottom",
                            align: 'start',
                            onNextClick: () => {
                                docMenu.dropdown('open')
                                driverObj.moveNext();
                                docMenu.find('ul').removeClass('driver-active-element');
                            },
                        }
                    },
                    {
                        element: docMenu.find('ul')[0],
                        popover: {
                            description: '<p>展开的菜单中，依次为：文档的基础信息编辑、编写文档内容的入口、复制整份文档和删除文档的操作。</p>',
                            side: "bottom",
                            align: 'start'
                        }
                    },
                    {
                        popover: {
                            description: '<div class="am-text-center am-text-xxxl">👏</div><p>重要的指引已经告诉您了，接下来马上完成一份文档的创建吧！</p>',
                            side: "top",
                            align: 'center'
                        }
                    },
                ],

                onDestroyStarted: () => {
                    if (!driverObj.hasNextStep() || confirm("确认要跳开新手教学吗?")) {
                        driverObj.destroy();
                    }
                },
                onPopoverRender: (popover, {config, state}) => {
                    const firstButton = document.createElement("button");
                    firstButton.innerText = "跳开教学";

                    popover.footerButtons.prepend(firstButton);

                    firstButton.addEventListener("click", () => {
                        driverObj.destroy();
                    });
                },

                onDestroyed: () => {
                    $.post('<?= $label->url('Create-Setting-recordTips') ?>', {
                        status: 2,
                        method: 'PUT'
                    }, function () {
                    }, 'JSON')

                    try {
                        docAlert.style.display = 'block';
                    } catch (e) {

                    }
                    $('.example-doc').remove()

                }

            });

            if (read_tips <= 1) {
                driverObj.drive();
            }


        });

    </script>

    <?php if ($system['read_tips'] == 1): ?>
        <ul class="am-avg-sm-1 am-avg-lg-5 am-thumbnails pes-doc-table am-padding-horizontal-xs example-doc">
            <li>
                <div class="am-panel am-panel-default ">
                    <div class="am-panel-bd">
                        <div class="am-checkbox pes-doc-title-column">
                            <label>
                                <input class="checkbox-all-children" type="checkbox" name="id[4]" value="4">
                                PESCMS DOC使用手册 </label>
                            <a href="javscript:;" target="_blank"><i class="am-icon-external-link"></i>
                                预览</a>
                        </div>
                        <hr>
                        <div class="am-text-center">
                            <div class="pes-doc-cover" style="background-image: url('<?= DOCUMENT_ROOT ?>/Theme/assets/i/logo.png')"></div>
                        </div>
                    </div>

                    <div class="am-padding">
                        <hr>
                        <div class="am-g am-g-collapse">
                            <div class="am-u-sm-4">
                                <time class="time am-text-middle">2023-03-20</time>
                            </div>
                            <div class="am-u-sm-8 am-text-right">

                                <div class="am-dropdown" data-am-dropdown="">
                                    <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle="">
                                        管理文档
                                        <span class="am-icon-caret-down"></span></button>
                                    <ul class="am-dropdown-content">
                                        <li>
                                            <a href="javscript:;"><i class="am-icon-cogs"></i>
                                                基础信息设置</a>
                                        </li>

                                        <li>
                                            <a href="javscript:;"><i class="am-icon-pencil"></i>
                                                开始编辑文档</a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="ajax-click ajax-dialog" msg="复制《PESCMS DOC使用手册》文档，只会复制当前启用的版本。历史信息不会被复制。" data="javscript:;"><i class="am-icon-copy"></i>
                                                复制文档</a>
                                        </li>

                                        <li>
                                            <a class="am-text-danger ajax-click ajax-dialog" msg="确定删除吗？将无法恢复的！" href="javascript:;" data="javscript:;"><i class="am-icon-remove"></i>
                                                删除文档</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="am-margin-top">
                            <span class="am-badge am-badge-primary">软件使用指南</span>
                        </div>

                    </div>

                    <footer class="am-panel-footer am-cf">
                        <div class="am-g am-g-collapse">
                            <div class="am-u-sm-6">
                                版本号：v 2.1
                            </div>
                            <div class="am-u-sm-6 am-text-right">
                                <input type="text" class="am-text-center" name="id[4]" value="4" size="1">
                            </div>
                        </div>
                    </footer>
                </div>
            </li>

        </ul>
    <?php endif; ?>
<?php endif; ?>