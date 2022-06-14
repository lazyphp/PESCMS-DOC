<h2>基本信息</h2>

<p><strong>接口地址：</strong><span style="color: rgb(255, 192, 0);"><?= $api_url ?></span></p>
<p><strong>请求方式：</strong><span style="color: rgb(255, 192, 0);"><?= $api_method ?></span></p>

<?php if (!empty($data)): ?>
    <!-- API参数请求 -->
    <?php foreach ($data as $type => $item): ?>
        <h2><?= ucfirst($type) ?>参数请求</h2>

        <?php if ($type == 'body' && $postType == 'raw'): ?>
            <blockquote>
                <p><strong>请求方式：</strong><span style="color: rgb(255, 192, 0);"><?= strtoupper($rawType) ?></span></p>
                <p><strong>示例格式：</strong></p>
                <pre><?= htmlspecialchars($raw) ?></pre>
            </blockquote>
        <?php endif; ?>
        <table class="pes-article-api-table">
            <tr>
                <th>参数</th>
                <th>示例值</th>
                <th>类型</th>
                <th>默认值</th>
                <th>是否必填</th>
                <th>描述</th>
            </tr>
            <?php foreach ($item as $key => $value): ?>
                <tr>
                    <td><?= $value['key'] ?></td>
                    <td><?= $value['value'] ?? '-' ?></td>
                    <td><?= $value['type'] ?></td>
                    <td><?= $value['default'] ?? '-' ?></td>
                    <td><?= $value['require'] == 1 ? '必填' : '非必填' ?></td>
                    <td><?= $value['desc'] ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endforeach; ?>

<?php endif; ?>

<?php if (!empty($response)): ?>
    <!-- 资源响应结果 -->
    <?php foreach ($response as $type => $item): ?>

        <h2><?= $type ?></h2>

        <strong><?= $type ?>时返回的结构</strong>
        <pre><?= $item['content'] ?></pre>

        <?php if (!empty($item['detail'])): ?>
            <p>返回参数说明</p>
            <table class="pes-article-api-table">
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>描述</th>
                </tr>
                <?php foreach ($item['detail'] as $key => $value): ?>
                    <tr>
                        <td><?= $value['key'] ?></td>
                        <td><?= $value['type'] ?></td>
                        <td><?= $value['desc'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>