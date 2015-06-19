<script type="text/javascript">
    $(document).ready(function(){
         var code	= $("#code").val();
         var FileUploader_uploadFile = new qq.FileUploader(
            {
                'element':document.getElementById("lampiran"),
                'debug':false,
                'multiple':false,
                'action':'<?php echo base_url('index.php/dokumen/upload'); ?>',
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
                <h3><i class="icon-th-list"></i> Form Dokumen</h3>
            </div>
            <div class="box-content nopadding">
                <?php echo form_open_multipart('dokumen/simpan', array('class'=>'form-horizontal form-bordered','id'=>'form','name'=>'form')); ?>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kode Dokumen</label>
                        <div class="controls">
                            <input type="text" name="code" id="code" placeholder="Kode.." class="input-medium" value="<?php echo $code; ?>" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Judul</label>
                        <div class="controls">
                            <input type="text" name="judul" id="judul" placeholder="Judul..." class="input-xxlarge" value="<?php echo $judul; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Deskripsi</label>
                        <div class="controls">
                            <textarea name="desc" id="desc" rows="5" class="input-block-level"><?php echo $desc; ?></textarea>
                        </div>
                    </div>
		    <div class="control-group">
                    <label for="textfield" class="control-label">Status Dokumen</label>
                    <div class="controls">
                        <div class="input-small"><select name="status" id="status" class="chosen-select" required="true">
                                <?php
                                if(empty($status)){
                                    ?>
                                    <option value="">-PILIH-</option>
                                <?php
                                }
                                foreach($l_status->result() as $t){
                                    if($status==$t->code_status){
                                        ?>
                                        <option value="<?php echo $t->code_status;?>" selected="selected"><?php echo $t->nm_status;?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $t->code_status;?>"><?php echo $t->nm_status;?></option>
                                    <?php }
                                } ?>
                            </select></div>
                    </div>
                    </div>

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
                                            <td><a href="#" id="<?php echo $lmp['lampiran_id']; ?>" class="hapus btn" rel="tooltip" title="Hapus">
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
                        <script type="application/javascript">
                            $(function(){
                                $(".hapus").click(function(event){
                                    event.preventDefault();
                                    if(confirm("Apakah anda ingin menghapus data ini?")){
                                        var lampid = $(this).attr("id");
                                        var parent = $(this).parent().parent();
                                        //console.log(lampid + "\n" + parent);
                                        $.ajax({
                                            type    :   "post",
                                            url     :   "<?php echo base_url(); ?>index.php/dokumen/delete_lampiran",
                                            cache   :   false,
                                            data    :   "lampiran_id=" + lampid,
                                            success :   function(response){
                                                try{
                                                    if(response=='true'){
                                                        parent.slideUp('slow', function() {$(this).remove();});
                                                    }
                                                } catch(e) {
                                                    alert("error hapus data lampiran..");
                                                }
                                            },
                                            error : function(){
                                                alert("error hapus");
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                    <?php } ?>
                    <div class="form-actions">
                        <button type="submit"  id="simpan" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                        <button type="button" class="btn"><i class="icon-undo"></i> Batal</button>
                        <a href="<?php echo base_url();?>index.php/dokumen">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
