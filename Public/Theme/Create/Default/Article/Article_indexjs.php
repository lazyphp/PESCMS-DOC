<script>
    $(function () {

        /**
         * 注册热键提交文档
         */
        document.addEventListener('keyup', function (e) {
            if(e.ctrlKey && e.key == 'Enter'){
                $('#pes-article-submit').submit();
            }
        }, false);


        var ue, vd;

        /**
         * 初始化UE编辑器
         */
        var initUE = function () {
            if (ue) {
                UE.delEditor('content');
                $('#content').remove();
                //@todo UE在渲染编辑器时，会在form元素最后插入一个隐藏的textarea 。这就导致了重新渲染时错位。因此需要删除旧的textarea，再重新插入
                $('#content_md').after('<div id="content" type="text/plain"></div>')
                ue = UE.getEditor('content', {
                    textarea: 'content',
                });
                ue.ready(function () {
                    ue.setHeight('400')
                    ue.setContent($('textarea[name="html"]').val())
                })
            } else {
                ue = UE.getEditor('content', {
                    textarea: 'content',
                });
                ue.ready(function () {
                    ue.setHeight('400')
                    ue.setContent($('textarea[name="html"]').val())
                })
            }
            $('input[name="editor"]').val('0');
            $('textarea[id="content"]').remove();
        }

        /**
         * 初始化MD编辑器
         */
        var initMD = function () {
            var vdOption = {
                cache: {
                    enable: false
                },
                mode: 'sv',
                value: $('textarea[name="md"]').val(),
                upload: {
                    accept: 'image/*,.mp3, .wav, .rar, .zip',
                    token: 'test',
                    multiple: false,
                    url: pesMDUploadURL,
                    fieldName: 'upfile',
                    success(editor, msg) {
                        var res = JSON.parse(msg);
                        if (res.state == 'SUCCESS') {
                            vd.tip('上传成功')
                            var isImg = res.action == 'uploadimage' ? '!' : ''
                            vd.insertValue(`${isImg}[${res.original}](${res.url})`)
                        } else {
                            vd.tip(res.state)
                        }
                    }
                },
                after(){
                    $('.vditor-toolbar').attr('style', 'z-index:10;display:flex').sticky()
                }
            };
            if (!vd) {
                vd = new Vditor('content_md', vdOption)
            } else {
                vd.destroy();
                vd = new Vditor('content_md', vdOption)
            }

            $('input[name="editor"]').val('1')
        }

        /**
         * 获取历史记录
         */
        var getHistory = function (aid) {

            //新文档不请求历史记录
            if(aid == 'new'){
                $('.pes-history-list').html('')
                return false;
            }

            $.ajaxSubmit({
                url: '/?g=Create&m=Article&a=history&aid=' + aid,
                skipAutoTips: true,
                stopJump: true,
                success: function (res) {
                    //读取历史信息
                    var history = res?.data?.html || false;

                    if (history) {
                        $('.pes-history-list').html(history)
                    } else {
                        $('.pes-history-list').html('<div class="am-alert am-alert-danger">获取文档操作历史出错</div>')
                    }
                }
            });

        }

        /**
         * 刷新目录
         */
        var refreshPath = function () {
            var id = '<?= $doc['doc_id'] ?>';
            $.ajaxSubmit({
                url: '/?g=Create&m=Article&a=refreshPath&id=' + id,
                skipAutoTips: true,
                success: function (res) {
                    $('.pes-doc-path-container').html(res.data);
                }
            })
        }

        if ($('.use-ue').hasClass('am-active')) {
            initUE();
        } else {
            initMD();
        }

        /**
         * 切换编辑器
         */
        $(document).on('click', '.use-ue, .use-md', function () {

            $('#editor-tab-list a').removeClass('am-active')
            $(this).addClass('am-active')

            if ($(this).hasClass('use-ue')) {
                if (vd) {
                    $('#content_md').hide();
                }
                $('#content').show();
                initUE(vd);
            } else {
                $('#content').hide();
                $('#content_md').show().addClass('am-active');
                initMD(ue);
            }

        })

        /**
         * 文档属性切换方法
         */
        var articleNode = function () {
            var nodeValue = $('input[name="article_node"]:checked').val();
            $('.pes-article-editor, .article_external_link').hide();
            if (nodeValue == '0') {
                $('.pes-article-editor').show();
            }else if(nodeValue == '2'){
                $('.article_external_link').show()
            }

        }

        $(document).on('click', 'input[name="article_node"]', function () {
            articleNode()
        })

        /**
         * 点击目录，获取文档内容
         */
        $(document).on('click', '.pes-doc-path a, .pes-add-article', function () {
            var id = '<?= $doc['doc_id'] ?>';
            var aid = $(this).data('id');

            //处理URL地址
            var link = $(this).data('link');
            if(link && link.length > 0){
                history.pushState({aid:aid}, $(this).text().trim(), link)
            }

            $('.pes-doc-path a').removeClass('am-active')
            if (aid != 'new') {
                $(this).addClass('am-active');
            }
            $('.pes-doc-article-tool').show();
            $('.pes-article-delete').removeClass('am-hide').attr('data', '/?g=Create&m=Article&a=delete&method=DELETE&aid=' + aid);
            $('.pes-doc-index-tool, .pes-article-preview').hide();
            $('.pes-article-tips').addClass('am-hide')
            $('.pes-article-tips').removeClass('am-alert-success').removeClass('am-alert-warning');

            $.ajaxSubmit({
                url: '/?g=Create&m=Article&a=write&id=' + id + '&aid=' + aid,
                skipAutoTips: true,
                success: function (res, dialogOption) {
                    if (res.status == 200) {

                        $('.pes-article-paper h1').html('<i class="am-icon-edit"></i> ' + (aid == 'new' ? '新文档' : '编辑文档'));
                        $('.pes-article-paper .am-form').attr('action', '')

                        $('.pes-form-wrapper').html(res.data.html);
                        if ($('.use-ue').hasClass('am-active')) {
                            initUE();
                        } else {
                            initMD();
                        }

                        articleNode();

                        //显示预览按钮
                        var url = res?.data?.url || ''
                        if(url != ''){
                            $('.pes-article-preview').show().find('a').attr('href', url);
                        }


                    } else {
                        $('.pes-doc-path a').removeClass('am-active')
                        var d = dialog(dialogOption).showModal();
                        setTimeout(function () {
                            d.close().remove();
                        }, 3000);
                    }

                },
                error: function (res, dialogOption) {
                    var d = dialog(dialogOption).showModal();
                    $('.pes-doc-path a').removeClass('am-active')
                    setTimeout(function () {
                        d.close().remove();
                    }, 3000);
                },
                complete: function (res) {
                    getHistory(aid);

                    $('.mobile-show').hide()

                }
            })
            return false;
        })

        /**
         * 保存文档内容
         */
        $(document).on('submit', '#pes-article-submit', function () {
            if (vd) {
                $('textarea[name="md"]').val(vd.getValue());
                $('textarea[name="html"]').val(vd.getHTML())
            }
            var d = dialog();
            var url = $(this).attr('action');
            $.ajaxSubmit({
                url: url,
                method: 'POST',
                data: $(this).serializeArray(),
                stopJump: true,
                skipAutoTips: true,
                complete: function (res) {
                    let aid = res?.responseJSON?.data?.aid || false;
                    if (aid) {
                        getHistory(aid);
                    }

                    let refresh = res?.responseJSON?.data?.refresh || false;
                    if(refresh == 1){
                        var newAid = res?.responseJSON?.data?.aid || -1;
                        var markID = res?.responseJSON?.data?.mark || '';
                        $('input[name="aid"]').val(newAid);
                        $('input[name="method"]').val('PUT');
                        $('input[name="article_mark"]').val(markID);

                    }

                    var status = res?.responseJSON?.status || 0;
                    //只有提交成功才显示预览按钮
                    if(status == 200){
                        var url = res?.responseJSON?.data?.url || 'javascript:;'
                        $('.pes-article-preview').show().find('a').attr('href', url);
                    }

                    var msg = res?.responseJSON?.msg || '未知错误';
                    var dateObj = new Date();
                    var month = dateObj.getMonth() + 1;
                    var FullDate = ` [${dateObj.getFullYear()}-${month}-${dateObj.getDate()} ${dateObj.getHours()}:${dateObj.getMinutes()}:${dateObj.getSeconds()}]`;
                    $('.pes-article-tips').removeClass('am-alert-success').removeClass('am-alert-warning').removeClass('am-hide');
                    $('.pes-article-tips').addClass(status == 200 ? 'am-alert-success' : 'am-alert-warning').show().html(msg + FullDate);

                    if($('.pes-article-tips')[0].getBoundingClientRect().y < 0){

                        var autoTipsWidth = $('.pes-article-paper').width();

                        $('.pes-article-tips').css({position: 'fixed', width: autoTipsWidth+'px', 'z-index' : '9999999', top: '0px'})

                        setTimeout(function (){
                            $('.pes-article-tips').removeAttr('style')
                        }, 1800)
                    }

                    refreshPath();
                }
            })
            return false;
        })

        /**
         * 保存按钮
         */
        $('.pes-article-save').on('click', function () {
            $('#pes-article-submit').submit();
        })

        /**
         * 删除历史记录
         */
        $(document).on('click', '.remove-history', function () {
            if (!confirm('确定要删除吗？')) {
                return false;
            }

            var url = $(this).attr("href");
            var token = $('input[name="token"]').val();
            var dom = $(this);

            $.ajaxSubmit({
                url: url,
                data: {token: token},
                stopJump: true,
                success: function (res) {
                    if (res.status == 200) {
                        dom.parents('tr').remove();
                    }
                }
            });

            return false;
        })


        //文档滚动固定高度
        $(document).scroll(function () {
            var scrollbar = $(this).scrollTop();  //滚动高度
            var dom = $('.pes-article-left-sidebar, .pes-article-right-sidebar')
            if (scrollbar > 50) {
                dom.addClass('pes-article-sidebar-scroll').css('top', '');
            } else {
                var topPx = 6.7 - (scrollbar / 10)
                dom.removeClass('pes-article-sidebar-scroll').css({top: `${topPx}rem`});
            }
        })


        /**
         * 打开对比界面
         */
        $(document).on('click', '.history-wp', function () {
            //清空子窗口执行结果
            $('#history-result').val('')
            var link = $(this).attr('href');
            var aid = $(this).data('id');
            let page = window.open(link, 'history', 'height=800,width=800')
            let openLoad = dialog({
                content: '<i class="am-icon-spinner am-icon-spin"></i> 正在对比过去版本中...'
            });
            openLoad.showModal();
            page.onload = function () {
                page.onunload = function () {
                    openLoad.close();
                    //@todo 当子窗口关闭后，读取某个因此表单，看看返回的执行结果。
                    if ($('#history-result').val() == '200') {
                        $('.pes-doc-path a[data-id="' + aid + '"]').trigger('click')
                    }
                }
            }
            return false;
        })

        /**
         * 创建新版本
         */
        $(document).on('click', '.submit-version', function () {
            var empty = $('.empty-version').prop('checked');
            var number = $('.version-number').val();
            var id = '<?= $doc['doc_id'] ?>';
            var token = $('input[name="token"]').val();

            $.ajaxSubmit({
                url: '/?g=Create&m=Doc&a=version',
                method: 'POST',
                data: {id: id, number: number, empty: empty, token:token}
            });

        })

        /**
         * 右侧边栏拖动效果
         */
        $('.pes-article-right-sidebar-move').on('mousedown', function (e) {
            var initWidth = $('.pes-article-right-sidebar').outerWidth();
            $(document).on('mousemove', function (ev) {
                var moveWidth = initWidth + e.pageX - ev.pageX;

                $('.pes-article-right-sidebar').css({width: moveWidth + 'px'});
                $('.pes-article-paper').css({'margin-right': moveWidth + 'px'});
                var ueWidth = $('.pes-article-paper').width();
                $('.edui-editor, .edui-editor-iframeholder').css({width: ueWidth + 'px'});
            })
        })

        /**
         * 解除拖动效果
         */
        $(document).on('mouseup', function () {
            $(this).off('mousemove');
        })

        /**
         * 快速复制文档地址
         */
        $(document).on('click', '.pes-article-copy-link', function () {
            var dom = $(this)
            var link = $(this).attr('link')
            const input = document.createElement('input');
            input.setAttribute('value', link);
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

        /**
         * 提交页内版本
         */
        $(document).on('click', '.submit-article-version', function (){
            var aid = $(this).attr('data');
            var version = $('.article-version-number').val();
            var sort = $('.article-version-sort').val();

            var token = $('input[name="token"]').val()
            $.ajaxSubmit({
                url: '/?g=Create&m=Article&a=version',
                method: 'POST',
                stopJump: true,
                data: {aid: aid, version:version, sort:sort, token:token},
                complete: function (res){
                    getHistory(aid);
                }
            });

            return false;
        })

        /**
         * 页内版本版本号排序
         */
        $(document).on('click', '.submit-article-version-sort', function (){

            var aid = $(this).attr('data');
            var dom = $(this).parents('form');
            var data = dom.serializeArray();
            var token = $('input[name="token"]').val()
            var url = dom.attr('action')

            data.push({name:'token', value:token})
            $.ajaxSubmit({
                url: url,
                method: 'POST',
                stopJump: true,
                data: data,
                complete: function (res){
                    getHistory(aid);
                }
            });

            return false;
        })

        //页面跳转编辑
        var editLoading = function (){
            $('.pes-article-paper h1').html('<i class="am-icon-spinner am-icon-spin"></i> 加载中...');
        }

        var searchParams = new URLSearchParams(window.location.href);
        var urlAid = searchParams.get('aid');
        if(urlAid > 0){
            editLoading();
            setTimeout(function (){
                $('.pes-doc-path a[data-id="'+urlAid+'"]').trigger('click');
            }, 600)

        }else if(urlAid == 'new'){
            editLoading();
            setTimeout(function (){
                $('.pes-add-article').trigger('click')
            }, 600)

        }


        $(document).on('click', '.mobile-button>.am-icon-exchange', function (){
            $('.pes-article-left-sidebar, .mask-layer').show().addClass('mobile-show');
        })

        $('.mask-layer').on('click', function () {
            $('.mask-layer, .pes-article-left-sidebar').hide()
        })


    })
</script>