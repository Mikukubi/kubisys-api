$(function() {
    $(".section").each(function() {
        var main = $(this).children(".main");
        var side = $(this).children(".side");
        if (main.height() < side.height()) {
            main.height(side.height());
        }
    });
});
