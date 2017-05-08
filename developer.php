<?php 
 include_once 'access.php';
 $request='';
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	if(!empty($_POST['request']))
 		$request=verify($_POST['request']);
 	else die('Error empty request');
 	
 	if($request=='list')
 		getList();
 	if($request=='vote'){
 		$type=$_POST['type'];
 		$id=$_POST['id'];
 		$mac=$_POST['mac'];
 		if(!getAccess($mac))
 			die("You have finished your 3 voting chances, Thank you. \nCSIT Team");
 		if($type=='stu_vote'){
 			addVote($mac);
 			stuVote($id);
 		}
 		else{ 
 		    addVote($mac);
 			staffVote($id);
 		}
 	}
 	else if($request=="unvote"){
 		$type=$_POST['type'];
 		$id=$_POST['id'];
 		$mac=$_POST['mac'];
 		if(!getAccess($mac))
 			die("You have finished your 3 unvoting chances too! \nCSIT team");
 		removeVote($mac);
        unvote($id,$type);
 	}
 }
  function verify($input){
 	$input=trim($input);
 	$input=htmlspecialchars($input);
 	$input=stripslashes($input);
 	return $input;
 }
 function getList(){
 	//Returns List of all developers with their id,firstname,lastname,title,stu_score & staff_scores 
 	//id,fn,ln,title,stu_vote,staff_vote
 	$connect=mysqli_connect('localhost','root','','voting');
 	$query1="select id,firstname,lastname from developer";
 	$result=mysqli_query($connect,$query1) or die('Error mysql syntax');
 	$data='';
 	$counter=0;
 	while($row=mysqli_fetch_array($result)){
 		$id=$row['id'];
 		$query2="select title from project where dev_id='$id'";
 		$query3="select stu_vote,staff_vote from score where dev_id='$id'";
 		$result1=mysqli_query($connect,$query2) or die('error mysql syntax');
 		$result2=mysqli_query($connect,$query3) or die('error mysql syntax');
 		$temp=$row['id'].','.$row['firstname'].','.$row['lastname'].',';
 		if($row2=mysqli_fetch_array($result1))
 			$temp=$temp.$row2['title'].',';
 		else $temp=$temp.$row2['no_title'].',';
 		if($row3=mysqli_fetch_array($result2))
 			$temp=$temp.$row3['stu_vote'].','.$row3['staff_vote'].';';
 		else $temp=$temp.'0'.','.'0'.';';
 		$data=$data.$temp;
 		$counter++;
 	}
 	die($counter.':'.$data);
 }
  function getStuVote($id){
  	$connect=mysqli_connect('localhost','root','','voting');
  	$query="select stu_vote from score where dev_id='$id'";
  	$result=mysqli_query($connect,$query);
  	$data='0';
  	if($row=mysqli_fetch_array($result)){
  		$data=$row['stu_vote'];
  		return $data;
  	}
  	return $data;
  }
  function getStaffVote($id){
  	$connect=mysqli_connect('localhost','root','','voting');
  	$query="select staff_vote from score where dev_id='$id'";
  	$result=mysqli_query($connect,$query);
  	$data='0';
  	if($row=mysqli_fetch_array($result)){
  		$data=$row['staff_vote'];
  		return $data;
  	}
  	return $data;
  }
  function stuVote($id){
     $connect=mysqli_connect('localhost','root','','voting');
     $current=getStuVote($id);
     $current=$current+1;
     $query="update score set stu_vote='$current' where dev_id='$id'";
     $result=mysqli_query($connect,$query) or die('error');
     if($result)
     	die('true');
     else die('false');
  }
  function staffVote($id){
    $connect=mysqli_connect('localhost','root','','voting');
     $current=getStaffVote($id);
     $current=$current+1;
     $query="update score set staff_vote='$current' where dev_id='$id'";
     $result=mysqli_query($connect,$query) or die('error');
     if($result)
     	die('true');
     else die('false');
  }
  function unvote($id,$type){
  	$connect=mysqli_connect('localhost','root','','voting');
  	$query='';
  	if($type=='student'){
       $current=getStuVote($id);
       if($current!=0)
       	$current--;
        $query="update score set stu_vote='$current' where dev_id='$id'";
       }
    else if($type=='staff'){
       $current=getStaffVote($id);
       if($current!=0)
       	$current--;
        $query="update score set staff_vote='$current' where dev_id='$id'";
    }
    $result=mysqli_query($connect,$query) or die('error');
    if($result)
    	die('true');
    else die('false');
  }
?>