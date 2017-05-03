/**
 * Created by workstation on 19.04.17.
 */

var inEdit = false;

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

function update(id) {

    switch (inEdit) {
        case true:
            $.ajax({
                method: "POST",
                url: "api/api.php?case=user&action=update-set",
                data: {username: $("#username").val(), id: $("form").attr("data-edit-id")}
            }).done(function (response) {

                console.log(response);

                $("form").removeAttr("data-edit-id");
                $("input[type='submit']").val("User erstellen");
                inEdit = false;
                read();
            });
            break;

        case false:
            getUser(id);
            break;
    }
}

function getUser(id) {
    $.ajax({
        method: "GET",
        url: "api/api.php?case=user&action=update-get&id=" + id
    }).done(function (response) {

        console.log(response);
        var data = $.parseJSON(response);
        $("#username").val(data[0].user_name);
        $("form").attr("data-edit-id", data[0].user_id);
        $("input[type='submit']").val("Datensatz editieren");
        inEdit = true;
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
                "<td><a class='btn red delete' data-delete-id='" + data[i].user_id + "'>Löschen</a> / <a class='btn yellow update' data-update-id='" + data[i].user_id + "'>edit</a></td>" +
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

function deleteUser(id) {
    if (typeof id === "undefined") {
        return;
    }

    $.ajax({
        method: "GET",
        url: "api/api.php?case=user&action=delete",
        data: {id: id}
    }).done(function (response) {
        console.log(response);
        var data = $.parseJSON(response);
        Materialize.toast(data.message, 4000)
        read();
    });
}

function checkLogin() {
    $.ajax({
        method: "GET",
        url: "api/api.php?case=checkLoggedIn"
    }).done(function (response) {
        console.log(response);
        var data = $.parseJSON(response);
        if(data.success === "true"){
            read();
        }else{
            window.location.href = "login.html";
        }

    });
}

// TODO : if logged in : redirect to login

$(document).ready(function () {

    checkLogin();

    $("form").submit(function (e) {
        e.preventDefault();
        if (inEdit === true) {
            update()
        } else {
            create();
        }
    });

    $("body").on("click", "a.delete", function () {
        var id = $(this).attr("data-delete-id");
        console.log(id);
        deleteUser(id);
    });

    $("body").on("click", "a.update", function () {
        var id = $(this).attr("data-update-id");
        console.log(id);
        update(id);
    });

});