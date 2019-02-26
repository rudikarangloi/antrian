
<?php
	if(isset($_POST['btn_delete']))
	{
	    if(isset($_POST['chk_delete']))
	    {
	        foreach($_POST['chk_delete'] as $value)
	        {
	            //$delete_query = mysqli_query($con,"DELETE from qr_code where cid = '$value' ") or die('Error: ' . mysqli_error($con));
	            $delete_query = $mysqli->query("DELETE from retrieve where id = '$value' ");         
	            if($delete_query == true)
	            {
	                $_SESSION['delete'] = 1;
	                header("location: ".$_SERVER['REQUEST_URI']);
	            }
	        }
	    }
	}
?>