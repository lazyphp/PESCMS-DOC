<?php include THEME_PATH . '/Content/Content_action_header.php' ?>
<?php include THEME_PATH . '/Content/Content_action_hidden.php' ?>
<?php include THEME_PATH . '/Content/Content_action_form.php' ?>
<?php include THEME_PATH . '/Content/Content_action_footer.php' ?>
<script>
    $(function (){

        $('input[name="pid"]').before($('select[name="pid"]'))
        $('input[name="pid"]').remove();
        $('select[name="pid"]').val('<?= $menu_pid ?? '' ?>')
        $('select[name="pid"] option[value="<?=$menu_id ?? '' ?>"]').attr('disabled', 'disabled')
    })

</script>

<select name="pid">
    <option value="">请选择</option>
    <option value="0">一级菜单</option>

    <?php \Model\Menu::recursion(0, THEME_PATH.'/Menu/Menu_option.php'); ?>
</select>
