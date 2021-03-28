// window.addEventListener("submit", function (e) {
//     var needed = document.getElementsByClassName("required");
//     var flag = false;
//     for (i = 0; i < needed.length; i++) {
//         if (needed[i].value == "") {
//             flag = true;
//         }
//     }
//     if (flag) {
//         var temp = document.getElementsByClassName("required");
//         temp.style.color = "red";
//         e.preventDefault();
//         createRed();
//     }

// });

// function createRed(e) {
//     var sheet = document.getElementsByClassName("required");
//     for (var i = 0; i < sheet.length; i++) {
//         sheet[i].style.border = "1px solid red";
//     }
// }

// window.addEventListener("input", function (e) {
//     var sheet = document.getElementsByClassName("required");
//     for (var i = 0; i < sheet.length; i++) {
//         if (sheet[i].value.length != 0 && !sheet[i].value == "") {
//             sheet[i].style.border = "1px solid black";
//         }
//     }
// });


//Still needs form type validation (string lengths mainly)
window.addEventListener("load", function (e) {
    $("#user_form").on("submit", function (e) {
        var required = $(".required");
        var flag = 0;
        for (var i = 0; i < required.length; i++) {
            var node = $(required[i]);
            if (node.val() == "") {
                e.preventDefault();
                flag = flag + 1;
                node.css("border", "1px solid red");
            } else {
                node.css("border", "1px solid black");
            }
        }
        if (flag) {
            alert("Must submit data for each field,\nMissing: " + flag + " fields");
        }
    });
});