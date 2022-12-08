<?php
  include 'componets/connect.php';


  if(isset($_COOKIE['user_id'])){
  	   $user_id=$_COOKIE['user_id'];
  }else{
  	$user_id='';
  }
 
  if(isset($_POST['submit'])){
    $id=creat_unique_id();
    $name=$_POST['name'];
    $num=$_POST['num'];
    $email=$_POST['email'];
    $pass = sha1($_POST['pass']);
    $c_pass=sha1($_POST['c_pass']);

    $select_email= $conn->prepare("SELECT  * FROM `users` WHERE email=?");
    $select_email->execute([$email]);
    
    if($select_email->rowCount() > 0){
      $warning_msg[] = 'email alredy taken!';
    }else{
    //  $success_msg[]= 'its working!';
      if($pass != $c_pass){
        $warning_msg[]="password not matched";
      }else{
        $insert_user= $conn->prepare("INSERT INTO `users`(id,name,number,email,password) VALUES(?,?,?,?,?)  ");
        $insert_user->execute([$id,$name,$num,$email,$c_pass]);

        if($insert_user){
          $verify_user=$conn->prepare("SELECT * FROM `users` WHERE email = ? AND password= ? LIMIT 1");
          $verify_user->execute([$email,$c_pass]);
          $row=$verify_user->fetch(PDO::FETCH_ASSOC);
          if($verify_user->rowCount() > 0){
            setcookie('user_id',$row['id'],time() + 60*60*24*30,'/');
            header('location:home.php');
          }else{
            $error_msg[]='something went wrong';
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>register</title>
	<!-- fontawesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- custome css file link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- header section strat -->
    <?php include 'componets/user_header.php'; ?>
    <!-- header section end -->




<!-- register section start -->

  <section class="form-container">
      <form action="" method="POST">
          <h3>creat an account</h3>
         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="num" required min="0" max="9999999999" maxlength="10" placeholder="enter your mobile number" class="box">
         <input type="password" name="pass" required maxlength="50" placeholder="enter your password" class="box">
         <input type="password" name="c_pass" required maxlength="50" placeholder="confirm your password" class="box">
         <p>alredy have an account? <a href="login.php">login now</a></p>
         <input type="submit" value="register now" name="submit" class="btn">
      </form>
  </section>
<!-- register section end -->





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