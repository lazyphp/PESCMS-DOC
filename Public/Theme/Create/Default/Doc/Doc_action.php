<?php include THEME_PATH . '/Content/Content_action_header.php' ?>
<?php include THEME_PATH . '/Content/Content_action_hidden.php' ?>
<?php include THEME_PATH . '/Content/Content_action_form.php' ?>
<?php include THEME_PATH . '/Content/Content_action_footer.php' ?>
<script>
    $(function (){
        $('select[name="attr[]"]').selected({
            btnWidth: '100%',
            btnSize: 'sm',
            searchBox: '1'
        })

    })
</script>
<?php include __DIR__ . '/Doc_action_driver.php' ?>