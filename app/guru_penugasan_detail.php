<div class="col-sm-7">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Mengajar</h4>
		</div>
        
        <table id="simple-table" class="table table-striped table-bordered table-hover">

            <thead>
        		<tr>            
        			<?php
        				$idtingkat = array();
        				$sql=$select->list_tingkat();
        				while($row_tingkat=$sql->fetch(PDO::FETCH_OBJ)) {
        					
        					$idtingkat[] = $row_tingkat->replid;
        			?>
		        			<th align="center">Tingkat <?php echo $row_tingkat->tingkat ?></th> 
        			<?php
        				}
        			?>
        			<input type="hidden" id="datakelas" name="datakelas" value="<?php echo count($idtingkat); ?>" >
        		</tr>
        	</thead>
            

        	<tbody>
            
                    <tr>
                    	<?php
                    		for($no=0; $no<count($idtingkat); $no++) {
                    	?>
                    			<td>
		                			<table>
					                    <?php         
					                    	$jmldata = 0;    	
					                    	$sql=$select->get_guru_kelas($idtingkat[$no]);
							        		$jmldata = $sql->rowCount();
							            	$x = 0;					
							            	while($row_guru_penugasan=$sql->fetch(PDO::FETCH_OBJ)) { 
							        		
							            ?>
							            	<tr style="background-color:ffffff;"> 
						        				<td width="200">
						        					Kelas : <?php echo $row_guru_penugasan->kelas; ?> &nbsp;
						        					<input type="checkbox" class="ace" id="pilihkelas_<?php echo $no.$x; ?>" name="pilihkelas_<?php echo $no.$x; ?>" value="1" ><span class="lbl"></span>
						        				</td>
						        			</tr>
						        			
						        			<input type="hidden" id="idkelas_<?php echo $no.$x; ?>" name="idkelas_<?php echo $no.$x; ?>" value="<?php echo $row_guru_penugasan->replid; ?>" >
						        			
					        			<?php
					        					$x++;
					        				}
					        			?>
				        			</table>
		        				</td>
		        				
		        				<input type="hidden" id="idtingkat_<?php echo $no; ?>" name="idtingkat_<?php echo $no; ?>" value="<?php echo $idtingkat[$no]; ?>" >
		        				<input type="hidden" id="jmldata_<?php echo $no; ?>" name="jmldata_<?php echo $no; ?>" value="<?php echo $jmldata; ?>" >
                    	<?php
                    		}
                    	?>
        				
        			</tr>
        			           
        	</tbody>
        </table>

    </div>
</div>