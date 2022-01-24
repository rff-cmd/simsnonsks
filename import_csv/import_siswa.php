<?php

//$conn = new mysqli("localhost", "root", "", "build_system");

if (isset($_POST["import"])) {
	
	$conn = @mysqli_connect("localhost","root","","sekolahsma3");
	
	function random($number) 
	{
		$total = 0;
		if ($number)
		{
	    	for($i=1;$i<=$number;$i++)
			{
	       		$nr=rand(0,25);
	       		$total=$total.$nr;
	       	}
	    	return $total;
		}
	}


	function petikreplace($string="") {

		$string = str_replace("'","''",$string);
		
		return $string;	
	}

	function numberreplace($string="0") {

		$string = str_replace(",","",(empty($string)) ? 0 : $string);
		
		return $string;	
	}
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	$uid = "import";
		$dlu = date("Y-m-d H:i:s");
		$active = "1";
        
        $file = fopen($fileName, "r");
        
        $gagal = 0;
        $sukses = 0;
        $x = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	
        	if($x > 0) {
        		
        		$nis 		=  	$column[1];
				$nama 		= 	petikreplace($column[2]);
				$kelamin	= 	$column[3];
				$idkelas	= 	$column[5];
				$alumni		=	0;
				$uid		=	"import";
				$aktif		=	"1";
				
				if (!empty($nis))	 {
					
					$cekitem="select nis from siswa where nis='$nis'";
					$qdata=$conn->query($cekitem);
					$rowsitem=mysqli_num_rows($qdata);
					
					if($rowsitem == 0) {
						$query = "insert into siswa (nis, nama, kelamin, idkelas, alumni, uid, aktif) values ('$nis', '$nama', '$kelamin', '$idkelas', '$alumni', '$uid', '$aktif')";	   
						$hasil = $conn->query($query);	  
				  		
					} 
				  
				} 
				
				if ($hasil) {
					$sukses++;
				}  else {
				$gagal++;

				//echo $code . "---" . $name."<br>";
				}
				
			}
			
			$x++;
			
        }
        
        
        
	     
    }
    
    
    // tampilan status sukses dan gagal
	echo "<h3>Proses import data selesai.</h3>";
	echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
	echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
	font-family: Arial;
	width: 550px;
}

.outer-scontainer {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 20px;
	border-radius: 2px;
}

.input-row {
	margin-top: 0px;
	margin-bottom: 20px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
	color: #f0f0f0;
	font-size: 0.9em;
	width: 100px;
	border-radius: 2px;
	cursor: pointer;
}

.outer-scontainer table {
	border-collapse: collapse;
	width: 100%;
}

.outer-scontainer th {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.outer-scontainer td {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>
    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               
    </div>

</body>

</html>