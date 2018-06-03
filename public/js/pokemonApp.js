$(function(){
    $(".expand-button").click(function(){
        var $button = $(this),
            $parent = $button.closest(".recipe-container");
        if($parent.hasClass("expanded")){
            $parent.removeClass("expanded");
            $button.html("+");
        }
        else {
            $parent.addClass("expanded");
            $button.html("-");
        }
    });
});