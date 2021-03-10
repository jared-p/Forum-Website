window.addEventListener('load', function(){
    
    var postid = $(".post").attr("id");
    var url = "getComments.php";
    $.post(url, {'postid':postid}, function(data, status){
        if( status == 'success'){
            var comments = $.parseJSON(data);            
            for( var i = 0; i < comments.length; i++){
                if( comments[i].parentid == null){
                    //if( $("#comments")[0].children.length == 0){ //may have to change the == value if add to the div node.
                    //}
                    var node = $("<div id='c"+comments[i].commentid+"'>"+comments[i].body+"</div>");
                    $("#comments").prepend(node);
                }else{
                    var node = $("<div id='c"+comments[i].commentid+"'>"+comments[i].body+"</div>");
                    $('#c'+comments[i].parentid).append(node);
                }

                console.log(comments[i]);                
            
            }
        }else{
            alert("error");
        }
        console.log($("#comments")[0].children.length);
    });
    //console.log(postid);


    //will continiously call the function to show the comments
    //setInterval(function(e){
    //}, 1000);



});