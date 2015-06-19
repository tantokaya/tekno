<script type="text/javascript">
    $(document).ready(function(){
        $("#code").focus();

        $("#code").autocomplete({
            source: function(request,response) {
                $.ajax({
                    url: "<?php echo site_url('ref_json/ListStkk'); ?>",
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
            CariDataStkk();
        });

        function CariDataStkk(){
            var kode = $("#code").val()
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/ref_json/InfoStkk",
                data	: "code="+kode,
                cache	: false,
                dataType : "json",
                success	: function(data){
                    $("#name").val(data.stkk_name);
                    $("#desc").val(data.stkk_desc);
                    $("#kp").val(data.nm_kp);
                    $("#pm").val(data.nm_pm);
                    $("#ce").val(data.nm_ce);
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
                url		: "<?php echo site_url(); ?>/stkk/simpan",
                data	: string,
                cache	: false,
                success	: function(data){
                    window.location.href = "<?php echo site_url(); ?>/stkk";
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
                <h3><i class="icon-th-list"></i> Form STKK</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered'>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Kode STKK</label>
                        <div class="controls">
                            <input type="text" name="code" id="code" placeholder="Kode.." class="input-large" value="<?php echo $code; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama STKK</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" placeholder="Nama..." class="input-xlarge" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama KP</label>
                        <div class="controls">
                            <input type="text" name="kp" id="kp" placeholder="KP..." class="input-xlarge" value="<?php echo $kp; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama PM</label>
                        <div class="controls">
                            <input type="text" name="pm" id="pm" placeholder="PM..." class="input-xlarge" value="<?php echo $pm; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama CE</label>
                        <div class="controls">
                            <input type="text" name="ce" id="ce" placeholder="CE..." class="input-xlarge" value="<?php echo $ce; ?>">
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
                        <a href="<?php echo base_url();?>index.php/stkk">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
