/**
 * Created by Andrey on 15.02.2020.
 */
//Добавление яблока на дерево
$("#newApple").on('click',function () {
    $("#message").text("");
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
            size = data['size'];
            $("#t"+pos).html("<div class='appleOntree' data-id='"+id+"' data-size='"+size+"' style='background-color:"+color+" '></div>");
        }
        else
            $("#message").text(data['message']);
    });
});

//Кнопки управления яблоками
$(".appleOnTree td").on('click',function () {
    event.stopPropagation();
    $("#message").text("");

    if (!$(this).find("input").val())
    {
        $(".appleOnTree").find("div.appleForm").remove();

        var id = $(this).find("div.appleOntree").data('id');
        var size = $(this).find("div.appleOntree").data('size');
        if(id && size)
            $(this).append("<div class='appleForm' align='center'><div data-id='"+id+"' onclick='tear("+id+");'><span class='glyphicon glyphicon-save tear' title='упасть'></span></div><div class='eat' title='съесть' onclick='eat("+id+");'></div><input type='number' value='"+size+"' min='0' max='"+size+"'></div>");
    }
});

$(".container").on('click',function () {
    $(".appleForm").remove();
});

$(".tree").on('click','div', function () {
    event.stopPropagation();
});

//Сорвать яблоко
function tear(id) {
    console.log(id);
    $("#message").text("");
    $.ajax({
        url: "/apple/tear",
        method: "POST",
        data: {'id': id},
        dataType: "json"
    }).done(function (data){
        if(data['success'])
        {
            pos = data['position'];
            id = data['id'];
            color = data['color'];
            oldpos = data['oldposition'];
            size = data['size']
            $("#t"+oldpos).html("");
            $("#t"+pos).html("<div class='appleOntree' data-id='"+id+"' data-size = '"+size+"' style='background-color:"+color+"'></div>");
         }
        else
            $("#message").text(data['message']);
    });
}

/**
 * Поедание яблока
 *
 */
function eat(id) {
    eatval = $(".appleOnTree").find("input").val();
    $("#message").text("");
    $.ajax({
        url: "/apple/eat",
        method: "POST",
        data: {'id': id,'eat':eatval},
        dataType: "json"
    }).done(function (data){
        if(data['success'])
        {
            pos = data['position'];
            size = data['size'];
            $("#t"+pos).find(".appleOntree").data('size',size);

            if(size == 0)
                $("#t"+pos).html("");
            else
            {
                $("#t"+pos).find("input").attr('value',size);
                $("#t"+pos).find("input").attr('max',size);
                $("#t"+pos).find("input").val(size);
            }
        }
        else
            $("#message").text(data['message']);

    });
}
