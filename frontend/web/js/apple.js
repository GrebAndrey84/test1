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
    // var fid = $(this).data('id');
    // console.log(fid);
    // $("#t"+fid).html("<div class='appleForm'></div>");
    $(".appleForm").remove();
    $(this).parent().append("<div class='appleForm'></div>");
});
