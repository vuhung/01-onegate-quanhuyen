<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="UTF-8"/>
	<xsl:param name="p_site_root" select="0"/>
	<xsl:param name="p_current_date" select="current-date()"/>

	<xsl:template match="/">
		<table border="0" width="100%" class="main_table" cellpadding="1" cellspacing="0">
			<xsl:for-each select="form/line">
					<tr>
					<xsl:attribute name="class">
						<xsl:if test="position() mod 2 = 0">
							xslgridrow
						</xsl:if>
					</xsl:attribute>
						<td style="width:100%">
							<xsl:if test="@label!=''">
								<table class="panel_table" border="0" style="width:100%" cellpadding="0" cellspacing="0">
									<tr class="panel_color">
										<td colspan="4" height="25px">
											<span class="@css">
												<xsl:value-of select="@label"/>
											</span>
										</td>
									</tr>
								</table>
							</xsl:if>
							<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
								<tr>
									<xsl:if test="@cols='1'">
										<xsl:for-each select="item">
											<td width="20%" class="text_color">
												<xsl:if test="@allownull='no'">
													<xsl:value-of select="@label"/>
													<span class="text_color_red">(*)</span>
												</xsl:if>
												<xsl:if test="@allownull='yes'">
													<xsl:value-of select="@label"/>
												</xsl:if>
											</td>
											<td width="80%">
												<xsl:call-template name="find_control">
													<xsl:with-param name="ControlType">
														<xsl:value-of select="@type"/>
													</xsl:with-param>
												</xsl:call-template>
											</td>
										</xsl:for-each>
									</xsl:if>
									<xsl:if test="@cols='2'">
										<xsl:for-each select="item">
											<td width="20%" class="text_color">
												<xsl:if test="@allownull='no'">
													<xsl:value-of select="@label"/>
													<span class="text_color_red">(*)</span>
												</xsl:if>
												<xsl:if test="@allownull='yes'">
													<xsl:value-of select="@label"/>
												</xsl:if>
											</td>
											<td width="30%">
												<xsl:call-template name="find_control">
													<xsl:with-param name="ControlType">
														<xsl:value-of select="@type"/>
													</xsl:with-param>
												</xsl:call-template>
											</td>
										</xsl:for-each>
									</xsl:if>

									<xsl:if test="@cols='0'">
										<td width="20%" class="panel_color"></td>
										<td width="80%" class="panel_color" colspan="3" align="left">
											<xsl:for-each select="item">
												<xsl:call-template name="find_control">
													<xsl:with-param name="ControlType">
														<xsl:value-of select="@type"/>
													</xsl:with-param>
												</xsl:call-template>
											</xsl:for-each>
										</td>
									</xsl:if>
									<xsl:if test="@cols='3'">
										<td width="20%" class="text_color">
											<span class="text_color">
												<xsl:value-of select="@label"/>
											</span>
										</td>
										<td width="80%" class="text_color" colspan="3" align="left">
											<xsl:for-each select="item">
												<xsl:call-template name="find_control">
													<xsl:with-param name="ControlType">
														<xsl:value-of select="@type"/>
													</xsl:with-param>
												</xsl:call-template>
											</xsl:for-each>
										</td>
									</xsl:if>
								</tr>
							</table>
						</td>
					</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	
	<!--*********************************************************************************************************-->
	
	<xsl:template name="find_control">
		<xsl:param name="ControlType"/>
		<xsl:choose>
			<xsl:when test="$ControlType = 'TextboxName'">
				<xsl:call-template name="CreateTextboxName"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'TextboxMoney'">
				<xsl:call-template name="CreateTextboxMoney"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'Textbox'">
				<xsl:call-template name="CreateTextbox"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'TextboxDate'">
				<xsl:call-template name="CreateTextboxDate"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'DropDownList'">
				<xsl:call-template name="CreateDropDownList"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'RadioButton'">
				<xsl:call-template name="CreateRadioButton"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'Textarea'">
				<xsl:call-template name="CreateTextArea"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'Button'">
				<xsl:call-template name="CreateButton"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'MultiCheckbox'">
				<xsl:call-template name="CreateMultiCheckbox"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'Checkbox'">
				<xsl:call-template name="CreateCheckbox"/>
			</xsl:when>
			<xsl:when test="$ControlType = 'TextboxArea'">
				<xsl:call-template name="CreateTextboxArea"/>
			</xsl:when>
			<xsl:otherwise>This object [<xsl:value-of select="$ControlType"/>] not found</xsl:otherwise>
		</xsl:choose>
	</xsl:template>

	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateTextboxArea">
		<xsl:if test="@id='txtTaiLieuKhac'">
			<textarea id="{@id}" cols="{@size}" class="text  valid" style="display:none;" rows="10" value="{@defaul_value}" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes" data-doc="{@doc}">&#x20;
			</textarea>
		</xsl:if>
		<xsl:if test="@id!='txtTaiLieuKhac'">
			<textarea id="{@id}" cols="{@size}" class="text  valid" rows="10" value="{@defaul_value}" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes" data-doc="{@doc}">&#x20;
			</textarea>
		</xsl:if>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box has even-->
	<xsl:template name="CreateTextboxMoney">
		<input type="textbox" id="{@id}" class="text  valid" size="{@size}" value="{@defaul_value}" onfocusout="ReadNumberToString('{@id}','lbl_mess_{@id}');" onkeyup="{@Even}" maxlength="15" onKeyDown="return handleEnter(this, event);"
		       data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes" data-doc="{@doc}"
			   onfocus="this.value=removeCommas(this.value)" />			   
		<br/>
		<span id="lbl_mess_{@id}" class="{@css}"></span>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box has even-->
	<xsl:template name="CreateTextboxName">

		<input type="textbox" id="{@id}" class=" text  valid" size="{@size}" value="{@defaul_value}" onkeyup="{@Even}" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes"
		       data-doc="{@doc}"/>
		<br/>
		<span id="lbl_mess_{@id}" class="{@css}"></span>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateTextbox">
		<input type="textbox" id="{@id}" class=" text  valid" size="{@size}" value="{@defaul_value}" onkeyup="{@Even}" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes"
		       data-doc="{@doc}"/>
		<xsl:if test="@legend != ''">
			<label><xsl:value-of select="@legend" disable-output-escaping="yes" /></label>
		</xsl:if>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateDropDownList">
		<select id="{@id}" class="ddl" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes" data-doc="{@doc}">
			<xsl:for-each select="document(@src_file)//item">
				<!--<xsl:sort select="@name" order="ascending" lang="vi" />-->
				<option value="{@value}">
					<xsl:value-of select="@name"/>
				</option>
			</xsl:for-each>
		</select>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateRadioButton">
		<input type="radio" id="{@id}" name="{@gioitinh}" value="{@value}" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@text}" data-xml="yes" data-doc="{@doc}">
			<label for="{@id}">
				<xsl:value-of select="@text"/>
			</label>
		</input>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateTextboxDate">
		<xsl:if test="@defaul_value!=''">
			<xsl:if test="@defaul_value!= 'current-date()'">
				<input type="textbox" id="{@id}" class=" text  valid" size="{@size}" value="{@defaul_value}" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes"
				       data-doc="{@doc}"/>
			</xsl:if>
			<xsl:if test="@defaul_value = 'current-date()'">
				<input type="textbox" id="{@id}" class=" text  valid" size="{@size}" value="{$p_current_date}" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes"
				       data-doc="{@doc}"/>
			</xsl:if>
		</xsl:if>
		<xsl:if test="@defaul_value=''">
			<input type="textbox" id="{@id}" class=" text  valid" value="Ngày/Tháng/Năm" size="{@size}" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes"
			       data-doc="{@doc}"/>
		</xsl:if>
		<xsl:text disable-output-escaping="yes">&amp;nbsp</xsl:text>
		<img class="btndate" style="cursor:pointer" id="btnDate" src="{$p_site_root}public/images/calendar.gif" onclick="DoCal('{@id}')"/>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateTextArea">
		<textarea id="{@id}" cols="{@col}" class=" text  valid" rows="{@row}" value="{@defaul_value}" onKeyDown="return handleEnter(this, event);" data-allownull="{@allownull}" data-validate="{@validate}" data-name="{@name}" data-xml="yes"
		          data-doc="{@doc}"/>
	</xsl:template>
	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateButton">
		<input type="button" class="ClassButton" value="{@value}" onClick="{@ObjList}"/>
	</xsl:template>

	<!--***********************************************************************************************
  Call this template when object is normal text box-->
	<xsl:template name="CreateMultiCheckbox">
		<div style="overflow: auto; width: 100%; height:120px; padding-left:0px;margin:0px">
			<table>
				<xsl:for-each select="document(@src_file)//item">
					<tr>
						<td>
							<input type="checkbox" id="{@item_id}" name="Fields" value="{@value}" onKeyDown="return handleEnter(this, event);" data-name="{@text}" data-xml="yes" data-doc="{@doc}"/>
							<label for="{@item_id}">
								<xsl:value-of select="@text"/>
							</label>
						</td>
					</tr>
				</xsl:for-each>
			</table>
		</div>
	</xsl:template>

	<!--***********************************************************************************************
  Call this template when object is check box-->
	<xsl:template name="CreateCheckbox">
		<table border="0">
			<tr>
				<td align="top" style="width:1%">
					<xsl:if test="@id='ckbTaiLieuKhac'">
						<input type="checkbox" id="{@id}" onclick="Textarea('{@id}','{@id}_div');" onKeyDown="return handleEnter(this, event);" data-name="{@title}" data-xml="yes" data-doc="{@doc}"/>
					</xsl:if>
					<xsl:if test="@id!='ckbTaiLieuKhac'">
						<input type="checkbox" id="{@id}" data-name="{@title}" data-xml="yes" data-doc="{@doc}"/>
					</xsl:if>
				</td>
				<td class="text_check">
					<label for="{@id}">
						<xsl:value-of select="@title"/>
					</label>
				</td>
			</tr>
			<tr style="display:none">
				<td colspan="2">
					<div id="{@id}_div" style="display:none;"></div>
				</td>
			</tr>
		</table>
	</xsl:template>
</xsl:stylesheet>
