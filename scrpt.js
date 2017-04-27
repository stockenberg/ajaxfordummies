/**
 * Created by workstation on 19.04.17.
 */



function saveFormDataToObj() {

    var obj = {};
    if (arguments.length > 0) {
        for (var count = 0; count < arguments.length; count++) {
            if (typeof arguments[count] !== "undefined") {
                for (var i = 0; i < arguments[count].length; i++) {
                    obj[arguments[count][i].name] = arguments[count][i].value;
                }
            }
        }
    }

    return obj;
}

function change() {

    var inputs = $("input[type='text']");
    var textareas = $("textarea");

    var data = saveFormDataToObj(inputs, textareas);

    //console.dir(data);

    $.ajax({
        method: "POST",
        url: "index.php?case=message",
        data: data
    }).done(function (response) {
        console.log(response);
        $("ul").empty();


        var res = $.parseJSON(response);


        for (var i = 0; i < res.errors.length; i++) {
            $("ul").append("<li>Error: " + res.errors[i].response + "</li>");
        }

        for (data in res.data.data) {
            $("ul").append("<li>Data: " + res.data.data[data] + "</li>");
        }


    });
}

function read() {

    $.ajax({
        method: "GET",
        url: "api/api.php?case=user&action=read"
    }).done(function (response) {
        console.log(response);
        var data = $.parseJSON(response);
        console.log(data);
        $("tbody").empty();

        for (var i = 0; i < data.length; i++) {
            console.log(data[i].user_name)
            $("tbody").append("" +
                "<tr>" +
                "<td>" + data[i].user_id + "</td>" +
                "<td>" + data[i].user_name + "</td>" +
                "<td>" + data[i].user_created + "</td>" +
                "<td>Löschen / edit</td>" +
                "</tr>")
        }
    });
}

function create() {
    var username = $("input[name='username']").val();

    $.ajax({
        method: "POST",
        url: "api/api.php?case=user&action=save",
        data: {username: username}
    }).done(function (response) {
        console.log(response);
        var data = $.parseJSON(response);
        $("input[name='username']").val("");
        Materialize.toast(data.message, 4000)
        read();
    });
}

$(document).ready(function () {

    read();

    $("form").submit(function (e) {
        e.preventDefault();
        create();

    });

});