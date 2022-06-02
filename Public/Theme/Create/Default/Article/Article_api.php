<div class="am-g am-g-collapse pes-api-article">

    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-input-group">
              <span class="am-input-group-select">
                <select name="api-method">
                    <?php foreach(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'COPY', 'HEAD', 'OPTIONS', 'LINK', 'UNLINK', 'PURGE', 'LOCK', 'PROPFIND', 'VIEW'] as $value): ?>
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
            <li class="am-fl am-active" >Header设置</li>
            <li class="am-fl">Body设置</li>
        </ul>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered">
        <table id="api-header" class="am-table am-table-bordered">
            <tr>
                <th></th>
                <th>名称</th>
                <th>值</th>
                <th>是否必填</th>
                <th>描述</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="api-use">
                    <input type="hidden" name="header_send[]" value="0">
                </td>
                <td><input type="text" class="api-new-input" name="header_key[]"></td>
                <td><input type="text" class="api-new-input" name="header_value[]"></td>
                <td>
                    <input type="checkbox" class="api-use">
                    <input type="hidden" name="header_require[]" value="0">
                </td>
                <td><input type="text" class="api-new-input" name="header_desc[]"></td>
                <td></td>
            </tr>
        </table>

        <table id="api-body" class="am-table am-table-bordered" style="display: none">
            <tr>
                <th></th>
                <th>名称</th>
                <th>值</th>
                <th>是否必填</th>
                <th>描述</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="api-use">
                    <input type="hidden" name="body_send[]" value="0">
                </td>
                <td><input type="text" class="api-new-input" name="body_key[]"></td>
                <td><input type="text" class="api-new-input" name="body_value[]"></td>
                <td>
                    <input type="checkbox" class="api-use">
                    <input type="hidden" name="body_require[]" value="0">
                </td>
                <td><input type="text" class="api-new-input" name="body_desc[]"></td>
                <td></td>
            </tr>
        </table>

    </div>
</div>

