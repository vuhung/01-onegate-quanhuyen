<?php 
/**
  	* o	Chương trình: Xây dựng phần mềm một cửa điện tử nguồn mở cho các quận huyện.
	* o	Thực hiện: Ban Quản lý các dự án công nghiệp công nghệ thông tin-Bộ Thông tin và Truyền thông.
	* o	Thuộc dự án: Hỗ trợ địa phương xây dựng, hoàn thiện một số sản phẩm phần mềm nguồn mở theo Quyết định 112/QĐ-TTg ngày 20/01/2012 của Thủ tướng Chính phủ.
	* o	Tác giả: Công ty Cổ phần Đầu tư và Phát triển Công nghệ Tâm Việt
	* o	Email: LTBinh@gmail.com
	* o	Điện thoại: 0936.114411
	* 
*/	


if (!defined('SERVER_ROOT')) {exit('No direct script access allowed');}?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <link rel="shortcut icon" href="favicon.ico" />
        <title><?php echo session::get('user_name');?>::<?php echo $this->eprint($this->title); ?></title>
        <link rel="stylesheet" href="<?php echo SITE_ROOT; ?>public/css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo SITE_ROOT; ?>public/css/text.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo SITE_ROOT; ?>public/css/1008_24_1_1.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->stylesheet_url;?>" type="text/css" media="screen" />

        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery-ui.min.js" type="text/javascript"></script>
        <link href="<?php echo SITE_ROOT; ?>public/js/jquery/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <!--  Datepicker -->
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery.ui.datepicker-vi.js" type="text/javascript"></script>

        <!-- Right-click context menu -->
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery.contextMenu.js" type="text/javascript"></script>
        <!-- Upload -->
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery.MultiFile.pack.js" type="text/javascript"></script>
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery.blockUI.js" type="text/javascript"></script>
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery/jquery.MetaData.js" type="text/javascript"></script>

        <script type="text/javascript">
            var SITE_ROOT='<?php echo SITE_ROOT;?>';
            var _CONST_LIST_DELIM = '<?php echo _CONST_LIST_DELIM;?>';
        </script>
        <!--  Modal dialog -->
        <script src="<?php echo SITE_ROOT; ?>public/js/submodal.js" type="text/javascript"></script>
        <link href="<?php echo SITE_ROOT; ?>public/css/subModal.css" rel="stylesheet" type="text/css"/>

        <script src="<?php echo SITE_ROOT; ?>public/js/qm.js" type="text/javascript"></script>
        <link href="<?php echo SITE_ROOT; ?>public/css/qm.css" rel="stylesheet" type="text/css"/>

        <!-- Tooltip -->
        <script src="<?php echo SITE_ROOT; ?>public/js/overlib_mini.js" type="text/javascript"></script>

        <script src="<?php echo SITE_ROOT; ?>public/js/mylibs.js" type="text/javascript"></script>
        <script src="<?php echo SITE_ROOT; ?>public/js/DynamicFormHelper.js" type="text/javascript"></script>

        <?php if (isset($this->local_js)):?>
            <script src="<?php echo $this->local_js;?>" type="text/javascript"></script>
        <?php endif;?>
    </head>
    <body>
        <DIV id=overDiv style="Z-INDEX: 10000; VISIBILITY: hidden; POSITION: absolute"></DIV>
        <div class="container_24" id="main">
			<div class="grid_24" id="banner">
			    <label id="unit_full_name"><?php echo get_xml_value(simplexml_load_file(SERVER_ROOT . 'public/xml/xml_unit_info.xml'), '//full_name')?></label>
			</div>
            <div class="grid_24 top-nav-box" id="header">
                <div id="user_info">
                    <div>
                        <ul id="menu-bar">
                            <li><?php echo VIEW::nav_home();?></li>
                            <?php if (check_permission('QUAN_TRI_DANH_MUC_LOAI_HO_SO', 'R3') OR check_permission('QUAN_TRI_QUY_TRINH_XU_LY_HO_SO', 'R3') OR check_permission('QUAN_TRI_LUAT_CAN_LOC_HO_SO', 'R3')  OR Session::get('is_admin')):?>
                                <li><a href="javascript:void(0)"><img src="<?php echo SITE_ROOT;?>public/images/admin-32x32.png" border="0" width="28px" height="28px"/>Quản trị</a>
                                    <ul>
                                        <?php if (Session::get('is_admin')): ?>
                                            <li><a href="<?php echo SITE_ROOT?>cores/xlist"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị loại danh mục</a></li>
                                            <li><a href="<?php echo SITE_ROOT?>cores/xlist/dsp_all_list"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị đối tượng danh mục</a></li>
                                            <li><a href="<?php echo SITE_ROOT?>cores/user"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị NSD</a></li>
                                            <li><a href="<?php echo SITE_ROOT?>cores/calendar"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị ngày làm việc/ngày nghỉ</a></li>
                                            <li><a href="<?php echo SITE_ROOT?>cores/application"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị ứng dụng</a></li>
                                        <?php endif;?>
                                        <?php if (check_permission('QUAN_TRI_DANH_MUC_LOAI_HO_SO', 'R3')):?>
                                            <li><a href="<?php echo SITE_ROOT?>r3/record_type"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị danh mục loại hồ sơ</a></li>
                                        <?php endif;?>
                                        <?php if (check_permission('QUAN_TRI_QUY_TRINH_XU_LY_HO_SO', 'R3')):?>
                                            <li><a href="<?php echo SITE_ROOT?>r3/workflow"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị quy trình xử lý hồ sơ</a></li>
                                        <?php endif;?>
                                        <?php if (check_permission('QUAN_TRI_LUAT_CAN_LOC_HO_SO', 'R3')):?>
                                            <li><a href="<?php echo SITE_ROOT?>r3/blacklist"><img src="<?php echo SITE_ROOT;?>public/images/item_configuration-16x16.png" border="0" /> &nbsp;Quản trị quy luật cản lọc hồ sơ</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>    
                <div id="date"><?php echo jwDate::vn_day_of_week() . ', ' . date("d/m/Y");?>
                    <?php if (Session::get('login_name') !== NULL): ?>
                        <img src="<?php echo SITE_ROOT;?>public/images/users.png" />
                        <label><?php echo Session::get('user_name');?> - <?php echo Session::get('user_job_title');?></label>
                        <?php if (session::get('auth_by') != 'AD'):?>
                            <?php $v_change_password_url = SITE_ROOT . 'cores/user/dsp_change_password';?>
                            <label>(<a href="javascript:void(0)" onclick="showPopWin('<?php echo $v_change_password_url;?>' , 500,400, null);">Đổi mật khẩu</a>)</label>
                        <?php endif; ?>
                        <label>(<a href="<?php echo SITE_ROOT;?>logout.php">Đăng thoát</a>)</label>
                    <?php endif; ?>
                </div>
			</div>
            <div class="grid_24">
                <div id="roles">
                    <ul>
                        <?php if (isset($this->arr_roles)): ?>
                            <?php foreach ($this->arr_roles as $key => $val): ?>
                                <?php $v_class = (strtolower($this->active_role) == strtolower($key)) ? ' class="active_role"' : '';?>
                                <li <?php echo $v_class;?> data-role="<?php echo $key;?>" data-menu="1">
                                    <a href="<?php echo $this->controller_url . 'ho_so/' . strtolower($key);?>"><?php echo $val;?>
                                        <?php if ( (strtoupper($key) != _CONST_TRA_CUU_ROLE) && (strtoupper($key) != _CONST_BAO_CAO_ROLE) && (strtoupper($key) != _CONST_Y_KIEN_LANH_DAO_ROLE)): ?>
                                            <span class="count">(0)</span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <script>
                                function get_role_notice(){get_notice("<?php echo $this->active_role;?>")}
                                $(function() {
                                    <?php if (strtoupper($this->active_role) != _CONST_TRA_CUU_ROLE && strtoupper($this->active_role) != _CONST_BAO_CAO_ROLE && strtoupper($this->active_role) != _CONST_Y_KIEN_LANH_DAO_ROLE): ?>
                                        get_role_notice();
                                        setInterval(get_role_notice, <?php echo _CONST_GET_NEW_RECORD_NOTICE_INTERVAL;?>);
                                    <?php endif; ?>

                                    count_processing_record_per_role();
                                    setInterval(count_processing_record_per_role, <?php echo _CONST_GET_NEW_RECORD_NOTICE_INTERVAL;?>);
                                });

                                function count_processing_record_per_role()
                                {
                                    q = 'li[data-menu="1"]';
                                    $(q).each(function(index) {
                                        var v_role = $(this).attr('data-role');
                                        if (v_role.toUpperCase() != '<?php echo _CONST_TRA_CUU_ROLE;?>' && v_role.toUpperCase() != '<?php echo _CONST_BAO_CAO_ROLE;?>' && v_role.toUpperCase() != '<?php echo _CONST_Y_KIEN_LANH_DAO_ROLE;?>')
                                        {
                                            var url = '<?php echo $this->controller_url;?>'+ 'count_processing_record_by_role/' + v_role;
                                            $.getJSON(url, function(data) {
                                                count = data.count;
                                                role = data.role;
                                                rq = 'li[data-role="' + role + '"] span[class="count"]';
                                                $(rq).html(' (' + count +')');
                                            });
                                        }
                                    });
                                }
                            </script>
                        <?php endif;?>
                    </ul>
                </div><!--roles-->
            </div>
            <?php if ($this->show_left_side_bar): ?>
                <div class="clear">&nbsp;</div>
                <div class="container_24" id="wrapper">
                    <div class="grid_5">
                        <div class="edit-box" id="left_side_bar">
                            <div style="width: 96%; padding: 4px;">
                                <?php if (isset($this->activity_filter)): ?>
                                    <div class="menuLeft" id="menuLeft">
                                        <ul>
                                        <?php foreach ($this->activity_filter as $key => $val): ?>
                                            <div class="menuLeft-left">
                                                <li class="menuLeft-item<?php echo ($_GET['tt'] == $key)? ' menuLeft-item-mark' : '';?>">
                                                    <a href="<?php echo $this->controller_url;?>ho_so/tra_cuu/&tt=<?php echo $key;?>"><?php echo $val?></a>
                                                    (<span class="activity-num" data-activity="<?php echo $key;?>"></span>)
                                                </li>
                                            </div>
                                        <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <script>
                                     $(document).ready(function() {
                                        var url = '<?php echo $this->controller_url;?>count_record_by_activity';
                                        $.getJSON(url, function(json_data) {
                                            $('#menuLeft .activity-num').each(function(index) {
                                                v_activity = $(this).attr('data-activity') ;
                                                $(this).html(json_data[v_activity]);
                                            });
                                        });
                                     });
                                    </script>
                                <?php endif; ?>

                                <!-- Menu Bao cao -->
                                <?php if (isset($this->arr_all_report_type)): ?>
                                    <div id="report-menu" class="menuLeft">
                                        <ul class="report-menu">
                                        <?php foreach ($this->arr_all_report_type as $v_code => $v_name): ?>
                                            <li <?php echo (strval($v_code) == strval($this->current_report_type)) ? ' class="current"' : '';?>>
                                                <a href="<?php echo $this->controller_url;?>option/<?php echo $v_code;?>"><?php echo $v_name;?></a>
                                            </li>
                                        <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="grid_19" id="content_right">
            <?php else: ?>
                <div class="grid_24" id="content_right">
            <?php endif; ?>