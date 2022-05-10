<div id="<?= $field['field_name'] ?>" style="min-height: 400px" ></div>
<textarea name="<?= $field['field_name'] ?>" style="display: none"><?= $field['value'] ?? '' ?></textarea>
<script>
    $(function () {

        pesMD.<?= $field['field_name'] ?> = new Vditor('<?= $field['field_name'] ?>', {
            cache: {
                enable: false
            },
            mode: 'sv',
            value: $('textarea[name="<?= $field['field_name'] ?>"]').val(),
            upload: {
                accept: 'image/*,.mp3, .wav, .rar, .zip',
                token: 'test',
                multiple: false,
                url: pesMDUploadURL,
                fieldName: 'upfile',
                success(editor, msg) {
                    var res = JSON.parse(msg);
                    if (res.state == 'SUCCESS') {
                        pesMD.<?= $field['field_name'] ?>.tip('上传成功')
                        var isImg = res.action == 'uploadimage' ? '!' : ''
                        pesMD.<?= $field['field_name'] ?>.insertValue(`${isImg}[${res.original}](${res.url})`)
                    } else {
                        pesMD.<?= $field['field_name'] ?>.tip(res.state)
                    }
                }
            },
            after(){
                $('.vditor-toolbar').attr('style', 'z-index:10;display:flex').sticky()
            }
        })

    })
</script>