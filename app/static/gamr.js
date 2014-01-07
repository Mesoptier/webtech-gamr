$(function(){
    $(".search-input").on("input", function(){
        $.ajax({
            url: "http://localhost/webtech-gamr/app/search-results",
            success: function(data){
                $(".results").empty();

                for (var i = 0; i < data.length; i++){
                    $(".results").append(
                        $("<li>").text(data[i].title)
                    );
                }
            }
        })
    });
});