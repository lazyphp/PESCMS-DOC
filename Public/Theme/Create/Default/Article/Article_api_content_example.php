<?php if (!empty($data)): ?>

    <?php foreach ($data as $type => $item): ?>
        <h2><?= ucfirst($type) ?></h2>

        <table>
            <tr>
                <td>名称</td>
                <td>值</td>
                <td>是否必填</td>
                <td>描述</td>
            </tr>
            <?php foreach ($item as $key => $value): ?>
                <tr>
                    <td><?= $value['key'] ?></td>
                    <td><?= $value['value'] ?></td>
                    <td><?= $value['require'] ?></td>
                    <td><?= $value['desc'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endforeach; ?>

<?php endif; ?>