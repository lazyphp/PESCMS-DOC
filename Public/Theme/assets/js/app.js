$(function () {
    /**
     * 更新token
     * @param token
     */
    $.refreshToken = function (token) {
        $('input[name=token]').each(function () {
            $(this).val(token);
        })
    }

    $.ajaxSubmit = function (options) {
        var obj = {
            url: '',
            method: 'GET',
            data: {
                '': ''
            },
            dataType: 'JSON',
            timeout: 60000,
            closeTips: false, //默认是开启提示，不执行自定义的success, fail, complete
            success: function () {

            },
            error: function () {

            },
            complete: function () {

            },
            skipAutoTips: false, //跳过 404 和 500 错误的默认提示
            stopJump: false //停至跳转
        };

        Object.assign(obj, options);

        var dialogOption = {id: 'submit-tips', zIndex: '9999', fixed: true, skin: 'submit-warning'};

        $.ajax({
            url: obj.url,
            type: obj.method,
            data: obj.data,
            dataType: obj.dataType,
            timeout: obj.timeout,
            beforeSend: function () {
                $.AMUI.progress.start();
            },
            success: function (res) {
                if (res.status == 200) {
                    dialogOption.content = '<i class="am-icon-check-circle"></i>  ';
                    dialogOption.skin = 'submit-success';

                    if (obj.skipAutoTips == false && obj.stopJump == false) {

                        //快速跳转
                        if (res.waitSecond == -1) {
                            window.location.href = res.url
                            return false;
                        }

                        //自动跳转或者刷新
                        setTimeout(function () {
                            res.url ? window.location.href = res.url : location.reload();
                        }, 2000);
                    }

                } else {
                    dialogOption.content = '<i class="am-icon-exclamation-circle"></i>  ';
                }
                dialogOption.content += res.msg;

                obj.success(res, dialogOption)

            },
            error: function (res) {
                var msg = '系统请求出错！请再次提交!';
                try {
                    switch (res.status) {
                        case 0:
                            msg = res.statusText;
                            break;
                        case 500:
                            msg = res.responseJSON.msg;
                            break;
                        case 404:
                            msg = res.responseJSON.msg;
                            break;
                        case 302:
                            var redirectDialog = dialog({
                                title: '重定向提示',
                                content: '<i class="am-icon-refresh am-icon-spin"></i> '+res.responseJSON.msg,
                                skin:'submit-success',
                                id:'redirectDialog',
                                fixed: true,
                                okValue: '新窗口打开',
                                ok: function () {
                                    window.open(res.responseJSON.url)
                                    return false;
                                },
                            });
                            redirectDialog.showModal();
                            obj.error(res, dialogOption)

                    }

                } catch (e) {
                }
                dialogOption.skin = 'submit-error';
                dialogOption.content = '<i class="am-icon-times-circle"></i> ' + msg;

                obj.error(res, dialogOption)

            },
            complete: function (res) {

                if (obj.skipAutoTips == false) {
                    //对话框关闭
                    var d = dialog(dialogOption).showModal();
                    setTimeout(function () {
                        d.close().remove();
                    }, 3000);
                }

                obj.complete(res, dialogOption);

                //刷新页面的验证码
                var src = $('.refresh-verify').attr('src')
                $('.refresh-verify').attr('src', src + '&time=' + Math.random());

                //刷新页面存在的预设token字段
                try {
                    $.refreshToken(res.responseJSON.token);
                } catch (e) {
                }

                //结束进度条
                $.AMUI.progress.done();
            }
        })

    }

    /**
     * 触发表单提交功能。
     */
    $(document).on('submit', '.ajax-submit', function () {
        var url = $(this).attr("action")
        var dom = $(this);

        try{
            if(Object.keys(pesMD).length > 0){
                for (var k in pesMD){
                    $('textarea[name="'+k+'"]').val(pesMD[k].getValue());
                }
            }
        }catch (e) {

        }


        $.ajaxSubmit({
            url: url,
            method: 'POST',
            data: dom.serialize()
        });

        return false;
    })


    /**
     * 适用于GET请求的ajax方法
     * 需要注意的是，若需要明确restful的话，请在URL中声明method方法。
     * 若监听的class中存在ajax-dialog，在该标签中声明 msg="提示信息" ，将可以自定义提示信息
     */
    $(document).on("click", ".ajax-click", function () {
        var url = $(this).attr("data");
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

        var token = $('input[name="token"]').val();

        $.ajaxSubmit({
            url: url,
            data: {token: token}
        });
        return false;
    })

    /**
     * 刷新验证码
     */
    $(document).on('click', '.refresh-verify', function () {
        var src = $(this).attr('src')
        $(this).attr('src', src + '&time=' + Math.random());
    });

    /**
     * 批量删除
     */
    $(document).on('click', '.delete-batch', function () {
        var url = $(this).attr('data');
        var children = $('.checkbox-all-children').serialize()
        if (!children) {
            alert('您没有勾选要删除的数据.')
            return false;
        }

        if (confirm('确认进行批量删除所勾选数据吗？')) {
            var token = $('input[name="token"]').val();
            $.ajaxSubmit({url: url, method: 'POST', data: children + '&token=' + token})

            return false;
        }

        return false;
    })

    /**
     * 生成随机字符串
     * @param length
     * @returns {string}
     */
    var randomString = function (length) {
        var str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-=_+<>?!@#$%^&&*()';
        var result = '';
        for (var i = length; i > 0; --i)
            result += str[Math.floor(Math.random() * str.length)];
        return result;
    }

    $('.pes-login-secret-key').val(randomString(16));

    /**
     * 生成安全密钥并复制
     */
    $('.secret-key-refresh, .pes-login-secret-key').on('click', function () {

        if(!$(this).hasClass('pes-login-secret-key')){
            var key = randomString(16);
            $('.pes-login-secret-key').val(key);
        }
        $('.pes-login-secret-key').select();
        if (document.execCommand('copy')) {
            document.execCommand('copy');
        }

    })

    $(document).on('click', '.pes-copy-command', function () {
        var dom = $(this)
        var copyData = $(this).attr('data')
        const input = document.createElement('input');
        input.setAttribute('value', copyData);
        document.body.appendChild(input);
        input.select();
        if (document.execCommand('copy')) {
            dom.addClass('am-text-secondary');
            document.execCommand('copy');
            var d = dialog({
                id: 'copy-tips',
                fixed: true,
                skin: 'submit-warning',
                zIndex: '777',
                content: '<i class="am-icon-check-circle"></i> 复制成功'
            }).show();
            setTimeout(function () {
                dom.removeClass('am-text-secondary');
                d.close();
            }, 2000)

        }
        document.body.removeChild(input);
        return false;
    })


})