
<!-- ========= CLASS MODAL ======== -->
<?php 
if($row['aproove_rm'] == '1'){
	$chek_rm_aktif = 'selected';
	$chek_rm_non_aktif = '';
}else{	
	$chek_rm_aktif = '';
	$chek_rm_non_aktif = 'selected';
}
if($row['approve_poli'] == '1'){
	$chek_poli_aktif = 'selected';
	$chek_poli_non_aktif = '';
}else{	
	$chek_poli_aktif = '';
	$chek_poli_non_aktif = 'selected';
}
echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Cetak RM</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Nomor RM </label>
                    <input name="txt_nomor" readonly id="txt_nomor" class="form-control input-sm" type="text" value="'.$row['no_rm'].'" />
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input name="txt_nama" readonly id="txt_nama" class="form-control input-sm" type="text" value="'.$row['nama'].'" />
                </div>
				
				<!--
                <div class="form-group">
                    <label>Alamat</label>
                     <input name="txt_kelamin" id="txt_kelamin" class="form-control input-sm" type="text" value="'.$row['alamat'].'" />
                </div>	
				
				 <div class="form-group">
                    <label>Poliklinik</label>
                     <input name="kdpoli" id="kdpoli" class="form-control input-sm" type="text" value="'.$row['PoliklinikName'].'" />
                </div>	
				
				 <div class="form-group">
                    <label>NIK</label>
                     <input name="kuota_hp" id="kuota_hp" class="form-control input-sm" type="text" value="'.$row['nik'].'" />
                </div>	
				-->
				
				<div class="form-group">
                    <label>Status diterima Rekam Medis </label><br/>	
					<select class="form-control" name="status_rm" id="status_rm">						
						<option '.$chek_rm_aktif.'     value="1">Terima</option>
						<option '.$chek_rm_non_aktif.' value="0">Belum diterima</option>						
					</select>
				<div class="form-group">
                    <label>Status diterima Poli </label><br/>	
					<select class="form-control" name="status_poli" id="status_poli">						
						<option '.$chek_poli_aktif.'     value="1">Terima</option>
						<option '.$chek_poli_non_aktif.' value="0">Belum diterima</option>						
					</select>
			
            </div>
        </div>
        </div>
        <div class="modal-footer">
		
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
		
        </div>
    </div>
  </div>
</form>
</div>';?>