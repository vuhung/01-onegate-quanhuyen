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


if (!defined('SERVER_ROOT')) {exit('No direct script access allowed');}

//View data
$arr_all_record_type    = $VIEW_DATA['arr_all_record_type'];
//$v_record_type_code     = $VIEW_DATA['record_type_code'];
$arr_single_record      = $VIEW_DATA['arr_single_record'];

if (isset($arr_single_record['PK_RECORD']))
{
    $v_record_id            = $arr_single_record['PK_RECORD'];
    $v_record_no            = $arr_single_record['C_RECORD_NO'];
    $v_receive_date         = $arr_single_record['C_RECEIVE_DATE'];
    $v_return_phone_number  = $arr_single_record['C_RETURN_PHONE_NUMBER'];
    $v_return_email         = $arr_single_record['C_RETURN_EMAIL'];
    $v_return_date          = $arr_single_record['C_RETURN_DATE'];

    $v_xml_data             = $arr_single_record['C_XML_DATA'];

    $v_total_time           = $arr_single_record['C_TOTAL_TIME'];
    $v_record_type_code     = $arr_single_record['C_RECORD_TYPE_CODE'];

    //Convert date
    $v_receive_date         = jwDate::yyyymmdd_to_ddmmyyyy($v_receive_date, TRUE);

    $v_return_date_by_text  = $this->return_date_by_text($v_return_date);

    //$v_return_date          = jwDate::yyyymmdd_to_ddmmyyyy($v_return_date, TRUE);


}
else
{
    $v_record_id = 0;

    $v_record_no = $v_record_type_code . Date('dmyHis');
    $v_receive_date = Date('d-m-Y H:i:s');
    $v_return_phone_number = '';
    $v_return_email = '';

    $v_xml_data = '';

    $v_return_date = $arr_single_record['C_RETURN_DATE'];
    $v_return_date_by_text  = $this->return_date_by_text($v_return_date);

    $v_total_time = $arr_single_record['C_TOTAL_TIME'];
}

$v_record_id > 0 OR DIE();

//display header
$this->template->title = 'Bổ sung hồ sơ';
$this->template->display('dsp_header_pop_win.php');

