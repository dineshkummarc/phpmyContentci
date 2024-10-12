<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dashboard/common/head_view');
$this->load->view('dashboard/common/header_view');
//Show relevant sidebar
if ($_SESSION['user_type'] == 1)
    $this->load->view('dashboard/common/sidebar_view');
elseif ($_SESSION['user_type'] == 2)
    $this->load->view('dashboard/common/sidebar_user_view');
?>

    <section class="content">
        <div class="container-fluid">
            <!--<div class="block-header">
                <h2>
                    <?php echo $this->lang->line("Push Notification"); ?>
                </h2>
            </div>-->
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <!-- Alert after process start -->
                    <?php
                    $msg = $this->session->flashdata('msg');
                    $msgType = $this->session->flashdata('msgType');
                    if (isset($msg))
                    {
                        ?>
                        <div class="alert alert-<?php echo $msgType; ?> alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $msg; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- ./Alert after process end -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $this->lang->line("Push Notification"); ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo base_url()."dashboard/Dashboard/"; ?>"><?php echo $this->lang->line("Dashboard"); ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php
                            $attributes = array('class' => 'form-horizontal', 'method' => 'post');
                            echo form_open(base_url()."dashboard/Settings/push_notification/", $attributes);
                            //form_open_multipart//For Upload
                            ?>
                            <!--<form class="form-horizontal" method="post" action="<?php echo base_url()."dashboard/User/add_user/" ?>" enctype="multipart/form-data">-->
                                <div class="form-group">
                                    <label for="push_notification_title" class="col-sm-3 control-label"><?php echo $this->lang->line("Title"); ?> *</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="push_notification_title" minlength="2" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="push_notification_message" class="col-sm-3 control-label"><?php echo $this->lang->line("Message"); ?> *</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <textarea class="form-control" name="push_notification_message" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <!--<button <?php if($_SESSION['user_role_id'] == 4) echo "disabled='disabled'"; ?> type="submit" class="btn <?php echo $this->lang->line("bg-x"); ?> m-t-15 waves-effect"><?php echo $this->lang->line("Submit"); ?></button>-->
                                        <button type="submit" class="btn <?php echo $this->lang->line("bg-x"); ?> m-t-15 waves-effect"><?php echo $this->lang->line("Submit"); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>


<?php
$this->load->view('dashboard/common/footer_view');
?>
<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/" ?>plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    } );
</script>