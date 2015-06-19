<script type="text/javascript">
    $(document).ready(function(){
        $("#name").focus();

		var code	= $("#code").val();
		var FileUploader_uploadFile = new qq.FileUploader(
        {			
            'element':document.getElementById("lampiran"),
            'debug':false,
            'multiple':false,
            'action':'<?php echo base_url('index.php/agenda/upload'); ?>',
            'allowedExtensions':['pdf','doc','docx','pptx','ppt'],
            'sizeLimit':10485760,
            'minSizeLimit':100,
			'params' : {
				'code'  : code 
			},
            'onComplete':function(id, fileName, responseJSON){
                $('#lampirancontainer').append(
                    "<input type=\"hidden\" name=\"lampiran[]\" value=\""+responseJSON.idlampiran+"\" />" 
                 );
            }
        });
		
		
	
    });
</script>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Form Agenda</h3>
            </div>
            <div class="box-content nopadding">
                <?php echo form_open_multipart('agenda/simpan', array('class'=>'form-horizontal form-bordered','id'=>'form','name'=>'form')); ?>
                <!--
                <form name="form" id="form" class="form-horizontal form-bordered" enctype="multipart/form-data">
                -->
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kode Agenda</label>
                        <div class="controls">
                            <input type="text" name="code" id="code" placeholder="Kode.." class="input-medium" value="<?php echo $code; ?>" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Acara</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" placeholder="Acara..." class="input-large" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Keterangan</label>
                        <div class="controls">
                            <textarea name="desc" id="desc" rows="5" class="input-block-level"><?php echo $desc; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tgl Mulai</label>
                        <div class="controls">
                            <input type="text" name="mulai" id="mulai" class="input-medium datepick" value="<?php echo $mulai; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tgl Akhir</label>
                        <div class="controls">
                            <input type="text" name="akhir" id="akhir" class="input-medium datepick" value="<?php echo $akhir; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Lokasi</label>
                        <div class="controls">
                            <input type="text" name="lokasi" id="lokasi" placeholder="Lokasi..." class="input-xlarge" value="<?php echo $lokasi; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Mitra</label>
                        <div class="controls">
                            <div class="input-xlarge">
                                <select name="mitra" id="mitra" class="chosen-select" required="true">
                                    <?php
                                    if(empty($mitra)){
                                        ?>
                                        <option value="">-PILIH-</option>
                                    <?php
                                    }
                                    foreach($l_mitra->result() as $t){
                                        if($mitra==$t->mitra_code){
                                            ?>
                                            <option value="<?php echo $t->mitra_code;?>" selected="selected"><?php echo $t->mitra_code.' - '.$t->mitra_name;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $t->mitra_code;?>"><?php echo $t->mitra_code.' - '.$t->mitra_name;?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="control-group">
                        <label for="textfield" class="control-label">Upload File 1</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload" >
                                <div class="input-append">
                                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="userfile[]" id="file_1"/></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Upload File 2</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload" >
                                <div class="input-append">
                                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="userfile[]" id="file_2"/></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Upload File 3</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload" >
                                <div class="input-append">
                                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="userfile[]" id="file_3"/></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
					-->
                    <div class="control-group">
                        <label for="textfield" class="control-label">Upload File Lampiran </label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload" id="lampiran" >
                                <div class="input-append">
                                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="userfile[]" id="file_1"/></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            	</div>
                        	</div>
                            <div id="lampirancontainer"></div>
                        </div>
                    </div>
                    <?php if($this->uri->segment(2) == "edit")
					{
					?>
                    <div class="control-group">
                    	<div class="controls">
                    	<table class="table table-hover table-nomargin table-bordered" id="list-lampiran">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama File</th>
											<th class='hidden-350'>Tipe</th>
											<th class='hidden-1024'>Ukuran</th>
											<th class='hidden-480'>Aksi</th>
										</tr>
									</thead>
									<tbody>
                                    <?php 
									$i=1;
									foreach($l_lampiran as $lmp){
									?>
                                    	<tr>
                                        	<td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url() . 'uploads/' .$lmp['lampiran_nama'];?>"><?php echo $lmp['lampiran_nama']; ?></a></td>
                                            <td><?php echo $lmp['lampiran_ext']; ?></td>
                                            <td><?php echo $lmp['lampiran_size']; ?></td>
                                            <td><a href="#"
                                   onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn" rel="tooltip" title="Hapus">
                                    <i class="icon-remove"></i>
                                </a></td>
                                        </tr>
                                    <?php
									$i++;	
									}
									?>
                                    </tbody>
                       </table>
                       </div>
                    </div>
					<?php } ?>
                    <div class="form-actions">
                        <button type="submit"  id="simpan" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                        <button type="button" class="btn"><i class="icon-undo"></i> Batal</button>
                        <a href="<?php echo base_url();?>index.php/agenda">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
