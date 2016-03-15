<div class="admin-content am-padding am-padding-top-0">

    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

    <form class="am-form am-form-horizontal ajax-submit" action="" method="post" data-am-validator>
        <input type="hidden" name="method" value="PUT"/>
        <ul class="am-list am-list-static am-list-border am-text-sm">
            <li style="background: #F5f6FA;border-left: 4px solid #6d7781;">基础信息</li>
            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">当前版本</label>

                    <div class="am-u-sm-9">
                        <a class="am-btn am-btn-sm am-btn-warning" href="<?= $label->url(GROUP . '-Setting-upgrade') ?>"><i class="am-icon-refresh"></i> <?= $version['value'] ?>
                        </a>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">程序名称</label>

                    <div class="am-u-sm-9">
                        <input type="text" name="sitetitle" value="<?= $sitetitle['value'] ?>"/>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">上传图片格式</label>

                    <div class="am-u-sm-9">
                        <textarea name="upload_img"><?= implode(',', $upload_img) ?></textarea>

                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> 填写您要支持的图片格式，英文逗号分隔。
                        </div>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">上传文件格式</label>

                    <div class="am-u-sm-9">
                        <textarea name="upload_file"><?= implode(',', $upload_file) ?></textarea>

                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> 填写您要支持的文件格式，英文逗号分隔。
                        </div>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">文章导读</label>

                    <div class="am-u-sm-9">
                        <textarea name="articlereview" rows="10"><?= $articlereview['value'] ?></textarea>

                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> 为空则文章不显示导读（目录）功能。官方默认提供提取文章内容为h2字号的为导读标题。
                        </div>
                    </div>
                    <div class="am-u-sm-1">

                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">开启全站登录</label>

                    <div class="am-u-sm-9">
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
                    <div class="am-u-sm-1">

                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">登录开启验证码</label>

                    <div class="am-u-sm-9">
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
                    <div class="am-u-sm-1">

                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="submit" id="btn-submit" class="am-btn am-btn-primary am-btn-xs"
                                data-am-loading="{spinner: 'circle-o-notch', loadingText: '提交中...', resetText: '再次提交'}">
                            保存设置
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </form>
</div>
