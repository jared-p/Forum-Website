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
                    if (comments[i].parentid == null) {
                        var node = $("<div id='c" + comments[i].commentid + "' class='root_comment'>" + comments[i].body + "</div>");
                        var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                        var formNode = $('<form action="createComment.php" method="post"></form>');
                        var editButton = $('<input type="submit" value="Add Comment">');
                        var hiddenInput = $('<input type="hidden" name="commentid" value="' + comments[i].commentid + '">');
                        var hidden_postid = $('<input type="hidden" name="postid" value="' + postid + '">');
                        formNode.append(editButton);
                        formNode.append(hiddenInput);
                        formNode.append(hidden_postid);
                        node.append(formNode);
                        node.append(infoNode);
                        $("#comments").prepend(node);
                    } else {
                        var node = $("<div id='c" + comments[i].commentid + "' class='sub_comment'>" + comments[i].body + "</div>");
                        var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                        var formNode = $('<form action="createComment.php" method="post"></form>');
                        var editButton = $('<input type="submit" value="Add Comment">');
                        var hiddenInput = $('<input type="hidden" name="commentid" value="' + comments[i].commentid + '">');
                        var hidden_postid = $('<input type="hidden" name="postid" value="' + postid + '">');
                        formNode.append(editButton);
                        formNode.append(hiddenInput);
                        formNode.append(hidden_postid);
                        node.append(formNode);
                        node.append(infoNode);
                        $('#c' + comments[i].parentid).append(node);
                    }

                    console.log(comments[i]);

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