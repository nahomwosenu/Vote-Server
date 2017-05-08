<?php 
  if($_SERVER['REQUEST_METHOD']=='POST'){
  	$type=$_POST['type'];
  	if($type=='student')
  		byStuVote();
  	else if($type=='staff')
  	    byStaffVote();
  }
 function byStuVote(){
   $connect=mysqli_connect('localhost','root','','voting');
   $query="select * from score order by stu_vote DESC";
   $result=mysqli_query($connect,$query) or die('error');
   $list="";
   $count=0;
   while($row=mysqli_fetch_array($result)){
   	$id=$row['dev_id'];
   	$query2="select firstname,lastname from developer where id='$id'";
   	$query3="select title from project where dev_id='$id'";
   	$result2=mysqli_query($connect,$query2) or die('error');
   	$result3=mysqli_query($connect,$query3) or die('error');
   	if($row2=mysqli_fetch_array($result2))
   		$list=$list.$id.','.$row2['firstname'].','.$row2['lastname'].',';

   	if($row3=mysqli_fetch_array($result3))
      $list=$list.$row3['title'].','.$row['stu_vote'].','.$row['staff_vote'].';';
   	$count++;
   }
   $list=$count.':'.$list;
   die($list);
 }
 function byStaffVote(){
    $connect=mysqli_connect('localhost','root','','voting');
   $query="select * from score order by staff_vote DESC";
   $result=mysqli_query($connect,$query) or die('error');
   $list="";
   $count=0;
   while($row=mysqli_fetch_array($result)){
   	$id=$row['dev_id'];
   	$query2="select firstname,lastname from developer where id='$id'";
   	$query3="select title from project where dev_id='$id'";
   	$result2=mysqli_query($connect,$query2) or die('error');
   	$result3=mysqli_query($connect,$query3) or die('error');
   	if($row2=mysqli_fetch_array($result2))
   		$list=$list.$id.','.$row2['firstname'].','.$row2['lastname'].',';
   	if($row3=mysqli_fetch_array($result3))
   		$list=$list.$row3['title'].','.$row['stu_vote'].','.$row['staff_vote'].';';
   	$count++;
   }
   $list=$count.':'.$list;
   die($list);
 }
?>