<html>
<body>
	<form method="post">
	<p align = "center"> <h2>LOGIN PAGE</h2></p>
		<pre>
			Input username:<input type="text" name="txtUname">
			Input password:<input type="password" name="txtPwd">
			
			<input type="submit" name="btnLogin" value="Login"> 
		</pre>
	</form>
</body>
</html>


<?php
	session_start();
	$con= mysqli_connect("localhost","root","","dbstudentinfosystem") 
		or die("Error in connection");
	echo "connected";
	if(isset($_POST['btnLogin'])){
		$uname=$_POST['txtUname'];
		$pwd=$_POST['txtPwd'];
		$sql ="select * from trainee where username='".$uname."'";
		$result = mysqli_query($con,$sql);
		$count = mysqli_num_rows($result);
		
		$row = mysqli_fetch_array($result);
		
		if($count== 0){
			echo "<script language='javascript'>
						alert('username not existing.');
				  </script>";
		}else if($row[1] != $pwd) {
			echo "<script language='javascript'>
						alert('Incorrect password');
				  </script>";
		}else{
			$_SESSION['username']=$row[0];
			header("location: main.php");
		}
			
		
	}
		

?>
