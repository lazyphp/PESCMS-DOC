<!-- content start -->
<div class=" am-padding-xs am-padding-top-0">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            <div class="am-cf">
                <div class="am-fl am-cf">
                    <?php if (!empty($_GET['back_url'])): ?>
                        <a href="<?= base64_decode($_GET['back_url']) ?>" class="am-margin-right-xs am-text-danger"><i
                                class="am-icon-reply"></i>返回</a>
                    <?php endif; ?>
                    <strong class="am-text-primary am-text-lg"><a href="<?= $label->url(GROUP .'-' . MODULE . '-' . ACTION); ?>"><?= $title; ?></a>
                    </strong> /
                    <small>列表</small>
                </div>
            </div>
            <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
            <blockquote class="am-text-xs">背景绿色的为菜单</blockquote>
            <form class="am-form ajax-submit" method="post">
                <input type="hidden" name="method" value="PUT">
                <table class="am-table am-table-striped am-table-hover">
                    <tr>
                        <th>
                            <input type="checkbox" class="checkbox-all-children" data-id="0">
                            节点名称
                        </th>
                        <th>菜单地址</th>
                    </tr>

                    <?php \Model\Node::recursion('0', __DIR__.'/Member_organize_auth_list.php'); ?>
                </table>
                <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius">保存</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(function (){
        
        var checked = JSON.parse('<?= json_encode($checked) ?>');
        checked.map(function (item) {
            $('input[name="id['+item['node_id']+']"]').prop('checked', true)
        })

        var recursion = function (id, checked){
            $('input[data-parent="'+id+'"]').each(function (){
                $(this).prop('checked', checked)
                var id = $(this).data('id')
                recursion(id, checked);
            })
        }

        $('.checkbox-all-children').on('click', function (){
            var id = $(this).data('id')
            var checked = $(this).prop('checked');
            recursion(id, checked);
        })
    })
</script>