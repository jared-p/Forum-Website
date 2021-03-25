window.addEventListener('load', function () {
    $(".post").on('click', function (e) {
        //console.log($(e.target).attr("class"));
        ///*
        if (this.id == "create_post") {
            if (e.target.className == "post_title") {
                $(this.children[1]).toggleClass("hide");
                $(this.children[2]).toggleClass("hide");
            }
        } else if (this.id == "demo") {
            var url = "main.php";
            window.location.href = url;
        } else if ($(e.target).attr("class") == "post_title") {
            $(this.children[1]).toggleClass("hide");
            $(this.children[2]).toggleClass("hide");
        } else {
            var postid = this.children[0].id;
            var url = "posting.php";
            var pointer = url + "?id=" + postid;

            //console.log(this.children[0].id);
            window.location.href = pointer;
            //$(this).css('color','red');
        }
        //*/
    });
    $(".post").on('mouseover', function (e) {
        $(this).css("border", "1px solid #d7dadc");
    });
    $(".post").on('mouseout', function (e) {
        $(this).css("border", "1px solid #343536");
    });




    $("#post_form").on('submit', function (e) {
        title = $("#post_form_title");
        body = $("#post_form_body");
        topic = $("#post_form_topic");
        flag = "";
        if (title.val().length == 0 || title.val().length > 50) {
            e.preventDefault();
            flag = flag + "Title must be less than 50 characters but non zero, yours is " + title.val().length + "\n";
            title.css("border", "3px solid red");
        } else {
            title.css("border", "none");
        }
        if (body.val().trim().length == 0 || body.val().trim().length > 5000) {
            e.preventDefault();
            flag = flag + "Post must be less than 5000 characters but non zero, yours is " + body.val().trim().length + "\n";
            body.css("border", "3px solid red");
        } else {
            body.css("border", "none");
        }
        if (topic.val() == "" || topic.val() == "none") {
            e.preventDefault();
            flag = flag + "Must select a topic for the post";
            topic.css("border", "3px solid red");
        } else {
            topic.css("border", "none");
        }
        if (flag != "") {
            alert(flag);
        }
    });
});