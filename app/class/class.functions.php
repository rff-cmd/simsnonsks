<?php
//include("../../app/include/sambung.php");

class functions{	
	
	//---------get GetTarif_Range_Satu_DL
	function GetTarif_Range_Satu_DL($Ref='', $Kapasitas=0, $Total_Tarif=0){
		odbc_exec(condb,"delete Barang_Range_Satu_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1) {
				if ( $Kapasitas >= $Dari && $Kapasitas <= $smp) { 
					odbc_exec(condb,"Insert Into Barang_Range_Satu_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");					
				} else {
					odbc_exec(condb,"Insert Into Barang_Range_Satu_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 2) {
				if ( $Kapasitas > $Dari) { 
					$sum_tarif = 0;
					$kapasitas2 = 0;
					$result2 = odbc_exec(condb,"select sum(tarif) tarif from Barang_Range_Satu_Tmp where Ref='$Ref' order by ref");
					$data2 = odbc_fetch_object($result2);
					$sum_tarif = $data2->tarif;
						
					$kapasitas2	= floor($Kapasitas / 10);
					if ($kapasitas2 == $Kapasitas / 10) 
					{
						$kapasitas2 = floor($kapasitas2-0.1);
					} 
					else 
					{
						$kapasitas2 = floor($Kapasitas / 10);
					}
							
					odbc_exec(condb,"insert Into Barang_Range_Satu_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * $kapasitas2)");				
				} 
			}
			
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Satu_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
		
	}
	
	
	//---------get GetTarif_Range_Dua_DL
	function GetTarif_Range_Dua_DL($Ref='', $kapasitas=0, $Total_Tarif=0){
		odbc_exec(condb,"delete Barang_Range_Dua_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			if($no == 1) {
				if ( $kapasitas >= $dari && $kapasitas <= $smp) { 
					odbc_exec(condb,"Insert Into Barang_Range_Dua_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");					
				} else {
					odbc_exec(condb,"Insert Into Barang_Range_Dua_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 2) {
				if ( $kapasitas >= $dari) { 
					$kapasitas_next = ceil($kapasitas/1000)-3;
						
					odbc_exec(condb,"Insert Into Barang_Range_Dua_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $kapasitas_next * $tarif)");					
				} 
			}
			
		
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Dua_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
	
	}
	
	
	//---------get GetTarif_Range_Tiga_DL
	function GetTarif_Range_Tiga_DL($Ref='', $Kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Tiga_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
						
			if ( $kapasitas > $dari) { 
				odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
					values ('$Ref', $smp, $tarif * $kapasitas)");					
			}
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Tiga_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
			
	}
	
	//---------get GetTarif_Range_Empat_DL
	function GetTarif_Range_Empat_DL($Ref='', $Kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Empat_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1) {
				if ( $Kapasitas > $Dari && $Kapasitas <= $smp) { 
				
					odbc_exec(condb,"Insert Into Barang_Range_Empat_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * $kapasitas)");					
				} else {
					if ($Kapasitas == 0) {
						odbc_exec(condb,"Insert Into Barang_Range_Empat_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, 0)");
					} else {
						odbc_exec(condb,"Insert Into Barang_Range_Empat_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * $smp)");
					}
				}
			}	
			
			if($no == 2) {
				$tarif_kedua = ($smp - $dari) * $tarif;
				if ( $Kapasitas > $dari && $Kapasitas <= $smp) { 
				
					if ( ($Kapasitas > $dari) && ($Kapasitas - $smp <= $smp) )  {
						
						odbc_exec(condb,"Insert Into Barang_Range_Empat_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, ($tarif * ($Kapasitas-$smp1)) )");
						
					}
					
					if ( $Kapasitas > $smp ) {
						odbc_exec(condb,"Insert Into Barang_Range_Empat_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif_kedua )");
					} 						
										
				}
				
			}
			
			if($no == 3) {
				if ( $Kapasitas > $smp ) {
					
					$smp2 = $Kapasitas - $smp;
					odbc_exec(condb,"Insert Into Barang_Range_Empat_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * $smp2 )");
						
				}
			}
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Empat_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
		
		
	}
			
	//---------get GetTarif_Range_DL
	function GetTarif_Range_DL($Ref='', $kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Tiga_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1 || $no == 2 || $no == 3) {
				if ( $kapasitas >= $dari && $kapasitas <= $smp) { 
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");					
				}
			}	
			
			if($no == 4) {
				$tarif_lima	= 0;
				$tarif_lima = 0;
				$tarif_lima = $tarif;
				
				if ( $kapasitas >= $dari and $kapasitas <= $smp ) { 
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");					
				}
			}
			
			if($no == 5) {
				if ( $kapasitas > $dari ) { 
					$smp4 = 0;
					$smp4 = ceil( ($kapasitas - $smp)/1000 );
						
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");					
				}
			}					
						
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Tiga_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
	}
	
	
	//---------get GetTarif_Range_Enam_DL
	function GetTarif_Range_Enam_DL($Ref='', $kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Tiga_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1) {
				if ( $kapasitas > $dari && $kapasitas <= $smp ) { 
						
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * $kapasitas)");					
				} else {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * $smp)");
						
					$smp1 = $smp;
					$tarif1 = $tarif;
						
				}
			}
			
