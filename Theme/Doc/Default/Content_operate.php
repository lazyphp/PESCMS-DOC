<?php //本模板为通用编辑按钮  ?>
<div class="am-btn-toolbar">
    <div class="am-btn-group am-btn-group-xs">
        <a class="am-btn am-btn-secondary" href="<?= $label->url(GROUP.'-' . MODULE . '-action', array('id' => $value["{$fieldPrefix}id"])); ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
        <a class="am-btn am-btn-danger" href="<?= $label->url(GROUP.'-' . MODULE . '-action', array('id' => $value["{$fieldPrefix}id"], 'method' => 'DELETE')); ?>" onclick="return confirm('确定删除吗?')"><span class="am-icon-trash-o"></span> 删除</a>
    </div>
</div>