<div class="am-padding am-padding-top">
    <div class="am-cf">
        <div class="am-fl am-cf">
            <?php if (!empty($_GET['back_url'])): ?>
                <a href="<?= base64_decode($_GET['back_url']) ?>" class="am-margin-right-xs am-text-danger"><i
                        class="am-icon-reply"></i>返回</a>
            <?php endif; ?>
            <strong class="am-text-primary am-text-lg"><a href="javascript:;"><?= $getVersionInfo['tree_version_title'] ?> —— 设置封面</a>
            </strong> /
            <small>列表</small>
        </div>
    </div>
    <hr />
    <form class="ajax-submit" method="POST">
        <input type="hidden" name="method" value="PUT">
        <div class="am-g am-g-collapse">
            <div class="am-u-sm-12 am-u-sm-centered">
                <div class="am-form-group">
                    <div data-am-webuploader-simple="{id:'cover', name:'cover', pick:{id:'#cover'}, content:'<?= $getVersionInfo['tree_version_cover']; ?>'}"></div>
                </div>
            </div>
        </div>
        <div class="am-g am-g-collapse">
            <div class="am-u-sm-12 am-u-sm-centered ">
                <button type="submit" class="am-btn am-btn-primary am-btn-xs" >提交保存</button>
            </div>
        </div>
    </form>
</div>