<?php    
    include 'connect.php';
    include 'readrecords.php';   
	include 'includes/imports.php';
?>

<?php	
	if(isset($_POST['btnRegister'])){		
		//retrieve data from form and save the value to a variable
		//for tbluserprofile
		$fname = $_POST['txtfirstname'];		
		$lname = $_POST['txtlastname'];
		$ugender = $_POST['gender'];
		$ubday = $_POST['birthdate'];
		
		//for tbluseraccount
		$email=$_POST['txtemail'];		
		$uname=$_POST['txtusername'];
		$pword=$_POST['txtpassword'];
		
		//Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
		$sql2 ="Select * from tbluseraccount where username='".$uname."'";
		$result = mysqli_query($connection,$sql2);
		$row = mysqli_num_rows($result);
		if($row == 0){
			//save data to tbluserprofile			
			$sql1 ="Insert into tbluserprofile(firstname,lastname,gender,birthdate) values('".$fname."','".$lname."','".$ugender."','".$ubday."')";
			mysqli_query($connection,$sql1);
			
			$sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$uname."','".password_hash($pword, PASSWORD_DEFAULT, ["cost" => 12])."')";
			mysqli_query($connection,$sql);
			$sucRegister = "User succesfully registered.";
		}else{
			$errRegister = "Username already taken.";
		}
			
	}
		

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Register | Eventify</title>
        <link rel="stylesheet" href="css/cssLogReg.css">
    </head>

	<body class="bgCustom">
			<div class="center form-bg shadow-box">
				<h2 class="div-center headerDiv">User Registration</h2>
				<form method="post">
					<div class="flex-wrapper">
						<div class="flex-wrapper-column">
							<label class="label-form" for="fname">First Name:</label>
							<input class="box-form" type="text" id="fname" name="txtfirstname" autocomplete="off" required>
						</div>
						<div class="flex-wrapper-column">
							<label class="label-form" for="lname">Last Name:</label>
							<input class="box-form" type="text" id="lname" name="txtlastname" autocomplete="off" required>
						</div>
					</div>
					<div class="flex-wrapper">
						<label class="label-form1" for="gndr">Gender:</label>
						<input id="gndr" class="label-form1" type="radio" name="gender" value="male" checked> Male
						<input class="label-form1" type="radio" name="gender" value="female"> Female
						<input class="label-form1" type="radio" name="gender" value="other"> Other
					</div>
					<div>
						<label class="label-form1" for="bday">Birthday:</label>
						<input class="box-form" type="date" id="bday" name="birthdate" required>
					</div>
					<div>
						<label class="label-form1" for="eadd">Email Address:</label>
						<input class="box-form" type="text" id="eadd" name="txtemail" autocomplete="off" required>
					</div>
					<div class="flex-wrapper">
						<div class="flex-wrapper-column">
							<label class="label-form" for="user-name">Username:</label>
							<input class="box-form" type="text" id="user-name" name="txtusername" autocomplete="off" required>
						</div>
						<div class="flex-wrapper-column">
							<label class="label-form" for="passw">Password:</label>
							<input class="box-form" type="password" id="passw" name="txtpassword" autocomplete="off" required>
						</div>
					</div>
					<div class="space">
						<?php if (isset($errRegister)) { ?>
							<p class="errRegister error-message"><?= $errRegister ?></p>
						<?php } ?>
						<?php if (isset($sucRegister)) { ?>
							<p class="sucRegister succ-message"><?= $sucRegister ?></p>
						<?php } ?>
					</div>
					<div class="space"></div>
					<div class="bottom-wrapper">
						<a class="box-form" href="index.php">&lt Back</a>
						<input class="box-form" type="submit" name="btnRegister" value="Register">
					</div>
				</form>
			</div>
	</body>
	<footer>
        <h6>Fiel Louis L. Omas-as</h6>
        <h6>Giles Anthony I. Villamor</h6>
        <h6>BSCS - 2</h6>
    </footer>
</html>