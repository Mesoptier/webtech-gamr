var doSearch = false,
    searchWait = false;

$(function(){
    $(".search-input").on("input", function(){
        requestSearchResults($(this));
    });

    $(".search").on("submit", function(e){
        e.preventDefault();

        if (searchWait)
            doSearch = true;
        else
            location.href = $(".results li:first a").attr("href");
    });
});

function requestSearchResults($search){
    if (!searchWait){
        searchWait = true;
        setTimeout(function(){
            $.ajax({
                url: "search-results",
                data: { search: $(".search-input").val() },

                success: function(data){
                    $(".results").empty();

                    if (data.length > 0){
                        if (doSearch)
                            location.href = "game/" + data[0].id;

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
        }, 200);
    }
}