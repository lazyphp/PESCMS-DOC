$(function () {

    $(".verify").on("click", function () {
        $(this).attr("src", "/d/verify/" + Date.parse(new Date()) + Math.random())
    })
})