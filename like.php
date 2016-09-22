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


      // echo('<script>alert("Inside'.$_COOKIE['roll_no'].'");</script>');
      include('data_connect.php');
      $que = "select liked_id from upload_data where s_no='".$_POST['s_no']."'";
      $res = mysqli_query($db, $que);
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      $liked_id = $row['liked_id'];
      if($liked_id == "")
      {
        $liked_id = $_POST['roll_no'];
      }
      else
      {
        echo('<script>console.log("'.$liked_id.'");</script>');
        $liked_id = $liked_id . ', ' . (string)$_POST['roll_no'];
        echo('<script>console.log("'.$liked_id.'");</script>');
      }

      $que = "update upload_data set liked_id='".$liked_id."' where s_no='".$_POST['s_no']."'";
      mysqli_query($db, $que);

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
