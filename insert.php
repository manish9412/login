
<?php 
include ("includes/connection.php");
include ("includes/header.php");

if(isset($_POST['submit']))
{
	if (!empty($_POST['email']) && !empty($_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "insert into login_data(email,password) values('$email','$password')";
		$run = mysqli_query($conn,$sql) or die(mysqli_error());

		if ($run)
		{
			# echo "Form Submitted Successfully";
		}
		else
		{
			echo "Form not submitted";
		}
	}
else
{
	echo "All fields required";
}

}


if(isset($_POST['create']))
{
	if (!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Password']) && !empty($_POST['CPassword']))
	{
		$name = $_POST['Name'];
		$email = $_POST['Email'];
		$password = $_POST['Password'];
		$cpassword = $_POST['CPassword'];
		$sql2 = "insert into sign_in(email,password) values('$email','$password')";
		$sql1 = "insert into sign_up(Name,Email,Password,CPassword) values('$name','$email','$password','$cpassword')";
		$run2 = mysqli_query($conn,$sql1) && mysqli_query($conn,$sql2) or die(mysqli_error());

		if ($run2)
		{
			echo '<div class="alert alert-success  w-25 text-center mx-auto p-5 mt-5" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>You have successfully created Account....!!</p>
  <hr>
  <a href="index.php" class="btn btn-success"> Login Now</a>
</div>';
		}
		else
		{
			echo "Form not submitted";
		}
	}
else
{
	echo "All fields required";
}

}

 
 

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Data Page</title>

	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!-- 
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="refresh" content="4, url=logged.php"> -->
 </head>
 <body>
 	<?php

    if (isset($_POST['submit'])) {
      $email = mysqli_real_escape_string($conn,trim($_POST['email']));
      $password = mysqli_real_escape_string($conn,(trim($_POST['password'])));
      
      $query = "SELECT * FROM sign_in WHERE email='$email' AND password = '$password'";
 	$fire = mysqli_query($conn,$query);

 	 if ($fire)
      {
       if (mysqli_num_rows($fire) == 1 )
       {
       		session_start();
       		$_SESSION['is_login'] = true;
       		$_SESSION['email'] = $email;
       		$_SESSION['password'] = $password; 

echo '<div class="alert alert-success w-25 text-center mx-auto p-5 mt-5" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Your details are correct ....!!</p>
  <hr>
  <h4>Go to <a href="logged.php" class="btn btn-success"> Dashboard</a></h4>
  
</div>';
}
else
{
	
echo '<div class="alert alert-danger w-25 text-center mx-auto p-5 mt-5" role="alert">
  <h4 class="alert-heading">Oops....!</h4>
  <p>You have enterted wrong email and password</p>
  <hr>
  <a href="index.php" class="btn btn-danger">Login Again</a>
  <a href="sign_up.php" class="btn btn-danger">Create Account</a>
</div>';	
}
}
}
?>
 </body>
 </html>