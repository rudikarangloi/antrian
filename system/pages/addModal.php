<!-- ========================= SCHOOLYEAR MODAL ======================= -->
<!--
<div id="addSYModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add School Year</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>School Year:</label>
                        <input required name="txt_sy" id="txt_sy" class="form-control input-sm" type="text" placeholder="eg. 2016-2017" />
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add" name="btn_add_sy" value="Add School Year"/>
        </div>
    </div>
  </div>
  </form>
</div>

-->

<!-- ========================= YEARLEVEL MODAL ======================= -->
<!--
<div id="addYLModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Year Level</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Year Level:</label>
                        <select name="ddl_yl" class="form-control input-sm">
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                            <option>4th</option>
                            <option>5th</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input required name="txt_desc" id="txt_desc" class="form-control input-sm" type="text" placeholder="Description" />
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add" name="btn_add_yl" value="Add Year Level"/>
        </div>
    </div>
  </div>
  </form>
</div>
-->


<!-- ========================= SUBJECT MODAL ======================= -->
<!--
<div id="addSubjModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Subject</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Subject Name:</label>
                        <input required name="txt_sname" id="txt_sname" class="form-control input-sm" type="text" placeholder="Subject Name" />
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input required name="txt_desc" id="txt_desc" class="form-control input-sm" type="text" placeholder="Description" />
                    </div>
                    <div class="form-group">
                        <label>Year Level:</label>
                        <select name="ddl_yl" id="ddl_yl" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Year Level --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblyearlevel");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['yearlevel'].' - '.$row['description'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add" name="btn_add_subj" value="Add Year Level"/>
        </div>
    </div>
  </div>
  </form>
</div>

-->

<!-- ========================= STUDENT MODAL ======================= -->
<!--
<div id="addStudModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Student</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>First Name:</label>
                        <input required name="txt_fname" id="txt_fname" class="form-control input-sm" type="text" placeholder="First Name" />
                    </div>
                    <div class="form-group">
                        <label>Middle Name:</label>
                        <input required name="txt_mname" id="txt_mname" class="form-control input-sm" type="text" placeholder="Middle Name" />
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input required name="txt_lname" id="txt_lname" class="form-control input-sm" type="text" placeholder="Last Name" />
                    </div>
                    <div class="form-group">
                        <label>Contact:</label>
                        <input required name="txt_contact" id="txt_contact" class="form-control input-sm" type="number" placeholder="Contact" />
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input required name="txt_addr" id="txt_addr" class="form-control input-sm" type="text" placeholder="Address" />
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input required name="txt_uname" id="txt_uname" class="form-control input-sm" type="text" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input required name="txt_pass" id="txt_pass" class="form-control input-sm" type="password" placeholder="Password" />
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_stud" name="btn_add_stud" value="Add Student"/>
        </div>
    </div>
  </div>
  </form>
</div>

-->

