$(document).ready(function() {
    var email_works = false;
    var password_works = false;
    var password_match = false;
    var load_user = $("#username").blur(function () {
        var obj = this;
        var email = this.value;
        var url_base = 'php';
        $.ajax(url_base + "/user.php/email/" + email,
            {
                type: "GET",
                dataType: "json",
                success: function (user_json, status, jqXHR) {
                    var u = new User(user_json);
                    var json = JSON.stringify(u);
                    document.getElementById('username_availabilty').innerHTML = "Email already registered. <a href='index.html'>Login?</a>";
                    email_works = false;
                },
                error: function () {
                    document.getElementById('username_availabilty').innerHTML = "Valid";
                    email_works = true;
                }
            })
    });

    var validate_password = $("#password").blur(function () {
        var re = /^[A-Za-z]\w{7,14}$/;
        if (document.getElementById("password").value.match(re)) {
            document.getElementById('password_availabilty').innerHTML = "";
            password_works = true;
        } else {
            document.getElementById('password_availabilty').innerHTML = "Invalid Password";
            password_works = false;
        }
    });
    var verify_matching_passwords = $("#verify").blur(function () {
        var password_content = document.getElementById("password").value;
        var verify_content = document.getElementById("verify").value;
        if (password_content == verify_content) {
            document.getElementById('verify_match').innerHTML = "Passwords match";
            password_match = true;
        } else {
            document.getElementById('verify_match').innerHTML = "Passwords do not match";
            password_match = false;
        }

    });

    var validate_account = $("#register").click(function (e) {
        e.preventDefault();
        var url_base = 'php';
        if (email_works && password_works && password_match) {
            email=document.getElementById("username").value;
            password=document.getElementById("password").value;
            var obj = new Object();
            obj.email=email;
            obj.password=password;
            var json = JSON.stringify(obj);


            $.ajax(url_base + "/user.php/",
                {
                    type: "POST",
                    dataType: "json",
                    data: jQuery.param(obj),
                    success: function (user_json, status, jqXHR) {
                        var t = new User(user_json);
                        alert('Account Successfully created');
                        window.location="index.html";
                    },
                    error: function (jqXHR, status, error) {
                        alert(jqXHR.responseText);
                    }
                });

        } else {
            alert("Cannot create account. Double check the information");
        }

    });


});
