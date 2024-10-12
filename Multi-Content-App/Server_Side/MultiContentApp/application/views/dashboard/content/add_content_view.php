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
                    <?php echo $this->lang->line("Add Content"); ?>
                </h2>
            </div>-->
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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
                                <?php echo $this->lang->line("Add Content"); ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo base_url()."dashboard/Dashboard"; ?>"><?php echo $this->lang->line("Dashboard"); ?></a></li>
                                        <li><a href="<?php echo base_url()."dashboard/Content/content_list"; ?>"><?php echo $this->lang->line("Content List"); ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php
                            $attributes = array('class' => 'form-horizontal', 'method' => 'post');
                            echo form_open_multipart(base_url()."dashboard/Content/add_content/", $attributes);
                            //form_open_multipart//For Upload
                            ?>

                                <div class="form-group">
                                    <label for="content_title" class="col-sm-2 control-label"><?php echo $this->lang->line("Title"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="content_title" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_description" class="col-sm-2 control-label"><?php echo $this->lang->line("Description"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="">
                                            <textarea class="form-control" name="content_description" id="content_description" required><?php echo $this->lang->line("Write Something..."); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_category_id" class="col-sm-2 control-label"><?php echo $this->lang->line("Category"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="content_category_id" name="content_category_id" data-live-search="true" data-show-subtext="true" required>
                                                <option selected="selected" disabled><?php echo $this->lang->line("--- Please Select ---"); ?></option>
                                                <?php
                                                foreach ($fetchCategories as $key) {
                                                    ?>
                                                    <option data-divider="true"></option>
                                                    <option value="<?php echo $key->category_id ?>">◼ <?php echo $key->category_title; ?></option>
                                                    <?php
                                                    //To get sub category
                                                    $subCategory = $this->db->get_where('category_table', array('category_parent_id' => $key->category_id))->result();
                                                    foreach($subCategory as $sKey)
                                                    {
                                                        echo "<option data-subtext='($key->category_title)' value='$sKey->category_id'>&nbsp;&nbsp;&nbsp;&nbsp;◾&nbsp;$sKey->category_title</option>";
                                                        //To get sub sub category
                                                        $subSubCategory = $this->db->get_where('category_table', array('category_parent_id' => $sKey->category_id))->result();
                                                        foreach($subSubCategory as $ssKey)
                                                        {
                                                            echo "<option data-subtext='($sKey->category_title)' class='subSubCategoryDropDown' value='$ssKey->category_id'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;◽&nbsp;$ssKey->category_title</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_orientation" class="col-sm-2 control-label"><?php echo $this->lang->line("Orientation"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="content_orientation" name="content_orientation" required>
                                                <option selected="selected" value="1"><?php echo $this->lang->line("It does not matter"); ?></option>
                                                <option data-subtext="(Portrait)" value="2"><?php echo $this->lang->line("Portrait"); ?></option>
                                                <option data-subtext="(Landscape)" value="3"><?php echo $this->lang->line("Landscape"); ?></option>
                                            </select>
                                        </div>
                                        <small class="col-pink"><?php echo $this->lang->line("Suitable for display on a mobile phone vertically or horizontally."); ?></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_type_id" class="col-sm-2 control-label"><?php echo $this->lang->line("Content Type"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="content_type_id" name="content_type_id" required>
                                                <option selected="selected" disabled><?php echo $this->lang->line("--- Please Select ---"); ?></option>
                                                <?php
                                                foreach ($contentType as $key) {
                                                    ?>
                                                    <option data-subtext="(<?php echo $key->content_type_description; ?>)" value="<?php echo $key->content_type_id; ?>"><?php echo $key->content_type_title; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label for="content_access" class="col-sm-2 control-label"><?php echo $this->lang->line("Access to content"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="content_access" name="content_access" required>
                                                <option selected value="1"><?php echo $this->lang->line("Indirect Access"); ?></option>
                                                <option value="2"><?php echo $this->lang->line("Direct Access"); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>-->

                                <!--<div class="form-group">
                                    <label for="content_user_role_id" class="col-sm-2 control-label"><?php echo $this->lang->line("User Role"); ?> *</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="content_user_role_id" name="content_user_role_id" data-show-subtext="true" required>
                                                <?php
                                                foreach ($userRole as $key) {
                                                    ?>
                                                    <option value="<?php echo $key->user_role_id; ?>"><?php echo $key->user_role_title ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label for="content_url" class="col-sm-2 control-label"><?php echo $this->lang->line("URL"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="url" style="direction: ltr" class="form-control" name="content_url" placeholder="http://www.YourDomain.com">
                                        </div>
                                        <small class="col-pink">Video or Music or Other URL about this content. For video: .mp4 and for music .mp3</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_duration" class="col-sm-2 control-label"><?php echo $this->lang->line("Duration"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="content_duration" placeholder="01:25">
                                        </div>
                                        <small class="col-pink">Only for Video and Music.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_order" class="col-sm-2 control-label"><?php echo $this->lang->line("Category Order"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="content_order" placeholder="1" value="1" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_image" class="col-sm-2 control-label"><?php echo $this->lang->line("Main Image"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="file" name="content_image" multiple>
                                        </div>
                                        <small class="col-pink"><?php echo $this->lang->line("Please select the main image."); ?></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_featured" class="col-sm-2 control-label"><?php echo $this->lang->line("Featured"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="checkbox" class="filled-in <?php echo $this->lang->line("chk-col-x"); ?>" id="content_featured" name="content_featured">
                                            <label class="" for="content_featured"><?php echo $this->lang->line("This content is Featured."); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label for="content_special" class="col-sm-2 control-label"><?php echo $this->lang->line("Special"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="checkbox" class="filled-in <?php echo $this->lang->line("chk-col-x"); ?>" id="content_special" name="content_special">
                                            <label class="" for="content_special"><?php echo $this->lang->line("This content is Special."); ?></label>
                                        </div>
                                    </div>
                                </div>-->
								
								<div class="form-group">
                                    <label for="send_push_notification" class="col-sm-2 control-label"><?php echo $this->lang->line("Push Notification"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="checkbox" class="filled-in <?php echo $this->lang->line("chk-col-x"); ?>" id="send_push_notification" name="send_push_notification">
                                            <label class="" for="send_push_notification"><?php echo $this->lang->line("Send push notification to all users about this content."); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content_status" class="col-sm-2 control-label"><?php echo $this->lang->line("Status"); ?></label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="checkbox" checked class="filled-in <?php echo $this->lang->line("chk-col-x"); ?>" id="content_status" name="content_status">
                                            <label class="" for="content_status"><?php echo $this->lang->line("Enable this content."); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" class="form-control" name="content_user_role_id" value="5" readonly>
                                        <input type="hidden" class="form-control" name="content_access" value="1" readonly>
                                        <button <?php if($_SESSION['user_role_id'] == 4) echo "disabled='disabled'"; ?> type="submit" class="btn <?php echo $this->lang->line("bg-x"); ?> m-t-15 waves-effect"><?php echo $this->lang->line("Add Content"); ?></button>
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

<!-- TinyMCE -->
<script src="<?php echo base_url()."assets/dashboard/plugins/tinymce/tinymce.js"; ?>"></script>
<?php
$this->load->view('dashboard/common/footer_view');
?>
<script>
    tinymce.init({
        selector: '#content_description',
        height: 250,
        theme: 'modern',
        directionality: "<?php echo $this->lang->line('app_direction'); ?>",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste wordcount"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
        setup : function(ed)
        {
            ed.on('init', function()
            {
                this.getDoc().body.style.fontSize = '13px';
                this.getDoc().body.style.fontFamily = 'Tahoma';
            });
        },

    });
</script>