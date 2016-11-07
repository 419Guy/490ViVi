<?php
include('session.php');
?>
<!DOCTYPE  html>
<html>
<head>
<meta  content='text/html;  charset=UTF-8'  http-equiv='Content-Type'/>
<link  rel="stylesheet"  type="text/css"  href="css/style2.css"  />
<title><?php echo $loggedin_session; ?>'s Profile Page</title>
</head>
<body>
<header>
<nav>
<ul>
<li><a href= "postlogin.php">Return to search</a></li>
<li><a  href="logout.php">Sign  Out</a></li>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<h1  align='center'>Welcome  <?php  echo  $loggedin_session;  ?>!</h1>
<!--<p  align='center'>  You  are  now  logged  in.  You  can  logout  by  clicking  on  signout  link  given  below.</p>-->
<div  id="contentbox">
<?php
include('db.php');
$sql="SELECT  *  FROM  register  where id=$loggedin_id";
$result=mysqli_query($db,$sql);
?>
<?php
while($rows=mysqli_fetch_array($result)){
?>
<div  id="signup">
<div  id="signup-st">
<form  action=""  method="POST"  id="signin"  id="reg">
<div  id="reg-head"  class="headrg">Your  Profile</div>
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Name:</div></td>
<td  class="tl-4"><?php  echo  $rows['firstname'];  ?>  <?php  echo  $rows['lastname'];  ?></td>
</tr>
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Email:</div></td>
<td  class="tl-4"><?php  echo  $rows['email'];  ?></td>
</tr>
</table>
<?php
}
mysqli_close($db);

?>

<!--<div  id="reg-bottom"  class="btmrg">Copyright  &copy;  2015  7topics.com</div>-->
</form>
</div>
</div>
<div  id="login">
<div  id="login-st">
<?php
include('db.php');
$search_sql = "select * from search_table where id = '$loggedin_id'";
$result2=mysqli_query($db,$search_sql);
?>

<div  id="search-head" class="searchrg">Search History</div>
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
<?php

        while($rows=mysqli_fetch_array($result2)){
?>
<tr  id="sg-1">
<td  class="tl-4"><?php  echo  $rows['search'];?></td></tr>

<?php
};
?>

</table>

        
<!--<div  id="st"><a  href="logout.php"  id="st-btn">Sign  Out</a></div>-->
<!--<div  id="st"><a  href="deleteac.php"  id="st-btn">Delete  Account</a></div>-->
</div>
</div>

</div>
</div>
</div>
<?php
//close connection
mysqli_close($db);
?>
<div  id="footer">
<!--<p>Copyright  &copy;  2014-2015  7topics.com</p>-->
</div>
</body>
</html>
