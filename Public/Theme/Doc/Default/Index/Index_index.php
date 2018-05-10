<?php include THEME_PATH . '/header.php'; ?>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-lg-10 am-u-sm-centered ">
            <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-bordered">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <li class="am-text-center">
                        <div class="am-gallery-item">
                            <a href="javascript:;" class="">
                                <img src="http://s.amazeui.org/media/i/demos/bing-1.jpg" alt="远方 有一个地方 那里种有我们的梦想"/>
                                <h3 class="am-gallery-title">PESCMS开发文档</h3>
                            </a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>


<?php include THEME_PATH . "/footer.php"; ?>