<?php

	echo '
	<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        
                        <div class="pull-left info">
                            <h4>Hello, ';

                                //if($_SESSION['role'] == "Administrator"){                                  
                                    $user = $mysqli->query("SELECT * from tbladmin where id = '".$_SESSION['userid']."' "); 
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['accounttype'];
                                        echo $row['accounttype'];
                                    }
                                //}
                                
                                echo '
                            </h4>

                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">';
                        if($_SESSION['role'] == "Administrator"){
                            echo '
                                <p>
                                    <a href="../dashboard/dashboard.php?jenis=antrian">
                                        <i class="fa  fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                
                                <p>
                                    <a href="../dashboard/dashboard.php?jenis=panggilan">
                                        <i class="fa  fa-dashboard"></i> <span>Loket Poliklinik</span>
                                    </a>
                                

                                <p>
                                    <a href="../client/index.html" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Klien Antrian</span>
                                    </a>
                               
								
								 <p>
                                    <a href="../client/form_scan_qr.php" target="_blank">									
                                        <i class="fa  fa-dashboard"></i> <span>Konfirmasi Antrian</span>
                                    </a>
                                
								
								 <br>
                                    <hr />
                               
								
								 <P>
                                    <a href="../dashboard_pendaftaran/dashboard.php?jenis=antrian">
                                        <i class="fa  fa-dashboard"></i> <span>Dashboard Pendaftaran</span>
                                    </a>
                               
                                <P>
                                    <a href="../dashboard_pendaftaran/admin_loket2.php" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Loket Pendaftaran</span>
                                    </a>
                                
								
								 <br>
                                    <hr />                               
                                    <a href="../dashboard/dashboard.php?jenis=apotik">
                                        <i class="fa  fa-dashboard"></i> <span>Admin Apotik</span>
                                    </a>                               
                               
                                <P><P>
                                    <a href="../apotik/admin_panggilan_general_apotik.php" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Pemanggil Antrian Apotik</span>
                                    </a>
                               
								<br>
                                    <hr />
                               
                                <P>
                                    <a href="../loket/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Setting Poliklinik</span>
                                    </a>
                                

                                <P>
                                    <a href="../loket_pendaftaran/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Setting Loket</span>
                                    </a>
                               

                                <P>
                                    <a href="../banner/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Setting Teks</span>
                                    </a>
                              
								
								 <P>
                                    <a href="../info/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Info Antrian</span>
                                    </a>
                                
								
								<P>
                                    <a href="../rekam_medis/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Rekam Medis</span>
                                    </a>
									
								<P>
                                    <a href="../jaminan/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Jaminan Pembayaran</span>
                                    </a>
                                
								
								
																
                               

                               
								
								                   



                                <!--
                                <li>
                                    <a href="../backup/admin_panggilan_general_apotik.php">
                                        <i class="fa fa-database"></i> <span>Backup/Restore Database</span>
                                    </a>
                                </li>	
                                -->						
							';							
                        }
						
						if($_SESSION['role'] == "Apotik"){
                            echo '
                                
                                <li>                                   
                                    <a href="../dashboard/dashboard.php?jenis=apotik">
                                        <i class="fa  fa-dashboard"></i> <span>Admin Apotik</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="../apotik/admin_panggilan_general_apotik.php" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Pemanggil Antrian Apotik</span>
                                    </a>
                                </li>                              

				
							';							
                        }

                        if($_SESSION['role'] == "User"){
                            echo '
                                <li>
                                    <a href="../dashboard/dashboard.php">
                                        <i class="fa  fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                
                                                  
                            
                               						
							';							
                        }
						
						if($_SESSION['role'] == "Master"){
                            echo '
                                
								<li>
                                    <a href="../retrieve/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Retrieve Antiran</span>
                                    </a>
                                </li>
								
								<li>
                                    <a href="../retrieve_apotik/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Retrieve Antiran Apotik</span>
                                    </a>
                                </li>
                                
                                                  
                            
                               						
							';							
                        }
                        
                        echo'
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
	';
?>