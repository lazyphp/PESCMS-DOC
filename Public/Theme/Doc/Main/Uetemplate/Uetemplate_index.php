<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_tool.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_list.php"; ?>

<script>
    $(function(){
        $('.am-btn-group>a.am-btn-default').after('<a href="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/dialogs/template/config.js" class="am-btn am-btn-success" target="_blank"><span class="am-icon-refresh"></span> 更新模板配置文件</a>')
    })
</script>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>