<select class="input-leng3 am-radius" name="<?= $field['field_name'] ?>" <?= $field['field_required'] == '1' ? 'required' : '' ?> >
    <?php foreach (json_decode(htmlspecialchars_decode($field['field_option']), true) as $key => $value) : ?>
        <option value="<?= $value ?>" <?= isset($field['value']) && $field['value'] == $value ? 'selected="selected"' : (!isset($field['value']) && $field['field_default'] == $value ? 'selected="selected"' : '') ?>><?= $key ?></option>
    <?php endforeach; ?>
</select>