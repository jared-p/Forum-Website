window.addEventListener('load', function () {

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
        if (topic.val() == "") {
            e.preventDefault();
            flag = flag + "Must select a topic for the post";
            topic.css("border", "3px solid red");
        } else {
            topic.css("border", "none");
        }
        if (flag != "") {
            alert(flag);
        }
        //e.preventDefault();
    });
});