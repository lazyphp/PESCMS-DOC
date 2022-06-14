<div class="am-g am-g-collapse pes-api-article" <?= isset($article_using_api_tool) && $article_using_api_tool == 1 ? '' : 'style="display:none"' ?>>
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-input-group">
              <span class="am-input-group-select">
                <select name="api-method">
                    <?php foreach (['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'COPY', 'HEAD', 'OPTIONS', 'LINK', 'UNLINK', 'PURGE', 'LOCK', 'PROPFIND', 'VIEW'] as $value): ?>
                        <option <?= isset($apiParams['api_method']) && $value == $apiParams['api_method'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach; ?>
                </select>
              </span>
            <input type="text" name="api-url" value="<?= $apiParams['api_url'] ?? '' ?>" class="am-form-field">

            <span class="am-input-group-btn">
            <a href="javascript:;" class="am-btn am-btn-default api-send">发送/更新</a>
            </span>

        </div>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered">
        <ul class="pes-api-article-setting am-nbfc">
            <li class="am-fl" data="get">GET设置</li>
            <li class="am-fl am-active" data="header">Header设置</li>
            <li class="am-fl" data="body">Body设置</li>
            <li class="am-fl" data="result">执行结果</li>
        </ul>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered">
        <?php foreach (['header', 'get', 'body'] as $apiName): ?>
            <table id="api-<?= $apiName ?>" class="am-table am-table-bordered" <?= $apiName == 'header' ? '' : 'style="display: none"' ?>>
                <?php if ($apiName == 'body'): ?>
                    <tr class="body-type">
                        <th class="am-text-middle" colspan="8">
                            <div class="am-form-group am-margin-0">
                                <?php foreach (['form-data', 'raw'] as $postType): ?>
                                    <label class="am-radio-inline">
                                        <input type="radio" value="<?= $postType ?>" name="post-type" <?= isset($apiParams['postType']) && $apiParams['postType'] == $postType ? 'checked' : '' ?>>
                                        <?= $postType ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </th>
                    </tr>
                    <tr class="post-raw" style="display: none;">
                        <th class="am-text-middle" colspan="8">
                            <select name="raw-type">
                                <?php foreach (['JSON', 'XML', 'Text', 'HTML'] as $rt): ?>
                                    <option value="<?= $rt ?>" <?= isset($apiParams['rawType']) && strtolower($rt) == $apiParams['rawType'] ? 'selected' : '' ?> ><?= $rt ?></option>
                                <?php endforeach; ?>
                            </select>
                            <textarea name="raw" rows="10"><?= $apiParams['raw'] ?? '' ?></textarea>
                        </th>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th <?= $apiName == 'get' ? 'style="display: none"' : '' ?>>发送数据</th>
                    <th>参数</th>
                    <th>示例值</th>
                    <th>类型</th>
                    <th>默认值</th>
                    <th>是否必填</th>
                    <th>描述</th>
                    <th></th>
                </tr>
                <?php foreach (array_merge($apiParams['data'][$apiName] ?? [], [['new' => 'new']]) as $key => $value): ?>
                    <tr>
                        <td class="am-text-middle" <?= $apiName == 'get' ? 'style="display: none"' : '' ?>>
                            <input type="checkbox" class="api-use" <?= isset($value['send']) && $value['require'] == 1 ? 'checked' : '' ?>>
                            <input type="hidden" name="<?= $apiName ?>_send[]" value="<?= $value['send'] ?? '0' ?>">
                        </td>
                        <td class="am-text-middle">
                            <input type="text" class="<?= isset($value['new']) ? 'api-new-input' : '' ?>" name="<?= $apiName ?>_key[]" value="<?= $value['key'] ?? '' ?>" <?= $apiName == 'get' ? 'readonly="readonly"' : '' ?>>
                        </td>
                        <td class="am-text-middle">
                            <input type="text" class="<?= isset($value['new']) ? 'api-new-input' : '' ?>" name="<?= $apiName ?>_value[]" value="<?= $value['value'] ?? '' ?>" <?= $apiName == 'get' ? 'readonly="readonly"' : '' ?>>
                        </td>
                        <td class="am-text-middle">
                            <select name="<?= $apiName ?>_type[]">
                                <?php foreach ($apiField as $type): ?>
                                    <option value="<?= $type ?>" <?= isset($value['type']) && $type == $value['type'] ? 'selected' : ''  ?>><?= $type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="am-text-middle">
                            <input type="text" class="<?= isset($value['new']) ? 'api-new-input' : '' ?>" name="<?= $apiName ?>_default[]" value="<?= $value['default'] ?? '' ?>">
                        </td>
                        <td class="am-text-middle">
                            <input type="checkbox" class="api-use" <?= isset($value['require']) && $value['require'] == 1 ? 'checked' : '' ?>>
                            <input type="hidden" name="<?= $apiName ?>_require[]" value="<?= $value['require'] ?? '0' ?>">
                        </td>
                        <td class="am-text-middle">
                            <input type="text" class="<?= isset($value['new']) ? 'api-new-input' : '' ?>" name="<?= $apiName ?>_desc[]" value="<?= $value['desc'] ?? '' ?>">
                        </td>
                        <td class="am-text-middle"></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        <?php endforeach; ?>

    </div>

    <div class="am-u-sm-12 am-u-sm-centered" id="api-result" style="display: none">
        <pre style="max-height: 300px;overflow: auto;background: #ffd;color: #333;display: none;"></pre>

        <div class="am-form-group am-margin-0">
            <div class="am-margin-vertical-xs">
                <label class="am-radio-inline">
                    <input type="radio" value="success" name="result-type" checked> 返回成功结构说明
                </label>
                <label class="am-radio-inline">
                    <input type="radio" value="error" name="result-type"> 返回错误结构说明
                </label>
            </div>

            <?php foreach (['success', 'error'] as $key => $apiName): ?>
                <table class="am-table am-table-bordered" id="table_<?= $apiName ?>" <?= $apiName == 'error' ? 'style="display:none"' : '' ?> >
                    <tr>
                        <th>参数</th>
                        <th>类型</th>
                        <th>描述</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <textarea name="<?= $apiName ?>_content" placeholder="此处填写API回调的文本" rows="5"><?= $apiParams['response'][$apiName]['content'] ?? '' ?></textarea>
                        </th>
                    </tr>

                    <?php foreach (array_merge($apiParams['response'][$apiName]['detail'] ?? [], [['new' => 'new']]) as $key => $value): ?>
                    <tr>
                        <td class="am-text-middle">
                            <input type="text" class="<?= isset($value['new']) ? 'api-new-input' : '' ?>" name="<?= $apiName ?>_key[]" value="<?= $value['key'] ?? '' ?>">
                        </td>
                        <td class="am-text-middle">
                            <select name="<?= $apiName ?>_type[]">
                                <?php foreach ($apiField as $type): ?>
                                    <option value="<?= $type ?>" <?= isset($value['type']) && $type == $value['type'] ? 'selected' : ''  ?>><?= $type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="am-text-middle">
                            <input type="text" class="<?= isset($value['new']) ? 'api-new-input' : '' ?>" name="<?= $apiName ?>_desc[]" value="<?= $value['desc'] ?? '' ?>">
                        </td>
                        <td class="am-text-middle"></td>
                    </tr>
                    <?php endforeach; ?>

                </table>
            <?php endforeach; ?>

        </div>

    </div>

    <div class="am-u-sm-12 am-u-sm-centered am-text-xs">
        <div class="am-alert am-alert-warning" data-am-alert>
            <button type="button" class="am-close">&times;</button>
            数值有任何变化都请点 [发送/更新] 按钮更新效果
        </div>
    </div>

    <div class="am-u-sm-12 am-u-sm-centered api-pre" style="display: none">
        <div class="api-pre-title am-nbfc">
            <div class="am-fl"><strong>API文档渲染结果</strong></div>
            <div class="am-fr">
                <a href="javascript:;" class="am-btn am-btn-xs am-btn-default api-refresh"><i class="am-icon-refresh"></i> 更新文档内容</a>
                <a href="javascript:;" class="am-btn am-btn-xs am-btn-default api-clear-editor"><i class="am-icon-eraser"></i> 清空编辑器</a>
                <a href="javascript:;" class="am-btn am-btn-xs am-btn-default api-result-copy"><i class="am-icon-copy"></i> 复制内容</a>
                <a href="javascript:;" class="am-btn am-btn-xs am-btn-default api-insert-editor"><i class="am-icon-clipboard"></i> 插入编辑器</a>
                <a href="javascript:;" class="am-btn am-btn-xs am-btn-default api-close-window"><i class="am-icon-close"></i> 关闭</a>
            </div>
        </div>
        <div class="api-pre-content"></div>
    </div>

</div>

