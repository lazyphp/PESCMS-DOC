UE.registerUI('markdown',function(editor,uiName){
    
    var markdownurl = path + '/Theme/assets/ueditor/dialogs/markdown/';
    
    //创建dialog
    var markdown = new UE.ui.Dialog({
        //指定弹出层中页面的路径，这里只能支持页面,因为跟addCustomizeDialog.js相同目录，所以无需加路径
        iframeUrl:markdownurl+'Markdown.html',
        //需要指定当前的编辑器实例
        editor:editor,
        //指定dialog的名字
        name:uiName,
        //dialog的标题
        title:"Markdown",

        //指定dialog的外围样式
        cssRules:"width:800px;height:600px;",

        //如果给出了buttons就代表dialog有确定和取消
        buttons:[
            {
                className:'edui-okbutton',
                label:'确定',
                onclick:function () {
                    editor.setContent($("iframe").contents().find("#preview").html(), true)
                    markdown.close(true);
                }
            },
            {
                className:'edui-cancelbutton',
                label:'取消',
                onclick:function () {
                    markdown.close(false);
                }
            }
        ]});

    //参考addCustomizeButton.js
    var btn = new UE.ui.Button({
        name:'markdownbutton' + uiName,
        title:'markdownbutton' + uiName,
        //需要添加的额外样式，指定icon图标，这里默认使用一个重复的icon
        cssRules :'background-image: url("'+markdownurl+'showdown.png") !important;background-repeat: no-repeat;background-position:center;',
        onclick:function () {
            //渲染dialog
            markdown.render();
            markdown.open();
        }
    });

    return btn;
}/*index 指定添加到工具栏上的那个位置，默认时追加到最后,editorId 指定这个UI是那个编辑器实例上的，默认是页面上所有的编辑器都会添加这个按钮*/);