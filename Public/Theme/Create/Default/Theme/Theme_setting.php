<div id="wrapper">
    <!-- content start -->
    <div class="admin-content am-padding-xs am-padding-top-0 am-padding-bottom-0">
        <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
                <div class="am-cf">
                    <div class="am-fl am-cf">
                        <?php if (!empty($_GET['back_url'])): ?>
                            <a href="<?= base64_decode($_GET['back_url']) ?>" class="am-margin-right-xs am-text-danger"><i
                                        class="am-icon-reply"></i>返回</a>
                        <?php endif; ?>
                        <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
                    </div>
                </div>
                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed am-no-layout">
                <form class="am-form ajax-submit" action="" method="post" data-am-validator>
                    <input type="hidden" name="method" value="PUT">
                    <input type="hidden" name="id" value="2">
                    <?= $label->token(); ?>
                    <input type="hidden" name="back_url" value="<?= $label->xss($_GET['back_url'] ?? '') ?>">

                    <div class="am-tabs am-margin-bottom" data-am-tabs="{noSwipe: 1}">

                        <ul class="am-tabs-nav am-nav am-nav-tabs">
                            <?php foreach ($tabTitle as $k => $name): ?>
                                <li class="<?= $k == 0 ? 'am-active' : '' ?>">
                                    <a href="#tab_<?= substr(md5($name), 0, 5) ?>"><?= $name ?></a></li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="am-tabs-bd">

                            <?php foreach ($tabTitle

                            as $k => $tName): ?>

                            <div class="am-tab-panel am-fade <?= $k == 0 ? 'am-in am-active' : '' ?>" id="tab_<?= substr(md5($tName), 0, 5) ?>">

                                <?php if ($k == 0): ?>

                                    <div class="am-g am-g-collapse <?= in_array('title', $disableThemeSetting) ? 'am-hide' : '' ?> ">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block">主题居中标题</label>
                                                <input class="form-text-input input-leng3 am-radius" name="title" placeholder="主题居中标题"
                                                       type="text" value="<?= $setting['title'] ?>"></div>
                                        </div>
                                    </div>

                                    <div class="am-g am-g-collapse <?= in_array('subtitle', $disableThemeSetting) ? 'am-hide' : '' ?>">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block">主题副标题</label>
                                                <input class="form-text-input input-leng3 am-radius" name="subtitle" placeholder="主题副标题"
                                                       type="text" value="<?= $setting['subtitle'] ?>"></div>
                                        </div>
                                    </div>

                                    <div class="am-g am-g-collapse <?= in_array('title_display', $disableThemeSetting) ? 'am-hide' : '' ?>">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block">显示主题标题<i class="am-text-danger">*</i></label>
                                                <label class="form-radio-label am-radio-inline">
                                                    <input class="form-radio" type="radio" name="title_display" value="0" required="" <?= $setting['title_display'] == 0 ? 'checked="checked"' : '' ?>>
                                                    <span>隐藏</span>
                                                </label>
                                                <label class="form-radio-label am-radio-inline">
                                                    <input class="form-radio" type="radio" name="title_display" value="1" required="" <?= $setting['title_display'] == 1 ? 'checked="checked"' : '' ?>>
                                                    <span>显示</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="am-g am-g-collapse <?= in_array('search', $disableThemeSetting) ? 'am-hide' : '' ?>">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block">显示全局搜索框<i class="am-text-danger">*</i></label>
                                                <label class="form-radio-label am-radio-inline">
                                                    <input class="form-radio" type="radio" name="search" value="0" required="" <?= $setting['search'] == 0 ? 'checked="checked"' : '' ?>>
                                                    <span>隐藏</span>
                                                </label>
                                                <label class="form-radio-label am-radio-inline">
                                                    <input class="form-radio" type="radio" name="search" value="1" required="" <?= $setting['search'] == 1 ? 'checked="checked"' : '' ?>>
                                                    <span>显示</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="am-g am-g-collapse <?= in_array('doc_type', $disableThemeSetting) ? 'am-hide' : '' ?>">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block">首页文档布局形式<i class="am-text-danger">*</i></label>
                                                <?php foreach (['0' => '按属性选项卡切换展示', '1' => '按属性布局面板展示', '2' => '按文档列表展示'] as $key => $name): ?>
                                                    <label class="form-radio-label am-radio-inline">
                                                        <input class="form-radio" type="radio" name="doc_type" value="<?= $key ?>" required="" <?= $setting['doc_type'] == $key ? 'checked="checked"' : '' ?>>
                                                        <span><?= $name ?></span>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif; ?>

                                <?php foreach ($indexField[$tName] as $key => $value) : ?>
                                    <?php $value['value'] = $setting[$value['field_name']] ?? '' ?>
                                    <div class="am-g am-g-collapse">
                                        <div class="am-u-sm-12 am-u-sm-centered">
                                            <div class="am-form-group">
                                                <label class="am-block"><?= $value['field_display_name'] ?><?= $value['field_required'] == '1' ? '<i class="am-text-danger">*</i>' : '' ?></label>
                                                <?= $form->formList($value); ?>
                                                <?php if (!empty($value['field_explain'])): ?>
                                                    <div class="pes-alert pes-alert-info am-text-xs ">
                                                        <i class="am-icon-lightbulb-o"></i> <?= $value['field_explain'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?php endforeach; ?>

                            </div>

                        </div>

                        <div class="am-g am-g-collapse am-margin-bottom">
                            <div class="am-u-sm-12 am-u-sm-centered">
                                <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius"><i
                                            class="am-icon-save"></i> 提交保存
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>