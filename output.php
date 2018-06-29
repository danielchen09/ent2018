<!doctype html>
<html>
	<body>
		<?php
			ini_set('display_errors', 1);
			ini_set('displat_startup_errors', 1);
			error_reporting(E_ALL);
			session_start();
			include("../classes.php");

			$h=new HospitalData("https://www.nhi.gov.tw/SysService/SevereAcuteHospital.aspx");
			$html=$h->getHtml();
			preg_match_all("~<a[^>]*>(.*)</a>~U", $html, $names);
			preg_match_all("~([0-9]+)</div>~isU", $html, $admission);
			preg_match_all("~\s(是|否)~isU", $html, $full);
			preg_match_all("~([0-9]+)</td>~isU", $html, $others);
			preg_match_all("~IP_[A-Z]~isU", $html, $status);
			$newOther=array(array());
			for($i=0; $i<count($others[0])/3; $i++){
				$newOther[$i]=array($others[0][3*$i], $others[0][3*$i+1], $others[0][3*$i+2]);
			}
			for($i=0; $i<count($names[0]); $i++){
				echo $names[0][$i] . " | " . $admission[0][$i] . " | " . $newOther[$i][0] . " | " . $newOther[$i][1] . " | " . $newOther[$i][2] . " | " . $full[0][$i] . " | " . $status[0][$i][3] . "<br>";
			}
			
			/*
			name: ~<a[^>]*>(.*)</a>~U
			admission: ~([0-9]+)</div>~isU
			other: ~([0-9]+)</td>~isU
			full: ~\s(是|否)~isU
			status: ~IP_[A-Z]~isU
			<tr>
				<td id="t11" headers="t1" class="HospTitle">
					<b class="ui-table-cell-label">簡稱</b> 
					<a href="http://tyghnetreg.tygh.mohw.gov.tw/EmgBoardWeb/BoardWebPageLoby.aspx" class="ui-link">桃園醫院</a>
				</td> 
				<td id="t21" headers="t2">
					<b class="ui-table-cell-label ui-table-cell-label-top">
						<b> 等待人數 </b>
					</b>
					<b class="ui-table-cell-label">住院</b>
					<div class="IP_R">9</div>
				</td>
				<td id="t31" headers="t3">
					<b class="ui-table-cell-label">看診</b>
					 4
				</td>
				<td id="t41" headers="t4">
					<b class="ui-table-cell-label">推床</b>
					0
				</td>
				<td id="t51" headers="t5">
					<b class="ui-table-cell-label">加護病床</b>
					0
				</td>
					<td id="t61" headers="t6" class="li_lastchild">
					<b class="ui-table-cell-label">是否已向119通報滿床</b> 
					否
				</td>
			</tr>
			
			

			output:
			桃園醫院	9	4	0	0	否
			*/

			/*
			<tr>(.*)</tr>
			*/
		?>
	</body>
</html>