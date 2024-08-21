<div class="am-container am-padding-top" id="<?= $this->session()->get('doc')['member_id'] == '1' ? 'super-ad' : '' ?>">
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">

            <div class="am-panel am-panel-default">
                <div class="am-panel-bd member-center">
                    <h2>个人信息</h2>
                    <hr/>

                    <?php if ($this->session()->get('doc')['member_id'] == '1'): ?>
                        <div class="announcement-container">
                            <i class="am-icon-bullhorn"></i>
                            <div id="announcement" class="announcement">
                                <div><a href="https://my.locvps.net/page.aspx?c=referral&u=15004" target="_blank">PESCMS推荐：美国/日本/新加坡/香港等地区服务器只需要37元/月，老牌VPS服务商品质保证。</a>
                                </div>
                                <div>
                                    <a href="https://curl.qcloud.com/zvlCwCMB" target="_blank">腾讯轻量云PESCMS官方服务器也在使用。</a>
                                </div>
                                <div>
                                    <a href="https://www.aliyun.com/product/swas?scm=20140722.X_data-d4b68a29ba28f53e56fa._.V_1&source=5176.29345612&userCode=dwpuyec3" target="_blank">还有阿里云轻量云，PESCMS合作客户也在使用。</a>
                                </div>
                            </div>

                            <span class="am-text-xs am-text-danger"> [仅超级管理员可见]</span>

                        </div>
                        <hr/>
                    <?php endif; ?>

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

            <?php require_once __DIR__ . '/Member_adbar.php' ?>

        </div>
    </div>
</div>

<?php if ($this->session()->get('doc')['member_id'] == '1'): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const announcements = document.querySelectorAll('#announcement > div');
        let currentIndex = 0;

        function typeEffect(element, text) {
            element.innerHTML = '';  // 清空文本
            let index = 0;

            function type() {
                if (index < text.length) {
                    element.innerHTML += text.charAt(index);
                    index++;
                    setTimeout(type, 25);
                }
            }

            type();
        }

        function eraseEffect(element, text, callback) {
            let index = text.length;

            function erase() {
                if (index >= 0) {
                    element.innerHTML = text.substring(0, index);
                    index--;
                    setTimeout(erase, 25);
                } else {
                    callback();
                }
            }

            erase();
        }

        function showNextAnnouncement() {
            const currentAnnouncement = announcements[currentIndex].querySelector('a');
            const currentText = currentAnnouncement.dataset.text;

            eraseEffect(currentAnnouncement, currentText, function () {
                announcements[currentIndex].classList.remove('active');
                announcements[currentIndex].classList.add('inactive');

                currentIndex = (currentIndex + 1) % announcements.length;
                const nextAnnouncement = announcements[currentIndex].querySelector('a');
                const nextText = nextAnnouncement.dataset.text;

                announcements[currentIndex].classList.remove('inactive');
                announcements[currentIndex].classList.add('active');

                typeEffect(nextAnnouncement, nextText);
            });
        }

        // 初始化
        announcements.forEach(announcement => {
            const link = announcement.querySelector('a');
            link.dataset.text = link.innerHTML; // 保存初始文本
        });

        announcements[currentIndex].classList.add('active');
        const initialAnnouncement = announcements[currentIndex].querySelector('a');
        typeEffect(initialAnnouncement, initialAnnouncement.dataset.text);

        // 定时切换公告
        setInterval(showNextAnnouncement, 10000);
    });

</script>
<?php endif; ?>