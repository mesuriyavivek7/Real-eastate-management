<?php
  include 'componets/connect.php';


  if(isset($_COOKIE['user_id'])){
  	   $user_id=$_COOKIE['user_id'];
  }else{
  	$user_id='';
    header('location:login.php');
  }

$select_account=$conn->prepare("SELECT * FROM `users`  WHERE id=? LIMIT 1");
$select_account->execute([$user_id]);
$fetch_account = $select_account->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $number=$_POST['num'];

  if(!empty($name)){
    $update_name= $conn->prepare("UPDATE `users` SET name =? WHERE id=?");
    $update_name->execute([$name,$user_id]);
    $success_msg[]='your name updated!';
  }

  if(!empty($number)){
    $update_number= $conn->prepare("UPDATE `users` SET number =? WHERE id=?");
    $update_number->execute([$number,$user_id]);
    $success_msg[]='your number updated!';
  }

  if(!empty($email)){
    $verify_email=$conn->prepare("SELECT email FROM `users`  WHERE email=?");
    $verify_email->execute([$email]);
    if($verify_email->rowCount() > 0){
       $warning_msg[]='email alredy exist';
    }else{
       $update_email= $conn->prepare("UPDATE `users` SET email =? WHERE id=?");
       $update_email->execute([$email,$user_id]);
       $success_msg[]='your email updated!';
    }
   
  }
  $empty_pass='da39a3ee5e6b4b0d3255bfef95601890afd80709';
  $prev_pass=$fetch_account['password'];
  $old_pass=sha1($_POST['old_pass']);
  $new_pass=sha1($_POST['new_pass']);
  $c_pass=sha1($_POST['c_pass']);

  if($old_pass!=$empty_pass){
    if($old_pass != $prev_pass){
      $warning_msg[]='old password not matched!';
    }else if($c_pass!=$new_pass){
      $warning_msg[]='confirm password not matched!';
    }else{
       if($new_pass!=$empty_pass){
          $update_pass=$conn->prepare("UPDATE `users` SET password =? WHERE id=?");
          $update_pass->execute([$c_pass,$user_id]);
          $success_msg[]='your profile updated sucessfully';
       }else{
        $warning_msg[]='please enter your new password!';
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
	<title>profile update</title>
	<!-- fontawesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- custome css file link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- header section strat -->
    <?php include 'componets/user_header.php'; ?>
    <!-- header section end -->

<!-- update section start -->

  <section class="form-container">
      <form action="" method="POST">
          <h3>update your account</h3>
         <input type="text" name="name" maxlength="50" placeholder="<?= $fetch_account['name']; ?>" class="box">
         <input type="email" name="email" maxlength="50" placeholder="<?= $fetch_account['email']; ?>" class="box">
         <input type="number" name="num" min="0" max="9999999999" maxlength="10" placeholder="<?= $fetch_account['number']; ?>" class="box">
         <input type="password" name="old_pass"  maxlength="50" placeholder="enter your old password" class="box">
         <input type="password" name="new_pass"  maxlength="50" placeholder="enter your new passeord" class="box">
         <input type="password" name="c_pass"  maxlength="50" placeholder="confirm your new password" class="box">
         <input type="submit" value="update now" name="submit" class="btn">
      </form>
  </section>


<!-- update section end -->




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