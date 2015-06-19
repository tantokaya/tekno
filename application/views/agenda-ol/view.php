<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Tabel Agenda
                </h3> &nbsp; &nbsp;
                <a href="<?php echo base_url(); ?>index.php/agenda/tambah">
                    <button class="btn btn-orange"><i class="glyphicon-circle_plus"></i> Tambah</button>
                </a>
            </div>
            <div class="box-content nopadding">
                <table class="table table-hover table-nomargin dataTable dataTable-tools table-bordered">
                    <thead>
                    <tr>
                        <th width="10">No</th>
                        <th width="30" >Kode Agenda</th>
                        <th width="200">Acara</th>
                        <th width="100">Lokasi</th>
                        <th width="40">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no =1;
                    foreach ($all_agenda as $db):
                        ?>
                        <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td align="center" ><?php echo $db['agenda_code']; ?></td>
                            <td ><?php echo $db['agenda_name']; ?></td>
                            <td align="center" ><?php echo $db['agenda_lokasi']; ?></td>
                            <td align="center">
                                <a href="<?php echo base_url();?>index.php/agenda/edit/<?php echo $db['agenda_code'];?>" class="btn" rel="tooltip" title="Edit">
                                    <i class="icon-edit"></i>
                                </a>
                                <a href="<?php echo base_url();?>index.php/agenda/hapus/<?php echo $db['agenda_code'];?>"
                                   onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn" rel="tooltip" title="Hapus">
                                    <i class="icon-remove"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
