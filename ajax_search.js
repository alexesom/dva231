
$(document).ready(function(){

    $("#search__bar").keyup(function () {
        var inputText = $("#search__bar").val();

            if (inputText.length > 2) {
                $.ajax(
                    {
                        url: 'index.php',
                        method: 'POST',
                        data: {
                            search: 1,
                            query: inputText
                        },
                        success: function (data) {
                            $("#ajax__dropdown").html(data);
                        },
                        dataType: 'text'
                    }
                );
            }
      
    });

});