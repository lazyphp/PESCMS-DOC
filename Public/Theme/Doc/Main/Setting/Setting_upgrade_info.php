<div class="am-padding-xs am-padding-top">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">

            <div class="am-cf">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">更新执行结果</strong>
                </div>
            </div>
            <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

            <div class="am-alert am-alert-secondary" data-am-alert>
                <?php if(!empty($info)): ?>
                    <?php foreach ($info as $value): ?>
                        <p><?= $value ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>更新成功</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>