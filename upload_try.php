<?php
     if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	    	// if($_POST['upload'] == 'upload')
	    	// {
				foreach ($_POST as $key => $value)
				{
					// echo ('<script>console.log("'.$key.'----'.$value.'");</script>');
					if(!isset($value))
					{
						die('<h2>Please enter '.$key.'</h2><a href="upload2.php"><h4>Go back.. </h4></a>');
					}
                    else
                    {
                        echo($key.' -- -- '.$value.'<br>');
                    }
				}
                echo('inside');
                echo($_POST['category']);
            }
            else
            echo('not submitted');
        // }
?>