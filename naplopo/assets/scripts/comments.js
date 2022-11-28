let articleID = getQueryVariable("article_id");
let comments = document.querySelector("#comments");

function getComments() {
    let html = "";

    $.ajax({
        method:"POST",
        url:getBaseUrl() + "/app/ajax/get_comments.php",
        data:{articleID:articleID}
    }).done(function(response) {
        let json = JSON.parse(response);

        json.forEach((comment)=> {
            html += `
                <div class="comment shadow">
                    <p>
                        <strong>${comment.UserName}</strong>: ${comment.CommentText}
                    </p>
                    <small><strong>${comment.CreationDate}</strong></small>
                </div>
            `;
        });

        comments.innerHTML = html;
    });
}

function setComment() {
    let comment = $("#comment").val();

    $.ajax({
        method:"POST",
        url:getBaseUrl() + "/app/ajax/set_comment.php",
        data:{
            articleID:articleID,
            comment:comment
        }
    }).done(function(response) {
        let json = JSON.parse(response);

        if(typeof json == "boolean" && json) {
            $("#comment").val("");
            getComments();
        } else {
            alert(json);
        }
    });
}

getComments();

$("#setComment").click(function() {
    setComment();
});

$("#comment").keyup(function(e) {
    let keyCode = e.which|e.keyCode;

    if(keyCode == 13) {
        setComment();
    }
});