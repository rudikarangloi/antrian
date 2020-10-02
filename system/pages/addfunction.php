<!-- =========  ADD SCHOOLYEAR  ============== -->
<?php
	if(isset($_POST['btn_add_sy'])){
		$txt_sy = $_POST['txt_sy'];

		$query = mysqli_query($con,"INSERT INTO tblschoolyear (schoolyear) values ('".$txt_sy."')"); 
		if($query == true){
            $_SESSION['added'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
		if(mysqli_error($con)){
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>


<!-- =========  ADD YEARLEVEL  ============== -->
<?php
	if(isset($_POST['btn_add_yl'])){
		$ddl_yl = $_POST['ddl_yl'];
		$txt_desc = $_POST['txt_desc'];

		$chk = mysqli_query($con,"SELECT * from tblyearlevel where yearlevel = '$ddl_yl' and description = '$txt_desc' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblyearlevel (yearlevel,description) values ('".$ddl_yl."','".$txt_desc."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>


<!-- =========  ADD SUBJECT  ============== -->
<?php
	if(isset($_POST['btn_add_subj'])){
		$txt_sname = $_POST['txt_sname'];
		$txt_desc = $_POST['txt_desc'];
		$ddl_yl = $_POST['ddl_yl'];

		$chk = mysqli_query($con,"SELECT * from tblsubjects where subjectname = '".$txt_sname."' and description = '".$txt_desc."' and yearlevelid = '$ddl_yl' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblsubjects (subjectname,description,yearlevelid) values ('".$txt_sname."','".$txt_desc."','".$ddl_yl."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>


<!-- =========  ADD STUDENT  ============== -->
<?php
	if(isset($_POST['btn_add_stud'])){
		$txt_fname = $_POST['txt_fname'];
		$txt_mname = $_POST['txt_mname'];
		$txt_lname = $_POST['txt_lname'];
		$txt_contact = $_POST['txt_contact'];
		$txt_addr = $_POST['txt_addr'];
		$txt_uname = $_POST['txt_uname'];
		$txt_pass = $_POST['txt_pass'];

		$chk = mysqli_query($con,"SELECT * from tblstudent where lname = '".$txt_lname."' and fname = '".$txt_fname."' and mname = '".$txt_mname."' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblstudent (lname,fname,mname,contact,address,username,password) values ('".$txt_lname."','".$txt_fname."','".$txt_mname."','".$txt_contact."','".$txt_addr."','".$txt_uname."','".$txt_pass."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>


<!-- =========  ADD CLASS  ============== -->
<?php
	if(isset($_POST['btn_add_class'])){
		$txt_class = $_POST['txt_class'];
		$ddl_sy = $_POST['ddl_sy'];
		$ddl_yl = $_POST['ddl_yl'];

		$chk = mysqli_query($con,"SELECT * from tblclass where classname = '".$txt_class."' and schoolyearid = '$ddl_sy' and yearlevelid = '$ddl_yl' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblclass (classname,schoolyearid,yearlevelid) values ('".$txt_class."','".$ddl_sy."','".$ddl_yl."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>

<!-- =========  ADD POLI  ============== -->
<?php
	if(isset($_POST['btn_add_qr'])){
	    	$txt_nomor   = $_POST['txt_nomor'];
	    	$txt_nama    = $_POST['txt_nama'];
	    	$txt_kelamin = $_POST['txt_kelamin'];	
			$kdpoli      = $_POST['kdpoli'];
			$kuota_hp    = $_POST['kuota_hp'];			
		
		$chk = $mysqli->query("SELECT * from client_antrian where client = '".$txt_nomor."'"); 
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = $mysqli->query("INSERT INTO client_antrian (client,description,kode_layanan,kdpoli,Kuota_hp) 
								values ('".$txt_nomor."','".$txt_nama."','".$txt_kelamin."','".$kdpoli."','".$kuota_hp."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>

<!-- =========  ADD LOKET  ============== -->
<?php
	if(isset($_POST['btn_add_loket'])){
	    	$txt_nomor   = $_POST['txt_nomor'];
	    	$txt_nama    = $_POST['txt_nama'];
	    	$txt_kelamin = $_POST['txt_kelamin'];	
		
		$chk = $mysqli->query("SELECT * from loket_antrian where client = '".$txt_nomor."'"); 
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = $mysqli->query("INSERT INTO loket_antrian (client,description,kode_layanan) 
								values ('".$txt_nomor."','".$txt_nama."','".$txt_kelamin."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>

<!-- =========  ADD BANNER  ============== -->
<?php
	if(isset($_POST['btn_add_banner'])){
	    	$txt_nomor   = $_POST['txt_nomor'];
	    	$txt_nama    = $_POST['txt_nama'];
	    	$txt_kelamin = $_POST['txt_kelamin'];	
		
		$chk = $mysqli->query("SELECT * from tblbanner where banner = '".$txt_nomor."'"); 
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = $mysqli->query("INSERT INTO tblbanner (banner,keterangan,status) 
								values ('".$txt_nomor."','".$txt_nama."','".$txt_kelamin."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>


<!-- =========  ADD INFO  ============== -->
<?php
	if(isset($_POST['btn_add_info'])){
	    	$txt_nomor   = $_POST['txt_nomor'];
	    	$txt_nama    = $_POST['txt_nama'];
	    
		
		$chk = $mysqli->query("SELECT * from info where informasi = '".$txt_nomor."'"); 
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = $mysqli->query("INSERT INTO info (informasi,keterangan) 
								values ('".$txt_nomor."','".$txt_nama."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>
<!-- =========  ADD retrieve  ============== -->
<?php
	if(isset($_POST['btn_add_retrieve'])){
	    	$txt_nomor   = $_POST['txt_nomor'];
	    	$txt_nama    = $_POST['txt_nama'];
	    	$txt_kelamin = '1';	
		
		$chk = $mysqli->query("SELECT * from retrieve where nomor = '".$txt_nomor."'"); 
		$ct = mysqli_num_rows($chk);

		//if($ct == 0){
			$query = $mysqli->query("INSERT INTO retrieve (nomor,keterangan,status,waktu) 
								values ('".$txt_nomor."','".$txt_nama."','".$txt_kelamin."','". date("Y-m-d H:i:s") ."')"); 
								
			$sql_retrieve = "UPDATE data_antrian SET STATUS=2 WHERE STATUS=3 AND nomor < ".$txt_nomor." AND DATE(waktu) = CURDATE() ";
			$query = $mysqli->query($sql_retrieve);
			
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		
		/*}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
		*/
	}
?>


<!-- =========  ADD retrieve Apotik  ============== -->
<?php
	if(isset($_POST['btn_add_retrieve_apotik'])){
	    	$txt_nomor   = $_POST['txt_nomor'];
	    	$txt_nama    = $_POST['txt_nama'];
	    	$txt_kelamin = '1';	
		
		$chk = $mysqli->query("SELECT * from retrieve_apotik where nomor = '".$txt_nomor."'"); 
		$ct = mysqli_num_rows($chk);

		//if($ct == 0){
			$query = $mysqli->query("INSERT INTO retrieve_apotik (nomor,keterangan,status,waktu) 
								values ('".$txt_nomor."','".$txt_nama."','".$txt_kelamin."','". date("Y-m-d H:i:s") ."')"); 
								
			$sql_retrieve = "UPDATE data_antrian_apotik SET STATUS=2 WHERE STATUS=3 AND nomor < ".$txt_nomor." AND DATE(waktu) = CURDATE() ";
			$query = $mysqli->query($sql_retrieve);
			
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		/*
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
		*/
	}
?>


<!-- =========  ADD STUDENT CLASS  ============== -->
<?php
	if(isset($_POST['btn_add_studclass'])){
		$ddl_class = $_POST['ddl_class'];
		$ddl_stud = $_POST['ddl_stud'];
		$ddl_subj = $_POST['ddl_subj'];

		$chk = mysqli_query($con,"SELECT * from tblstudentclass where classid = '$ddl_class' and studentid = '$ddl_stud' and subjectid = '$ddl_subj' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblstudentclass (classid,studentid,subjectid) values ('".$ddl_class."','".$ddl_stud."','".$ddl_subj."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>


<!-- =========  ADD TEACHER  ============== -->
<?php
	if(isset($_POST['btn_add_teacher'])){
		$txt_fname = $_POST['txt_fname'];
		$txt_mname = $_POST['txt_mname'];
		$txt_lname = $_POST['txt_lname'];
		$txt_contact = $_POST['txt_contact'];
		$txt_addr = $_POST['txt_addr'];
		$txt_uname = $_POST['txt_uname'];
		$txt_pass = $_POST['txt_pass'];

		$chk = mysqli_query($con,"SELECT * from tblteacher where lname = '".$txt_lname."' and fname = '".$txt_fname."' and mname = '".$txt_mname."' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblteacher (lname,fname,mname,contact,address,username,password) values ('".$txt_lname."','".$txt_fname."','".$txt_mname."','".$txt_contact."','".$txt_addr."','".$txt_uname."','".$txt_pass."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>




<!-- =========  ADD TEACHER ADVISORY  ============== -->
<?php
	if(isset($_POST['btn_add_adv'])){
		$ddl_teacher = $_POST['ddl_teacher'];
		$ddl_class = $_POST['ddl_class'];
		$ddl_subj = $_POST['ddl_subj'];

		$chk = mysqli_query($con,"SELECT * from tblteacheradvisory where teacherid = '$ddl_teacher' and classid = '$ddl_class' and subjectid = '$ddl_subj' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($con,"INSERT INTO tblteacheradvisory (teacherid,classid,subjectid) values ('".$ddl_teacher."','".$ddl_class."','".$ddl_subj."')"); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>




<!-- =========  ADD STUDENT GRADE  ============== -->
<?php
	if(isset($_POST['btn_add_studgrade'])){
		$ddl_sy = $_POST['ddl_sy'];
		$ddl_class = $_POST['ddl_class'];
		$ddl_stud = $_POST['ddl_stud'];
		$ddl_subj = $_POST['ddl_subj'];
		$txt_1stgrading = $_POST['txt_1stgrading'];

		$chk = mysqli_query($con,"SELECT * from tblstudentgrade where studentid = '$ddl_stud' and classid = '$ddl_class' and schoolyearid = '$ddl_sy' and subjectid = '$ddl_subj' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0)
		{
		$query = mysqli_query($con,"INSERT INTO tblstudentgrade (studentid,schoolyearid,subjectid,classid,adviserid,1stgrading) values ('".$ddl_stud."','".$ddl_sy."','".$ddl_subj."','".$ddl_class."','".$_SESSION['userid']."','".$txt_1stgrading."')") or die(mysqli_error($con)); 
			if($query == true){
	            $_SESSION['added'] = 1;
	            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>