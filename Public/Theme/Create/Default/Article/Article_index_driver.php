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
                            description: '这是本轮教程最后的一次指引了，感谢您耐心阅读。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.pes-article-left-sidebar',
                        popover: {
                            description: '此区域为文档新建入口、文档首页信息编辑和文档结构目录的展示区域。<br/>其中文档结构目录您点击任意文档链接即进入该文档的编辑界面。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.pes-add-article',
                        popover: {
                            description: '文档刚创建时，整份文档还是空白无内容的，您点击此按钮即可开始编写您的文档内容。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.pes-doc-edit-index',
                        popover: {
                            description: '默认打开“开始编辑文档”按钮，文档编辑界面会是文档首页。当您在编写文档后，想修改文档首页内容，可点击此按钮重新返回文档首页内容的编写界面。',
                            side: "bottom",
                            align: 'start',
                        }
                    },
                    {
                        element: '.pes-article-paper',
                        popover: {
                            description: '这个区域，就是您编写文档内容的区域。您根据页面的介绍，完成对应的文档内容编写即可。',
                            side: "left",
                            align: 'start',
                        }
                    },
                    {
                        element: '.pes-article-right-sidebar',
                        popover: {
                            description: '右边区域为文档提交操作等相关按钮。您在这里可以保存、预览和管理文档的历史版本。',
                            side: "left",
                            align: 'start',
                        }
                    },
                    {
                        popover: {
                            description: '<div class="am-text-center am-text-xxxl">👏</div><p>到这里，我们相信您已经掌握了文档系统的使用方法了，更多功能就请您自行探索和享受了！如果您有任何疑问，请按F1打开我们的帮助文档，或者与我们联系。</p>',
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
                        status: 4,
                        method: 'PUT'
                    }, function () {
                    }, 'JSON')

                }

            });

            if (read_tips <= 3) {
                driverObj.drive();
            }




        });

    </script>

<?php endif; ?>