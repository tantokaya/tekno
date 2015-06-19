<script type="text/javascript">
    $(document).ready(function(){
        $("#code").autocomplete({
            source: function(request,response) {
                $.ajax({
                    url: "<?php echo site_url('ref_json/ListWbs'); ?>",
                    data: { id: $("#code").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data){
                        response(data);
                    }
                });
            },
        });

        $("#code").keyup(function(e){
            var isi = $(e.target).val();
            $(e.target).val(isi.toUpperCase());
            CariDataWbs();
        });

        function CariDataWbs(){
            var kode = $("#code").val()
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/ref_json/InfoWbs",
                data	: "code="+kode,
                cache	: false,
                dataType : "json",
                success	: function(data){
                    $("#leader").val(data.nm_leader);
                    $("#name").val(data.wbs_name);
                    $("#desc").val(data.wbs_desc);
                }
            });
        }


        $("#simpan").click(function(){
            var code	= $("#code").val();
            var name	= $("#name").val();
            var desc	= $("#desc").val();

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
                url		: "<?php echo site_url(); ?>/wbs/simpan",
                data	: string,
                cache	: false,
                success	: function(data){
                    window.location.href = "<?php echo site_url(); ?>/wbs";
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
                <h3><i class="icon-th-list"></i> Form WBS</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered'>
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
                                            <option value="<?php echo $t->stkk_code;?>" selected="selected"><?php echo $t->stkk_name;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $t->stkk_code;?>"><?php echo $t->stkk_name;?></option>
                                        <?php }
                                    } ?>
                                </select></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kode WBS</label>
                        <div class="controls">
                            <input type="text" name="code" id="code" placeholder="Kode.." class="input-medium" value="<?php echo $code; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama GL / Leader</label>
                        <div class="controls">
                            <input type="text" name="leader" id="leader" placeholder=".." class="input-xxlarge" value="<?php echo $leader; ?>" >
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama WBS</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" placeholder="Nama..." class="input-xxlarge" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Keterangan</label>
                        <div class="controls">
                            <textarea name="desc" id="desc" rows="5" class="input-block-level"><?php echo $desc; ?></textarea>
                        </div>
                    </div>


                    <div class="form-actions">
                        <button type="button"  id="simpan" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                        <button type="button" class="btn"><i class="icon-undo"></i> Batal</button>
                        <a href="<?php echo base_url();?>index.php/wbs">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
