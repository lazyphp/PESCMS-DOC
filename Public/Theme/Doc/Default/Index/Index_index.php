<div class="am-container">
    <div class="am-u-sm-12 am-u-lg-centered pes-doc-index">
        <ul class="am-gallery am-gallery-bordered am-text-center am-no-layout">
            <?php foreach ($doc as $key => $value): ?>
                <li class="am-text-center am-inline-block">
                    <div class="am-gallery-item am-radius">
                        <a href="<?= $label->url('Doc-Article-index', ['id' => $value['doc_id']]) ?>">
                            <div class="doc-cover" style="background-image: url('<?=$value['doc_cover']?>')" ></div>
                            <h3 class="am-gallery-title"><?= $value['doc_title'] ?></h3>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

