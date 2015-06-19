<div class="span12">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Tabel Dokumen
            </h3> &nbsp; &nbsp;
            <a href="<?php echo base_url(); ?>index.php/dokumen/tambah">
                <button class="btn btn-orange"><i class="glyphicon-circle_plus"></i> Tambah</button>
            </a>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0,3">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Dok</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no =1;
                foreach ($all_dokumen as $db):
                    ?>
                    <tr>
                        <td style="text-align: center; width: 10px;"><?php echo $no; ?></td>
                        <td style="text-align: center; width: 30px;"><?php echo $db->dok_code; ?></td>
                        <td style="width: 400px;"><?php echo $db->dok_judul; ?></td>
                        <?php $isi = $db->dok_desc;
                        $isi = character_limiter($isi,100); ?>
                        <td ><?php echo $isi; ?></td>
                        <td style="text-align: center; width: 40px;">
                            <a href="<?php echo base_url();?>index.php/dokumen/edit/<?php echo $db->dok_code;?>" class="btn btn-inverse" rel="tooltip" title="Edit">
                                <i class="icon-edit"></i>
                            </a>
                            <a href="<?php echo base_url();?>index.php/dokumen/hapus/<?php echo $db->dok_code;?>"
                               onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-inverse" rel="tooltip" title="Hapus">
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
