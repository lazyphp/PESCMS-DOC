<div id="footer" class="footer">
    <div class="am-container">
        <div class="pes-footer">
            <div class="pes-logo am-text-middle">
                <img src="<?= $system['siteLogo'] ?: DOCUMENT_ROOT.'/Theme/assets/i/PESCMS_LOGO.png' ?> " alt="<?= $system['siteTitle'] ?: 'PESCMS' ?>" height="24" class="">
            </div>
            <span class="footer-line"></span>
            <div class="links" data-testid="links">
                <?php if(empty($system['siteFooter'])): ?>
                    <a href="https://www.pescms.com" target="_blank" class="">PESCMS官网</a>
                    <a href="https://document.pescms.com" target="_blank" class="">使用帮助</a>
                    <a href="https://www.pescms.com/article/view/-1.html" target="_blank" class="">软件协议</a>
                <?php else: ?>
                    <?= $system['siteFooter'] ?>
                <?php endif; ?>
                <span class="footer-line"></span>
                <a href="https://www.pescms.com/download/3.html" target="_blank" class="am-link-success" >Power By PESCMS DOC</a>
            </div>
        </div>
    </div>
</div>
<?php $label->footerEvent() ?>

<script>
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
            }).fail(function (){
                window.open('https://document.pescms.com/article/4.html')
            })
            return false;
        }

    })

    <?php if(isset($system['help_document']) && $system['help_document'] == 0): ?>
    $('header').before('<div class="am-alert am-alert-postscript am-text-sm am-margin-0 " data-am-alert style="position: fixed;width: 100%;bottom: 0px;z-index: 9999"><button type="button" class="close-f1 am-close">&times;</button><i class="am-icon-leanpub"></i> 按F1可以打开PESCMS Doc帮助文档</div>')
    $('html, body').animate({scrollTop: 0}, '500');
    $('.close-f1').on('click', function () {
        confirm('请谨记按F1可随时打开PESCMS Doc帮助文档。');
        $.post('<?= $label->url('Create-Setting-readHelpDoc') ?>', {method: 'PUT'}, function () {
        }, 'JSON')

    })
    <?php endif; ?>
</script>

<div style="display: none;">
    <?= $system['siteScript'] ?>
</div>
</body>
</html>