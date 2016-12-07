<?php
include_once "common/connect.php";
$pageTitle = "Register";
include_once "common/header.php";

if(!empty($_POST['username'])):
	include_once "inc/class.users.inc.php";
$users = new BBUser($db);
echo $users->createAccount();
else:
	?>
<div id="registerphp">
	<h2 class="title">Create an account</h2>
	<form method="post" action="register.php" id="registerForm">
		<div id="register_form">
			<label for="first_name">First Name:</label>
			<input type="text" name="first_name" id="first_name"><br>
			<label for="last_name">Last Name:</label>
			<input type="text" name="last_name" id="last_name"><br>
			<label for="username">Email:</label>
			<input type="text" name="username" id="username"><br>
			<label for="username">Email:</label>
			<input type="text" name="username" id="username"><br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password"><br>
			<label for="password">Verify Password:</label>
			<input type="password" name="password" id="password"><br>
			<input type="submit" name="register" id="register" value="Sign up"><br>
		</div>
	</div>
</form>

<?php
endif;
include_once 'common/footer.php';
?>