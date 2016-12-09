$(document).ready(function(){
	var login = $("#loginbutton").click(function(e) {
		e.preventDefault();
		if(document.getElementById("username")==null){
			alert("Enter a username");
		}else if(document.getElementById("password")==null){
			alert("Enter a password");
		}else{
			var email = document.getElementById("username").value;
			var base_url = 'php'
			$.ajax(
				base_url + '/user.php/email/' + email,
				{
				type: "GET",
				dataType: "json",
				success: function (user_json, status, jqXHR) {
					var u = new User(user_json);
					var id = u.id;
					cookie_text = "userid="+u.id+"; path=/";
				    document.cookie = cookie_text;
				    alert(document.cookie);
                },
                error: function () {
                	document.getElementById('username_availabilty').innerHTML = "Username or Password Invalid";               
                }
            });
		}
		
	});

});