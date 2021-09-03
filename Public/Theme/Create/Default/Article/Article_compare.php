<?php include THEME_PATH.'/header.php' ?>
<?= $label->token() ?>
<div class="am-margin-top-lg">
    <div class="am-g">
        <div class="am-u-sm-6">
            <div class="am-alert am-alert-warning am-text-center" data-am-scrollspy-nav="{offsetTop: 45}" data-am-sticky>
                当前文档
            </div>
            <article class="am-article">
                <article class="am-article-lead am-margin-bottom">
                    <p class="am-margin-vertical-xs">文档SEO关键词：<?= $article['article_keyword'] ?></p>
                    <p class="am-margin-vertical-xs">文档SEO描述：<?= $article['article_description'] ?></p>
                </article>
                <article class="am-article-hd">
                    <h1 class="am-article-title"><?= $article['article_title'] ?></h1>
                </article>
                <article class="am-article-bd">
                    <?= $article['article_content_editor'] == 1 ? 'MD格式渲染中...' : $article['article_content'] ?>
                </article>
            </article>
            <div class="pes-article-history-right-divider"></div>
        </div>
        <div class="am-u-sm-6">
            <div class="am-alert am-text-center" data-am-scrollspy-nav="{offsetTop: 45}" data-am-sticky>
                历史文档 >> <a href="<?= $label->url('Create-Article-history', ['hid'=> $history['content']['history_id']]) ?>" class="change-history"><i class="am-icon-toggle-on"></i> 切换</a>
            </div>
            <article class="am-article">
                <article class="am-article-lead am-margin-bottom">
                    <p class="am-margin-vertical-xs">文档SEO关键词：<?= $history['content']['article_keyword'] ?></p>
                    <p class="am-margin-vertical-xs">文档SEO描述：<?= $history['content']['article_description'] ?></p>
                </article>
                <article class="am-article-hd">
                    <h1 class="am-article-title"><?= $history['article_base']['article_title'] ?></h1>
                </article>
                <article class="am-article-bd">
                    <?= $history['content']['article_content_editor'] == 1 ? 'MD格式渲染中...' : $history['content']['article_content'] ?>
                </article>
            </article>
            <div class="pes-article-history-left-divider"></div>
        </div>
    </div>
</div>
<input type="hidden" class="use-md" value="<?= $article['article_content_editor'] ?>">
<input type="hidden" class="use-md-history" value="<?= $history['content']['article_content_editor'] ?>">

<script>

    $(function (){

        if($('.use-md').val() == 1){
            Vditor.preview(document.getElementsByClassName('am-article-bd')[0], `<?= str_replace('`', '\`', $article['article_content_md']) ?>`)
        }
        if($('.use-md-history').val() == 1){
            Vditor.preview(document.getElementsByClassName('am-article-bd')[1], `<?= str_replace('`', '\`', $history['content']['article_content_md']) ?>`)
        }

        $('.change-history').on('click', function () {
            if(confirm('您确定要将文档切换为该历史版本吗？')){
                var url = $(this).attr('href');
                var token = $('input[name="token"]').val()
                $.ajaxSubmit({
                    url:url,
                    data:{token:token, method:'PUT'},
                    skipAutoTips: true,
                    complete:function (res, dialogOption) {
                        var status = res?.responseJSON?.status || false;
                        var refreshToken = res?.responseJSON?.token || false;
                        if(status == 200){
                            //回调执行结果
                            window.opener.$('#history-result').val('200');
                            //关闭窗口
                            setTimeout(function () {
                                window.close();
                            }, 2000)
                        }
                        var d = dialog(dialogOption);
                        d.showModal();
                        window.opener.$('input[name="token"]').val(refreshToken);
                    }
                })
            }

            return false;
        })
    })
</script>
<hr/>
<?php include THEME_PATH.'/footer.php' ?>