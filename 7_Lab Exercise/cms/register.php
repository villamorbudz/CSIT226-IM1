<?php    
    include 'connect.php';
    //include 'readrecords.php';   
    require_once 'includes/header.php'; 
?>

<div style='background-color:#ffff00'>
    <center>
        <p style="color:white"><h2>User Registration Page</h2></p>
    </center>
</div>  

<div>
	<form method="post">
		<pre>
			Firstname:<input type="text" name="txtfirstname">
			Lastname:<input type="text" name="txtlastname">			
			
			
			Email Address:<input type="text" name="txtemail">	
			Username:<input type="text" name="txtusername">	
			Password:<input type="password" name="txtpassword">				
			
			<input type="submit" name="btnRegister" value="Register"> 
		</pre>
	</form>
</div>


<?php	
	if(isset($_POST['btnRegister'])){		
		//retrieve data from form and save the value to a variable
		//for tbluserprofile
		$fname=$_POST['txtfirstname'];		
		$lname=$_POST['txtlastname'];
		
		
		//for tbluseraccount
		$email=$_POST['txtemail'];		
		$uname=$_POST['txtpassword'];
		$pword=$_POST['txtpassword'];
		
		//save data to tbluserprofile			
		$sql1 ="Insert into tbluserprofile(firstname,lastname) values('".$fname."','".$lname."')";
		mysqli_query($connection,$sql1);
		
		//Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
		$sql2 ="Select * from tbluseraccount where username='".$uname."'";
		$result = mysqli_query($connection,$sql2);
		$row = mysqli_num_rows($result);
		if($row == 0){
			$sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$uname."','".$pword."')";
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


<?php require_once 'includes/footer.php'; ?>