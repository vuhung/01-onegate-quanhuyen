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

count($VIEW_DATA['arr_all_record']) > 0 OR DIE('ohhh');

$arr_all_record         = $VIEW_DATA['arr_all_record'];
$arr_single_task_info   = $VIEW_DATA['arr_single_task_info'];
$v_record_id_list       = $VIEW_DATA['record_id_list'];
$arr_all_exec_user      = $VIEW_DATA['arr_all_exec_user'];

$v_record_type_code = $arr_single_task_info['C_RECORD_TYPE_CODE'];
$v_record_type_name = $arr_single_task_info['C_RECORD_TYPE_NAME'];
$v_group_name       = $arr_single_task_info['C_GROUP_NAME'];

//display header
$this->template->title = 'Yêu cầu xác nhận lại';

$v_pop_win = isset($_REQUEST['pop_win']) ? '_pop_win' : '';
$this->template->display('dsp_header' . $v_pop_win . '.php');

$v_promote = _CONST_RECORD_APPROVAL_REJECT;
$v_reason = '';

?>
<form name="frmMain" method="post" id="frmMain" action="<?php echo $this->get_controller_url();?>do_resend_confirmation_request_record">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());

    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_record');
    echo $this->hidden('hdn_dsp_all_method', 'dsp_all_record');
    echo $this->hidden('hdn_update_method', 'update_record');
    echo $this->hidden('hdn_delete_method', 'delete_record');

    echo $this->hidden('pop_win', $v_pop_win);
    echo $this->hidden('hdn_item_id_list', $v_record_id_list);

    //Ma Loai HS
    echo $this->hidden('hdn_record_type_code', $v_record_type_code);

    //KQ thu ly
    echo $this->hidden('hdn_approval_value', $v_promote);
    ?>

    <div class="panel_color_form">Yêu cầu xác nhận lại</div>
    <div class="Row">
        <div class="left-Col">
            <label for="Loại hồ sơ: ">Loại hồ sơ: </label>
        </div>
        <div class="right-Col">
            <?php echo $v_record_type_code;?> - <?php echo $v_record_type_name;?>
        </div>
    </div>
    <!-- Record list -->
    <table cellpadding="4" cellspacing="0" width="100%" class="list">
        <tr>
            <th>STT</th>
            <th>Mã hồ sơ</th>
            <th>Người đăng ký</th>
            <th>Ngày nhận</th>
            <th>Ngày hẹn trả</th>
        </tr>
        <?php for ($i=0; $i<count($arr_all_record); $i++): ?>
            <tr>
                <td class="right"><?php echo ($i+1);?></td>
                <td><?php echo $arr_all_record[$i]['C_RECORD_NO'];?></td>
                <td><?php echo $arr_all_record[$i]['C_CITIZEN_NAME'];?></td>
                <td><?php echo jwDate::yyyymmdd_to_ddmmyyyy($arr_all_record[$i]['C_RECEIVE_DATE'], TRUE);?></td>
                <td><?php echo r3_View::return_date_by_text($arr_all_record[$i]['C_RETURN_DATE']);?></td>
            </tr>
        <?php endfor;?>
    </table>
    <!-- End: Record list -->
    <div class="Row">
        <div class="left-Col">
            <label>Gửi cho: </label>
        </div>
        <div class="right-Col"><ul id="signer"><?php
            //Ho so thuoc xa, phuong nao????
            $dom_xml_data = simplexml_load_string($arr_all_record[0]['C_XML_DATA']);

            $v_xa_phuong = $dom_xml_data->xpath("//item[@id='ddlXaPhuong']/value[last()]");
            $v_xa_phuong = $v_xa_phuong[0];

            for ($i=0; $i<count($arr_all_exec_user); $i++):
                $dom_xml_group_code = simplexml_load_string('<root>' . $arr_all_exec_user[$i]['C_XML_GROUP_CODE'] . '</root>');
                $check = $dom_xml_group_code->xpath("//row[@C_CODE='$v_xa_phuong']/@C_NAME[last()]");
                ?>
                <li>
                    <input type="radio" value="<?php echo $arr_all_exec_user[$i]['C_USER_LOGIN_NAME'];?>"
                        data-receiver_name="<?php echo $arr_all_exec_user[$i]['C_NAME'];?>"
                       id="rad_receiver_<?php echo $i;?>" name="rad_receiver"
                       <?php echo (sizeof($check) > 0) ? ' checked' : '';?> />
                    <label for="rad_receiver_<?php echo $i;?>">
                        <?php echo $arr_all_exec_user[$i]['C_NAME'];?> <i>(<?php echo $arr_all_exec_user[$i]['C_JOB_TITLE'];?>)</i>
                    </label>
                </li>
            <?php endfor;?>
            </ul>
        </div>
    </div>
    <div id="request_content" class="Row">
        <div class="left-Col">
            Lý do:<span class="required">*</span>
        </div>
        <div class="right-Col">
            <textarea rows="6" cols="80" name="txt_request_message_content" id="txt_request_message_content"></textarea>
        </div>
    </div>

    <div class="clear">&nbsp;</div>
    <!-- Buttons -->
    <div class="button-area">
        <hr/>
        <input type="button" name="btn_resend_confirmation_request_record" class="button save" value="Cập nhật" onclick="btn_resend_confirmation_request_record_onclick();" />
        <?php $v_back_action = ($v_pop_win === '') ? 'btn_back_onclick();' : 'try{window.parent.hidePopWin();}catch(e){window.close();};';?>
        <input type="button" name="cancel" class="button close" value="<?php echo __('close window'); ?>" onclick="<?php echo $v_back_action;?>"/>
    </div>
</form>
<script>

    function btn_resend_confirmation_request_record_onclick()
    {
        var f = document.frmMain;
        var v_approval_value = $("#hdn_approval_value").val();
        var v_reason = trim($("#txt_request_message_content").val());

        if (v_reason == '')
        {
            alert('Lý do không được bỏ trống!');
            f.txt_request_message_content.focus();
            return false;
        }

        f.submit();
    }
</script>
<?php $this->template->display('dsp_footer' .$v_pop_win . '.php');