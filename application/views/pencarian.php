<div class="row-fluid animated fadeInLeftBig">
    <div class="span6">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3><i class="icon-search"></i> Hasil Pencarian Agenda</h3>
            </div>
            <div class="box-content nopadding">
                <div class="search-results">
                    <?php if(!empty($agenda)){ ?>
                    <ul>
                        <?php foreach($agenda as $result): ?>
                        <li>
                            <div class="">
                                <a href="#" data-id="<?= $result['agenda_code']; ?>" class="link_agenda"><?= $result['agenda_name']; ?></a>
                                <p class="url"><?= $result['agenda_lokasi']; ?></p>
                                <p><?= $result['agenda_desc']; ?></p>
                                
                                <?php if(!empty($result['lampiran_agenda'])): ?> 
								<?php 
									$filename = explode(',', $result['lampiran_agenda']);
									$dir  = base_url().'uploads/';
									echo '<div class="basic-margin">';
									if(count($filename) > 1){
										for($i=0; $i < count($filename); $i++)
										{
											echo '<a href="'.$dir.$filename[$i].'" class="btn btn-blue">'.$filename[$i].'</a>';	
										}
									} else {
										echo '<a href="'.$dir.$filename[0].'" class="btn btn-blue">'.$filename[0].'</a>';	
									}	
								 endif;
									echo '<div>'; 
								 ?>
                            </div>
                        </li>
                        
                        <?php endforeach; ?>
                    </ul>
                    <?php } else { ?>
                        <ul><li><div><p class="url">Data yang Anda cari tidak ditemukan!</p></div></li></ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3><i class="icon-search"></i> Hasil Pencarian Dokumen</h3>
            </div>
            <div class="box-content nopadding">
                <div class="search-results">
                    <?php if(!empty($dokumen)){ ?>
                        <ul>
                            <?php foreach($dokumen as $rs): ?>
                                <li>
                                    <div class="">
                                    	<a href="#" data-id="<?= $rs['dok_id']; ?>" class="link_dokumen"><?= $rs['dok_judul']; ?></a>
                                       	<p><?= $rs['dok_desc']; ?></p>
                                        <?php if(!empty($rs['lampiran_dokumen'])): ?> 
										<?php 
                                            $filename = explode(',', $rs['lampiran_dokumen']);
                                            $dir  = base_url().'uploads/';
                                            echo '<div class="basic-margin">';
                                            if(count($filename) > 1){
                                                for($i=0; $i < count($filename); $i++)
                                                {
                                                    echo '<a href="'.$dir.$filename[$i].'" class="btn btn-blue">'.$filename[$i].'</a>';	
                                                }
                                            } else {
                                                echo '<a href="'.$dir.$filename[0].'" class="btn btn-blue">'.$filename[0].'</a>';	
                                            }	
                                         endif;
                                            echo '<div>'; 
                                         ?>
                                         
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } else { ?>
                        <ul><li><div><p class="url">Data yang Anda cari tidak ditemukan!</p></div></li></ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- START MODAL AGENDA DETAIL -->
<div id="eventAgendaDetailModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 id="modalTitleAgenda" class="modal-title"></h3>
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
                    <!--
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td id="lampiran"></td>
                    </tr>
                    -->
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- END MODAL AGENDA DETAIL -->

<!-- START MODAL AGENDA DETAIL -->
<div id="eventDokumenDetailModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 id="modalTitleDokumen" class="modal-title"></h3>
            </div>
            <div id="modalBody" class="modal-body">
                <table class="table table-hover table-nomargin table-striped">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td id="judul"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><textarea id="desc2" rows="5" class="input-block-level" disabled></textarea></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td id="status"></td>
                    </tr>
                    <tr>
                        <td>Diunggah Oleh</td>
                        <td>:</td>
                        <td id="uploadedby"></td>
                    </tr>
                    <!--
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td id="lampiran"></td>
                    </tr>
                    -->
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- END MODAL DOKUMEN DETAIL -->

<script type="text/javascript">
   $(document).ready(function(){
        $('.link_agenda').on('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
           // alert(id);
            $.ajax({
                type : 'post',
                url : '<?= base_url('index.php/ref_json/ListAgenda'); ?>',
                data :  'id='+id,
                success : function(data)
                {
                    //console.log(end+'\n');
                    var r = jQuery.parseJSON(data);
                    $('#modalTitleAgenda').html(r.judul);
                    $('#start').html(r.mulai);
                    $('#end').html(r.akhir);
                    $('#location').html(r.lokasi);
					$('#mitra').html(r.mitra);
                    $('#desc').html(r.deskripsi);
					$('#nama').html(r.nama);
					$('#tlp').html(r.tlp);
					//$('#lampiran').html(r.lampiran);

                   // console.log(response.judul+'\n');

                    //$('#eventUrl').attr('href',event.url);

                    $('#eventAgendaDetailModal').modal();
                    //$('.modal-body').show().html(r);
                }
            });
        });
		
		$('.link_dokumen').on('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
           // alert(id);
            $.ajax({
                type : 'post',
                url : '<?= base_url('index.php/ref_json/ListDokumen'); ?>',
                data :  'id='+id,
                success : function(data)
                {
                    //console.log(end+'\n');
                    var r = jQuery.parseJSON(data);
                    $('#modalTitleDokumen').html(r.judul);
                    $('#judul').html(r.judul);
                    
                    $('#desc2').html(r.desc2);
					$('#uploadedby').html(r.uploadedby);
					$('#status').html(r.status);
					

                    // console.log(response.judul+'\n');

                    //$('#eventUrl').attr('href',event.url);

                    $('#eventDokumenDetailModal').modal();
                    //$('.modal-body').show().html(r);
                }
            });

        });
   });
</script>