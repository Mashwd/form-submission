<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form-Submission</title>
</head>
<body style="background: #F3F3F3;">

	<h2 style="text-align:center">Form-Submission</h2>
	<?php 
		define("filepath", "data.txt");

        $firstName = $lastName = "";
        $firstNameErr = $lastNameErr = "";
        $gender = $birthday = $religion = $userName = $password = $email = "";
        $genderErr = $birthdayErr = $religionErr = $userNameErr = $passwordErr = $emailErr =  "";
        $successfulMessage = $errorMessage = $passSuccessfulMsg = $emailMsg = $passMsg = "";
        $flag = false;

        if($_SERVER['REQUEST_METHOD'] === "POST") {
	        $firstName = $_POST['firstname'];
	        $lastName = $_POST['lastname'];
	        $birthday = $_POST['birthday'];
	        $religion = $_POST['religion'];
	        $email = $_POST['email'];
	        $userName = $_POST['username'];
	        $password = $_POST['password'];


	        if(empty($firstName)) {
		        $firstNameErr = "First name can not be empty!";
		        $flag = true;
	        }
	        if(empty($lastName)) {
		        $lastNameErr = "Last name can not be empty!";
		        $flag = true;
	        }
	        if(empty($_POST['gender'])) {
		        $genderErr = "Gender can not be empty!";
		        $flag = true;
	        }
	        if(empty($birthday)) {
		        $birthdayErr = "Birthday can not be empty!";
		        $flag = true;
	        }
	        if(empty($religion)) {
		        $religionErr = "Religion can not be empty!";
		        $flag = true;
	        }
	        if(empty($email)) {
		        $emailErr = "Email can not be empty!";
		        $flag = true;
	        }
	        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	$emailMsg = "Invalid email format";
			  	$flag = true;
			}
	        if(empty($userName)) {
		        $userNameErr = "Username can not be empty!";
		        $flag = true;
	        }
	        if(empty($password)) {
		        $passwordErr = "Password can not be empty!";
		        $flag = true;
	        }
	        else
	        {
	        	$number = preg_match('@[0-9]@', $password);
				$uppercase = preg_match('@[A-Z]@', $password);
				$lowercase = preg_match('@[a-z]@', $password);
				$specialChars = preg_match('@[^\w]@', $password);
				 
				if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
				    $passMsg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
				    $flag = true;
				} 
				else {
				    $passSuccessfulMsg = "Your password is strong.";
				}
	        }
	        if(!$flag) {
		        $firstName = test_input($firstName);
		        $lastName = test_input($lastName);
		        $gender = test_input($_POST['gender']);
		        $birthday = test_input($gender);
		        $religion = test_input($religion);
		        $email = test_input($email);
		        $userName = test_input($userName);
				$successfulMessage = "Successfully saved.";	
        	}
    }

        function write($content) {
	        $resource = fopen(filepath, "w");
	        $fw = fwrite($resource, $content);
	        fclose($resource);
	        return $fw;
        }

        function test_input($data) {
	        $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
        }
        
	?>
	<div style = "position: absolute; top: 50%; left: 50%; transform: translate(-49%, -49%);"> 
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete = 'off'>
			<fieldset>
				<legend>Basic Information</legend>
				<label for="firstname">First Name <span style="color: red;">*</span>: </label>
				<input type="text" name="firstname" id="firstname">
				<span style="color: red;"><?php echo $firstNameErr; ?></span>
				<br><br>

				 <label for="lastname">Last Name <span style="color: red;">*</span>: </label>
				<input type="text" name="lastname" id="lastname">
				<span style="color: red;"><?php echo $lastNameErr; ?></span>

				<br><br>

				<label for="gender">Gender<span style="color: red;">*</span>:</label>
			    <input type="radio" id="gender" name="gender" value="Male">
			    <label for="Male">Male</label>
			    <input type="radio" id="gender" name="gender" value="Female">
			    <label for="Female">Female</label>
			    <input type="radio" id="gender" name="gender" value="Others">
			    <label for="Others">Others</label>
			    <span style="color: red;"><?php echo $genderErr; ?></span>

			    <br><br>

			    <label for="birthday">DoB<span style="color: red;">*</span>:</label>
			    <input type="date" id="birthday" name="birthday">
			    <span style="color: red;"><?php echo $birthdayErr; ?></span>

			    <br><br>

			    <label for="religion">Religion<span style="color: red;">*</span>:</label>
			    <select id="religion" name="religion">
				    <option value="">None</option>
				    <option value="muslim">Muslim</option>
				    <option value="hindu">Hindu</option>
				    <option value="buddist">Buddist</option>
				    <option value="christian">Christian</option>
			    </select>
			    <span style="color: red;"><?php echo $religionErr; ?></span>
			</fieldset>

			<fieldset>
		    <legend>Contact Information:</legend>

			    <label for="paddress">Present Address:</label>
			    <textarea id="paddress" name="paddress" rows="4" cols="25"></textarea>

			    <br><br>
			    <label for="peraddress">Permanent Address:</label>
			    <textarea id="peraddress" name="peraddress" rows="4" cols="25"></textarea>

			    <br><br>

			    <label for="phone">Phone:</label>
			    <input type="tel" id="phone" name="phone" pattern="[0-9]{5}-[0-9]{6}">

			    <br><br>

			    <label for="email">Email<span style="color: red;">*</span>:</label>
			    <input type="email" id="email" name="email">
			    <span style="color: red;"><?php echo $emailErr.$emailMsg; ?></span>

			    <br><br>
			    <label for="website">Personal Website Link:</label>
			    <input type="url" id="website" name="website">

		  </fieldset>

		  <fieldset>
		  	<legend>Account Information</legend>
				<label for="username">Username <span style="color: red;">*</span>: </label>
				<input type="text" name="username" id="username">
				<span style="color: red;"><?php echo $userNameErr; ?></span>
				<br><br>

				 <label for="password">Password <span style="color: red;">*</span>: </label>
				<input type="password" name="password" id="password">
				<span style="color: red;"><?php echo $passwordErr . $passMsg; ?></span>
				<span style="color: green;"><?php echo $passSuccessfulMsg; ?></span>
		  </fieldset>	
			<br>	
			 <input type="submit" name="submit" value="Submit">
		</form>

		<span style="color: green;"><?php echo $successfulMessage; ?></span>

</div>
</body>
</html>