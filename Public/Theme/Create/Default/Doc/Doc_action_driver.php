<?php if ($this->session()->get('doc')['member_id'] == '1'): ?>

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/driver.css?v=<?= $resources ?>">
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/driver.js?v=<?= $resources ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let read_tips = parseInt('<?= $system['read_tips'] ?>');
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
                            description: '在您开始新建文档之前，我们先告诉一些您容易设置错的地方。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.am-g:has([name="open"]) ',
                        popover: {
                            description: '如果您的文档是非公开，请勾选登录阅读。启用登录阅读后，您需要确保系统已经开启了账号注册或者您已经完成了对应账号的添加。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.am-g:has([name="read_organize[]"]) ',
                        popover: {
                            description: '当您文档开启了登录阅读，您还需要勾选可以打开本文档的用户分组。若没有勾选分组，用户登录账号后也会无法查看到本文档。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.am-g:has([name="open_nav"]) ',
                        popover: {
                            description: '开启文档目录（大纲）的前提是需要您当前使用的主题支持读取文章的段落生成目录。如果您的主题不支持，开启后也不会显示文档目录（大纲）。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.am-g:has([name="open_sidebar"]) ',
                        popover: {
                            description: '我们默认设置了侧边栏的文档结构目录展开。如果您的文档内容较多，建议您开启侧边栏，方便用户快速查看文档目录。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        popover: {
                            description: '<div class="am-text-center am-text-xxxl">👏</div><p>剩下的基础设置就由您自行去探索了！</p>',
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
                        status: 3,
                        method: 'PUT'
                    }, function () {
                    }, 'JSON')

                }

            });

            if (read_tips <= 2) {
                driverObj.drive();
            }




        });

    </script>

<?php endif; ?>