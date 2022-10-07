// DONE
function go_add_user() {
    var data = {};
    data.Members_name = $("#Members_name_a").val();
    data.Members_contact = $("#Members_contact_a").val();
    data.Members_email = $("#Members_email_a").val();
    data.Members_address = $("#Members_address_a").val();
    data.Members_password = $("#Members_password_a").val();

    // START - Check validation
    if (passwordValidation(data.Members_password) == false | emailValidation(data.Members_email) == false | nameValidation(data.Members_name) == false) {
        return false;
    }
    // END - Check validation

    $.ajax({
        url: "functions/cl_go_add_user.php",
        method: "post",
        data: data,
        success: function (res) {
            console.log(res.status);
            if (res.status == "failure") {
                alert("This email address is already in use.");
            }
            else {
                $('#addEmployeeModal').modal('toggle');  //To show and hide
                reload();
            }
        }
    });
}

// DONE
function go_del() {
    var data = {};
    data.Members_id = $("#Members_id_d").val();
    data.Members_email = $("#Members_email_d").val();

    $.ajax({
        url: "functions/cl_go_del.php",
        method: "post",
        data: data,
        success: function (res) {
            $('#deleteEmployeeModal').modal('toggle');  //To show and hide
            reload();
        }
    });
}

// DONE - go_modify
function go_modify() {
    var data = {};
    data.Members_id = $("#Members_id_m").val();
    data.Members_name = $("#Members_name_m").val();
    data.Members_contact = $("#Members_contact_m").val();
    data.Members_email = $("#Members_email_m").val();
    data.Members_address = $("#Members_address_m").val();
    data.Members_status = $("#Members_status_m").val();

    // START - Check validation
    if (emailValidation(data.Members_email) == false | nameValidation(data.Members_name) == false) {
        return false;
    }
    // END - Check validation

    $.ajax({
        url: "functions/cl_go_modify.php",
        method: "post",
        data: data,
        success: function (res) {
            console.log(res);
            if (res.status = "success") {
                $('#editEmployeeModal').modal('toggle');  //To show and hide
                reload();
            }
            else {
                alert("Error");
            }
        }
    });
}

function emailValidation(email) {
    if (email == "") {
        $(".emailErr").html("* Email address required.");
        return false;
    }
    if (emailFormat(email) == false) {
        $(".emailErr").html("* Invalid email address.");
        return false;
    } else {
        $(".emailErr").html("");
        return true;
    }
}

function emailFormat(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function passwordValidation(password) {
    if (password == "") {
        $(".passwordErr").html("* Password required.");
        return false;
    }
    if (password.length < 6) {
        $(".passwordErr").html("* At least 6 characters.");
        return false;
    } else {
        $(".passwordErr").html("");
        return true;
    }
}

function nameValidation(name) {
    if (name == "") {
        $(".nameErr").html("* Name required.");
        return false;
    }
    if (name.length < 3) {
        $(".nameErr").html("* At least 3 characters.");
        return false;
    } else {
        $(".nameErr").html("");
        return true;
    }
}

// Hide all errMsg class
function errMsg_hide() {
    $(".errMsg").html("");
}