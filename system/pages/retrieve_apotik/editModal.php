
<!-- ========= CLASS MODAL ======== -->
<?php 
echo '<div id="editModal'.$row['id'].'" class="modal fade">
        <form method="post">
        <div class="modal-dialog modal-sm" style="width:300px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Data Retrieve Apotik</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                        <div class="form-group">
                            <label>Nomor antrian </label>
                            <input name="txt_nomor" id="txt_nomor" class="form-control input-sm" type="number" value="'.$row['nomor'].'" />
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input name="txt_nama" id="txt_nama" class="form-control input-sm" type="text" value="'.$row['keterangan'].'" />
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
    </div>';
?>