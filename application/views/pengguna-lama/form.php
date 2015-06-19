<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/dynatree/ui.dynatree.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/dynatree/jquery.dynatree.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#username").focus();

        if($(".filetree").length > 0){
            $(".filetree").each(function(){
                var $el = $(this),
                    opt = {};
                opt.debugLevel = 0;

                if($el.hasClass("filetree-checkboxes")){
                    opt.checkbox = true;
                    opt.selectMode = 2;

                    /*
                    opt.onActivate = function(node){
                        $("#info").text(node.data.key);
                        //$(".additionalInformation").html("<ul style='margin-bottom:0;'><li>Key: "+node.data.key+"</li><li>is folder: "+node.data.isFolder+"</li></ul>");
                    };
                    */

                    opt.onSelect = function(select, node){
                        var selNodes = node.tree.getSelectedNodes();
                        var selKeys = $.map(selNodes, function(node){
                            return node.data.key;
                        });
                        //$("#info").text(selKeys);
                        $("#jabatan").val(selKeys);

                    };

                }

                $el.dynatree(opt);
            });
        }
    });
</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Form Pengguna</h3>
            </div>
            <div class="box-content nopadding">
                <form name="form" id="form" class='form-horizontal form-bordered' enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/pengguna/simpan" method="post">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Username</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" name="username" id="username" placeholder="Username.." class="username-check" value="<?php echo $username; ?>">
                                <a href="#" class="btn add-on username-check-force"><i class="icon-refresh"></i></a>
                            </div>
                            <span class="help-block">
								Please enter a username
							</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Password</label>
                        <div class="controls">
                            <div class="input-xlarge">
                                <input type="password" name="pwd" id="pwd" placeholder="Password input" class="complexify-me input-block-level" value="<?php echo $pwd; ?>">
                            <span class="help-block">
							    <div class="progress progress-info">
                                    <div class="bar bar-red" style="width: 0%"></div>
                                </div>
							</span>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Level</label>
                        <div class="controls">
                            <div class="input-medium"><select name="level" id="level" class="chosen-select">
                                    <?php
                                    if(empty($level)){
                                        ?>
                                        <option value="">-PILIH-</option>
                                    <?php
                                    }
                                    foreach($l_level->result() as $t){
                                        if($level==$t->id_level){
                                            ?>
                                            <option value="<?php echo $t->id_level;?>" selected="selected"><?php echo $t->level;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $t->id_level;?>"><?php echo $t->level;?></option>
                                        <?php }
                                    } ?>
                                </select></div>
                        </div>
                    </div>


                    <div class="control-group">
                        <label for="textfield" class="control-label">Jabatan</label>
                        <div class="controls">

                                <div class="filetree filetree-checkboxes">
                                   <?php echo $l_jabatan; ?>
                                </div>
                                <input type="hidden" id="jabatan" name="jabatan" value="<?php echo $jabatan; ?>">
                                <div id="info"></div>

                        </div>
                    </div>

                    <!--
                    <div class="control-group">
                        <label for="textfield" class="control-label">WP</label>
                        <div class="controls">
                            <div class="input-xxlarge"><select name="wp" id="wp" class="chosen-select" required="true">
                                    <?php
                                    if(empty($wp)){
                                        ?>
                                        <option value="">-PILIH-</option>
                                    <?php
                                    }
                                    foreach($l_wp->result() as $t){
                                        if($wp==$t->wp_code){
                                            ?>
                                            <option value="<?php echo $t->wp_code;?>" selected="selected"><?php echo $t->wp_name;?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $t->wp_code;?>"><?php echo $t->wp_name;?></option>
                                        <?php }
                                    } ?>
                                </select></div>
                        </div>
                    </div>
                    -->

                    <div class="control-group">
                        <label for="textfield" class="control-label">NIP</label>
                        <div class="controls">
                            <input type="text" name="nip" id="nip" placeholder="NIP..." class="input-large" value="<?php echo $nip; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama Lengkap</label>
                        <div class="controls">
                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama..." class="input-large" value="<?php echo $nama_lengkap; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">No Hp</label>
                        <div class="controls">
                            <input type="text" name="hp" id="hp" placeholder="Hp..." class="input-xlarge" value="<?php echo $hp; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">E-mail</label>
                        <div class="controls">
                            <input type="text" name="email" id="email" placeholder="Email..." class="input-xlarge" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Foto</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo base_url()?>uploads/profile/<?php echo $foto; ?>" /></div>
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
                        <a href="<?php echo base_url();?>index.php/pengguna">
                            <button type="button" class="btn btn-red"><i class="icon-power-off"></i> Tutup</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>