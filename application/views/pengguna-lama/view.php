<div class="span9">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Tabel Pengguna
            </h3> &nbsp; &nbsp;
            <a href="<?php echo base_url(); ?>index.php/pengguna/tambah">
                <button class="btn btn-orange"><i class="glyphicon-circle_plus"></i> Tambah</button>
            </a>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0,4">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Pengguna</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($data->num_rows()>0){
                    $no =1;
                    foreach($data->result_array() as $db){
                        $level = $this->app_model->CariLevel($db['id_level']);
                        ?>
                        <tr>
                            <td align="center" width="20"><?php echo $no; ?></td>
                            <td align="center" width="200" ><?php echo $db['username']; ?></td>
                            <td ><?php echo $db['nama_lengkap']; ?></td>
                            <td align="center" width="200" ><?php echo $db['id_level'].' - '.$level; ?></td>
                            <td align="center" width="80">
                                <a href="<?php echo base_url();?>index.php/pengguna/edit/<?php echo $db['username'];?>" class="btn btn-inverse" rel="tooltip" title="Edit">
                                    <i class="icon-edit"></i>
                                </a>
                                <a href="<?php echo base_url();?>index.php/pengguna/hapus/<?php echo $db['username'];?>"
                                   onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-inverse" rel="tooltip" title="Hapus">
                                    <i class="icon-remove"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="4" align="center" >Tidak Ada Data</td>
                    </tr>
                <?php
                }
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