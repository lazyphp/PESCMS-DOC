<script>

    $(function () {

        var recordFontSet = localStorage.getItem('font-set');

        if($('.sidebar-nav li.am-active').offset()){
            let recordScrollTop = parseFloat($('.sidebar-nav li.am-active').offset().top) - 150;

            document.querySelector('.sidebar').scrollTo({
                top: recordScrollTop, // 考虑头部的高度
                behavior: 'auto',
            });
        }

        //递归寻找子元素
        var findChildren = function (children, set) {
            var children = $(children).children();
            if (children.length > 0) {
                children.each(function () {
                    //指定标签不在字体改变范围
                    if (['img', 'strong', 'br'].includes($(this)[0].nodeName.toLowerCase()) == false) {
                        var originalFontSize = $(this).attr('original-size');
                        if (originalFontSize == undefined) {
                            var size = parseInt($(this).css('font-size').replace(/px/, ''));
                            var lineHeight = parseFloat($(this).css('line-height').replace(/px/, ''));
                            $(this).attr('original-size', size);
                            $(this).attr('lineHeight-size', lineHeight);
                        } else {
                            var size = parseInt(originalFontSize);
                            var lineHeight = parseFloat($(this).attr('lineHeight-size'));
                        }

                        var changeSize = size + set;
                        var changeLineHeight = lineHeight + set;
                        $(this).css({'line-height': changeLineHeight+'px', 'font-size':changeSize + 'px'})
                    }
                    findChildren($(this), set)
                })
            }
        }

        //调整页面字体大小
        $(document).on('click', '.font-set', function () {
            var set = parseInt($(this).attr('data'))

            //记录操作记录
            localStorage.setItem('font-set', set)
            findChildren('.am-article-bd, .vditor-reset', set)
            $('.font-set').removeClass('am-text-primary');
            $(this).addClass('am-text-primary')
        })

        if(recordFontSet){
            $('.font-set[data="'+recordFontSet+'"]').trigger('click')
        }

        $('.version').on('change', function () {
            var version = $(this).val();
            var id = '<?= $label->xss($_GET['id']) ?>';
            $.ajaxSubmit({
                url: `/?g=Doc&m=Article&a=switchVersion&id=${id}&version=${version}`,
                skipAutoTips: true,
                success: function (res, dialogOption) {
                    if (res.status != 200) {
                        var d = dialog(dialogOption).showModal();
                        setTimeout(function () {
                            d.close().remove();
                        }, 3000);
                    } else {
                        window.location.reload();
                    }
                }
            })
        })

        var titleNavigation = function () {
            var hasTitleNagContent = false;

            const contentPath = document.querySelector('.title-nav-content');
            const headings = document.querySelectorAll('.am-article-bd h1, .am-article-bd h2, .am-article-bd h3, .am-article-bd h4, .am-article-bd h5, .am-article-bd h6');

            // 生成目录树
            function generateToc() {
                const toc = document.createElement('ul');
                const stack = [{ level: 0, parent: toc }]; // 用于管理层级的栈

                headings.forEach((heading) => {
                    const level = parseInt(heading.tagName[1], 10); // 获取标题等级 H1 -> 1, H2 -> 2...
                    const text = heading.textContent;
                    const id = text.trim().replace(/\s+/g, '-').toLowerCase(); // 生成唯一ID
                    heading.id = id; // 为每个标题添加ID

                    // 创建目录项
                    const li = document.createElement('li');
                    const link = document.createElement('a');
                    link.textContent = text;
                    link.href = `#${id}`; // 锚点链接
                    li.appendChild(link);

                    // 处理层级关系
                    while (stack.length > 1 && stack[stack.length - 1].level >= level) {
                        stack.pop();
                    }

                    const parent = stack[stack.length - 1].parent;
                    if (!parent.querySelector('ul')) {
                        const ul = document.createElement('ul');
                        parent.appendChild(ul);
                    }
                    const ul = parent.querySelector('ul');
                    ul.appendChild(li);

                    stack.push({ level, parent: li });
                });

                const firstLi = toc.querySelector('li');
                if (firstLi) {
                    firstLi.classList.add('active');
                }

                contentPath.appendChild(toc);

                if($('.title-nav-content').find('li').length > 0){
                    hasTitleNagContent = true;
                }

            }
            generateToc();


            if (hasTitleNagContent == false) {
                //没有成功生成标题导航直接隐藏相关操作
                $('.title-nav').hide();
                return;
            } else {
                //手机版默认不展开
                if ($('.title-nav').css('display') == 'none') {
                    return;
                }

                var openWidth = $('.title-nav').attr('data') == '0' ? 0 : 300;

                $('.content').css({'margin-right': (openWidth + 50) + 'px'});

                $('.title-nav').animate({width: openWidth + 'px'}, 500, function () {
                    if (openWidth > 0) {
                        $(this).find('i').attr('class', 'am-icon-angle-double-right');
                    }
                    //标题导航刷新后，进行锚点跳转。假定URL锚点参数。
                    if (window.location.hash.length > 0) {
                        var anchorPoint = window.location.href;
                        window.location.href = anchorPoint;
                    }


                })
            }


            // 获取所有标题和目录项
            const tocItems = document.querySelectorAll('.title-nav-content li');

            function highlightToc() {

                const scrollPosition = window.scrollY + 0; // 增加偏移以更早触发高亮
                let activeId = null;

                // 遍历标题，找到最后一个在屏幕顶部或以上的标题
                for (let i = headings.length - 1; i >= 0; i--) {
                    const heading = headings[i];
                    if (heading.offsetTop - 110 <= scrollPosition) {
                        activeId = heading.id;
                        break;
                    }
                }

                // 如果找到一个合适的标题，更新目录高亮
                if (activeId) {
                    document.querySelectorAll('.title-nav-content a').forEach((link) => {
                        link.parentElement.classList.toggle('active', link.getAttribute('href') === `#${activeId}`);
                    });
                }
            }
            // 监听滚动事件
            window.addEventListener('scroll', highlightToc);


        }

        /**
         * 图片放大器
         */
        var viewBigPicture = function (){
            $('.am-article img').each(function () {
                var dom = $(this)
                var parent = $(this).parent();
                if(parent[0].tagName != 'a'){
                    var imgStr = '<a href="'+dom.attr('src')+'" data-fancybox="gallery" class="am-inline-block"><img src="'+dom.attr('src')+'" class="am-img-responsive" /></a>';
                    $(this).prop('outerHTML', imgStr)
                }
            })

            $(document).fancybox({
                buttons: [
                    "zoom",
                    "fullScreen",
                    "download",
                    "thumbs",
                    "rotate",
                    "close"
                ],
                selector: '[data-fancybox^="gallery"]'
            });
        }

        if ($('.use-md').val() == 1) {
            try {
                Vditor.preview(document.getElementsByClassName('am-article-bd')[0], `<?= str_replace('`', '\`',
                    htmlspecialchars_decode(str_replace($articleTemplate['replace'], $articleTemplate['md'], isset($article_content_md) ? $article_content_md : $doc['doc_content_md']))
                ) ?>`, {
                    after() {
                        titleNavigation();
                        viewBigPicture();
                        if(recordFontSet){
                            $('.font-set[data="'+recordFontSet+'"]').trigger('click')
                        }
                    },
                })
            } catch (e) {
                var d = dialog({
                    id: 'submit-tips',
                    zIndex: '9999',
                    fixed: true,
                    skin: 'submit-warning',
                    content: '<i class="am-icon-exclamation-circle"></i> MD格式渲染出错'
                });
                d.show();
                setTimeout(function () {
                    d.close();
                }, 3000)
            }
        } else {
            titleNavigation();
            viewBigPicture();
        }


        /**
         * 隐藏和展开标题导航
         */
        $(document).on('click', '.title-nav-hide', function () {
            var dom = $(this);
            var data = $(this).attr('data');

            if (data == 0) {
                $('.title-nav').animate({width: '0'}, 500, function () {
                    dom.attr({
                        'data': '1',
                        'title': '展开标题导航'
                    })
                    dom.find('i').attr('class', 'am-icon-angle-double-left')
                    $('.content').css({'margin-right': '5%'});
                });
            } else {
                $('.title-nav').animate({width: '300px'}, 500, function () {
                    dom.attr({
                        'data': '0',
                        'title': '收起标题导航'
                    })
                    dom.find('i').attr('class', 'am-icon-angle-double-right');
                    $('.content').css({'margin-right': '350px'});
                });
            }

        })

        //目录栏展开方法
        $('.sidebar-nav ul li').on('click', function () {
            var sidebarNavIDom = $(this).children('span').children('i')
            if (sidebarNavIDom.hasClass('am-icon-caret-right')) {
                sidebarNavIDom.removeClass('am-icon-caret-right').addClass('am-icon-caret-down');
                $(this).children('ul').children('li').removeClass('sidebar-hide');
            } else {
                sidebarNavIDom.addClass('am-icon-caret-right').removeClass('am-icon-caret-down');
                $(this).children('ul').children('li').addClass('sidebar-hide');
            }

            return false;
        })

        $('.sidebar-nav ul li a').on('click', function () {
            var target = $(this).attr('target')
            if (target) {
                window.open($(this).attr('href'))
            } else {
                window.location.href = $(this).attr('href');
            }

        })

        $('.sidebar-nav ul li.am-active a').parents('li').each(function () {
            $(this).children('span').children('i').removeClass('am-icon-caret-right').addClass('am-icon-caret-down')
            $(this).siblings().removeClass('sidebar-hide')
            $(this).removeClass('sidebar-hide')
        })

        /**
         * 文章点赞
         */
        $(document).on('click', '.pes-like', function () {
            var dom = $(this);
            var num = parseInt($('.pes-like-num').html());
            $.ajaxSubmit({
                url: '/?g=Doc&m=Article&a=like',
                data: {id: '<?= $doc['doc_id'] ?>', aid: '<?= $article_mark ?? '' ?>', method: 'PUT'},
                method: 'POST',
                skipAutoTips: true,
                stopJump: true,
                success: function (res, dialogOption) {
                    if (res.status == 200) {
                        $('.pes-like-num').html(num + 1)
                    } else {
                        var d = dialog(dialogOption);
                        d.show();
                        setTimeout(function () {
                            d.close();
                        }, 1800)
                    }
                }
            })
        })

        $('#pes-show-article-path').on('click', function () {
            $('.sidebar, .mask-layer').show()
        })
        $('.mask-layer').on('click', function () {
            $('.mask-layer').hide()
            $('.sidebar').animate({opacity: 0, width: '0px'}, 500, function () {
                $('.sidebar').removeAttr('style')
            })
        })

        /**
         * 页内版本切换
         */
        $(document).on('change', '.switch-article-version', function () {
            var version = $(this).val();
            var aid = $(this).data('aid');
            var id = $(this).data('id');
            window.location.href = `/?g=Doc&m=Article&a=index&id=${id}&aid=${aid}&version=${version}`;
        })

        /**
         * 快速复制文档地址
         */
        $(document).on('click', '.article-copy-link', function () {

            var hash = '';

            if($(this).parents('.am-article-bd').hasClass('am-article-bd') == true){
                hash = '#' + $(this).parent().attr('id')
            }

            var dom = $(this)
            var link = window.location.href.replace(window.location.hash, '') + hash;
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






    })
</script>