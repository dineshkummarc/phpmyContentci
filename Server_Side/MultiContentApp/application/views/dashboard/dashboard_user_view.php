<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2 style="padding-bottom: 7px;"><?php echo $this->lang->line("app_description"); ?></h2>
            <?php
            //Complete Your Profile Alert
            if(empty($userContent->user_firstname))
            {
                ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong><?php echo $this->lang->line("System Message!"); ?><br></strong><?php echo $this->lang->line("Please update your information (Name & Mobile) to dismiss this warning."); ?>
                    <a style="color: white; text-decoration: none; font-size: 14px; font-weight: 500; border-bottom: 1px #000000 dashed;" href="<?php echo base_url()."dashboard/User/profile/profile_settings"; ?>"><?php echo $this->lang->line("Click Here!"); ?></a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
