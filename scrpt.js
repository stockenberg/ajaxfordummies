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

$(document).ready(function () {


});