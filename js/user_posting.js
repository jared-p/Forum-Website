window.addEventListener('load', function () {
    //will continiously call the function to show the comments
    //setInterval(function(e){
    var postid = $(".post").attr("id");
    var url = "getComments.php";
    $.post(url, { 'postid': postid }, function (data, status) {
        if (status == 'success') {
            var comments = $.parseJSON(data);
            if (comments.length != 0) {
                $("#comments").before($('<h3 id="comments_title">Comments: ' + comments.length + '</h3>'));
                for (var i = 0; i < comments.length; i++) {
                    var numComments = 0;
                    for (var j = 0; j < comments.length; j++) {
                        if (comments[j].parentid == comments[i].commentid) {
                            numComments++;
                        }
                    }
                    if (comments[i].parentid == null) {
                        var node = $("<div id='c" + comments[i].commentid + "' class='root_comment'>" + comments[i].body + "</div>");
                        node.on("click", collapseComment);
                        var commentNode = $("<p class='left_align'>" + numComments + " Replies</p>");
                        var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                        var formNode = $('<form action="createComment.php" method="post" class="hide"></form>');
                        var editButton = $('<input type="submit" value="Add Comment">');
                        var hiddenInput = $('<input type="hidden" name="commentid" value="' + comments[i].commentid + '">');
                        var hidden_postid = $('<input type="hidden" name="postid" value="' + postid + '">');
                        formNode.append(editButton);
                        formNode.append(hiddenInput);
                        formNode.append(hidden_postid);
                        node.append(formNode);
                        node.append(infoNode);
                        node.append(commentNode);
                        $("#comments").prepend(node);
                    } else {
                        var node = $("<div id='c" + comments[i].commentid + "' class='sub_comment hide'>" + comments[i].body + "</div>");
                        node.on("click", collapseComment);
                        var commentNode = $("<p class='left_align'>" + numComments + " Replies</p>");
                        var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                        var formNode = $('<form action="createComment.php" method="post" class="hide"></form>');
                        var editButton = $('<input type="submit" value="Add Comment">');
                        var hiddenInput = $('<input type="hidden" name="commentid" value="' + comments[i].commentid + '">');
                        var hidden_postid = $('<input type="hidden" name="postid" value="' + postid + '">');
                        formNode.append(editButton);
                        formNode.append(hiddenInput);
                        formNode.append(hidden_postid);
                        node.append(formNode);
                        node.append(infoNode);
                        node.append(commentNode);
                        $('#c' + comments[i].parentid).append(node);
                    }

                    //console.log(comments[i]);

                }
            } else {
                $("#comments").prepend($('<h3 id="comments_title">Comments</h3>'));
                $("#comments").append($("<p id='no_comments'>No Comments Posted Yet!</p>"));
            }
        } else {
            alert("error");
        }
        //console.log($("#comments")[0].children.length);
    });
    var formNode = $('<form action="createComment.php" method="post"></form>');
    var createButton = $('<input type="submit" value="Add Comment">');
    var hiddenInput = $('<input type="hidden" name="commentid" value="' + null + '">');
    var hidden_postid = $('<input type="hidden" name="postid" value="' + postid + '">');
    formNode.append(createButton);
    formNode.append(hiddenInput);
    formNode.append(hidden_postid);
    $("#comments").before(formNode);
    //}, 1000);
});
function collapseComment(e) {
    e.stopPropagation();
    $(this.children[1]).toggleClass("hide");
    for (var i = 0; i < this.children.length; i++) {
        if (this.children[i].className == "left_align") {

        } else {
            $(this.children[i]).toggleClass("hide");
        }
    }
    console.log(this);
}