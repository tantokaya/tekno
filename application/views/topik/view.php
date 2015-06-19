<div class="span9">
    <div class="box">
        <div class="box-title">
            <div class="animated bounceInLeft">
                <h3>
                    <i class="icon-table"></i>
                Daftar Topik
                </h3> &nbsp; &nbsp;
                <a href="<?php echo base_url(); ?>index.php/topik/tambah">
                    <button class="btn btn-orange"><i class="glyphicon-circle_plus"></i> Tambah</button>
                </a>
            </div>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
                <thead>
                <tr>
                    <th width="20">No</th>
                    <th>Last Topik</th>
                    <th>Last Post</th>
                    <th>Last Stats</th>
                    <th width="10px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no =1;
                foreach ($all_topik as $db):
                    ?>
                    <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td align="center" ><a href="<?php echo base_url();?>index.php/topik/detail/<?php echo $db['topik_id'];?>"> <?php echo $db['topik_title']; ?></a></td>
                        <td align="center" ></td>
                        <td >Replies : <br/> Views :</td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/topik/hapus/<?php echo $db['topik_id'];?>"
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