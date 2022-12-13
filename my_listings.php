<?php
  include 'componets/connect.php';


  if(isset($_COOKIE['user_id'])){
  	   $user_id=$_COOKIE['user_id'];
  }else{
  	$user_id='';
    header('location:login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home </title>
	<!-- fontawesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- custome css file link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- header section strat -->
    <?php include 'componets/user_header.php'; ?>
    <!-- header section end -->

   <!-----my listing section start----->

      <section class="my-listings">
        <h1 class="heading">my listings</h1>

        <div class="box-container">

        <?php
          $select_listsing=$conn->prepare("SELECT * FROM `property` WHERE user_id = ? ORDER BY date DESC");
          $select_listsing->execute([$user_id]);
          if($select_listsing->rowCount() > 0){
             while($fetch_listing =$select_listsing->fetch(PDO::FETCH_ASSOC)){
               $listing_id=$fetch_listing['id'];
               
               if(!empty($fetch_listing['image_02'])){
                  $image_02=1;
               }else{
                 $image_02=0;
               }
               if(!empty($fetch_listing['image_03'])){
                $image_03=1;
               }else{
               $image_03=0;
               }
               if(!empty($fetch_listing['image_04'])){
                $image_04=1;
               }else{
                $image_04=0;
               }
               if(!empty($fetch_listing['image_05'])){
                $image_05=1;
               }else{
               $image_05=0;
               }
               $total_images=(1+$image_02+$image_03+$image_04+$image_05);
        ?>
        <form action=""  method="post" class="box">
           <input type="hidden" name="property_id" value="<?= $listing_id?>">
           <div class="thumb">
             <p><i class="fas fa-image"></i><span><?= $total_images; ?></span></p>
             <img src="uploaded_files/<?= $fetch_listing['image_01']; ?>" alt="">
           </div>
           <p class="price"><i class="fas fa-indian-rupee-sign"></i><?= $fetch_listing['price']; ?>/-</p>
           <h3 class="name"><?= $fetch_listing['property_name'];  ?></h3>
           <p class="adress"><i class="fas fa-map-marker-alt"></i><?= $fetch_listing['adress']; ?></p>
            <div class="flex-btn">
               <a href="update_property.php?get_id=<?= $listing_id; ?>" class="btn">update</a>
               <input type="submit" name="delete" value="delete" class="btn" onclick="return confirm('delete this listing?')">
            </div>
            <a href="view_property.php?get_id=<?= $listing_id; ?>" class="btn">view property</a>
        </form>

         <?php
             }
            }else{
                echo '<p class="empty">no listings found!</p>';
            }
         ?>


        </div>

      </section>
   <!----my listing section end-------->




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