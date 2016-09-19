<?php

//
// $liked = false;
// if($row['liked_id'] == "")
// {
//   $total_like = 0;
// }
// else
// {
//   $liked_list = explode(',', $row['liked_id']);
//   $total_like = count($liked_list);
//
// }

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['roll_no']))
    {
      // to check wether like exists for this id or not
      // if(isset($_COOKIE['roll_no']))
      // {
      //   if($total_like != 0)
      //   {
      //     foreach ($liked_list as $key => $value) {
      //       if($value == $_COOKIE['roll_no'])
      //       {
      //         $liked = true;
      //       }
      //     }
      //   }
      // }


      echo('<script>alert("Inside'.$_COOKIE['roll_no'].'");</script>');
      include('data_connect.php');
      $que = "select liked_id from upload_data where s_no='".$_POST['s_no']."'";
      $res = mysqli_query($db, $que);
      $liked_id = mysqli_fetch_array($res, MYSQLI_ASSOC);
      if($liked_id == "")
      {
        $liked_id = $_POST['roll_no'];
      }
      else
      {
        $liked_id = $liked_id . ', ' . $_POST['roll_no'];
      }
    }
    else
    {
      echo('<script>console.log("outside");</script>');
    }
  }
  else
  {
    echo('<script>console.log("not submitted");</script>');
  }

    ?>
     <!-- header('Location: home.php'); -->
    <span class="happ_content" style="width: 100px; cursor: pointer;">
      <form method="POST" action="like.php" class="<?php echo isset($row['s_no'])? 'form'.$row['s_no'] : '' ; ?>" target="like_div">
        <input type="text" name="roll_no" value="<?php echo (!isset($_COOKIE['roll_no']))? '' : $_COOKIE['roll_no']; ?>" hidden="true">
        <input type="text" name="s_no" value="<?php echo isset($row['s_no'])? $row['s_no'] : '' ; ?>" hidden="true">
        <i class="material-icons" id="like"
        <?php
        if(isset($_COOKIE['roll_no']))
         {
           if($liked == true)
           {
             echo('style="color: cornflowerblue;" title="You have Liked"');
           }
           else {
              $temp_s_no =  isset($row['s_no'])? 'form'.$row['s_no'] : '' ;
             echo('onclick="like_it(this)" ');
            //  , \''.$temp_s_no.'\'
             echo('style="color: gray;" title="Like"');
           }
         }
         else
         {
           echo('style="color: gray;" title="You must first login to Like"');
         }
         ?>>thumb_up</i> <span id="show_like" style="padding: 5px; position: relative; top: -5px; font-size: 15px"><?php echo($total_like); ?></span>
     </form>

    </span>
