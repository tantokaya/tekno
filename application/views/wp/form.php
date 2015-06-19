<script type="text/javascript">
    $(document).ready(function(){
        $("#code").autocomplete({
            source: function(request,response) {
                $.ajax({
                    url: "<?php echo site_url('ref_json/ListWp'); ?>",
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
//            CariDataWp();
        });

<!--        function CariDataWp(){-->
<!--            var kode = $("#code").val()-->
<!--            $.ajax({-->
<!--                type	: 'POST',-->
<!--                url		: "--><?php //echo site_url(); ?><!--/ref_json/InfoWp",-->
<!--                data	: "code="+kode,-->
<!--                cache	: false,-->
<!--                dataType : "json",-->
<!--                success	: function(data){-->
<!--                    $("#leader").val(data.nm_leader);-->
<!--                    $("#name").val(data.wp_name);-->
<!--                    $("#desc").val(data.wp_desc);-->
<!--                    $("#wbs").val(data.wbs_code);-->
<!--                }-->
<!--            });-->
<!--        }-->

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
                url		: "<?php echo site_url(); ?>/wp/simpan",
                data	: string,
                cache	: false,
                success	: function(data){
                    window.location.href = "<?php echo site_url(); ?>/wp";
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
                <h3><i class="icon-th-list"></i> Form WP</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered'>
					<!--
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama GL / L</label>
                        <div class="controls">
                            <input type="text" name="leader" id="leader" placeholder="..." class="input-large" value="<?php echo $leader; ?>" autofocus="true">
                        </div>
                    </div>
					-->
                    <div class="control-group">
                        <label for="textfield" class="control-label">WBS</label>
                        <div class="controls">
                            <div class="input-xxlarge"><select name="wbs" id="wbs" class="chosen-select" required="true">
                                    <?php
                                    if(empty($wbs)){
                                        ?>
                                        <option value="">-PILIH-</option>
                                    <?php
                                    }
                                    foreach($l_wbs->result() as $t){
                                        if($wbs==$t->wbs_code){
                                            ?>
                                            <option value="<?php echo $t->wbs_code;?>" selected="selected"><?php echo $t->wbs_name;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $t->wbs_code;?>"><?php echo $t->wbs_name;?></option>
                                        <?php }
                                    } ?>
                                </select></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kode WP</label>
                        <div class="controls">
                            <input type="text" name="code" id="code" placeholder="Kode.." class="input-medium" value="<?php echo $code; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama WP</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" placeholder="Nama..." class="input-xxlarge" value="<?php echo $name; ?>">
                        </div>
                    </div>
					<div class="control-group">
                        <label for="textfield" class="control-label">Nama Leader</label>
                        <div class="controls">
							<div class="input-xlarge">
                                <select name="lead" id="lead" class="chosen-select" required="true">
                                    <?php
                                    if(empty($lead)){
                                        ?>
                                        <option value="">-PILIH-</option>
                                    <?php
                                    }
                                    foreach($l_lead->result() as $z){
                                        if($lead==$z->username){
                                            ?>
                                            <option value="<?php echo $z->username;?>" selected="selected"><?php echo $z->nama_lengkap;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $z->username;?>"><?php echo $z->nama_lengkap;?></option>
                                        <?php }
                                    } ?>
                                </select>
							</div>
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
                        <a href="<?php echo base_url();?>index.php/wp">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
