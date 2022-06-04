<hr/>
<h2>基本信息</h2>

<p><strong>接口地址：</strong><span style="color: rgb(255, 192, 0);"><?= $api_url ?></span></p>
<p><strong>请求方式：</strong><span style="color: rgb(255, 192, 0);"><?= $api_method ?></span></p>

<?php if (!empty($data)): ?>

    <?php foreach ($data as $type => $item): ?>
        <h2><?= ucfirst($type) ?></h2>
        <?php if($type == 'body' && $postType == 'raw' ): ?>
            <blockquote>
                <p><strong>请求方式：</strong><span style="color: rgb(255, 192, 0);"><?= strtoupper($rawType) ?></span></p>
                <p><strong>示例格式：</strong><pre><?= $raw ?></pre></p>

            </blockquote>
        <?php endif; ?>
        <table>
            <tr>
                <td>名称</td>
                <td>示例值</td>
                <td>类型</td>
                <td>默认值</td>
                <td>是否必填</td>
                <td>描述</td>
            </tr>
            <?php foreach ($item as $key => $value): ?>
                <tr>
                    <td><?= $value['key'] ?></td>
                    <td><?= $value['value'] ?></td>
                    <td><?= $value['type'] ?></td>
                    <td><?= $value['default'] ?></td>
                    <td><?= $value['require'] == 1 ? '必填' : '非必填' ?></td>
                    <td><?= $value['desc'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endforeach; ?>

<?php endif; ?>