?>
<form name="frmMain" id="frmMain" action="#" method="POST">
    <?php
    echo $this->hidden('controller',$this->get_controller_url());
    echo $this->hidden('hdn_item_id',$v_record_id);
    echo $this->hidden('hdn_item_id_list','');

    echo $this->hidden('hdn_update_method','do_supplement_record');

    echo $this->hidden('XmlData',$v_xml_data);

    echo $this->hidden('hdn_return_date',$v_return_date);
    echo $this->hidden('hdn_record_type_code',$v_record_type_code);
    ?>

    <div class="page-title">Bổ sung hồ sơ</div>

    <div class="panel_color">Thông tin chung</div>
    <div id="div_filter">
        <div class="Row">
            <div class="left-Col">
                Loại hồ sơ:
            </div>
            <div class="right-Col">
                (1)&nbsp;<label>Mã loại hồ sơ</label>
                <input type="text" name="txt_record_type_code" id="txt_record_type_code"
                    value="<?php echo $v_record_type_code; ?>"
                    class="inputbox upper_text" size="10" maxlength="10"
                    onkeypress="txt_record_type_code_onkeypress(event);"
                    autofocus="autofocus"
                    accesskey="1"
                    data-allownull="no" data-validate="text"
                    data-name="Loại hồ sơ"
                    data-xml="no" data-doc="no"
                    disabled
                    />&nbsp;
                <select name="sel_record_type" id="sel_record_type" style="width:75%; color:#000000;"
                        onchange="sel_record_type_onchange(this)"
                        data-allownull="no" data-validate="text"
                        data-name="Loại hồ sơ"
                        data-xml="no" data-doc="no" disabled>
                    <option value="">-- Chọn loại hồ sơ --</option>
                    <?php echo $this->generate_select_option($arr_all_record_type, $v_record_type_code); ?>
                </select>
                <input type="text" name="noname" style="visibility: hidden"/>
            </div>
        </div>
    </div>
    <div id="record_detail">
        <div class="Row">
            <div class="left-Col2">
                <div class="left-item-col">
                    Mã hồ sơ:
                    <span class="required">(*)</span>
                </div>
                <div class="right-item-col">
                    <input class="text ui-widget-content ui-corner-all" readonly="True" name="txt_record_no" id="txt_record_no" maxlength="50" style="width:200px" type="text" value="<?php echo $v_record_no;?>" data-allownull="no" data-validate="text" data-name="M&atilde; h&#7891; s&#417;" data-xml="no" data-doc="no" />
                </div>
            </div>
            <div class="right-Col2">
                <div class="left-item-col" style="width:35%">
                    Số điện thoại nhận SMS:
                </div>
                <div class="right-item-col" style="width:50%">
                    <input class="text ui-widget-content ui-corner-all" name="txt_return_phone_number" id="txt_return_phone_number" maxlength="20" style="width:200px" type="text" value="<?php echo $v_return_phone_number;?>" data-allownull="yes" data-validate="text" data-name="S&#7889; &#273;i&#7879;n tho&#7841;i nh&#7853;n SMS" data-xml="no" data-doc="no" />
                </div>
            </div>
        </div>
        <div class="Row">
            <div class="left-Col2">
                <div class="left-item-col">
                    Ngày giờ tiếp nhận:
                    <span class="required">(*)</span>
                </div>
                <div class="right-item-col">
                    <input class="text ui-widget-content ui-corner-all" readonly="readonly" id="txt_receive_date" name="txt_receive_date" style="width:200px" type="text" value="<?php echo $v_receive_date;?>" data-allownull="no" data-validate="text" data-name="Ngày giờ tiếp nhận" data-xml="no" data-doc="no" />
                </div>
            </div>
            <div class="right-Col2">
                <div class="left-item-col" style="width:35%">
                    Email:
                </div>
                <div class="right-item-col" style="width:50%">
                    <input class="text ui-widget-content ui-corner-all"
                           name="txt_return_email" id="txt_return_email"
                           maxlength="255" style="width:200px" type="text"
                           value="<?php echo $v_return_email;?>"
                           data-allownull="yes" data-validate="email"
                           data-name="Địa chỉ email"
                           data-xml="no" data-doc="no"
                    />
                </div>
            </div>
        </div>
        <div class="Row">
            <div class="left-Col2">
                <div class="left-item-col">
                    Thời gian giải quyết:
                </div>
                <div class="right-item-col">
                    <?php echo $v_total_time;?> ngày làm việc
                </div>
            </div>
            <div class="right-Col2"></div>
        </div>
        <div class="Row">
            <div class="left-Col2">
                <div class="left-item-col">
                    Ngày hẹn trả:
                    <span class="required">(*)</span>
                </div>
                <div class="right-item-col">
                    <input class="text ui-widget-content ui-corner-all" readonly="readonly" id="txt_return_date" name="txt_return_date" style="width:200px" type="text" value="<?php echo $v_return_date_by_text;?>" data-allownull="no" data-validate="text" data-name="Ng&agrave;y gi&#7901; h&#7865;n tr&#7843;" data-xml="no" data-doc="no" />
                </div>
            </div>
            <div class="right-Col2"></div>
        </div>

        <div id="xml_part">
            <?php echo $this->transform($this->get_xml_config($v_record_type_code, 'form_struct')); ?>
        </div>
    </div>

    <!-- Button -->
    <div class="button-area">
        <input type="button" name="update" class="button save" value="(2) Bổ sung" onclick="btn_update_onclick();" accesskey="2"/>
        <input type="button" name="cancel" class="button close" value="<?php echo __('close window'); ?>" onclick="window.top.hidePopWin();"/>
    </div>
</form>
<script>
    $(document).ready(function() {
        //Fill data
        var formHelper = new DynamicFormHelper('','',document.frmMain);
        formHelper.BindXmlData();

        try{$("#txtName").focus();}catch (e){;}
    });
</script>
<?php $this->template->display('dsp_footer_pop_win.php');