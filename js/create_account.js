window.addEventListener("submit", function(e){
    var needed = document.getElementsByClassName("required");
    var flag=false;
    for (i=0;i<needed.length;i++){
        if (needed[i].value==""){
            flag=true;
        }
    }
    if (flag){
        var temp = document.getElementsByClassName("req");
        temp.style.color="red";
        e.preventDefault();
        createRed();
    }
    
});

function createRed(e){
    var sheet = document.getElementsByClassName("required");
    for (var i = 0; i < sheet.length; i++) {
        sheet[i].style.border = "1px solid red";
    }
}

window.addEventListener("input", function(e){
    var sheet = document.getElementsByClassName("required");
    for (var i = 0; i < sheet.length; i++) {
        if (sheet[i].value.length!=0 && !sheet[i].value==""){
            sheet[i].style.border = "1px solid black";
        }
    }
});
