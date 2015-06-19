<script type="text/javascript">
    $(document).ready(function(){

        tampil_data();

        function tampil_data(){
//            var kode = $("#kode_beli").val();
            //alert(kode);
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/home/DataDetail",
//                data	: "string",
//                cache	: false,
                success	: function(data){
                    $("#tampil_data").html(data);
                }
            });
            //return false();
        }

        $("#simpan_tugas").click(function(){
            var code	= $("#code_t").val();
            var name	= $("#name_t").val();

            var string = $("#form_tugas").serialize();

            if(code.length==0){
                $("#code_t").focus();
                return false();
            }
            if(name.length==0){
                $("#name_t").focus();
                return false();
            }

            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/home/simpan_tugas",
                data	: string,
                cache	: false,
                success	: function(data){
                    window.location.href = "<?php echo site_url(); ?>/home";
                }
            });
            return false();
        });

        $("#kirim").click(function(){
            var pesan	= $("#pesan").val();

            var string = $("#message-form").serialize();

            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/home/kirim",
                data	: string,
                cache	: false,
                success	: function(data){
                        tampil_data();
                        $("#pesan").val('');
                }
            });
            return false();
        });

        $('#pesan').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $("#kirim").click();
            }
        });



<!--        setInterval(function(){-->
<!--            tampildata();},1000);-->
    });
</script>

<!----------------------------------------  Modal Tugas ------------------------------------------------------------>

<div id="new-task" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Tugas</h3>
    </div>
    <form class='new-task-form form-horizontal form-bordered' id="form_tugas">
        <div class="modal-body nopadding">
            <div class="control-group">
                <label for="tasktitel" class="control-label">Icon</label>
                <div class="controls">
                    <input type="hidden" name="code_t" id="code_t" class="input-large" value="<?php echo $code_t; ?>">
                    <select name="icon" id="icon" class="select2-me input-xlarge">
                        <?php
                        if(empty($icon)){
                            ?>
                            <option value="">-PILIH-</option>
                        <?php
                        }
                        foreach($l_icon->result() as $t){
                            if($icon==$t->icon_id){
                                ?>
                                <option value="<?php echo $t->icon_id;?>" selected="selected"><?php echo $t->icon_name;?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $t->icon_id;?>"><?php echo $t->icon_name;?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label for="task-name" class="control-label">Keterangan</label>
                <div class="controls">
                    <input type="text" name="name_t" id="name_t" class="input-xxlarge">
                </div>
            </div>
            <div class="control-group">
                <label for="tasktitel" class="control-label"></label>
                <div class="controls">
                    <label class="checkbox"><input type="checkbox" name="task-bookmarked" value="yep"> Mark as important</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="simpan_tugas" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
        </div>
    </form>

</div>

<!----------------------------------------------  End of Modal Tugas ------------------------------------------->


<div class="container-fluid">

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered lightgrey">
            <div class="box-title">
                <h3><i class="icon-ok"></i> Catatan Tugas Pribadi</h3>
                <div class="actions">
                    <a href="#new-task" data-toggle="modal" class='btn'><i class="icon-plus-sign"></i> Tambah Tugas</a>
                </div>
            </div>
            <div class="box-content nopadding">
                <table class="table table-hover table-nomargin">
                <?php
                    foreach ($all_tugas as $db):
                        $icon = $this->app_model->CariIcon($db['icon_id']);
                ?>
                        <tbody>
                            <tr style="font-size: 13px">
                                <td width="10"><div class="check"><input type="checkbox" class="icheck-me" data-skin="square" data-color="blue"></div> </td>
                                <td>
                                    <span class="task"><i class="<?php echo $icon; ?>"></i> &nbsp;<span> <?php echo $db['tugas_name']; ?></span></span>
                                </td>
                                <td width="40" style="font-size: 16px">
                                    <span class="task-actions">
                                        <a href="<?php echo base_url();?>index.php/home/hapus_tugas/<?php echo $db['tugas_code'];?>"
                                           onClick="return confirm('Anda yakin ingin menghapus data ini?')" rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a> &nbsp;
                                        <a href="#" rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
							        </span>
                                </td>
                            </tr>
                        </tbody>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>


</div>



<div class="row-fluid">
    <div class="span6">
        <div class="box">
            <div class="box-title">
                <h3><i class="icon-tags"></i>Forum Diskusi</h3>
            </div>
            <div class="box-content nopadding">
                <table class="table table-hover table-nomargin table-striped">
                    <thead>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>pesan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="<?php echo base_url();?>index.php/forum/perkenalan"><i class="icon-rss icon-2x"></i></a> </td>
                            <td>
                                <a href="<?php echo base_url();?>index.php/forum/perkenalan"><b>Selamat Datang & Perkenalan</b><br/></a>
                                <p style="font-size: 12px">Selamat datang di Forum Komunitas Teknopark - Silahkan perkenalkan diri anda di sini. </p><br/>
                                <p style="font-size: 11px">Pesan Terakhir - </p>
                            </td>
                            <td><p style="font-size: 15px"><?php echo $jml_topik_perkenalan; ?></p></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>index.php/forum/pengumuman"><i class="icon-bullhorn icon-2x"></i> </a> </td>
                            <td>
                                <a href="<?php echo base_url();?>index.php/forum/pengumuman"><b>Pengumuman</b></a>
                                <p style="font-size: 12px">Pengumuman dari Kegiatan Teknopark.</p><br/>
                                <p style="font-size: 11px">Pesan Terakhir -</p>
                            </td>
                            <td><p style="font-size: 15px"><?php echo $jml_topik_pengumuman; ?></p></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>index.php/forum/saran"><i class="icon-lightbulb icon-2x"></i> </a> </td>
                            <td>
                                <a href="<?php echo base_url();?>index.php/forum/saran"><b>Saran untuk forum</b></a>
                                <p style="font-size: 12px">Pengguna yang sudah terdaftar dapat memberikan saran dan kritik mengenai Forum Komunitas Teknopark ini. </p><br/>
                                <p style="font-size: 11px">Pesan Terakhir - </p>
                            </td>
                            <td><p style="font-size: 15px"><?php echo $jml_topik_saran; ?></p></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>index.php/forum/pojok"><i class="icon-group icon-2x"></i> </a> </td>
                            <td>
                                <a href="<?php echo base_url();?>index.php/forum/pojok"><b>Pojok Komunitas</b></a>
                                <p style="font-size: 12px">Pengguna yang sudah terdaftar dapat berdiskusi, diskusi dengan topik yang umum dan tentu saja saling mengenal antara pengguna forum ini. </p><br/>
                                <p style="font-size: 11px">Pesan Terakhir - </p>
                            </td>
                            <td><p style="font-size: 15px"><?php echo $jml_topik_pojok; ?></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="box">
            <div class="box-title">
                <h3><i class="icon-comment"></i>Chat</h3>
                <div class="actions">
                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                </div>
            </div>
            <div class="box-content nopadding scrollable" data-height="500" data-visible="true" data-start="bottom">
                <ul class="messages">
                    <div id="tampil_data"></div>
                    <li class="typing">
                        <span><?php echo $this->app_model->CariNamaPengguna();?></span> is typing <img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="">
                    </li>
                    <li class="insert">
                        <form id="message-form">
                            <div class="text">
                                <input type="text" name="pesan" id="pesan"  placeholder="Write here..." class="input-block-level">
                            </div>
                            <div class="submit">
                                <button type="button" id="kirim"><i class="icon-share-alt"></i></button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</div>
