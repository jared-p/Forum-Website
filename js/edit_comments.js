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
                        var formNode = $('<form action="editComments.php" method="post"></form>');
                        var editButton = $('<input type="submit" value="Edit Comment">');
                        var hiddenInput = $('<input type="hidden" name="commentid" value="' + comments[i].commentid + '">');
                        formNode.append(editButton);
                        formNode.append(hiddenInput);
                        node.append(formNode);
                        node.append(infoNode);
                        $("#comments").prepend(node);
                    } else {
                        var node = $("<div id='c" + comments[i].commentid + "' class='sub_comment'>" + comments[i].body + "</div>");
                        var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                        var formNode = $('<form action="editComments.php" method="post"></form>');
                        var editButton = $('<input type="submit" value="Edit Comment">');
                        var hiddenInput = $('<input type="hidden" name="commentid" value="' + comments[i].commentid + '">');
                        formNode.append(editButton);
                        formNode.append(hiddenInput);
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
    //}, 1000);

    $("#comment_form").on('submit', function (e) {
        body = $("#comment_form_body");
        flag = "";
        if (body.val().trim().length == 0 || body.val().trim().length > 400) {
            e.preventDefault();
            flag = flag + "Post must be less than 400 characters but non zero, yours is " + body.val().trim().length + "\n";
            body.css("border", "3px solid red");
        } else {
            body.css("border", "none");
        }
        if (flag != "") {
            alert(flag);
        }
        //e.preventDefault();
    });


});