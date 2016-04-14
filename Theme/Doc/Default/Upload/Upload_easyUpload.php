<?php include THEME_PATH.'/header.php' ?>
<script>
        //声明全部变量
        var main_window = window.opener;
        $(function(){
            var upload = '<?=$img['state']?>';
            if(upload == 'SUCCESS'){
                $(main_window.document).find('input').val('<?=$img['url']?>');
                window.close();
            }else{
                <?= empty($alert) ? '' : "alert('{$alert}');" ?>
            }
        })
</script>
<form action="" method="POST" enctype="multipart/form-data">
        <div class="am-g am-padding-top">
            <div class="am-u-sm-12 am-u-sm-centered">
                <div class="am-form-group">
                    <img class="am-img-thumbnail" alt="140*140" src="<?= DOCUMENT_ROOT.'/Theme/assets/i/image.png'; ?>" width="140" height="140">
                    <div class="am-form-group am-form-file">
                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                            <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                        <input id="inputFileToLoad" type="file" name="upfile"  onchange="encodeImageFileAsURL();" multiple />
                    </div>
                    <div id="file-list"></div>
                    <script>
                        $(function() {
                            $('#doc-form-file').on('change', function() {
                                var fileNames = '';
                                $.each(this.files, function() {
                                    fileNames += '<span class="am-badge">' + this.name + '</span> ';
                                });
                                $('#file-list').html(fileNames);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>


        <div class="am-g">
            <div class="am-u-sm-12 am-u-sm-centered">
                <button type="submit" class="am-btn am-btn-primary">上传</button>
            </div>
        </div>
    </form>
    <script type='text/javascript'>
        function encodeImageFileAsURL(){

            var filesSelected = document.getElementById("inputFileToLoad").files;
            if (filesSelected.length > 0)
            {
                var fileToLoad = filesSelected[0];

                var fileReader = new FileReader();

                fileReader.onload = function(fileLoadedEvent) {
                    var srcData = fileLoadedEvent.target.result; // <--- data: base64
                    var newImage = document.createElement('img');
                    newImage.src = srcData;

                    $('.am-img-thumbnail').attr('src', newImage.src)

                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }
    </script>
</form>
<?php include THEME_PATH.'/footer.php' ?>