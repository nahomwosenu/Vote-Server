<?php 
 $username=$password='';
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	$request=verify($_POST['request']);
 	if($request=='login'){
 		$username=verify($_POST['username']);
 		$password=verify($_POST['password']);
 		login($username,$password);
 	}
 }
 function login($username,$password){
 	$connect=mysqli_connect('localhost','root','','voting');
 	$query="select password from staff where username='$username'";
 	$result=mysqli_query($connect,$query);
 	if($row=mysqli_fetch_array($result)){
 		$hash=$row['password'];
 		if(password_verify($password,$hash))
 			die('true');
 		else die('false');
 	}
 	else die('false');
 }
 function verify($input){
 	$input=trim($input);
 	$input=htmlspecialchars($input);
 	$input=stripslashes($input);
 	return $input;
 }
?>