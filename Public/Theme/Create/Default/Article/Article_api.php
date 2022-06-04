<div class="am-g am-g-collapse pes-api-article">

    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-input-group">
              <span class="am-input-group-select">
                <select name="api-method">
                    <?php foreach (['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'COPY', 'HEAD', 'OPTIONS', 'LINK', 'UNLINK', 'PURGE', 'LOCK', 'PROPFIND', 'VIEW'] as $value): ?>
                        <option><?= $value ?></option>
                    <?php endforeach; ?>
                </select>
              </span>
            <input type="text" name="api-url" class="am-form-field">

            <span class="am-input-group-btn">
            <a href="javascript:;" class="am-btn am-btn-default api-send">发送</a>
            </span>

        </div>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered">
        <ul class="pes-api-article-setting am-nbfc">
            <li class="am-fl">GET设置</li>
            <li class="am-fl am-active">Header设置</li>
            <li class="am-fl">Body设置</li>
        </ul>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered">
        <?php foreach (['header', 'get', 'body'] as $value): ?>
            <table id="api-<?= $value ?>" class="am-table am-table-bordered" <?= $value == 'header' ? '' : 'style="display: none"' ?>>
                <?php if($value == 'body'): ?>
                <tr class="body-type">
                    <th class="am-text-middle" colspan="8">
                        <div class="am-form-group am-margin-0">
                            <label class="am-radio-inline">
                                <input type="radio"  value="form-data" name="post-type" checked> form-data
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="raw" name="post-type"> raw
                            </label>
                        </div>
                    </th>
                </tr>
                <tr class="post-raw" style="display: none;">
                    <th class="am-text-middle" colspan="8">
                        <select name="raw-type">
                            <?php foreach(['JSON', 'XML', 'Text', 'HTML'] as $rt): ?>
                            <option value="<?= $rt ?>"><?= $rt ?></option>
                            <?php endforeach; ?>
                        </select>
                        <textarea name="raw" rows="10"></textarea>
                    </th>
                </tr>
                <?php endif; ?>
                <tr>
                    <th <?= $value == 'get' ? 'style="display: none"' : '' ?>>发送数据</th>
                    <th>名称</th>
                    <th>示例值</th>
                    <th>类型</th>
                    <th>默认值</th>
                    <th>是否必填</th>
                    <th>描述</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="am-text-middle" <?= $value == 'get' ? 'style="display: none"' : '' ?>>
                        <input type="checkbox" class="api-use">
                        <input type="hidden" name="<?= $value ?>_send[]" value="0">
                    </td>
                    <td class="am-text-middle">
                        <input type="text" class="api-new-input" name="<?= $value ?>_key[]" <?= $value == 'get' ? 'readonly="readonly"' : '' ?>>
                    </td>
                    <td class="am-text-middle">
                        <input type="text" class="api-new-input" name="<?= $value ?>_value[]" <?= $value == 'get' ? 'readonly="readonly"' : '' ?>>
                    </td>
                    <td class="am-text-middle">
                        <select name="<?= $value ?>_type[]">
                            <?php foreach ($apiField as $type): ?>
                                <option value="<?= $type ?>"><?= $type ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="am-text-middle"><input type="text" class="api-new-input" name="<?= $value ?>_default[]">
                    </td>
                    <td class="am-text-middle">
                        <input type="checkbox" class="api-use">
                        <input type="hidden" name="<?= $value ?>_require[]" value="0">
                    </td>
                    <td class="am-text-middle"><input type="text" class="api-new-input" name="<?= $value ?>_desc[]">
                    </td>
                    <td class="am-text-middle"></td>
                </tr>
            </table>
        <?php endforeach; ?>

    </div>


    <div class="am-u-sm-12 am-u-sm-centered api-pre">

    </div>

</div>

