<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Form Tambah Topik</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered'  enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/topik/simpan" method="post">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Judul</label>
                        <div class="controls">
                            <input type="hidden" name="code" id="code" class="input-large" value="<?php echo $code; ?>">
                            <input type="text" name="title" id="title" placeholder="Judul.." class="input-large" value="<?php echo $title; ?>" autofocus="true">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kategori</label>
                        <div class="controls">
                            <div class="input-xlarge">
                                <select name="kategori" id="kategori" class="chosen-select" required="true">
                                    <option value="">-PILIH-</option>
                                    <option value="perkenalan">Selamat datang dan Perkenalan</option>
                                    <option value="pengumuman">Pengumuman</option>
                                    <option value="saran">Saran Untuk Forum</option>
                                    <option value="pojok">Pojok Komunitas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Topik</label>
                        <div class="controls">
                            <textarea name="ck" id="ck" class='ckeditor' rows="5"><?php echo $ck; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Upload Image</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name='userfile' value="<?php echo $foto; ?>" /></span>
                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
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
