<?php if (!empty($this->session()->get('user')['user_id'])): ?>
    <hr/>
    <form action="<?= $label->url("Doc-Article-addContent", ['id' => $doc_id, 'version' => $_GET['version']]); ?>"
          class="ajax-submit" method="POST">
        <p class="am-text-warning am-text-lg"><strong>添加内容</strong></p>
        <div>
            <script id="editor" type="text/plain" style="height:250px;"></script>
        </div>
        <div class="am-margin-top-sm">
            <input type="text" class="am-form-field" name="tag" placeholder="内容标签;填写标签，有利于用户检索内容，标签用英文逗号“,”作为分隔符。">
        </div>
        <div class="am-padding-xs am-text-center">
            <button class="am-btn  am-btn-xs am-btn-primary">添加</button>
        </div>

    </form>
    <script>
        var ue = UE.getEditor('editor', {
            textarea: 'content'
        });
    </script>
<?php endif; ?>