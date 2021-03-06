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

if (!defined('SERVER_ROOT')) exit('No direct script access allowed');

//View data
$arr_all_record_type    = $VIEW_DATA['arr_all_record_type'];
$v_record_type_code     = $VIEW_DATA['record_type_code'];
$arr_all_record         = $VIEW_DATA['arr_all_record'];

//header
$this->template->title = 'Hồ sơ thụ lý';
$this->template->display('dsp_header.php');

?>
<form name="frmMain" id="frmMain" action="" method="POST">
    <?php
    echo $this->hidden('controller',$this->get_controller_url());
    echo $this->hidden('hdn_item_id','0');
    echo $this->hidden('hdn_item_id_list','');

    echo $this->hidden('hdn_dsp_single_method','dsp_single_record');
    echo $this->hidden('hdn_dsp_all_method', 'dsp_all_record');
    echo $this->hidden('hdn_update_method','update_record');
    echo $this->hidden('hdn_delete_method','delete_record');

    echo $this->hidden('hdn_role',$this->active_role);

    echo $this->hidden('record_type_code', $v_record_type_code);
    ?>
    <?php echo $this->dsp_div_notice($VIEW_DATA['active_role_text'] );?>
    <!-- filter -->
    <?php $this->dsp_div_filter($v_record_type_code, $arr_all_record_type);?>

    <div id="solid-button">
        <input type="button" class="solid commit" value="Hoàn thành thụ lý"
               onclick="btn_dsp_exec_onclick();" />
    </div>
    <div class="clear"></div>

    <div id="procedure">
        <?php if ($this->load_abs_xml($this->get_xml_config($v_record_type_code, 'list'))): ?>
            <?php echo $this->render_form_display_all_record($arr_all_record, FALSE); ?>
        <?php endif; ?>
    </div>
	<div><?php echo $this->paging2($arr_all_record);?></div>

    <!--
    <div class="button-area">
        <input type="button" name="btn_dsp_exec" class="button commit" value="Hoàn thành thụ lý" onclick="btn_dsp_exec_onclick();" />
    </div>-->

    <!-- Context menu -->
    <ul id="ownerMenu" class="contextMenu">
        <li class="exec">
            <a href="#exec">Hoàn thành thụ lý</a>
        </li>
        <li class="statistics">
            <a href="#statistics">Xem tiến độ</a>
        </li>
    </ul>
	<ul id="coExecMenu" class="contextMenu">
        <li class="statistics">
            <a href="#statistics">Xem tiến độ</a>
        </li>
    </ul>
</form>
<script>
    $(document).ready( function() {
        //Show context on each row
		//1.Owner
        $(".adminlist tr[role='presentation'][data-owner='1']").contextMenu({
            menu: 'ownerMenu'
        }, function(action, el, pos) {
            v_record_id = $(el).attr('data-item_id');
            v_owner = $(el).attr('data-owner');
            switch (action){
                case 'exec':
                    if (v_owner == "1")
                    {
                        dsp_exec_single_record(v_record_id);
                    }
                    break;

                case 'statistics':
                    dsp_record_statistics(v_record_id);
                    break;
            }
        });

		//2.co-exec
		$(".adminlist tr[role='presentation'][data-owner='0']").contextMenu({
            menu: 'coExecMenu'
        }, function(action, el, pos) {
            v_record_id = $(el).attr('data-item_id');
            v_owner = $(el).attr('data-owner');
            switch (action){
                case 'statistics':
                    dsp_record_statistics(v_record_id);
                    break;
            }
        });

        //Quick action

        $('.adminlist tr[role="presentation"] td[role="action"] .quick_action').each(function(index) {
            v_item_id =   $(this).attr('data-item_id');

            html = '';

            //Hoan thanh thu ly
            //Thong tin tien do
            v_is_owner = $('.adminlist tr[data-item_id="' + v_item_id + '"]').attr('data-owner');
            if (v_is_owner == "1")
            {
                html += '<a href="javascript:void(0)" onclick="btn_dsp_exec_onclick(\'' + v_item_id + '\')" class="quick_action" >';
                html += '<img src="' + SITE_ROOT + 'public/images/btn_commit.png" title="Hoàn thành thụ lý" /></a>';

                html += '<a href="javascript:void(0)" onclick="btn_dsp_resend_confirmation_request_records_onclick(\'' + v_item_id + '\')" class="quick_action" >';
                html += '<img src="' + SITE_ROOT + 'public/images/icon-32-rollback.png" title="Yêu cầu xác nhận lại" /></a>';
            }

            //Thong tin tien do
            html += '&nbsp;<a href="javascript:void(0)" onclick="dsp_record_statistics(\'' + v_item_id + '\')" class="quick_action" >';
            html += '<img src="' + SITE_ROOT + 'public/images/statistics-16x16.png" title="Xem tiến độ" /></a>';

            $(this).html(html);
        });

    });

    function dsp_record_statistics(record_id)
    {
        var url = '<?php echo $this->get_controller_url();?>statistics/' + record_id + '/'
                + '&hdn_item_id=' + record_id
                + '&pop_win=1';

        showPopWin(url, 1000, 600, null, true);
    }

    function exec_pop_win(url)
    {
        showPopWin(url, 1000, 600, null, true);
    }

    function btn_dsp_exec_onclick(record_id)
    {
        var f = document.frmMain;

        if (typeof(record_id) == 'undefined')
        {
            //Danh sach ID Ho so da chon
            v_selected_record_id_list = get_all_checked_checkbox(f.chk, ',');
        }
        else
        {
        	v_selected_record_id_list = record_id;
        }

        if (v_selected_record_id_list != '')
        {
            var url = '<?php echo $this->get_controller_url();?>dsp_inter_exec/' + v_selected_record_id_list
                + '/?record_type_code=' + $("#record_type_code").val()
                + '&pop_win=1';

            exec_pop_win(url);
        }
        else
        {
            alert('Chưa có hồ sơ nào được chọn!');
        }
    }

    function btn_dsp_resend_confirmation_request_records_onclick(record_id_list)
    {
        var f = document.frmMain;

        if (typeof(record_id_list) == 'undefined')
        {
            record_id_list = get_all_checked_checkbox(f.chk, ',');
        }

        if (record_id_list != '')
        {
            var url = '<?php echo $this->get_controller_url();?>dsp_resend_confirmation_request_record/' + record_id_list
                + '/?record_type_code=' + $("#record_type_code").val()
                + '&pop_win=1';

            showPopWin(url, 900, 600, null, true);
        }
        else
        {
            alert('Chưa có hồ sơ nào được chọn!');
        }
    }

</script>
<?php $this->template->display('dsp_footer.php');