<!DOCTYPE html>
<html>

    <?php
    include('../head_css.php'); 
    extract($_GET);
    ?>
  
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php         
          include "../apps/mysql_connect.php";
          include "../header.php";
		  
		  if(!isset($_GET['jenis'])){
			$jenis='antrian'  ;
		  }
        ?>
      

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <!-- <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>                    
                </section> -->

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <?php 
                            if($jenis=='antrian'){
                                //include('list_loket.php'); 
                                include('admin.php'); 
                            }
                            elseif($jenis=='panggilan'){
                                include('admin_panggilan.php');                             
                            }else{
                                include('../apotik/admin_apotik.php'); 
                            }
                            
                        ?>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; 
        ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>