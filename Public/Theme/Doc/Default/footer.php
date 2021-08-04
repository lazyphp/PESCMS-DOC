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
                <a href="https://www.pescms.com/download/3.html" target="_blank" class="am-link-success" >Power By PESCMS DOC
            </div>
        </div>
    </div>
</div>
<div style="display: none;">
    <?= $system['siteScript'] ?>
</div>
</body>
</html>