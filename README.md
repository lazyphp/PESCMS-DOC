# PESCMS DOC文档管理系统 v2
PESCMS DOC文档管理系统是一款以GPLv2协议发布的开源文档管理系统。您只需要一台具备PHP7+和MYSQL5.5+的服务器，即可通过现代浏览器，随时随地书写文档、管理文档、分享文档。  
## 2.0版本特征  

* 集成富文本编辑和Markdown编辑器
* 权限管理、阅读权限
* 无限层级的文档  
* 根据API请求，编写或生成指定风格的文档  
* 通过接口编写PESCMS DOC文档  
  
## 运行环境  
* PHP7.0及以上版本  
* Mysql5.5及以上版本  
* 现代浏览器（不再支持IE浏览器）  

## 安装使用
1. 下载并解压程序至您的HTTP运行环境所在目录。
2. 没有配置虚拟主机，则访问Public目录。反之，请将虚拟主机目录配置到Public
3. 根据安装程序填写对应数据，完成软件安装。

## 优雅的前端调试
若您需要编写自己的主题或者二次开发，我们提供了前端调试方式。
1. 安装nodejs
2. 安装npm
3. 执行npm install，完成基础环境安装
4. 在bs-config.js中配置您的代理服务器
5. 执行npm start，启动前端调试环境
6. 根据命令窗口提示，访问http://localhost:3000 即可看到您的前端页面，修改任意代码会浏览器会实时刷新，且多端访问同步更新。

## 反馈和建议
邮箱：sale#pescms.com  
演示地址：[https://doc.pescms.com](http://doc.pescms.com)  
反馈问题：[https://forum.pescms.com/](https://forum.pescms.com/)  
技术文档：[https://document.pescms.com/article/4.html](https://document.pescms.com/article/4.html)  
PESCMS官方QQ 1群：451828934 <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=70b9d382c5751b7b64117191a71d083fbab885f1fb7c009f0dc427851300be3a"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PESCMS官方1群" title="PESCMS官方1群"></a>  
PESCMS官方QQ 2群：496804032 <a target="_blank" href="https://jq.qq.com/?_wv=1027&k=5HqmNLN"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PESCMS官方2群" title="PESCMS官方2群"></a>  

## 鸣谢
排名不分先后  
* [vditor](https://b3log.org/vditor/) 一款非常优秀的MD编辑器  
* [ueditor](https://fex.baidu.com/ueditor/) 百度编辑器。  
* [amazeui](https://github.com/amazeui/amazeui) 本文档系统的前端框架。 尽管她已经逝去，但是开源让她保持着活力。  
* [看云](https://www.kancloud.cn/) 本次重构参考平台之一  
* [语雀](https://www.yuque.com/) 本次重构参考平台之一  
* [Gitbook](https://www.gitbook.com/) 本次重构参考平台之一  
* [jQuery](https://jquery.com/) 重构之处，尝过用流行的前端框架VUE，经过一周的磨合，我最爱的还是jQuery。  
* [@Devil](https://gitee.com/zongzhige/) 本次重构过程，帮助测试以及修复了上传粘贴失效的问题。
* 还有其他引用到的开源库，这里不一一列举了。
## 协议
本软件以GPLv2协议发布，在使用前请先阅读PESCMS官方的[用户协议](https://www.pescms.com/article/view/-1.html)。  