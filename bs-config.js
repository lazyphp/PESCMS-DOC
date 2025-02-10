module.exports = {
    proxy: "", // 你的 PHP 开发服务器地址
    files: [
        "./**/*.php",  // 使用相对路径
        "./**/*.js",
        "./**/*.css"
    ],
    notify: false,
    open: false,
    watchOptions: {
        ignored: ['**/node_modules/**', '**/dist/**']
    }
};
