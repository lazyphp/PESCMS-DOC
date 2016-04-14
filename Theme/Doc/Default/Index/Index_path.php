<?php include THEME_PATH.'/header.php' ?>

<input type="text" value="我是主窗口中的值1">
<button onclick="openWindow()">打开新窗口</button>

<script>
    function openWindow() {
        window.open(path + '/?g=Doc&m=Upload&a=easyUpload&method=POST', 'newwindow', 'height=400,width=500,top=200,left=50,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no');   //window.open()打开了一个新窗口,并且返回对新窗口的引用
    }
</script>
<?php include THEME_PATH.'/footer.php' ?>