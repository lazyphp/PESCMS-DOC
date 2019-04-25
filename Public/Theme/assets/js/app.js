/**
 * PESCMS核心的JS类库
 */
$(function () {

    /**
     * 触发表单提交功能。
     */
    $('body').on('submit', '.ajax-submit', function () {
        var url = $(this).attr("action")
        var dom = $(this)
        $.ajaxsubmit({
            url: url,
            data: dom.serialize()
        }, function () {
        });

        return false;
    })

    /**
     * 适用于GET请求的ajax方法
     * 需要注意的是，若需要明确restful的话，请在URL中声明method方法。
     * 若监听的class中存在ajax-delete，在该标签中声明 msg="提示信息" ，将可以自定义提示信息
     */
    $("body").on("click", ".ajax-click", function () {
        var url = $(this).attr("href");
        var stop = false;
        //设置了禁用则不允许触发事件
        if ($(this).hasClass('am-disabled')) {
            return false;
        }


        //弹出对话框
        if ($(this).hasClass('ajax-dialog')) {
            var msg = $(this).attr("msg") ? $(this).attr("msg") : '确定删除吗？';
            if (!confirm(msg)) {
                stop = true;
            }
        }
        if (stop == true) {
            return false;
        }

        $.ajaxsubmit({
            url: url
        }, function () {
        });
        return false;
    })

    /**
     * 封装过的ajax方法
     * 注：本方法仅适用于PESCMS系列程序
     * @param param ajax请求信息设置，以对象形式提交： {url:'请求地址', data:{'表单名称':'表单值'}, dialog:'是否在请求完成后进行对话框提示并刷新'}
     * @param callback 回调函数。请求成功后，会返回success的数据包
     * @returns {boolean}
     */
    $.ajaxsubmit = function (param, callback) {
        var obj = {url: '', data: {'': ''}, dialog: true};
        $.extend(obj, param)

        var progress = $.AMUI.progress;
        var d = dialog({title: '系统提示', zIndex: '999'});
        if(obj.dialog == true){
            d.showModal()
        }
        progress.start();

        $.post(obj.url, obj.data, function (data) {

            if (obj.dialog == true) {
                if (data.status == 200) {

                    if(data.waitSecond == -1){
                        window.location.href = data.url
                        return false;
                    }

                    setTimeout(function () {
                        data.url ? window.location.href = data.url : location.reload();
                    }, 2000);
                }
                d.content(data.msg);

            }
            $.refreshToken(data.token);
            callback(data);

        }, 'JSON').fail(function (jqXHR, textStatus, error) {
            var msg = '系统请求出错！请再次提交!';
            try{
                $.refreshToken(jqXHR.responseJSON.token);
                switch (jqXHR.responseJSON.status){
                    case 500:
                        msg = jqXHR.responseJSON.msg;
                        break;
                    case 404:
                        msg = jqXHR.responseJSON.msg;
                        break;
                }

            }catch (e){

            }
            d.content(msg);
        }).complete(function(){
            var src = $('.refresh-verify').attr('src')
            $('.refresh-verify').attr('src', src + '&time=' + Math.random());
            setTimeout(function () {
                d.close();
            }, 3000);
            progress.done();
        });
    }

    /**
     * 更新token
     * @param token
     */
    $.refreshToken = function (token) {
        $('input[name=token]').each(function () {
            $(this).val(token);
        })
    }

    /**
     * 预览输入的图标
     */
    $("body").on("blur", ".icon-input", function(){
        var name = $(this).attr("name");
        $('.'+name).attr("class", $(this).val()+ ' '+ name);
    })

    /**
     * 刷新验证码
     */
    $(document).on('click', '.refresh-verify', function () {
        var src = $(this).attr('src')
        $(this).attr('src', src + '&time=' + Math.random());
    });

    /**
     * 搜索弹出下拉选择
     */
    $('.search-article').on('click', function(){
        if($('.pes-search input[name="tree"]').val() == 0){
            $('.article-tree').dropdown('open');
            return false;
        }


    })

})