<?php if ($this->session()->get('user')['user_id']): ?>
    <form id="submit_<?= $value['doc_content_id'] ?>" class="ajax-submit" action="<?= $label->url('Doc-Doc-updateContent', ['id' => $value['doc_content_id']]); ?>" method="POST">
        <input type="hidden" name="method" value="PUT">
    <script id="content_<?= $value['doc_content_id'] ?>" type="text/plain" style="height:250px;"><?= htmlspecialchars_decode($value['doc_content']); ?></script>
        <div class="am-margin-top-sm am-hide content_tag_<?= $value['doc_content_id'] ?>">
            <input type="text" class="am-form-field" name="tag" value="<?= implode(',', $tagArray); ?>" placeholder="内容标签">

            <div class="am-alert am-alert-secondary am-text-xs" data-am-alert>
                填写标签，有利于用户检索内容，标签用英文逗号“,”作为分隔符。
            </div>
        </div>
    </form>
<?php endif; ?>