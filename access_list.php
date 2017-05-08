<?php 
 function exists($mac){
   $connect=mysqli_connect('localhost','root','','voting');
   $query="select mac from access_list where mac='$mac'";
   $result=mysqli_query($connect,$query) or die('error');
   if($row=mysqli_fetch_array($result))
      return true;
   else return false; 
 }
 function getVoteCount($mac){
    $connect=mysqli_connect('localhost','root','','voting');
    $query="select vote_count from access_list where mac='$mac'";
    $result=mysqli_query($connect,$query);
    if($row=mysqli_fetch_array($result)){
    	$data=$row['vote_count'];
    	return $data;
    }
    else return 0;
 }
 function upvote($mac){
    $connect=mysqli_connect('localhost','root','','voting');
    $current=getVoteCount($mac);
    $current++;
    $query="update access_list set vote_count='$current' where mac='$mac'";
    $result=mysqli_query($connect,$query) or die("Error");
    if($result)
    	return true;
    else return false;
 }
 function downvote($mac){
  $connect=mysqli_connect('localhost','root','','voting');
    $current=getVoteCount($mac);
    if($current>0)
    $current--;
    $query="update access_list set vote_count='$current' where mac='$mac'";
    $result=mysqli_query($connect,$result) or die("Error");
    if($result)
    	return true;
    else return false; 
 }
 function add($mac,$vote){
 	$connect=mysqli_connect('localhost','root','','voting');
 	$query="insert into access_list(mac,vote_count) values ('$mac','$vote')";
 	$result=mysqli_query($connect,$query) or die('error');
 	if($result)
 		return true;
 	else return false;
 }
?>