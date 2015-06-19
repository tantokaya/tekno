<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $this->app_model->CariNamaPengguna();?> <img src="<?php echo base_url(); ?>uploads/profile/<?php echo $this->app_model->CariFotoPengguna();?>" style="width: 27px; height: 27px" alt="Pengguna"></a>
<ul class="dropdown-menu pull-right">
    <li>
        <a href="<?php echo base_url();?>index.php/pengguna/edit/<?php echo $this->app_model->CariUserPengguna();?>">Edit profile</a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>">Sign out</a>
    </li>
</ul>