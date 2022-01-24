<?php

$sqliq = $select->list_evaluasi_psikologi_iq($ref, $departemen, $idtingkat, $idkelas, $nis, $idsemester);
$dataiq = $sqliq->fetch(PDO::FETCH_OBJ);

?>
<table border="1" width="100%" style="border: 0px solid #ccc">
			
	<tr style="background-color: #c8f2ff">
		<td align="center" style="font-weight: bold">
			ASPEK PSIKOLOGI
		</td>
		
		<td align="center" style="font-weight: bold">
			Nilai
		</td>
	</tr>
	
	<tr>
		<td align="center" style="font-weight: bold">
			IQ Siswa
		</td>
		
		<input type="hidden" name="old_ref" id="old_ref"  value="<?php echo $dataiq->ref ?>"/> 
		<input type="hidden" name="old_tanggal" id="old_tanggal"  value="<?php echo $dataiq->tanggal ?>"/>
			
		<td align="center" style="font-weight: bold">
	        <input type="text" style="min-width: 178px; text-align: center;"  name="iq" id="iq"  value="<?php echo $dataiq->iq ?>"/>     
	    </td>
	</tr>
				
	<?php 
		$i = 0;
		$sql = $select->list_aspek_psikologi("", $departemen);
		$jmldata_jenis_aspek = $sql->rowCount();
		while($data_aspek=$sql->fetch(PDO::FETCH_OBJ)) { 	
		
	?>
	
		
		<input type="hidden" id="jmldata_jenis_aspek" name="jmldata_jenis_aspek" value="<?php echo $jmldata_jenis_aspek; ?>" />
		<input type="hidden" id="jenis_aspek_id_<?php echo $i ?>" name="jenis_aspek_id_<?php echo $i ?>" value="<?php echo $data_aspek->replid ?>" />
		
				
		<tr>
			<td align="left" style="font-weight: bold; background-color: #ccc999">
                &nbsp; <?php echo abjad_convert($i+1) . ". " . $data_aspek->aspek ?>		                
            </td>
            
		</tr>
		
		<!--ASPEK DETAIL-->
    	<?php 
			$j = 0;
			$sql2 = $select->list_aspek_psikologi_detail("", $data_aspek->replid);
			$jml_aspek_detail = $sql2->rowCount();
			while($data_aspek_detail=$sql2->fetch(PDO::FETCH_OBJ)) { 	
			
		?>
				<input type="hidden" id="jml_aspek_detail_<?php echo $i ?>" name="jml_aspek_detail_<?php echo $i ?>" value="<?php echo $jml_aspek_detail; ?>" />
            	<tr>
            		<td>
            			&nbsp; <?php echo $j+1 . ". " . $data_aspek_detail->aspek ?>
            		</td>
            		
            		<?php 
            			$no = 0;
            			$linerow = "";
            			
            		
        				$linerow = $i.$j;
        				
        				$sqlnilai = $select->list_evaluasi_psikologi_nilai($ref, $data_aspek->replid, $data_aspek_detail->replid, $departemen, $idtingkat, $idkelas, $nis, $idsemester);
        				$datanilai = $sqlnilai->fetch(PDO::FETCH_OBJ);
        				$nilai = $datanilai->nilai;
        				if($datanilai->nilai == 0) {
							$nilai = "";
						}
        		?>
        		
            			<input type="hidden" name="aspek_psikologi_detail_id_<?php echo $linerow ?>" id="aspek_psikologi_detail_id_<?php echo $linerow ?>" value="<?php echo $data_aspek_detail->replid ?>"/>
            			<input type="hidden" name="old_line_<?php echo $linerow ?>" id="old_line_<?php echo $linerow ?>"  value="<?php echo $datanilai->line ?>"/>
            			
                		<td align="center">
                			<input type="text" style="width:50px; text-align: center;"  name="nilai_<?php echo $linerow ?>" id="nilai_<?php echo $linerow ?>"  onkeyup="formatangka('nilai_<?php echo $linerow ?>')" value="<?php echo $nilai ?>"/>
                		</td>
            		
            	</tr>
            	
    	<?php
    			$j++;
    		}
    	?>
        <!--END SPEK DETAIL-->
				
	<?php 
			$i++;
		} 
	?>
</table>
