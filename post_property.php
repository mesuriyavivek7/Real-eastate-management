<?php
  include 'componets/connect.php';


  if(isset($_COOKIE['user_id'])){
       $user_id=$_COOKIE['user_id'];
  }else{
    $user_id='';
    header('location:login.php');
  }

  if(isset($_POST['post'])){
      $property_id=creat_unique_id();
      $property_name=$_POST['property_name'];
      $property_price=$_POST['price'];
      $property_deposite=$_POST['deposite'];
      $property_adress=$_POST['property_adress'];
      $offer=$_POST['offer'];
      $type=$_POST['type'];
      $status=$_POST['status'];
      $furnished_status=$_POST['furnished'];
      $bhk=$_POST['bhk'];
      $bedrooms=$_POST['bedroom'];
      $bathrooms=$_POST['bathroom'];
      $balcony=$_POST['balcony'];
      $carpet=$_POST['carpet'];
      $age=$_POST['age'];
      $total_floors=$_POST['total_floor'];
      $room_floors=$_POST['room_floor'];
      $description=$_POST['description'];


      if(isset($_POST['lift'])){
        $lift=$_POST['lift'];
      }else{
        $lift='no';
      }

      if(isset($_POST['security_guard'])){
        $security_guard=$_POST['security_guard'];
      }else{
        $security_guard='no';
      }

      if(isset($_POST['play_ground'])){
        $play_ground=$_POST['play_ground'];
      }else{
        $play_ground='no';
      }

      if(isset($_POST['water_supply'])){
        $water_supply=$_POST['water_supply'];
      }else{
        $water_supply='no';
      }

      if(isset($_POST['garden'])){
        $garden=$_POST['garden'];
      }else{
        $garden='no';
      }

      if(isset($_POST['power_backup'])){
        $power_backup=$_POST['power_backup'];
      }else{
        $power_backup='no';
      }

      if(isset($_POST['parking_area'])){
        $parking_area=$_POST['parking_area'];
      }else{
        $parking_area='no';
      }

      if(isset($_POST['gym'])){
        $gym=$_POST['gym'];
      }else{
        $gym='no';
      }

      if(isset($_POST['shopping_mall'])){
        $shopping_mall=$_POST['shopping_mall'];
      }else{
        $shopping_mall='no';
      }


      if(isset($_POST['hospital'])){
        $hospital=$_POST['hospital'];
      }else{
        $hospital='no';
      }


      if(isset($_POST['school'])){
        $school=$_POST['school'];
      }else{
        $school='no';
      }

      if(isset($_POST['market_area'])){
        $market_area=$_POST['market_area'];
      }else{
        $market_area='no';
      }

      $image_01 =$_FILES['image_01']['name'];
      $image_01_ext=pathinfo($image_01,PATHINFO_EXTENSION);
      $rename_image_01= creat_unique_id().'.'.$image_01_ext;
      $image_01_size=$_FILES['image_01']['size'];
      $image_01_tmp_name=$_FILES['image_01']['tmp_name'];
      $image_01_folder= 'uploaded_files/'.$rename_image_01;

      

      $image_02 =$_FILES['image_02']['name'];
      $image_02_ext=pathinfo($image_02,PATHINFO_EXTENSION);
      $rename_image_02= creat_unique_id().'.'.$image_02_ext;
      $image_02_size=$_FILES['image_02']['size'];
      $image_02_tmp_name=$_FILES['image_02']['tmp_name'];
      $image_02_folder= 'uploaded_files/'.$rename_image_02;

      if(!empty($image_02)){
        if($image_02_size > 2000000){
           $warning_msg[]='image size is too large!';
        }else{
          move_uploaded_file($image_02_tmp_name,$image_02_folder);
        }
      }else{
        $rename_image_02='';
      }
      

      $image_03 =$_FILES['image_03']['name'];
      $image_03_ext=pathinfo($image_03,PATHINFO_EXTENSION);
      $rename_image_03= creat_unique_id().'.'.$image_03_ext;
      $image_03_size=$_FILES['image_03']['size'];
      $image_03_tmp_name=$_FILES['image_03']['tmp_name'];
      $image_03_folder= 'uploaded_files/'.$rename_image_03;


      if(!empty($image_03)){
        if($image_03_size > 2000000){
           $warning_msg[]='image size is too large!';
        }else{
          move_uploaded_file($image_03_tmp_name,$image_03_folder);
        }
      }else{
        $rename_image_03='';
      }

      $image_04 =$_FILES['image_04']['name'];
      $image_04_ext=pathinfo($image_04,PATHINFO_EXTENSION);
      $rename_image_04= creat_unique_id().'.'.$image_04_ext;
      $image_04_size=$_FILES['image_04']['size'];
      $image_04_tmp_name=$_FILES['image_04']['tmp_name'];
      $image_04_folder= 'uploaded_files/'.$rename_image_04;

      
      if(!empty($image_04)){
        if($image_04_size > 2000000){
           $warning_msg[]='image size is too large!';
        }else{
          move_uploaded_file($image_04_tmp_name,$image_04_folder);
        }
      }else{
        $rename_image_04='';
      }

      $image_05 =$_FILES['image_05']['name'];
      $image_05_ext=pathinfo($image_05,PATHINFO_EXTENSION);
      $rename_image_05= creat_unique_id().'.'.$image_05_ext;
      $image_05_size=$_FILES['image_05']['size'];
      $image_05_tmp_name=$_FILES['image_05']['tmp_name'];
      $image_05_folder= 'uploaded_files/'.$rename_image_05;

      
      if(!empty($image_05)){
        if($image_05_size > 2000000){
           $warning_msg[]='image size is too large!';
        }else{
          move_uploaded_file($image_05_tmp_name,$image_05_folder);
        }
      }else{
        $rename_image_05='';
      }


      if($image_01_size > 2000000){
         $warning_msg[]='image size is too large!';
      }else{
        $post_property=$conn->prepare("INSERT INTO `property`(id,user_id,property_name,adress, price ,type, offer, statufurnished, bhk, deposite, bedroom, bathroom, balcony, carpet, age, total_floors, room_floors, loan , lifsecurity_guard,play_ground,garden, water_supply, power_backup, parking_area,gym, shopping_mall,hospital, schoolmarket_area, image_01,image_02,image_03,image_04, image_05, description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)  ");
        $post_property->execute([$id,$user_id,$property_name,$property_adress,$property_price,$type,$offer,$statusfurnished_status,$bhk,$property_deposite,$bedrooms,$bathrooms,$balcony,$carpet,$age,$total_floors,$room_floors,$loa,$lift,$security_guard,$play_ground,$garden,$water_supply,$power_backup,$parking_area,$gym,$shopping_mall,$hospitalschool,$market_area,$rename_image_01,$rename_image_02,$rename_image_03,$rename_image_04,$rename_image_05,$descripti]);
        move_uploaded_file($image_01_tmp_name,$image_01_folder);
        $success_msg[]='sucessfully property information posted!';
      }
    

  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>post property</title>
  <!-- fontawesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- custome css file link -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <!-- header section strat -->
    <?php include 'componets/user_header.php'; ?>
   <!-- header section end -->

<!-- post property section start -->
 <section class="property-from">
   <form method="post" enctype="multipart/form-data">
    <h3>property details</h3>

     <div class="box">
      <p>property name <span>*</span></p>
      <input type="text" name="property_name" class="input" maxlength="50" required placeholder="enter property name">
     </div>

     <div class="flex">
      <div class="box">
        <p>property price <span>*</span></p>
          <input type="number" name="price" class="input" maxlength="10" min="0" max="9999999999" required placeholder="enter property price">
      </div>
      <div class="box">
        <p>deposite amount <span>*</span></p>
          <input type="number" name="deposite" class="input" maxlength="10" min="0" max="9999999999" required placeholder="enter deposite amount">
      </div>
      <div class="box">
           <p>property adress <span>*</span></p>
           <input type="text" name="property_adress" class="input" maxlength="100" required placeholder="enter property adress">
       </div>
        <div class="box">
           <p>offer type <span>*</span></p>
           <select name="offer" class="input" required>
            <option value="sale">sale</option>
            <option value="resale">resale</option>
            <option value="rent">rent</option>
           </select>
        </div>
        <div class="box">
           <p>property type <span>*</span></p>
           <select name="type" class="input" required>
            <option value="flate">flate</option>
            <option value="house">house</option>
            <option value="shop">shop</option>
           </select>
        </div>
        <div class="box">
           <p>property status <span>*</span></p>
           <select name="status" class="input" required>
            <option value="redy to move">redy to move</option>
            <option value="under construction">under construction</option>
           </select>
        </div>
        <div class="box">
           <p>furnished status <span>*</span></p>
           <select name="furnished" class="input" required>
            <option value="furnished">furnished</option>
            <option value="semi-furnished">semi-furnished</option>
            <option value="unfurnished">unfurnished</option>
           </select>
        </div>
        <div class="box">
           <p>BHK<span>*</span></p>
           <select name="bhk" class="input" required>
                <option value="1">1 BHK</option>
                <option value="2">2 bhk</option>
                <option value="3">3 BHK</option>
                <option value="4">4 BHK</option>
                <option value="5">5 BHK</option>
                <option value="6">6 BHK</option>
                <option value="7">7 BHK</option>
                <option value="8">8 BHK</option>
           </select>
        </div>

        <div class="box">
           <p>no of bedrooms<span>*</span></p>
           <select name="bedroom" class="input" required>
                <option value="1">1 bedrooms</option>
                <option value="2">2 bedrooms</option>
                <option value="3">3 bedrooms</option>
                <option value="4">4 bedrooms</option>
                <option value="5">5 bedrooms</option>
                <option value="6">6 bedrooms</option>
                <option value="7">7 bedrooms</option>
                <option value="8">8 bedrooms</option>
           </select>
        </div>

        <div class="box">
           <p>no of bathrooms<span>*</span></p>
           <select name="bathroom" class="input" required>
                <option value="1">1 bathrooms</option>
                <option value="2">2 bathrooms</option>
                <option value="3">3 bathrooms</option>
                <option value="4">4 bathrooms</option>
                <option value="5">5 bathrooms</option>
                <option value="6">6 bathrooms</option>
                <option value="7">7 bathrooms</option>
                <option value="8">8 bathrooms</option>
           </select>
        </div>
 
          <div class="box">
           <p>no of balconys<span>*</span></p>
           <select name="balcony" class="input" required>
                <option value="0">0 balconys</option>
                <option value="1">1 balconys</option>
                <option value="2">2 balconys</option>
                <option value="3">3 balconys</option>
                <option value="4">4 balconys</option>
                <option value="5">5 balconys</option>
                <option value="6">6 balconys</option>
                <option value="7">7 balconys</option>
                <option value="8">8 balconys</option>
           </select>
        </div>
 
      <div class="box">
        <p>carpet area (sqft) <span>*</span></p>
          <input type="number" name="carpet" class="input" maxlength="10" min="0" max="9999999999" required placeholder="how may sqarefits">
      </div>
        
      <div class="box">
        <p>property age <span>*</span></p>
          <input type="number" name="age" class="input" maxlength="2" min="0" max="99" required placeholder="how old is property">
      </div> 

      <div class="box">
        <p>total floors <span>*</span></p>
          <input type="number" name="total_floor" class="input" maxlength="2" min="0" max="99" required placeholder="total no of floors">
      </div> 

      <div class="box">
        <p>room floors <span>*</span></p>
          <input type="number" name="room_floor" class="input" maxlength="2" min="0" max="99" required placeholder="property floor number">
      </div> 

       <div class="box">
           <p>loan <span>*</span></p>
           <select name="loan" class="input" required>
            <option value="available">available</option>
            <option value="not available">not available</option>
           </select>
       </div>
 
        <div class="box">
           <p>property description <span>*</span></p>
           <textarea class="input" name="description" cols="30" rows="10" maxlength="10000" placeholder="enter property description.."></textarea>
       </div>

     </div>
     <div class="checkbox">
        <div class="box">
           <p><input type="checkbox" name="lift" value="yes" />lifts</p>
           <p><input type="checkbox" name="security_guard" value="yes" />security guard</p>
           <p><input type="checkbox" name="play_ground" value="yes" />play ground</p>
           <p><input type="checkbox" name="garden" value="yes" />garden</p>
           <p><input type="checkbox" name="water_supply" value="yes" />water supply</p>
           <p><input type="checkbox" name="power_backup" value="yes" />power backup</p>
        </div>

         <div class="box">
           <p><input type="checkbox" name="parking_area" value="yes" />parking area</p>
           <p><input type="checkbox" name="gym" value="yes" />gym</p>
           <p><input type="checkbox" name="shopping_mall" value="yes" />shopping mall</p>
           <p><input type="checkbox" name="hospital" value="yes" />hospital</p>
           <p><input type="checkbox" name="school" value="yes" />school</p>
           <p><input type="checkbox" name="market_area" value="yes" />market area</p>
        </div>
     </div>

     <div class="box">
       <p>image 01 <span>*</span></p>
       <input type="file" name="image_01" required class="input" accept="image/*" required>
     </div>
    <div class="flex">
       <div class="box">
          <p>image 02 </p>
          <input type="file" name="image_02" class="input" accept="image/*">
       </div>
       <div class="box">
          <p>image 03</p>
          <input type="file" name="image_03" class="input" accept="image/*">
       </div>
       <div class="box">
          <p>image 04 </p>
          <input type="file" name="image_04" class="input" accept="image/*">
       </div>
       <div class="box">
          <p>image 05 </p>
          <input type="file" name="image_05" class="input" accept="image/*">
       </div>
    </div>
     <input type="submit" value="post property" name="post" class="btn">
   </form>
 </section>
<!-- post property section end -->




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