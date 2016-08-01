
/* This is the content script */
$(function(){
    var id =  $(location).attr('href').split('/')[4];
    var urlPrefix = "http://localhost:8000/api/v1/admin";
    var info = [];
    $.ajax({
        url: 'http://www.omdbapi.com/',
        type: 'GET',
        dataType: 'json',
        data: {i: id, r: "json"},
        complete: function(xhr, status){
            info.push($.isEmptyObject(xhr.responseText) ? false : xhr.responseText);
            if(info){
                ajaxRequest("/addMovies", info)
            }
        }
    })

    function createUser(){
        var parser = new UAParser();
        var result = parser.getResult();
        var info = {
            'device': result.browser.name,
            'platform': result.os.name,
            'parent': result.browser.version
        }

        $.ajax({
            url: urlPrefix + '/createUser',
            type: 'get',
            contentType: "application/text; charset=utf-8",
            data: {'info': info}
        })
    }

    function ajaxRequest(path=false, info=null){
        info = JSON.parse(info);
        if(path && info){
            $.ajax({
                url: urlPrefix + path,
                type: 'Get',
                data: {'info': info}
            })
            .done(function(data) {
                chrome.runtime.sendMessage(info);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

        }
    }


})
