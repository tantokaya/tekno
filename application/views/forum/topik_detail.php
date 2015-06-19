<div class="row-fluid">
    <div class="span12">
        <?php if($this->uri->segment(4)<=1){ ?>
        <div class="box box-color box-bordered">
            <div class="box-title">
                <p style="color: #ffffff; height: 7px;"><i class="icon-comment"></i>  <?php echo $time; ?></p>
            </div>
            <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered">
                <tr>
                    <td style="width: 170px;background-color: whitesmoke;">
                        <img src="<?php echo base_url(); ?>uploads/profile/<?php echo $userfoto;?>" style="width: 80px; height: 80px; " ><br/>
                        <?php echo $username; ?><br/>
                        <?php echo $userhp; ?><br/>
                        <?php echo $useremail; ?>
                    </td>
                    <td>
                        <h4 style="text-align: center;"><?php echo $title; ?></h4>
                        <hr align="center">
                        <?php echo $topik; ?>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        <?php } ?>
        
        <?php if(!empty($all_topik_reply)){ ?>
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
            <table class="table table-hover table-nomargin table-bordered">
                <?php
                foreach ($all_topik_reply as $db):
                ?>
                <tr>
                    <td colspan="2" style="background-color: #368EE0; color: #ffffff;  height: 7px;">
                        <i class="icon-comment"></i> <?php echo $db->reply_time; ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 170px;background-color: whitesmoke;">
                        <img src="<?php echo base_url(); ?>uploads/profile/<?php echo $db->foto;?>" style="width: 80px; height: 80px; " ><br/>
                        <?php echo $db->nama_lengkap; ?><br/>
                        <?php echo $db->hp; ?><br/>
                        <?php echo $db->email; ?>
                    </td>
                    <td>
                        <?php echo $db->reply_post; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            </div>
        </div>
        <?php } ?>
        <div class="box box-color box-bordered">
            <div class="box-title"></div>
            <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <tr>
                    <td style="text-align: left;">
                        <a href="<?php echo base_url();?>index.php/topik/post_reply/<?php echo $code;?>">
                            <button class="btn btn-primary"><i class="icon-pencil"></i> Post Reply</button>
                        </a>
                    </td>
                    <td style="text-align: right;"><?php echo $links; ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>