			if($no == 2) {
				if ( $kapasitas > $dari && $kapasitas <= $smp ) { 
					
					if ( ($kapasitas > $dari) && ($kapasitas - $smp <= $smp) ) {
						odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * ($kapasitas-$smp1))");	
					} else {
						odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * ($kapasitas-$smp))");
					}	
									
				} 
				
				if ($kapasitas > $smp) {
					$smp2 = $smp;
					//$tarif2 = $tarif;
						
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * ($smp-$smp1))");
												
				}
			}
			
			if($no == 3) {
				if ($kapasitas > $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif * ($kapasitas-($smp2-$smp1)-$smp1))");
				}
			}			
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Tiga_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
		
	}
	
	
	//---------get GetTarif_Range_Tujuh_DL
	function GetTarif_Range_Tujuh_DL($Ref='', $kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Tiga_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1) {
				if ($kapasitas > $dari && $kapasitas <= $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 2) {
				if ($kapasitas >= $dari && $kapasitas <= $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 3) {
				if ($kapasitas >= $dari) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Tiga_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
		
	}
	
	
	//---------get GetTarif_Range_Delapan_DL
	function GetTarif_Range_Delapan_DL($Ref='', $kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Tiga_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1) {
				if ($kapasitas > $dari && $kapasitas <= $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 2) {
				if ($kapasitas >= $dari && $kapasitas <= $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 3) {
				if ($kapasitas >= $dari && $kapasitas <= $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
			if($no == 4) {
				if ($kapasitas >= $dari) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Tiga_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
		
	}
	
	
	//---------get GetTarif_Range_Sembilan_DL
	function GetTarif_Range_Sembilan_DL($Ref='', $kapasitas=0, $Total_Tarif=0){
		
		odbc_exec(condb,"delete Barang_Range_Tiga_Tmp where Ref='$Ref'");
		
		$no		= 0;
		$Dari	= 0;
		$smp 	= 0;
		$smp1 	= 0;
		$tarif 	= 0;
		$tarif1	= 0;
		$smp2 	= 0;
		$tarif_kedua = 0;
		
		$result = odbc_exec(condb,"select Dari, Smp, Tarif from Barang_Range_Det where Ref='$Ref' order by no");		while($data = odbc_fetch_object($result)) {
			
			$no++;
			
			$Dari = $data->Dari;
			$smp = $data->Smp;
			$tarif = $data->Tarif;
			
			if($no == 1) {
				if ($kapasitas > $dari and $kapasitas <= $smp) {
					odbc_exec(condb,"Insert Into Barang_Range_Tiga_Tmp(Ref, Kapasitas, Tarif) 
						values ('$Ref', $smp, $tarif)");
				}
			}
			
		}
		
		$result = odbc_exec(condb,"select sum(Tarif) tarif From Barang_Range_Tiga_Tmp where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$Total_Tarif = $data->tarif;
		
		return $Total_Tarif;
		
	}
		
	//--------Formula_Tera
	function Formula_Tera($Ref='', $Kapasitas=0, $Total_Tarif=''){
		$TipeID	= 0;
		$result = odbc_exec(condb,"select TipeID from Barang_Range where Ref='$Ref'");
		$data = odbc_fetch_object($result);
		$TipeID = $data->TipeID;
		
		if($TipeID == 1) {
			$Total_Tarif = $this->GetTarif_Range_Satu_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 2) {
			$Total_Tarif = $this->GetTarif_Range_Dua_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 3) {
			$Total_Tarif = $this->GetTarif_Range_Tiga_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 4) {
			$Total_Tarif = $this->GetTarif_Range_Empat_DL($Ref, $Kapasitas, $Total_Tarif);
		}
						
		if($TipeID == 5) {
			$Total_Tarif = $this->GetTarif_Range_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 6) {
			$Total_Tarif = $this->GetTarif_Range_Enam_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 7) {
			$Total_Tarif = $this->GetTarif_Range_Tujuh_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 8) {
			$Total_Tarif = $this->GetTarif_Range_Delapan_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		if($TipeID == 8) {
			$Total_Tarif = $this->GetTarif_Range_Sembilan_DL($Ref, $Kapasitas, $Total_Tarif);
		}
		
		return $Total_Tarif;
	}
	
		
}
?>