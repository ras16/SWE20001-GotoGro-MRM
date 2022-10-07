function go_login() {

    var email = $("#email").val();
    var password = $("#password").val();

    // START - Check validation
    if (emailValidation(email) == false | passwordValidation(password) == false) {
        return false;
    }
    // END - Check validation

    var data = {};
    data.emp_email = email;
    data.emp_password = password;

    $.ajax({
        url: "setup_cookies.php",
        method: "post",
        data: data,
        success: function (res) {
            console.log(res);
            if (res.status == "failure") {
                alert("The email address or password is incorrect.");
            }
            else {
                window.location.replace("setup_cookies.php?emp_email=" + email);
            }
        }
    })
}

function emailValidation(email) {
    if (email == "") {
        alert("Email address required.\n");
        return false;
    }
    else if (emailFormat(email) == false) {
        alert("Invalid email address.\n");
        return false;
    } else {
        return true;
    }
}

function emailFormat(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function passwordValidation(password) {
    if (password == "") {
        alert("Password required.\n");
        return false;
    }
    else if (password.length < 6) {
        alert("Password: At least 6 characters.\n");
        return false;
    } else {
        return true;
    }
}