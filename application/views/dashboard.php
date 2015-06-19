<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.js"></script>	
<script type="text/javascript">
    $(document).ready(function(){
		var end;
		// Calendar (fullcalendar)
		if($('.calendar').length > 0)
		{
			$('.calendar').fullCalendar({
				header: {
					left: '',
					center: 'prev,title,next',
					right: 'month,today'
				},
				events:	'<?php echo base_url('index.php/home/generate_event'); ?>',
				buttonText:{
					today:'Hari Ini',
					month:'Bulan',
					week: 'Minggu',
					day: 'Hari',
				},
				editable: false,
				eventClick:  function(event, jsEvent, view) {
            		$('#modalTitle').html(event.title);
					$('#start').html(moment(event.start).format('LL'));
					//console.log(event.start+'\n');
					end = event.end;
					if(end === null){
						end = event.start;	
					}
					//console.log(end+'\n');
					$('#end').html(moment(end).format('LL'));
					$('#location').html(event.location);
            		$('#desc').html(event.description);
					$('#mitra').html(event.mitra);
					$('#nama').html(event.nama);
                    $('#tlp').html(event.tlp);
					
            		//$('#eventUrl').attr('href',event.url);
            		$('#eventDetailModal').modal();
        		}
			});
			$(".fc-button-effect").remove();
			$(".fc-button-next .fc-button-content").html("<i class='icon-chevron-right'></i>");
			$(".fc-button-prev .fc-button-content").html("<i class='icon-chevron-left'></i>");
			$(".fc-button-today").addClass('fc-corner-right');
			$(".fc-button-prev").addClass('fc-corner-left');
		}
	});
    </script>

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
<!-- START MODAL EVENT DETAIL -->
<div id="eventDetailModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 id="modalTitle" class="modal-title"></h3>
            </div>
            <div id="modalBody" class="modal-body">
                <table class="table table-hover table-nomargin table-striped">
                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>:</td>
                        <td id="start"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir</td>
                        <td>:</td>
                        <td id="end"></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td id="location"></td>
                    </tr>
                    <tr>
                        <td>Mitra</td>
                        <td>:</td>
                        <td id="mitra"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><textarea id="desc" rows="5" class="input-block-level" disabled></textarea></td>
                    </tr>
                    <tr>
                        <td>Nama Pembuat</td>
                        <td>:</td>
                        <td id="nama"></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>:</td>
                        <td id="tlp"></td>
                    </tr>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- END MODAL EVENT DETAIL -->

<div class="container-fluid">

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
                        <td>topik</td>
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
                        <td><p style="font-size: 15px"></p><?php echo $jml_topik_pengumuman; ?></td>
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
                <h3><i class="icon-calendar"></i>Kalender Agenda</h3> &nbsp; &nbsp;
                <a href="<?php echo base_url(); ?>index.php/agenda/tambah">
                    <button class="btn btn-orange"><i class="glyphicon-circle_plus"></i> Tambah</button>
                </a>
            </div>
            <div class="box-content nopadding">
                <div class="calendar"></div>
            </div>
        </div>
    </div>

</div>



<div class="row-fluid">
    <div class="span6">
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
