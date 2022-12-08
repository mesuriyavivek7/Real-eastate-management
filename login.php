<?php
  include 'componets/connect.php';


  if(isset($_COOKIE['user_id'])){
  	   $user_id=$_COOKIE['user_id'];
  }else{
  	$user_id='';
  }
  
  if(isset($_POST['submit'])){
    
    $email=$_POST['email'];
    $pass =sha1($_POST['pass']);
     
    $verify_user=$conn->prepare("SELECT * FROM `users` WHERE email=? AND password=? LIMIT 1");
    $verify_user->execute([$email,$pass]);
    $row=$verify_user->fetch(PDO::FETCH_ASSOC);
    if($verify_user->rowCount() > 0){
       setcookie('user_id',$row['id'],time() + 60*60*24*30,'/');
       header('location:home.php');
    }else{
      $warning_msg[]='incorrect email or password!';
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!-- fontawesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- custome css file link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- header section strat -->
    <?php include 'componets/user_header.php'; ?>
    <!-- header section end -->

  <!-- login section start -->
   <section class="form-container">
      <form action="" method="POST">
          <h3>welcome back!</h3>
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="password" name="pass" required maxlength="50" placeholder="enter your password" class="box">
         <p>don't have any account? <a href="register.php">register now</a></p>
         <input type="submit" value="login now" name="submit" class="btn">
      </form>
  </section>
  <!-- login section end -->




<!-- footer section start -->
 <?php include 'componets/footer.php'; ?>
<!-- footer section end -->
  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<!-- custome js file link -->
<script type="text/javascript" src="js/script.js"></script>

<?php  include 'componets/message.php'; ?>
</body>
</html>