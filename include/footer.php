<?php
//ตรวจสอบว่ามีการเข้ามายังหน้านี้โดยตรงหรือไม่
if (!defined('WEB_ROOT')) {
	exit;
}
?>

<!--แสดงข้อมูลของเว็บไซต์ที่ด้านล่างของเว็บเพจ-->
<div class="row">
  	<div class="col-md-12">
		<hr>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
 <tr>
  <td align="center">
    <p>&copy;  <?php echo
    $shopConfig['name']; ?></p>
   <p>Address : ร้านชัยสิทธิ์เกษตร Chaiyasit Kaset
          จำหน่าย ยากำจัดวัชพืช ยากำจัดแมลง ยาปราบศัตรูพืช อาหารเสริมพืชนานาชนิด
          เลขที่  36/1 ม.3 ต.หนองบัว  อ.บ้านแพ้ว จ.สมุทรสาคร 74120   
            <?php echo $shopConfig['address']; ?><br>
    Phone : 081-9177716  <?php echo $shopConfig['phone']; ?><br>
    Email : chaiyasitkaset@gmail.com <a href="mailto:<?php echo $shopConfig['email']; ?>"><?php echo $shopConfig['email']; ?></a><br>
   <p><br>
   </p>
   </td>
    </tr>
        </table>
 

	</div>
</div>

<script>
  $(function() {
    $('.dropdown-toggle').dropdown();	//สำหรับการคลิก dropdown menu ใน Bootstrap
  });
</script>
</div><!-- ปิดส่วนของคลาส container -->
</body>
</html>