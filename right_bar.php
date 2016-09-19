<?php
  if(!isset($_COOKIE['roll_no']))
  {
    header('Location: home.php');
  }
else
{
  include('data_connect.php');
  $type = array();
  $category = array();
  //getting all the type name in array..
  $que = "select name from type";
  $res = mysqli_query($db, $que);

  if(isset($res))
  {
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
    {
      array_push($type, $row['name']);
    }
  }

  //getting all the category name in array..
  $que = "select name from category";
  $res = mysqli_query($db, $que);

  if(isset($res))
  {
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
    {
      array_push($category, $row['name']);
    }
  }
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>right bar</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

      <style media="screen">
        div.main_right_bar{
          position: fixed;;
          right: 20px;
          top: 100px;
          width: 25%;
          /*border: 1px solid gray;*/
          height: 100%;
        }

        div.card{
          width: 95%;
          margin: auto;
          height: 100%;
        }

        div.type, div.category{
          display: inline;
          float: left;
          width: 46%;
          padding: 5px;
          margin: 5px;
        }
        h4.main_heading{
          padding: 6px;
          padding-top: 15px;
          padding-bottom: 0px;
          color: cadetblue;
          border-bottom: 3px solid cadetblue;
          display: table;
          border-radius: 6px;
        }
        h6.filter_heading{
          padding: 3px;
          margin-bottom: 15px;
          border-bottom: 1px solid cadetblue;
          color: cadetblue;
          display: table;
          font-weight: 600;
          font-size: 17px;
        }
      </style>

  </head>
  <body>

    <div class="main_right_bar">
      <div class="card">
        <center><h4 class="main_heading">Filter</h4></center>
        <!-- type div -->
        <form class="filter" action="home.php" method="POST">
          <div class="type">
            <h6 class="filter_heading">By Type</h6>
            <?php
              foreach ($type as $key => $value)
              {
             ?>
                <p>
                  <input type="checkbox" class="filled-in" id="<?php echo($value); ?>" name="<?php echo($value); ?>" value="<?php echo($value); ?>" <?php echo (isset($_POST[$value]))? 'checked="checked"' : ""; ?> />
                  <label for="<?php echo($value); ?>">
                    <?php echo($value); ?>
                  </label>
                </p>
            <?php
              }
             ?>
          </div>

          <!-- category div -->
          <div class="category">
            <h6 class="filter_heading">By Category</h6>
            <?php
              foreach ($category as $key => $value)
              {
             ?>
                <p>
                  <input type="checkbox" class="filled-in" id="<?php echo($value); ?>" name="<?php echo($value); ?>" value="<?php echo($value); ?>" <?php echo (isset($_POST[$value]))? 'checked="checked"' : ""; ?> />
                  <label for="<?php echo($value); ?>">
                    <?php echo($value); ?>
                  </label>
                </p>
            <?php
              }
             ?>
          </div>
          <!-- <input type="submit" name="filter" value="filter"> -->
          <button class="btn waves-effect waves-light" type="submit" style="width: 100%; margin-top: 15px;" name="filter" value="filter">Filter

          </button>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

  </body>
</html>
