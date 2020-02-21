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
            color = data['color'];
            $("#t"+pos).html("<div class='appleOntree' data-id='"+id+"' style='background-color:"+color+"'></div>");
            console.log("position="+pos);
            console.log("id="+id);
        }
        else {
            console.log(data['message']);
        }
    });

});

$(".appleOntree").on('click',function () {

    var id = $(this).data('id');
    var status = $(this).data('status');
    var size = $(this).data('size');
    var condition = $(this).data('condition');

    $(".appleForm").remove();
    event.stopPropagation();
    $(this).parent().append("<div class='appleForm' align='center'><div><span class='glyphicon glyphicon-apple' title='упасть'></span></div><div><input type='number' value='"+size+"' min='0' max='"+size+"'><span class='glyphicon glyphicon-adjust' title='съесть'></span></div></div>");
});

$(".container").on('click',function () {
    $(".appleForm").remove();
});

$(".tree").on('click','div', function () {
    event.stopPropagation();
});


