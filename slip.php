<form action="myorder.php?action=addsend" method="post" enctype="multipart/form-data" name="frm_login" id="frm_login" onSubmit="return checks()">
  <table width="628" border="0" align="center">
	      <tr>
            <td colspan="3" align="center" class="style23"><table width="700" height="44" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left"><table width="700" height="33" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="50" align="center" bgcolor="#FFFFFF" class="style32">ข้อมูลการแจ้งโอนเงิน</td>
                    <td width="66%" align="center" bgcolor="#FFFFFF" class="style33" style="color: #FF6600">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
	      </tr>
	      <tr>
            <td width="230" align="right" class="style23">&nbsp;</td>
	        <td colspan="2" class="style23">&nbsp;</td>
	        </tr>
	      <tr>
            <td align="right" class="style23">รหัสบิล :</td>
	        <td colspan="2" class="style23"><?=$idbill?>
	          <input name="sp" type="hidden" id="sp" value="<?=$sp?>" /></td>
	        </tr>
	      <tr>
            <td align="right" class="style23">แนบสลิปการโอนเงิน : </td>
	        <td colspan="2" class="style23"><input name="file" type="file" id="file" size="20" />
              <input name="idbill" type="hidden" id="idbill" value="<?=$idbill?>"/></td>
	        </tr>
	      <tr>
            <td align="right" class="style23">จำนวนเงินที่โอน : </td>
	        <td width="216" class="style23"><label>
              <input name="money" type="text" class="input1" id="money" value="<?=$money?>" />
            </label></td>
	        <td width="246" class="style23">&nbsp;</td>
	        </tr>
	      <tr>
            <td align="right" class="style23">ธนาคาร : </td>
	        <td class="style23"><select name="bank" class="input1" id="bank">
	          <option value="ธนาคารกสิกรไทย  839-206-306-5" selected="selected">ธนาคารกสิกรไทย  839-206-306-5</option>
              <option value="ธนาคารไทยพาณิชย์ 769-245-380-7">ธนาคารไทยพาณิชย์ 769-245-380-7</option>
              <option value="ธนาคารกรุงไทย 224-039-376-9">ธนาคารกรุงไทย224-039-376-9</option>

	          </select></td>
	        <td class="style23">&nbsp;</td>
	        </tr>
	      
	      
          <tr>
            <td align="right" class="style23">&nbsp;</td>
            <td colspan="2" class="style23"><table width="117" border="0">
              <tr>
                <td width="56"><input name="Submit4" type="submit" class="submit1" value=" แก้ไข " /></td>
                <td width="51"><input name="Submit33" type="button" class="submit1"  onclick="parent.location='myorder.php'" value=" กลับ "/></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="3" align="center" class="style13"><p><a href="viewpic.php?idbill=<?=$idbill;?>&amp;fill=idbill&amp;tb=orderproduct&amp;pic=inform_pic" target="_blank"><img src="show.php?id=<?=$idbill;?>&amp;fill=idbill&amp;tb=orderproduct&amp;pic=inform_pic"  width="400"  border="0"/></a></p>
              <p>&nbsp;</p></td>
          </tr>
        </table>
      </form>