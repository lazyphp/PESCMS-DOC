<div class="am-padding-xs am-padding-top">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            <div class="am-cf">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
                </div>
            </div>
            <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

            <form class="am-form am-form-horizontal ajax-submit" action="" method="post" data-am-validator>
                <input type="hidden" name="method" value="PUT"/>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">当前版本<i class="am-text-danger">*</i></label>
                            <a class="am-btn am-btn-sm am-btn-warning"
                               href="<?= $label->url(GROUP . '-Setting-upgrade', ['back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>"><i
                                        class="am-icon-refresh"></i> <?= $version['value'] ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">程序名称<i class="am-text-danger">*</i></label>
                            <input type="text" name="sitetitle" value="<?= $sitetitle['value'] ?>"/>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">上传图片格式<i class="am-text-danger">*</i></label>
                            <textarea name="upload_img"><?= implode(',', $upload_img) ?></textarea>
                            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                                <i class="am-icon-lightbulb-o"></i> 填写您要支持的图片格式，英文逗号分隔。
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">上传文件格式<i class="am-text-danger">*</i></label>
                            <textarea name="upload_file"><?= implode(',', $upload_file) ?></textarea>
                            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                                <i class="am-icon-lightbulb-o"></i> 填写您要支持的文件格式，英文逗号分隔。
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">文章导读<i class="am-text-danger">*</i></label>
                            <textarea name="articlereview" rows="10"><?= $articlereview['value'] ?></textarea>
                            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                                <i class="am-icon-lightbulb-o"></i> 为空则文章不显示导读（目录）功能。官方默认提供提取文章内容为h2字号的为导读标题。
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">开启全站登录<i class="am-text-danger">*</i></label>
                            <label class="am-radio-inline">
                                <input type="radio" value="0" name="login"
                                       required="" <?= $login['value'] == '0' ? 'checked="checked"' : '' ?>> 关闭
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="1" name="login"
                                       required="" <?= $login['value'] == '1' ? 'checked="checked"' : '' ?>> 开启
                            </label>

                            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                                开启后，访问文档和查询文档将需要登录。
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">显示版本切换功能<i class="am-text-danger">*</i></label>
                            <label class="am-radio-inline">
                                <input type="radio" value="0" name="change_version"
                                       required="" <?= $change_version['value'] == '0' ? 'checked="checked"' : '' ?>> 关闭
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="1" name="change_version"
                                       required="" <?= $change_version['value'] == '1' ? 'checked="checked"' : '' ?>> 开启
                            </label>

                            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                                默认开启。关闭后，在文档页访客将无法切换版本
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-g am-g-collapse">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-block">登录开启验证码<i class="am-text-danger">*</i></label>

                            <label class="am-radio-inline">
                                <input type="radio" value="0" name="verify"
                                       required="" <?= $verify['value'] == '0' ? 'checked="checked"' : '' ?>> 关闭
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="1" name="verify"
                                       required="" <?= $verify['value'] == '1' ? 'checked="checked"' : '' ?>> 开启
                            </label>

                            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                                防止暴力爆破就开启她吧！
                            </div>
                        </div>
                    </div>
                </div>


                <div class="am-g am-g-collapse am-margin-bottom">
                    <div class="am-u-sm-12 am-u-sm-centered">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
