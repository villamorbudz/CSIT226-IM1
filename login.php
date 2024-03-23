<?php    
    include 'connect.php'; 
	include 'includes/imports.php';

    $style = "";

	if(isset($_POST['btnLogin'])){
		$uname = $_POST['txtusername'];
		$pwd = $_POST['txtpassword'];
		//check tbluseraccount if username is existing
		$sql = "Select * from tbluseraccount where username='".$uname."'";

		$result = mysqli_query($connection,$sql);	
		
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		
		if($count == 0){
			$errLogIn = "Username not found.";
		}else if(!password_verify($pwd, $row[3])) {
			$errLogIn = "Incorrect password.";
		}else{
            $_SESSION['username']=$row[0];
            header("location: index-logged.php");
		}
			
		
	}
		

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Log In | Eventify</title>
        <link rel="stylesheet" href="css/cssLogReg.css">
    </head>

	<body class="bgCustom">
        <div class="center flex-wrapper">
            <div class="leftChild">
                <img src="images/party.jpg" alt="people partying">
            </div>
            <div class="rightChild">
                <form class="form-bg" method="post">
                    <div class="space"></div>
                    <div class="space"></div>
                    <div class="flex-wrapper-column">
                        <label class="label-form" for="username">Username:</label>
                        <input class="box-form" type="text" name="txtusername" id="username" placeholder="" autocomplete="off">
                    </div>
                    <div class="space"></div>
                    <div class="flex-wrapper-column">
                        <label class="label-form" for="password">Password:</label>
                        <input class="box-form" type="password" name="txtpassword" id="password" placeholder="" autocomplete="off">
                    </div>
                    <div class="space"></div>
                    <div class="space"></div>
                    <div class="space">
                        <?php if (isset($errLogIn) && !empty($errLogIn)) { ?>
                                <p class="errLogIn label-form"><?= $errLogIn ?></p>
                        <?php } ?>
                    </div>
                    <a href="index.php">&lt Back</a>
                    <input class="box-form" type="submit" name="btnLogin" value="Login">
                </form>
            </div>
        </div>
	</body>
</html>