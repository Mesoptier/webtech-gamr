$(function(){
    $(".search-input").on("input", function(){
        requestSearchResults($(this));
    });
});

var searchWait = false;
function requestSearchResults($search){
    if (!searchWait){
        searchWait = true;
        setTimeout(function(){
            $.ajax({
                url: "http://localhost/webtech-gamr/app/search-results",
                data: { search: $search.val() },

                success: function(data){
                    $(".results").empty();

                    if (data.length > 0){
                        for (var i = 0; i < data.length; i++){
                            $(".results").append(
                                "<li class=\"result-item\"><a href=\"game/" +
                                data[i].id + "\">" + data[i].title + "</a></li>");
                        }
                    }
                },

                complete: function(){
                    searchWait = false;
                }
            });
        }, 500);
    }
}