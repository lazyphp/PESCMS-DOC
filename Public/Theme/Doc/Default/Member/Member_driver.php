<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/driver.css?v=<?= $resources ?>">
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/driver.js?v=<?= $resources ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        let read_tips = parseInt('<?= $system['read_tips'] ?>');

        const driver = window.driver.js.driver;

        let tipsElement = $('.tips-manual')[0].cloneNode(true);
        tipsElement.style.display = 'block';


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
                        title: '欢迎使用PESCMS DOC',
                        description: tipsElement.outerHTML,
                    }
                },
                {
                    element: '.am-alert-postscript',
                    popover: {
                        description: '如果您使用文档系统遇到疑问，可以按F1查看我们的软件帮助文档。大部分文档在文档中都可以找到答案。',
                        side: "bottom",
                        align: 'start'
                    }
                },
                {
                    element: '.super-sidebar',
                    popover: {
                        description: '仪表盘右侧栏目仅超级管理员账号可见。您可以根据自己的业务需求，选择安装合适的应用插件或者模板主题。同时可以查阅文档系统最新的资讯。',
                        side: "left",
                        align: 'start',
                    }
                },


                {
                    element: '.am-topbar-right .am-nav li:first-child',
                    popover: {
                        description: '只有拥有管理权限的用户登录文档系统后才看到“创作空间”，点击“创作空间”即可进入文档管理和系统后台。',
                        side: "bottom",
                        align: 'start',
                    }
                },
                {
                    popover: {
                        description: '现在您已经对PESCMS DOC有了初步的了解。我们将会在后续一些地方继续指引您。<br/>后续若您使用过程中有任何疑问，可以随时联系我们。'+

                            '<div class="am-margin-top-sm">推荐登录问答中心反馈问题：<a href="https://forum.pescms.com/" target="_blank">https://forum.pescms.com/</a></div>'+

                            '<div class="am-margin-top-sm">或者加入官方QQ群：<br/>PESCMS官方QQ 1群：451828934 <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=70b9d382c5751b7b64117191a71d083fbab885f1fb7c009f0dc427851300be3a"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PESCMS官方1群" title="PESCMS官方1群"></a> <br/> PESCMS官方QQ 2群：496804032 <a target="_blank" href="https://jq.qq.com/?_wv=1027&k=5HqmNLN"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PESCMS官方2群" title="PESCMS官方2群"></a></div>',
                        side: "bottom",
                        align: 'start',
                    }
                }

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
                    status: 1,
                    method: 'PUT'
                }, function () {
                }, 'JSON')
            }

        });

        if (read_tips == 0) {
            driverObj.drive();
        }

    });

</script>

<div class="tips-manual" style="display: none">

    <div class="desc">
        <p>
            感谢您使用PESCMS DOC。为了更好的使用本系统，请您花费几分钟时间阅读以下提示和根据指引提示操作。若您已经熟悉本系统，您可以点击"跳开教学"按钮关闭本提示。
        </p>
        <p class="am-margin-bottom-0">
            本项目若对您有所帮助，您可以给我们一个Star支持一下，非常感谢！<br/>
            <a href="https://gitee.com/fallBirds/PESCMS-DOC" target="_blank">Gitee地址</a>
            <a href="https://github.com/lazyphp/PESCMS-DOC" target="_blank" class="am-margin-left">Github地址</a>
        </p>
    </div>

    <div class="ad">
        <h3>PESCMS带货服务器：</h3>

        <p>
            <a href="https://www.aliyun.com/minisite/goods?userCode=dwpuyec3" target="_blank"><i class="am-icon-external-link"></i>
                新用户购阿里云服务器享受7.5折优惠，老用户一样有优惠。</a>
        </p>
        <p>
            <a href="https://cloud.tencent.com/act/cps/redirect?redirect=2446&cps_key=593915c4c0306b57e399c4259553c150&from=console" target="_blank" style="color: #f56c6c"><i class="am-icon-external-link"></i>
                &nbsp;PESCMS用户也可以考虑使用腾讯云，官方服务器部署在腾讯云上。</a>
        </p>
        <p>
            <a href="https://my.locvps.net/page.aspx?c=referral&u=15004" target="_blank" style="color: #b88408"><i class="am-icon-external-link"></i>
                &nbsp;免备案服务器，老牌LocVPS，PESCMS官方早期使用的服务器。</a>
        </p>

    </div>

</div>