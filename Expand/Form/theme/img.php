<div data-am-webuploader-simple="{id:'<?= $field['field_name']; ?>', name:'<?= $field['field_name']; ?>[]',pick:{id:'#<?= $field['field_name']; ?>', multiple:true}, accept:{title:'Images', mimeTypes: '<?= self::$accept['upload_img'] ?? '' ?>'  }, content:'<?= $field['value'] ?? ''; ?>', type:'img'}"></div>