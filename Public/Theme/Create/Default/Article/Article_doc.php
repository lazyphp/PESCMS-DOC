<input type="hidden" name="method" value="PUT">
<textarea class="am-hide" name="md"><?= $doc['doc_content_md'] ?></textarea>
<textarea class="am-hide" name="html"><?= $doc['doc_content'] ?></textarea>
<input type="hidden" name="editor" value="<?= $doc['doc_content_editor'] ?>">

<div class="am-g am-g-collapse">

    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">文档首页关键词</label>
                <input type="text" name="doc_keyword" value="<?= $doc['doc_keyword'] ?>"  placeholder="文档首页关键词">
            </div>
        </div>
    </div>

    <div class="am-g am-g-collapse">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">文档首页描述</label>
                <textarea name="doc_description" placeholder="文档首页描述" rows="5"><?= $doc['doc_description'] ?></textarea>
            </div>
        </div>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block"> 详细内容</label>
            <div id="editor-tab-list">
                <a href="javascript:;" class="use-ue am-link-muted <?= ($doc['doc_content_editor'] == '0' && !empty($doc['doc_content'])  ) || ( self::session()->get('doc')['member_editor'] == 0 && empty($doc['doc_content']) && empty($doc['doc_content_md']) ) ? 'am-active' :'' ?>">HTML编辑器</a>
                <a href="javascript:;" class="use-md am-link-muted <?= ($doc['doc_content_editor'] == '1' && !empty($doc['doc_content']) && !empty($doc['doc_content_md']) ) || ( self::session()->get('doc')['member_editor'] == 1 && empty($doc['doc_content']) && empty($doc['doc_content_md']) ) ? 'am-active' :'' ?>">Markdown编辑器</a>
            </div>
            <div id="content" type="text/plain"></div>
            <div id="content_md" type="text/plain"></div>

        </div>
    </div>
</div>