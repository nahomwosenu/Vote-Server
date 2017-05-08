<?php 
 include_once 'access_list.php';
 if($_SERVER['REQUEST_METHOD']=='POST'){
  $request=$_POST['request'];
  $mac=$_POST['mac'];
  if($request=='access'){
    access($mac);
  }
 }
 function access($mac){
   if(exists($mac)){
     $vote=getVoteCount($mac);
     if($vote>=3){
      die("Access Denied: you have finished your 3 voting chances");
     }
     else{
      $chance=3-$vote;
      die("Info :-You vote ".$vote." times, you have now only ".$chance." chances");
     }
   }
   else {
      add($mac,'0');
      die("granted");
   }
 }
 function getAccess($mac){
   if(exists($mac)){
     $vote=getVoteCount($mac);
     if($vote>=3)
      return false;
     else return true;
 }
   else {
      return true;
   }
 }
 function addVote($mac){
   upvote($mac);
 }
 function removeVote($mac){
  downvote($mac);
 }
?>