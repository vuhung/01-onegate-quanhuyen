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

if (!defined('SERVER_ROOT')) exit('No direct script access allowed');?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>In giấy yêu cầu hồ sơ</title>
        <link rel="stylesheet" href="<?php echo SITE_ROOT;?>public/css/reset.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo SITE_ROOT;?>public/css/text.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo SITE_ROOT;?>public/css/printer.css" type="text/css" media="all" />
        <script src="<?php echo SITE_ROOT;?>public/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo SITE_ROOT;?>public/js/mylibs.js" type="text/javascript"></script>
    </head>
    <body>
    	<div class="print-button">
    		<input type="button" value="In trang"
    			onclick="window.print();" /> <input type="button"
    			value="Đóng cửa sổ" onclick="window.parent.hidePopWin()" />
    	</div>
    	<div>
		    <?php $dom_unit_info = simplexml_load_file(SERVER_ROOT . 'public/xml/xml_unit_info.xml');?>
            <!-- header -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="header">
                <tr>
                    <td align="center" class="unit_full_name">
                        <?php echo get_xml_value($dom_unit_info, '/unit/full_name');?><br/>
                        <strong style="font-size: 13px;text-decoration: underline;">
                        <script>w(parent.$("#hdn_approving_group_name").val());</script>
                        </strong>
                    </td>
                    <td align="center">
                        <span style="font-size: 12px">
                            <strong>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong>
                        </span>
                        <br/>
                        <strong>
                            <u style="font-size: 10px">Độc lập - Tự do - Hạnh phúc</u>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="right italic" style="text-align: right;padding:20px 30px 0px 0px;">
                        <?php echo get_xml_value($dom_unit_info, '/unit/name');?>, ngày <?php echo Date('d-m-Y');?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="report-title">
                        <span class="title-1">PHIẾU TỪ CHỐI HỒ SƠ</span><br/>
                    </td>
                </tr>
            </table>
            <!-- Message -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td colspan="2" class="center">
                        <b><u>Kính gửi:</u></b><i> Bộ phận Một cửa</i>
                    </td>
                </tr>
                <tr>
                    <td>
                        <script>
                            w(parent.$("#hdn_approving_group_name").val() + ' nhận được hồ sơ "' + parent.$("#hdn_record_type_name").val() + '" do Bộ phận Một cửa chuyển xuống.');
                            w('<br/><br/>'); 
                            w('Sau khi kiểm tra hồ sơ, đối chiếu với quy định pháp luật về "' + parent.$("#hdn_record_type_name").val() + '", '); 
                            w(parent.$("#hdn_approving_group_name").val() + ' từ chối xét duyệt các hồ sơ sau đây:'); 
                            //w('<br/><br/>'); 
                            //w('<u>Cụ thể như sau</u>:'); 
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <script>w(parent.$("#record_list").html());</script>
                    </td>
                </tr>
                <tr>
                    <td><u>Lý do</u>:</td>
                </tr>
                <tr>
                    <td>
                        <script>w('<textarea class="note-writer" rows="3">' + parent.$("#txt_reason").val() + '</textarea>');</script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Vậy, <script>w(parent.$("#hdn_approving_group_name").val()); </script> thông báo cho bộ phận "Một-Cửa" được biết và phối hợp thực hiện.
                    </td>
                </tr>
            </table>    
            <br/><br/><br/>
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td class="left" >
                        <b>Nơi nhận: </b> <br/> - Như trên; <br/>- TT UBND TP; <br/> - Bộ phận "Một cửa"; <br/> - Lưu VT;
                    </td>
                    <td style="text-align: center">
                        <b>KT.TRƯỞNG PHÒNG <br/> PHÓ TRƯỞNG PHÒNG</b>
                    </td>
                </tr>
            </table>
    	</div>
    </body>
</html>