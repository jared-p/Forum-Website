window.addEventListener('load', function () {
    $(".post").on('click', function (e) {
        if (this.id == "create_post") {

        } else {
            var postid = this.children[0].id;
            var url = "posting.php";
            var pointer = url + "?id=" + postid;

            //console.log(this.children[0].id);
            window.location.href = pointer;
            //$(this).css('color','red');
        }
    });
    $(".post").on('mouseover', function (e) {
        //console.log(this.id);
        $(this).css("border", "1px solid #d7dadc");
    });
    $(".post").on('mouseout', function (e) {
        $(this).css("border", "1px solid #343536");
    });

});