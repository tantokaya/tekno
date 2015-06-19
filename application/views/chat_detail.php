<div class="box-content nopadding scrollable" data-height="500" data-visible="true" data-start="bottom">
    <ul class="messages">
        <?php
        $tampil=mysql_query("SELECT tbl_chat.id_chat,tbl_chat.`user`,tbl_chat.waktu,tbl_chat.pesan,tbl_admin.foto,tbl_admin.nama_lengkap
                FROM tbl_chat INNER JOIN tbl_admin ON tbl_chat.`user` = tbl_admin.username ORDER BY waktu ASC");
        while($r=mysql_fetch_array($tampil)){
        ?>
            <li>
                <?php echo $r['user']; ?></span>
                        <p><?php echo $r['pesan']; ?></p> <?php echo $r['waktu']; ?>
            </li>
        <?php } ?>
    </ul>
</div>