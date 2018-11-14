<?php
	/*Template Name: Registration*/
 ?>

<?php
	get_header();

	// making a global variable
	global $wpdb;

	// if post is true do this
	if ($_POST) {
		$email = $wpdb->escape($_POST['email']);
		$username = $wpdb->escape($_POST['username']);
		$password = $wpdb->escape($_POST['password']);
		$confirm = $wpdb->escape($_POST['confpwd']);

		// Adding error messages to this array
		$error = array();

		// VALIDATING FORM
		// if the username contains space we need to validate it, store the error in an array
		if (strpos($username, ' ') !== false) {
			$error['username_space'] = "Username has space";
		}

		// Checking if empty input box
		if (empty($username)) {
			$error['username_empty'] = "Username is empty";
		}

		// if the username exists in the database
		if (username_exists($username)) {
			$error['username_exists'] = "Username already exists";
		}

		// Not in the correct format of email
		if (!is_email($email)) {
			$error['email_valid'] = "Not a valid email";
		}

		// if the email exists in the database
		if (email_exists($email)) {
			$error['email_exists'] = "Email already exists";
		}

		// check if the password and confirm passsword match
		if (strcmp($password, $confirm) !== 0) {
			$error[''] = "Passwords do not match";
		}

		// What happenes when we submit the form
		if (count($error) == 0) {
			// Create the user by adding the details inputted in the form into the database
			wp_create_user($username, $password, $email);
			echo "User created successfully";
			exit();
		} else {
			// prinitng the array of errors
			print_r($error);
		}

	}
?>
<div style="margin: 0 auto; width: 50%;">
	<form class="" action="" method="post">
		<label for="email">Email</label>
		<input type="text" name="email" id="email" placeholder="email" style="margin-bottom: 2em;">

		<label for="email">Username</label>
		<input type="text" name="username" id="username" placeholder="username" style="margin-bottom: 2em;">

		<label for="password">Password</label>
		<input type="password" name="password" id="password" placeholder="password" style="margin-bottom: 2em;">

		<label for="confpwd">Confirm Password</label>
		<input type="password" name="confpwd" id="confpwd" placeholder="confirm password" style="margin-bottom: 2em;">

		<button type="sumbit" name="button">Submit</button>
	</form>
</div>


<?php get_footer(); ?>
