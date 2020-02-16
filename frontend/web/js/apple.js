/**
 * Created by Andrey on 15.02.2020.
 */
$("#newApple").on('click',function () {
    var color = $("#appleColor").val();
    $.ajax({
        url: "/apple/create",
        method: "POST",
        data: {'color': color},
        dataType: "json"
    }).done(function (data){
        if(data['success'])
        {
            pos = data['position'];
            id = data['id'];
            $("#t"+pos).html("<div class='appleOntree' data-id='"+id+"'></div>");
            console.log("position="+pos);
            console.log("id="+id);
        }
        else {
            console.log(data['message']);
        }
    });

});
