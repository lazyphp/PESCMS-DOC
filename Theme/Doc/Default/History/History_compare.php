<?= $this->header(); ?>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/jsdiff.js"></script>
    <div class="am-cf am-padding-top am-padding-bottom">
        <div class="tm-content am-margin">
            <article class="am-article tm-article">

                <div class="am-article-bd">
                    <div class="am-g am-form">
                        <div class="am-u-sm-6 tm-border-right compare-now ">
                            <p class="am-article-lead">目前版本</p>
                            <?= htmlspecialchars_decode($now); ?>
                        </div>
                        <div class="am-u-sm-6 compare-history">
                            <p class="am-article-lead">历史版本</p>
                            <p><?= htmlspecialchars_decode($history); ?></p>
                        </div>
                    </div>
                    <div class="diffent-result am-padding">

                    </div>
                </div>
            </article>
        </div>
    </div>
    <script>
        $(function () {
            var now = '<?= strip_tags(htmlspecialchars_decode($now)); ?>';
            var history = '<?= strip_tags(htmlspecialchars_decode($history)); ?>';
            $(".diffent-result").html(diffString(
                now,
                history
            ))
        })
    </script>
<?= $this->footer(); ?>