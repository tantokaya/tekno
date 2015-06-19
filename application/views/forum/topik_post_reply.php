<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Form Reply Post</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered'  action="<?php echo base_url(); ?>index.php/topik/simpan_reply" method="post">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Judul</label>
                        <div class="controls">
                            <input type="hidden" name="code" id="code" class="input-xlarge" value="<?php echo $code; ?>">
                            <input type="text" name="title" id="title" placeholder="Judul.." class="input-large" value="<?php echo $title; ?>" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Reply Post</label>
                        <div class="controls">
                            <textarea name="post" id="ck" class='ckeditor' rows="5"><?php echo $post; ?></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit"  id="simpan" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                        <button type="button" class="btn"><i class="icon-undo"></i> Batal</button>
                        <a href="<?php echo base_url();?>index.php/topik">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
