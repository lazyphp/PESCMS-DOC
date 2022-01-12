$(function (){
    /**
     * 获取浏览器信息。代码直接复制自网上懒得写了
     * 主要作用是 DOC一部分代码用到 可选连 这些特性。
     * 而国产浏览器chromium核心默认都低于80版本
     * 因此会导致系统使用不正常。
     * @returns {{}}
     */
    function getBrowser() {
        var UserAgent = navigator.userAgent.toLowerCase();
        var browserInfo = {};
        var browserArray = {
            IE: window.ActiveXObject || "ActiveXObject" in window, // IE
            Chrome: UserAgent.indexOf('chrome') > -1 && UserAgent.indexOf('safari') > -1, // Chrome浏览器
            Firefox: UserAgent.indexOf('firefox') > -1, // 火狐浏览器
            Opera: UserAgent.indexOf('opera') > -1, // Opera浏览器
            Safari: UserAgent.indexOf('safari') > -1 && UserAgent.indexOf('chrome') == -1, // safari浏览器
            Edge: UserAgent.indexOf('edge') > -1, // Edge浏览器
            QQBrowser: /qqbrowser/.test(UserAgent), // qq浏览器
            WeixinBrowser: /MicroMessenger/i.test(UserAgent) // 微信浏览器
        };
        // console.log(browserArray)
        for (var i in browserArray) {
            if (browserArray[i]) {
                var versions = '';
                if (i == 'IE') {
                    versions = UserAgent.match(/(msie\s|trident.*rv:)([\w.]+)/)[2];
                } else if (i == 'Chrome') {
                    for (var mt in navigator.mimeTypes) {
                        //检测是否是360浏览器(测试只有pc端的360才起作用)
                        if (navigator.mimeTypes[mt]['type'] == 'application/360softmgrplugin') {
                            i = '360';
                        }
                    }
                    versions = UserAgent.match(/chrome\/([\d.]+)/)[1];
                } else if (i == 'Firefox') {
                    versions = UserAgent.match(/firefox\/([\d.]+)/)[1];
                } else if (i == 'Opera') {
                    versions = UserAgent.match(/opera\/([\d.]+)/)[1];
                } else if (i == 'Safari') {
                    versions = UserAgent.match(/version\/([\d.]+)/)[1];
                } else if (i == 'Edge') {
                    versions = UserAgent.match(/edge\/([\d.]+)/)[1];
                } else if (i == 'QQBrowser') {
                    versions = UserAgent.match(/qqbrowser\/([\d.]+)/)[1];
                }
                browserInfo.type = i;
                browserInfo.versions = parseInt(versions);
            }
        }
        return browserInfo;
    }
    
    function browserTips() {
        $('body').prepend('<div class="am-alert am-alert-danger am-margin-0" data-am-alert style="border-radius: 0"><button type="button" class="am-close">&times;</button><p><i class="am-icon-warning"></i> 当前您使用的浏览器版本过低，可能无法正常使用DOC文档系统，推荐更换为：Chrome或者火狐浏览器。</p></div>').addClass('am-margin-bottom-0')
    }

    var userBrowser = getBrowser();

    //可选链参考：https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Operators/Optional_chaining
    switch (userBrowser.type) {
        case 'Safari':
            if(parseInt(userBrowser.versions) < 13){
                browserTips()
            }
            break;
        case 'Firefox':
            if(parseInt(userBrowser.versions) < 75){
                browserTips()
            }
            break;
        case 'Chrome':
        default:
            if(parseInt(userBrowser.versions) < 80){
                browserTips()
            }
    }

})