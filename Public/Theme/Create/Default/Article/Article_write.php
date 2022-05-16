<input type="hidden" name="method" value="<?= $method ?? null ?>">
<input type="hidden" name="aid" value="<?= $article_id ?? null ?>">
<textarea class="am-hide" name="md"><?= $article_content_md ?? null ?></textarea>
<textarea class="am-hide" name="html"><?= $article_content ?? null ?></textarea>
<input type="hidden" name="editor" value="<?= $article_content_editor ?? null ?>">

<div class="am-g am-g-collapse">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档标题</label>
            <input type="text" name="article_title" value="<?= $article_title ?? null ?>"  placeholder="文档标题" required>
        </div>
    </div>
</div>

<div class="am-g am-g-collapse">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">所属目录</label>
            <select name="article_parent" required>
                <option value="0">顶层目录</option>
                <?= $pathOption ?? null ?>
            </select>
        </div>
    </div>
</div>

<div class="am-g am-g-collapse">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档属性</label>
            <label class="am-radio-inline">
                <input type="radio"  value="0" name="article_node" <?= isset($article_node) && $article_node == 0 && is_numeric($article_node) ? 'checked="checked"' : '' ?> required> 文章
            </label>
            <label class="am-radio-inline">
                <input type="radio" value="1" name="article_node" <?= isset($article_node) &&  $article_node == 1 && is_numeric($article_node) ? 'checked="checked"' : '' ?> required> 目录
            </label>
            <label class="am-radio-inline">
                <input type="radio" value="2" name="article_node" <?= isset($article_node) &&  $article_node == 2 && is_numeric($article_node) ? 'checked="checked"' : '' ?> required> 外链文章
            </label>
        </div>
    </div>
</div>

<div class="am-g am-g-collapse">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档权重</label>
            <input type="text" name="article_listsort" value="<?= $article_listsort ?? null ?>"  placeholder="文档权重升序，默认是创建顺序倒叙">
        </div>
    </div>
</div>

<div class="am-g am-g-collapse article_external_link">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">外链地址</label>
            <input type="text" name="article_external_link" value="<?= $article_external_link ?? null ?>"  placeholder="文档外链地址">
        </div>
    </div>
</div>

<div class="am-g am-g-collapse pes-article-editor">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档内容</label>
            <div id="editor-tab-list">
                <a href="javascript:;" class="use-ue am-link-muted <?= ($article_content_editor == '0' && !empty($article_content) ) || ( self::session()->get('doc')['member_editor'] == 0 && empty($article_content) && empty($article_content_md) ) ? 'am-active' :'' ?>">HTML编辑器</a>
                <a href="javascript:;" class="use-md am-link-muted <?= ( $article_content_editor == '1' && !empty($article_content) && !empty($article_content_md) ) || ( self::session()->get('doc')['member_editor'] == 1 && empty($article_content) && empty($article_content_md) ) ? 'am-active' :'' ?>">Markdown编辑器</a>
            </div>
            <div id="content" type="text/plain"></div>
            <div id="content_md" type="text/plain"></div>

        </div>
    </div>
</div>

<div class="am-g am-g-collapse pes-article-editor">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档关键词</label>
            <input type="text" name="article_keyword" value="<?= $article_keyword ?? null ?>"  placeholder="文档关键词">
        </div>
    </div>
</div>

<div class="am-g am-g-collapse pes-article-editor">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档描述</label>
            <textarea name="article_description" placeholder="文档描述" rows="5"><?= $article_description ?? null ?></textarea>
        </div>
    </div>
</div>

<div class="am-g am-g-collapse">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">文档标记</label>
            <input type="text" name="article_mark" value="<?= $article_mark ?? null ?>"  placeholder="文档唯一标记">
        </div>
        <div class="am-alert am-alert-info am-text-xs ">
            <i class="am-icon-lightbulb-o"></i> 没有特别需要，此处留空即可。程序会基于雪花算法生成文档的唯一标记。
        </div>
    </div>
</div>