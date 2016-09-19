<?php
if(isset($_COOKIE['roll_no']))
{
  include('data_connect.php');

  $que = "select * from all_info where roll_no = '".$_COOKIE['roll_no']."'";
  $res = mysqli_query($db, $que);

  $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    //setting session variable..
    foreach ($row as $key => $value) {
      if($key != 'old_pass' && $key != 'ip_address' && $key != 'date')
      {
        $_SESSION[$key] = $value;
        // echo('<script>alert("'.$value.'");</script>');
      }

    }

  mysqli_close($db);

} ?>

<html>
    <head>
        <title>Login Page</title>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified JavaScript -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script> -->
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="one_div.css">

    </head>
    <body>

       <?php include('header.php'); ?>

       <div class="main_log_in_back">
         <i class="Small material-icons prefix" id="close_icon" title="Close" onclick="close_login_div(this)">clear</i>
            <div class="row" id="main_login">
               <div class="col s12 m7">
               <div class="card">
                    <h1 class="heading_login">
                   Login:
                   </h1>
               <div class="row">
               <form class="col s12" name="login" action="login_sub.php" method="POST">
               <div class="row">
                   <div class="input-field col s12">
                   <i class="material-icons prefix">account_circle</i>
                   <input id="icon_prefix" type="text" class="validate" name="roll_no">
                   <label for="icon_prefix">Roll No.</label>
                   </div>
                   <div class="input-field col s12">
                   <i class="material-icons prefix">lock_outline</i>
                   <input id="icon_telephone" type="password" class="validate" name="password">
                   <label for="icon_telephone">Password</label>
                   </div>
               </div>
               <!--<input type="submit" class="waves-effect waves-light btn" id="login_button" value="Login" name"login" />-->

               <button onclick="submit" class="waves-effect waves-light btn" id="login_button" style="opacity: 1" name="login" value="Login">Login</button>
               </form>
               </div>
               </div>
           </div>
       </div>
       </div>

       <?php
         $liked = false;
         $total_like ;
           // to make a sorting in decending order
           echo('console.log("starts");');
           include('data_connect.php');
           $que = "";
           //this is used to filter the data..
           if($_SERVER['REQUEST_METHOD'] == 'POST')
           {
             if($_POST['filter'] == 'filter')
             {
               $que = "hello";
               //query to make an array to use in next step array ot type and category..
               $type2 = array();

               $category2 = array();

               //getting all the type name in array..
               $que1 = "select name from type";
               $res1 = mysqli_query($db, $que1);

               //getting all the category name in array..
               $que_c = "select name from category";
               $res_c = mysqli_query($db, $que_c);

               foreach ($_POST as $key => $value) {
                 // this is done for getting type...
                 if(isset($res1))
                  {
                    $res1 = mysqli_query($db, $que1);
                    while($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC))
                    {
                      if($value == $row1['name'])
                      {
                        array_push($type2, $value);
                        break;
                      }
                    }
                  }

                  // this is done for getting category...
                  if(isset($res_c))
                   {
                    $res_c = mysqli_query($db, $que_c);
                     while($row_c = mysqli_fetch_array($res_c, MYSQLI_ASSOC))
                     {
                       if($value == $row_c['name'])
                       {
                         array_push($category2, $value);
                         break;
                       }
                     }
                   }
               }

               $new_str = "";

               foreach ($type2 as $key => $value)
               {
                 foreach ($category2 as $key_c => $value_c)
                 {
                  //  to make a string like
                  // where (type = "audio" and category = "photo") or (type = "audio" and category = "song")...
                   $new_str = $new_str."(type='".$value."' and category='".$value_c."') or";
                 }
               }

                 //to remove the last "or" from the string..
                 $new_str = substr($new_str, 0, strlen($new_str)-2);

                 $que = "select * from upload_data where ".$new_str." order by date DESC";
                //  echo('<script>alert("'.$que.'");</script>');
             }
           }
           else
           {
             $que = "select * from upload_data order by date DESC";
           }
           echo('<script>alert("'.$que.'");</script>');
           $res = mysqli_query($db, $que);
           if(isset($res))
           {
             while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
             {
             if($row['liked_id'] == "")
             {
               $total_like = 0;
             }
             else
             {
               $liked_list = explode(',', $row['liked_id']);
               $total_like = count($liked_list);

             }

             if(isset($_COOKIE['roll_no']))
             {
               if($total_like != 0)
               {
                 foreach ($liked_list as $key => $value) {
                   if($value == $_COOKIE['roll_no'])
                   {
                     $liked = true;
                   }
                 }
               }
             }
             $type = $row['type'];
       ?>
       <script type="text/javascript">
         var total_l = <?php echo($total_like); ?>
       </script>
       <div class="card" id="main_one_div">
           <div class="card-image waves-effect waves-block waves-light">
           <?php
              if($type == 'photo')
              {
           ?>
           <img class="activator" src="<?php echo('./'.$row['file_url']); ?>" id="image_one_div">
            <?php
              }
              else if($type == 'video')
              {
           ?>
           <!--<embed src="<?php echo('./'.$row['file_url']); ?>" type="video">-->
           <video width="100%" height="350" style="padding-top: 5px;" controls>
              <source src="<?php echo('./'.$row['file_url']); ?>" type="video/mp4">
              <source src="<?php echo('./'.$row['file_url']); ?>" type="video/ogg">
            Your browser does not support the video tag.
            </video>
            <?php
              }
              else if($type == 'audio')
              {
           ?>
           <img src="audio/default.jpg" alt="audio" style="width: 100%; height: 350px; padding-top: 5px;">
           <audio style="width: 100%;" controls>
              <source src="<?php echo('./'.$row['file_url']); ?>" type="audio/ogg">
              <source src="<?php echo('./'.$row['file_url']); ?>" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio>
            <?php
             }
           ?>
           console.log('<?php echo($_COOKIE['roll_no']); ?>');
           </div>
           <div class="card-content">
           <span class="card-title activator grey-text text-darken-4" id="happ_name">
             <i class="material-icons prefix" style="color: cornflowerblue; margin: 5px 10px;" title="More">label</i>
             <a href="#"><?php echo($row['full_name']); ?></a><i class="material-icons right">more_vert</i>
             <span style="font-size: 12px; display: block; margin-left: 55px; margin-top: -16px;">Uploaded <?php echo($row['type'].'  '.time_calc($row['date'])) ; ?></span>
           </span>
             <div class="extra_content" style="margin-top: 10px; padding: 0px;">

               <?php include('like.php'); ?>

               <iframe src="like.php" width="700" height="100" style="position: fixed; left: 10px; top: 10px;" name="like_div">
                 Like
               </iframe>

               <span class="h app_content" style="width: 100px; cursor: pointer;">

                 <i class="material-icons">screen_share</i><span style="padding: 5px; position: relative; top: -5px; font-size: 15px" >000</span>
               </span>

               <span style="width: 100px; cursor: pointer;">Views 000</span>
               <!-- <span style="float: right;">other</span> -->

               <p><a href="#" style="float: right;margin-bottom: 0px; margin-top: -30px;">View More</a></p>
             </div>
           </div>
           <div class="card-reveal">
           <span class="card-title grey-text text-darken-4"><?php echo($row['title']); ?> :<i class="material-icons right">close</i></span>
           <br><br>
           <p><?php echo('<span style="color: cornflowerblue; font-size: 20px">Description: </span> '.$row['description']); ?></p>
           <br>

           <?php
           if(isset($row['subcategory']))
           {
              ?>
           <p><?php echo('<span style="color: cornflowerblue; font-size: 20px">Type : </span> '.$row['description']); ?></p>
           <?php
         }
            ?>
            <span style="position: absolute; bottom: 30px; right: 30px; color: cornflowerblue; cursor: pointer;">Download</span>
           </div>
       </div>
       </div>

       <?php
           }
         }
         mysqli_close($db);
         ?>

         <!-- <iframe src="right_bar.php" style="position: absolute; right: 20px; top: 100px; width: 25%; height: 100%; border: 0px"></iframe> -->

         <?php
          include('right_bar.php');
          include('footer.php');
       ?>
       <script type="text/javascript">
         function like_it(ele)
         {
           alert(ele);
          //  var col = document.querySelector('i#like');
           ele.style.color = "cornflowerblue";
          //  var show = document.querySelector('span#show_like');
           var show = ele.nextElementSibling;
           show.innerHTML = parseInt(show.innerHTML) + 1;
           ele.parentElement.submit();
          alert(ele.parentNode);
         }
       </script>

        <script type="text/javascript" src="login.js"></script>



    </body>
</html>
