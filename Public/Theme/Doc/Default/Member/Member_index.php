<div class="am-container am-padding-top">
    <div class="am-g ">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd member-center">
                    <h2>个人信息</h2>
                    <hr/>

                    <form class="am-form ajax-submit" method="post" data-am-validator>
                        <?= $label->token() ?>
                        <input type="hidden" name="method" value="PUT">
                        <?php foreach ($field as $key => $value) : ?>
                            <?php $value['value'] = self::session()->get('doc')["member_{$value['field_name']}"] ?? '' ?>
                            <div class="am-g am-g-collapse">
                                <div class="am-u-sm-12 am-u-sm-centered">
                                    <div class="am-form-group">
                                        <label class="am-block"><?= $value['field_display_name'] ?><?= $value['field_required'] == '1' ? '<i class="am-text-danger">*</i>' : '' ?></label>
                                        <?= $form->formList($value); ?>
                                        <?php if (!empty($value['field_explain'])): ?>
                                            <div class="pes-alert pes-alert-info">
                                                <i class="am-icon-lightbulb-o"></i> <?= $value['field_explain'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($value['field_name'] == 'account'): ?>
                                <div class="am-g am-g-collapse">
                                    <div class="am-u-sm-12 am-u-sm-centered">
                                        <div class="am-form-group">
                                            <label class="am-block"><?= $password['field_display_name'] ?></label>
                                            <input class="form-text-input input-leng3 am-radius" name="password" placeholder="<?= $password['field_display_name'] ?>" type="password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="am-g am-g-collapse">
                                    <div class="am-u-sm-12 am-u-sm-centered">
                                        <div class="am-form-group">
                                            <label class="am-block">确认密码</label>
                                            <input class="form-text-input input-leng3 am-radius" name="repassword" placeholder="确认密码" type="password" value="">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <button type="submit" class="am-btn am-btn-success">更新</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>