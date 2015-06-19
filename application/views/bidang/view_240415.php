<div class="span9">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Tabel WBS
            </h3> &nbsp; &nbsp;
            <a href="<?php echo base_url(); ?>index.php/wbs/tambah">
                <button class="btn btn-orange"><i class="glyphicon-circle_plus"></i> Tambah</button>
            </a>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0,4">
                <thead>
                <tr>
                    <th width="20">No</th>
                    <th width="30" >Kode WBS</th>
                    <th width="100">Nama WBS</th>
                    <th width="150">Deskripsi WBS</th>
                    <th width="40">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no =1;
                foreach ($all_wbs as $db):
                    ?>
                    <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td align="center" ><?php echo $db['wbs_code']; ?></td>
                        <td ><?php echo $db['wbs_name']; ?></td>
                        <td align="center"><?php echo $db['wbs_desc']; ?></td>
                        <td align="center">
                            <a href="<?php echo base_url();?>index.php/wbs/edit/<?php echo $db['wbs_code'];?>" class="btn btn-inverse" rel="tooltip" title="Edit">
                                <i class="icon-edit"></i>
                            </a>
                            <a href="<?php echo base_url();?>index.php/wbs/hapus/<?php echo $db['wbs_id'];?>"
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

<div class="span4">
    <div class="box">
        <div class="box-title">
            <h3><i class="icon-tags"></i>Dukungan Teknis Lainnya</h3>
        </div>
        <div class="box-content nopadding">

        </div>
    </div>
</div>