<?php    
    include 'connect.php';
    include 'readrecords.php';   
	include 'includes/imports.php'
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
		
		//save data to tbluserprofile			
		$sql1 ="Insert into tbluserprofile(firstname,lastname,gender,birthdate) values('".$fname."','".$lname."','".$ugender."','".$ubday."')";
		mysqli_query($connection,$sql1);
		
		//Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
		$sql2 ="Select * from tbluseraccount where username='".$uname."'";
		$result = mysqli_query($connection,$sql2);
		$row = mysqli_num_rows($result);
		if($row == 0){
			$sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$uname."','".password_hash($pword, PASSWORD_DEFAULT, ["cost" => 12])."')";
			mysqli_query($connection,$sql);
			echo "<script language='javascript'>
						alert('New record saved.');
				  </script>";
		}else{
			echo "<script language='javascript'>
						alert('Username already existing');
				  </script>";
		}
			
		
	}
		

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Register | Eventify</title>
        <link rel="stylesheet" href="css/css.css">
    </head>

	<body>
		<div style='background-color:#ffff00'>
			<center>
				<p style="color:white"><h2>User Registration Page</h2></p>
			</center>
		</div>  

		<div>
			<form method="post">
				<pre>
					First Name:<input type="text" name="txtfirstname" autocomplete="off">
					Last Name:<input type="text" name="txtlastname" autocomplete="off">		

                    <input type="radio" name="gender" value="male" checked> Male
                    <input type="radio" name="gender" value="female"> Female
                    <input type="radio" name="gender" value="other"> Other

					Birthday:<input type="date" name="birthdate">
					
					Email Address:<input type="text" name="txtemail" autocomplete="off">	
					Username:<input type="text" name="txtusername" autocomplete="off">	
					Password:<input type="password" name="txtpassword" autocomplete="off">				
					
					<input type="submit" name="btnRegister" value="Register">
                    <a href="index.php">&lt Back</a>
				</pre>
			</form>
		</div>
	</body>
</html>