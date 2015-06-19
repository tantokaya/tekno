<div class="span9">
    <div class="box">
        <div class="box-title">
            <div class="animated bounceInLeft">
                <b>
                    <i class="icon-table"></i>
                Pengguna yang sudah terdaftar dapat memberikan saran dan kritik mengenai Forum Komunitas Teknopark ini.
                </b>
            </div>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
                <thead>
                <tr class='thefilter'>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Balasan</th>
                    <th>Penulis</th>
                    <th>Kali dilihat</th>
                    <th>Pesan Terakhir</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no =1;
                foreach ($all_forum as $db):
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><a href="<?php echo base_url();?>index.php/topik/detail/<?php echo $db['topik_id'];?>"> <?php echo $db['topik_title']; ?></a></td>
                    <td></td>
                    <td><?php echo $db['username']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
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