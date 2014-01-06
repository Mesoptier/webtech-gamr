$(function(){

    $(".search-input").on("change keyup", function(){
        console.log($(this).val());

        if ($(this).val() != ""){
            $(".results").removeClass("hidden");
        } else {
            $(".results").addClass("hidden");
        }
    });

});