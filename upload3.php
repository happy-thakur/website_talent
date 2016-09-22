<?php
  if(isset($_SERVER['REQUEST_METHOD']) == 'POST')
  {
    if($_POST['upload'] == 'upload')
    {
      foreach ($_POST as $key => $value) {
        echo('<br />'.$key.'========'.$value);
      }
    }
  }
  else
  {
    echo('not submitted');
  }
 ?>
