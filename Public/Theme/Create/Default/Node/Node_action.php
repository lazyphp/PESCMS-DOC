<?php include THEME_PATH . '/Content/Content_action_header.php' ?>
<?php include THEME_PATH . '/Content/Content_action_hidden.php' ?>
<?php include THEME_PATH . '/Content/Content_action_form.php' ?>
<?php include THEME_PATH . '/Content/Content_action_footer.php' ?>
<script>
    $(function (){
        var menu = function (){
            var ismenu = $('input[name="is_menu"]:checked').val();
            var dom = $('input[name="link_type"], input[name="link"], input[name="menu_icon"]').parents('.am-g')
            if(ismenu == 1){
                dom.show();
            }else{
                dom.hide();
            }
        }
        menu();

        $('input[name="is_menu"]').on('click', function (){
            menu();
        })

        $('input[name="parent"]').before($('select[name="parent"]'))
        $('input[name="parent"]').remove();
        $('select[name="parent"]').val('<?= $node_parent ?? '' ?>')
        $('select[name="parent"] option[value="<?=$node_id ?? ''?>"]').attr('disabled', 'disabled')
    })

</script>

<select name="parent">
    <option value="">请选择</option>
    <option value="0">一级菜单</option>
    <?php \Model\Node::recursion(0, THEME_PATH.'/Node/Node_option.php'); ?>
</select>
