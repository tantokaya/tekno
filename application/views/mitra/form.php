<script type="text/javascript">
    $(document).ready(function(){
        $("#name").focus();


        $("#simpan").click(function(){
            var code	= $("#code").val();
            var name	= $("#name").val();

            var string = $("#form").serialize();

            if(code.length==0){
                $("#code").focus();
                return false();
            }
            if(name.length==0){
                $("#name").focus();
                return false();
            }

            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/mitra/simpan",
                data	: string,
                cache	: false,
                success	: function(data){
                    window.location.href = "<?php echo site_url(); ?>/mitra";
                }
            });
            return false();
        });

    });
</script>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Form MITRA</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered'>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kode MITRA</label>
                        <div class="controls">
                            <input type="text" name="code" id="code" placeholder="Kode.." class="input-large" value="<?php echo $code; ?>" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">STKK</label>
                        <div class="controls">
                            <div class="input-xlarge">
                                <select name="stkk" id="stkk" class="chosen-select" required="true">
                                    <?php
                                    if(empty($stkk)){
                                        ?>
                                        <option value="">-PILIH-</option>
                                    <?php
                                    }
                                    foreach($l_stkk->result() as $t){
                                        if($stkk==$t->stkk_code){
                                            ?>
                                            <option value="<?php echo $t->stkk_code;?>" selected="selected"><?php echo $t->stkk_code.' - '.$t->stkk_name;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $t->stkk_code;?>"><?php echo $t->stkk_code.' - '.$t->stkk_name;?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama MITRA</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" placeholder="Nama..." class="input-xxlarge" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Alamat</label>
                        <div class="controls">
                            <textarea name="addr" id="addr" rows="5" class="input-block-level"><?php echo $addr; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Telp</label>
                        <div class="controls">
                            <input type="text" name="telp" id="telp" placeholder="Telp..." class="input-large" value="<?php echo $telp; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="email" id="email" placeholder="Email..." class="input-large" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Keterangan</label>
                        <div class="controls">
                            <textarea name="desc" id="desc" rows="5" class="input-block-level"><?php echo $desc; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Contact Person</label>
                        <div class="controls">
                            <input type="text" name="cp" id="cp" placeholder="Contact Person..." class="input-xxlarge" value="<?php echo $cp; ?>">
                        </div>
                    </div>


                    <div class="form-actions">
                        <button type="button"  id="simpan" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                        <button type="button" class="btn"><i class="icon-undo"></i> Batal</button>
                        <a href="<?php echo base_url();?>index.php/mitra">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
