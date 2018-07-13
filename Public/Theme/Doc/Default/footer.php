<div class="amz-toolbar" id="amz-toolbar" style="">
    <a href="#top" title="回到顶部" class="am-icon-btn am-icon-arrow-up am-active" id="amz-go-top" data-am-smooth-scroll></a>
    <?php if(!empty($system['fqa'] )): ?>
    <a href="<?= $system['fqa'] ?>" title="常见问题" class="am-icon-faq am-icon-btn am-icon-question-circle"></a>
    <?php endif; ?>
</div>
<footer class="my-footer">
    <p>PESCMS 文档系统<br>
        <small>© Copyright 2015-<?= date('Y') ?>. by the <a href="https://www.pescms.com" target="_blank">PESCMS</a>
        </small>
        <br>
        <small>耗时<?= round(microtime(true) - PES_RUN_TIME, 4) ?>秒</small>
    </p>
</footer>
</body>
</html>