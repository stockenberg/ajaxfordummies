/**
 * Created by workstation on 27.04.17.
 */

function saveFormDataToObj() {

    var obj = {};
    if (arguments.length > 0) {
        for (var count = 0; count < arguments.length; count++) {
            if (typeof arguments[count] !== "undefined") {
                for (var i = 0; i < arguments[count].length; i++) {
                    obj[arguments[count][i].name] =
                        arguments[count][i].type === "password"
                        && arguments[count][i].value !== ""
                            ? $.md5(arguments[count][i].value)
                            : arguments[count][i].value;
                }
            }
        }
    }

    return obj;
}

$(document).ready(function () {
    console.log($.md5("test"));

    $("form").submit(function (e) {
        e.preventDefault();

        var inputs = $("input[type='text'], input[type='password']");

        var data = saveFormDataToObj(inputs);

        console.log(data);

        $.ajax({
            method: "POST",
            url: "api/api.php?case=authentification&action=login",
            data : data
        }).done(function (response) {
            console.log(response);
            var data = $.parseJSON(response);
            Materialize.toast(data.message);
            if(data.success === "true"){
                setTimeout(function () {
                    window.location.href = data.redirect;
                }, 500);
            }
        });
    });

});