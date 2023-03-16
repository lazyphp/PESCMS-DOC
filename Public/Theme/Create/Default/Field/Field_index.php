<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_tool.php"; ?>
<script>
    $(function(){
        $("input[name=keyword]").after('<input type="hidden" name="model_id" value="<?=$_GET['model_id'] ?? null ?>"/><?=$label->backTo()?>')
    })
</script>

<?php include THEME_PATH . "/Content/Content_index_list.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>
