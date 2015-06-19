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


<div class="span12">
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