<!-- ========================= CLASS MODAL ======================= -->
<!--
<div id="addClassModal" class="modal fade">
	<form method="post">
		  <div class="modal-dialog modal-sm" style="width:300px !important;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add Class</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Class Name:</label>
								<input required name="txt_class" id="txt_class" class="form-control input-sm" type="text" placeholder="Class Name" />
							</div>
							<div class="form-group">
								<label>School Year:</label>
								<select name="ddl_sy" id="ddl_sy" data-style="btn-primary" class="form-control input-sm">
									<option selected disabled>-- Select Year Level --</option>
									<?php
										$q = mysqli_query($con,"SELECT * from tblschoolyear");
										while($row=mysqli_fetch_array($q)){
											echo '<option value="'.$row['id'].'">'.$row['schoolyear'].'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Year Level:</label>
								<select name="ddl_yl" id="ddl_yl" data-style="btn-primary" class="form-control input-sm">
									<option selected disabled>-- Select Year Level --</option>
									<?php
										$q = mysqli_query($con,"SELECT * from tblyearlevel");
										while($row=mysqli_fetch_array($q)){
											echo '<option value="'.$row['id'].'">'.$row['yearlevel'].' - '.$row['description'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
					<input type="submit" class="btn btn-primary btn-sm" id="btn_add_class" name="btn_add_class" value="Add Class"/>
				</div>
			</div>
		  </div>
  </form>
</div>

-->

<!-- ========================= POLI MODAL ======================= -->
<div id="addQrModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Poli</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nomor</label>
                        <input required name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="text" placeholder="Nomor" />
                    </div>
					
					<div class="form-group">
                        <label>Nama</label>
                        <input required name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" placeholder="Nama Loket" />
                    </div>
					
                   <div class="form-group">
                        <label>Kode Layanan</label>
                        <input required name="txt_kelamin" id="txt_kelamin" class="form-control input-sm" type="text" placeholder="Kode" />
                    </div>
					
					 <div class="form-group">
                        <label>Kode Poli</label>
                        <input required name="kdpoli" id="kdpoli" class="form-control input-sm" type="text" placeholder="Kode" />
                    </div>
					
					<div class="form-group">
                        <label>Kode HP</label>
                        <input required name="kuota_hp" id="kuota_hp" class="form-control input-sm" type="text" placeholder="Kuota hp" />
                    </div>
					
					
                  
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_qr" name="btn_add_qr" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!-- ========================= BANNER ======================= -->
<div id="addBannerModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Banner</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Teks:</label>
                        <input required name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="text" placeholder="Teks" />
                    </div>
					
					<div class="form-group">
                        <label>Keterangan:</label>
                        <input required name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" placeholder="Keterangan" />
                    </div>
					
                   <div class="form-group">
                        <label>Status:</label>
                        <input required name="txt_kelamin" id="txt_kelamin" class="form-control input-sm" type="text" placeholder="Status" />
                    </div>
					
					
                  
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_banner" name="btn_add_banner" value="Tambah"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!-- ========================= INFO ======================= -->
<div id="addInfoModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Informasi</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Teks:</label>
                        <input required name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="text" placeholder="Isi Informasi" />
                    </div>
					
					<div class="form-group">
                        <label>Keterangan:</label>
                        <input required name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" placeholder="Keterangan" />
                    </div>
					
                 					
                  
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_info" name="btn_add_info" value="Tambah"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!-- ========================= RETRIEVE ======================= -->
<div id="addRetrieveModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nomor:</label>
                        <input required name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="number" placeholder="Nomor" />
                    </div>
					
					<div class="form-group">
                        <label>Keterangan:</label>
                        <input required name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" placeholder="Keterangan" />
                    </div>
					
                 				
					
                  
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_retrieve" name="btn_add_retrieve" value="Tambah"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!-- ========================= RETRIEVE APOTIK======================= -->
<div id="addRetrieveApotikModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nomor:</label>
                        <input required name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="number" placeholder="Nomor" />
                    </div>
					
					<div class="form-group">
                        <label>Keterangan:</label>
                        <input required name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" placeholder="Keterangan" />
                    </div>
					
                 				
					
                  
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_retrieve_apotik" name="btn_add_retrieve_apotik" value="Tambah"/>
        </div>
    </div>
  </div>
  </form>
</div>


<!-- ========================= LOKET MODAL ======================= -->
<div id="addLoketModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Loket</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nomor:</label>
                        <input required name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="text" placeholder="Nomor" />
                    </div>
					
					<div class="form-group">
                        <label>Nama Loket:</label>
                        <input required name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" placeholder="Nama Loket" />
                    </div>
					
                   <div class="form-group">
                        <label>Kode:</label>
                        <input required name="txt_kelamin" id="txt_kelamin" class="form-control input-sm" type="text" placeholder="Kode" />
                    </div>
					
					
                  
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_loket" name="btn_add_loket" value="Add Class"/>
        </div>
    </div>
  </div>
  </form>
</div>



<!-- ========================= STUDENT CLASS MODAL ======================= -->
<!--
<div id="addStudClassModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Student Class</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Class:</label>
                        <select name="ddl_class" id="ddl_class" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Class --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblclass");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['classname'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Student:</label>
                        <select name="ddl_stud" id="ddl_stud" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Student --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblstudent");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subject:</label>
                        <select name="ddl_subj" id="ddl_subj" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Subject --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblsubjects");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['subjectname'].' - '.$row['description'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_studclass" name="btn_add_studclass" value="Add Student Class"/>
        </div>
    </div>
  </div>
  </form>
</div>
-->



<!-- ========================= TEACHER MODAL ======================= -->
<!--
<div id="addTeacherModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Teacher</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>First Name:</label>
                        <input required name="txt_fname" id="txt_fname" class="form-control input-sm" type="text" placeholder="First Name" />
                    </div>
                    <div class="form-group">
                        <label>Middle Name:</label>
                        <input required name="txt_mname" id="txt_mname" class="form-control input-sm" type="text" placeholder="Middle Name" />
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input required name="txt_lname" id="txt_lname" class="form-control input-sm" type="text" placeholder="Last Name" />
                    </div>
                    <div class="form-group">
                        <label>Contact:</label>
                        <input required name="txt_contact" id="txt_contact" class="form-control input-sm" type="number" placeholder="Contact" />
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input required name="txt_addr" id="txt_addr" class="form-control input-sm" type="text" placeholder="Address" />
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input required name="txt_uname" id="txt_uname" class="form-control input-sm" type="text" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input required name="txt_pass" id="txt_pass" class="form-control input-sm" type="password" placeholder="Password" />
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_teacher" name="btn_add_teacher" value="Add Teacher"/>
        </div>
    </div>
  </div>
  </form>
</div>
-->


<!-- ========================= TEACHER ADVISORY MODAL ======================= -->
<!--
<div id="addAdvModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Advisory</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Teacher:</label>
                        <select name="ddl_teacher" id="ddl_teacher" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Teacher --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblteacher");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class:</label>
                        <select name="ddl_class" id="ddl_class" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Class --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblclass");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['classname'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subject:</label>
                        <select name="ddl_subj" id="ddl_subj" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Subject --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblsubjects");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['subjectname'].' - '.$row['description'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_adv" name="btn_add_adv" value="Add Advisory"/>
        </div>
    </div>
  </div>
  </form>
</div>

-->



<!-- ========================= STUDENT GRADE MODAL ======================= -->
<!--
<div id="addStudGradeModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Student Grade</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" >
                        <label>School Year:</label>
                        <select name="ddl_sy" id="ddl_sy" data-style="btn-primary" class="form-control input-sm" onchange="show_class()">
                            <option selected disabled>-- Select School Year --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblschoolyear");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="1">'.$row['schoolyear'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class:</label>
                        <select name="ddl_class" id="ddl_class" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select School Year First --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subject:</label>
                        <select name="ddl_subj" id="ddl_subj" data-style="btn-primary" class="form-control input-sm">
                            <option selected disabled>-- Select Subject --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblsubjects");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['subjectname'].' - '.$row['description'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_adv" name="btn_add_adv" value="Add Advisory"/>
        </div>
    </div>
  </div>
  </form>
</div>
-->

