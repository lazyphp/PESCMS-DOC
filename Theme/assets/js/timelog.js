$(function () {

    /**
     * 刷新验证码
     */
    $(".verify").on("click", function () {
        $(this).attr("src", "/d/verify/" + Date.parse(new Date()) + Math.random())
    })

    /**
     * 封装过的ajax方法
     * 注：本方法仅适用于PESCMS系列程序
     * @param data ajax请求信息设置，以对象形式提交： {url:'请求地址', data:{'表单名称':'表单值'}, type:'请求方式', dataType:'回调数据', dialog:'是否在请求完成后进行对话框提示'} | type默认为POST，dataType默认为JSON, dialog默认为true
     * @param callback 回调函数。请求成功后，会返回success的数据包
     * @returns {boolean}
     */
    ajax = function (data, callback) {
        var obj = {url: '', data: {}, type: 'POST', 'dataType': 'JSON', dialog:true};
        $.extend(obj, data)
        if (obj.url == '') {
            $('#am-alert').modal();
            $(".alert-tips").html('没有填写请求地址');
            return false;
        }
        var progress = $.AMUI.progress;
        progress.start();
        $.ajax({
            url: obj.url,
            data: obj.data,
            type: obj.type,
            dataType: obj.dataType,
            success: function (data) {
                if(obj.dialog == true){
                    $('#am-alert').modal();
                    $(".alert-tips").html(data.msg);
                    setTimeout(function () {
                        $('#am-alert').modal('close');
                    }, '1200');
                }

                callback(data);
                progress.done();
            },
            error: function () {
                $('#am-alert').modal();
                $(".alert-tips").html("数据异常");

                setTimeout(function () {
                    $('#am-alert').modal('close');
                }, '1000')
                progress.done();
                return false;
            }
        })
    }
})