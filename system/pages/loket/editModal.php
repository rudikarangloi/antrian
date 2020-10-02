
<!-- ========= CLASS MODAL ======== -->
<?php 

if($row['status'] == '1'){
	$chek_aktif = 'selected';	
	$chek_non_aktif = '';
}else{
	$chek_aktif = '';
	$chek_non_aktif = 'selected';
}


echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Poli</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Nomor </label>
                    <input name="txt_nomor"  id="txt_nomor" class="form-control input-sm" type="text" value="'.$row['client'].'" />
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" value="'.$row['description'].'" />
                </div>
                <div class="form-group">
                    <label>Kode Layanan</label>
                     <input name="txt_kelamin" id="txt_kelamin" class="form-control input-sm" type="text" value="'.$row['kode_layanan'].'" />
                </div>	
				
				 <div class="form-group">
                    <label>Kode Poli</label>
                     <input name="kdpoli" id="kdpoli" class="form-control input-sm" type="text" value="'.$row['kdpoli'].'" />
                </div>	
				
				 <div class="form-group">
                    <label>Kuota Online</label>
                     <input name="kuota_hp" id="kuota_hp" class="form-control input-sm" type="text" value="'.$row['kuota_hp'].'" />
                </div>
				
				<div class="form-group">
                    <label>Dokter</label>
                     <input name="dokter" id="dokter" class="form-control input-sm" type="text" value="'.$row['dokter'].'" />
                </div>

				<div class="form-group">
                    <label>Status </label><br/>					
					
					<select class="form-control" name="status" id="status">						
						<option '.$chek_aktif.'     value="1">Aktif</option>
						<option '.$chek_non_aktif.' value="0">Non Aktif</option>						
					</select>
					
					

                    
                </div>				
			
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