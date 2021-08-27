<?php include THEME_PATH . '/Content/Content_action_header.php' ?>
<!--    <div class="am-alert am-alert-warning" data-am-alert>-->
<!--        <p>通用格式</p>-->
<!--    </div>-->
<?php include THEME_PATH . '/Content/Content_action_hidden.php' ?>
<?php include THEME_PATH . '/Content/Content_action_form.php' ?>
<?php include THEME_PATH . '/Content/Content_action_footer.php' ?>
<script>
    $(function () {
        $('.ajax-submit').on('submit', function () {

            if($('input[name="md_render"]:checked').val() == 1){
                ue_uetemplate.setContent(pesMD['mdtemplate'].getHTML())
            }
        })
    })
</script>
