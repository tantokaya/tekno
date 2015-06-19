<form action="" class='search-form'>
    <div class="search-pane">
        <input type="text" name="search" placeholder="Search here...">
        <button type="submit"><i class="icon-search"></i></button>
    </div>
</form>
<div class="<?php if($judul == 'list_agenda' || $judul == 'add_agenda' || $judul == 'edit_agenda') echo 'subnav'; else echo 'subnav subnav-hidden'; ?>">
    <div class="subnav-title">
        <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Kegiatan</span></a>
    </div>
    <ul class="subnav-menu">
       <li>
            <a href="<?php echo base_url(); ?>index.php/agenda">Agenda</a>
        </li>
        <li>
            <a href="#">Kalender</a>
        </li>
    </ul>
</div>
<div class="subnav subnav-hidden">
    <div class="subnav-title">
        <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Settings</span></a>
    </div>
    <ul class="subnav-menu">
        <li>
            <a href="#">Tentang Aplikasi</a>
        </li>
    </ul>
</div>
