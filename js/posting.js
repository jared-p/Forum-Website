window.addEventListener('load', function () {
    //will continiously call the function to show the comments
    setInterval(function (e) {
        var postid = $(".post").attr("id");
        var url = "getComments.php";
        $.post(url, { 'postid': postid }, function (data, status) {
            if (status == 'success') {
                var comments = $.parseJSON(data);
                if (comments.length != 0) {
                    for (var i = 0; i < comments.length; i++) {
                        var numComments = 0;
                        for (var j = 0; j < comments.length; j++) {
                            if (comments[j].parentid == comments[i].commentid) {
                                numComments++;
                            }
                        }
                        if ($("#comments_title").length == 0) {
                            $("#comments").before($('<h3 id="comments_title">Comments: ' + comments.length + '</h3>'));
                        } else {
                            $("#comments_title").text('Comments: ' + comments.length);
                            $('#no_comments').remove();
                        }
                        if (comments[i].parentid == null) {
                            var testnode = $('#c' + comments[i].commentid);
                            if (testnode.length == 0) {
                                var node = $("<div id='c" + comments[i].commentid + "' class='root_comment'>" + comments[i].body + "</div>");
                                node.on("click", collapseComment);
                                var commentNode = $("<p class='left_align' id='" + postid + comments[i].commentid + "'>" + numComments + " Replies</p>");
                                var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                                node.append(infoNode);
                                node.append(commentNode);
                                $("#comments").prepend(node);
                            } else {
                                $('#' + postid + comments[i].commentid).text(numComments + " Replies");
                            }
                        } else {
                            var testnode = $('#c' + comments[i].commentid);
                            //console.log(testnode.length == 0);
                            if (testnode.length == 0) {
                                var node = $("<div id='c" + comments[i].commentid + "' class='sub_comment hide'>" + comments[i].body + "</div>");
                                node.on("click", collapseComment);
                                var commentNode = $("<p class='left_align'>" + numComments + " Replies</p>");
                                var infoNode = $('<p class="comment_information">Username: ' + comments[i].username + ', Posted on: ' + comments[i].commentdate + '</p>');
                                node.append(infoNode);
                                node.append(commentNode);
                                $('#c' + comments[i].parentid).append(node);
                            }
                        }

                        //console.log(comments[i]);

                    }
                } else {
                    if ($("#comments_title").length == 0) {
                        $("#comments").before($('<h3 id="comments_title">Comments: ' + comments.length + '</h3>'));
                        $("#comments").append($("<p id='no_comments'>No Comments Posted Yet!</p>"));
                    }
                }
            } else {
                alert("error");
            }
            //console.log($("#comments")[0].children.length);
        });
    }, 1000);
});
function collapseComment(e) {
    e.stopPropagation();
    $(this.children[1]).toggleClass("hide");
    for (var i = 0; i < this.children.length; i++) {
        if (this.children[i].className == "left_align" || this.children[i].className == "comment_information") {

        } else {
            $(this.children[i]).toggleClass("hide");
        }
    }
    console.log(this);
}