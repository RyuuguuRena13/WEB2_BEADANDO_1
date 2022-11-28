class RestApi {
    callApi(url, data) {
        $.ajax({
            method:"POST",
            url:url,
            data:data
        }).done(function(response) {
            console.log(response);
        }).fail(function(response) {
            console.log(response.responseText);
            console.log(response.statusText);
            console.log(response.status);
        });
    }


}

let restApi = new RestApi();

restApi.callApi(getBaseUrl() + "/app/api/get_articles.php", 
    {userName:"admin", pass:"jelszó66"}
);

restApi.callApi(getBaseUrl() + "/app/api/get_article.php", 
    {userName:"main_admin", pass:"jelszó66", articleID:5}
);