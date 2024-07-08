<div id="footer" class="footer">
    <div class="am-container">
        <div class="pes-footer">
            <div class="pes-logo am-text-middle">
                <img src="<?= $system['siteLogo'] ?: DOCUMENT_ROOT . '/Theme/assets/i/PESCMS_LOGO.png' ?> "
                     alt="<?= $system['siteTitle'] ?: 'PESCMS' ?>" height="24" class="">
            </div>
            <span class="footer-line"></span>
            <div class="links" data-testid="links">
                <?php if (empty($system['siteFooter'])): ?>
                    <a href="https://www.pescms.com" target="_blank" class="">PESCMS官网</a>
                    <a href="https://document.pescms.com" target="_blank" class="">使用帮助</a>
                    <a href="https://www.pescms.com/article/view/-1.html" target="_blank" class="">软件协议</a>
                <?php else: ?>
                    <?= $system['siteFooter'] ?>
                <?php endif; ?>

                <?php if (empty($system['is_authorize']) || $system['is_authorize'] != 'right'): ?>
                    <span class="footer-line"></span>
                    <a href="https://www.pescms.com/download/3.html" target="_blank" class="am-link-success">Power By
                        PESCMS DOC</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $label->footerEvent() ?>

<script>
    $(function (){
        /**
         * F1帮助文档
         */
        $(document).on('keydown', function () {
            var e = window.event;
            var code = e.charCode || e.keyCode;
            if (code == 112) {
                $.getJSON('<?= $label->url('Doc-HelpDocument-find', ['help_controller' => GROUP . '-' . MODULE . '-' . ACTION, 'match' => GROUP . '-' . MODULE . '-:a']) ?>', function (res) {
                    try {
                        if (res.status == 200) {
                            window.open(res.data.help_document_link)
                        } else {
                            window.open('https://document.pescms.com/article/4.html')
                        }
                    } catch (e) {
                        window.open('https://document.pescms.com/article/4.html')
                    }
                }).fail(function () {
                    window.open('https://document.pescms.com/article/4.html')
                })
                return false;
            }

        })

        /**
         * PESCMS软件存活统计
         * 本请求只记录软件使用者存活情况，不会将您的服务器信息发给PESCMS，请放心使用。
         * 本请求只会在每个月的第一次访问时记录，且仅记录当前使用者的浏览器信息发给PESCMS服务器。
         */

        var survivalDate = localStorage.getItem('survivalDate');

        var recordSurvival = function (){
            //这是基于前端ajax跨域请求，因此并不会将软件部署的服务器信息发给PESCMS。
            $.post(PESCMS_URL + '/?g=Api&m=Statistics&a=survival&method=POST', {id: '3'}, function () {
            }, 'JSON')
        }

        var month = new Date().getMonth() + 1;
        if(survivalDate == null) {
            localStorage.setItem('survivalDate', month);
            recordSurvival();
        } else {
            if(survivalDate != month){
                localStorage.setItem('survivalDate', month);
                recordSurvival();
            }
        }

        <?php if(isset($system['help_document']) && $system['help_document'] == 0): ?>
        $('header').before('<div class="am-alert am-alert-postscript am-text-sm am-margin-0 " data-am-alert style="position: fixed;width: 100%;bottom: 0px;z-index: 9999"><button type="button" class="close-f1 am-close">&times;</button><i class="am-icon-leanpub"></i> 按F1可以打开PESCMS Doc帮助文档 [点击右侧X按钮可永久关闭本提示]</div>')
        $('html, body').animate({scrollTop: 0}, '500');
        $('.close-f1').on('click', function () {
            confirm('请谨记按F1可随时打开PESCMS Doc帮助文档。');
            $.post('<?= $label->url('Create-Setting-readHelpDoc') ?>', {method: 'PUT'}, function () {
            }, 'JSON')

        })
        <?php endif; ?>

    })
</script>

<div style="display: none;">
    <?= $system['siteScript'] ?>
</div>
</body>
</html>