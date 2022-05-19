<?php include THEME_PATH.'/header.php'; ?>
<div class="pes-login">
    <div class="pes-login-layer">
        <div class="pes-login-panel">
            <div class="pes-login-logo">
                <a href="/"><img src="<?= $system['siteLogo'] ?: DOCUMENT_ROOT.'/Theme/assets/i/PESCMS_LOGO.png' ?>"></a>
            </div>
            <div class="pes-login-desc">
                <h2><?= $system['siteTitle'] ?></h2>
            </div>
            <?php require $file?>

            <?= $label->loginEvent(); ?>

        </div>
    </div>
</div>
<?php include THEME_PATH.'/footer.php'; ?>

