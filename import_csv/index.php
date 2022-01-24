<?php

//$conn = new mysqli("localhost", "root", "", "build_system");

if (isset($_POST["import"])) {
	
	$conn = @mysqli_connect("localhost","root","","build_system");
	
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
        
        $x = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	
        	if($x > 0) {
        		
        		//brand
	        	$nama_merk 	= $column[4]; 
				$brand_code	= substr($nama_merk, 0, 5);
				$brand_id	= 0;
				
				if($nama_merk != "") {
					$sqlmerk = "select id from brand where name='$nama_merk'";
					$queryrslt=$conn->query($sqlmerk);
					$data_brand = $queryrslt->fetch_object();
					$rowscat=mysqli_num_rows($queryrslt);
					
					if($rowscat == 0) {
						
						if($nama_merk != "") {
							$sqlinscat="insert into brand (code, name, active, uid, dlu) values ('$brand_code', '$nama_merk', '$active', '$uid', '$dlu')";
							$sql=$conn->query($sqlinscat);
										
							$strlast="select last_insert_id() id";
							$rsltcat=$conn->query($strlast);
							$datacat=$rsltcat->fetch_object();
							$brand_id=$datacat->id;
						}
						
					} else {
						$strlast="select id from brand where name='$nama_merk'";
						$rsltcat=$conn->query($strlast);
						$datacat=$rsltcat->fetch_object();
						$brand_id=$datacat->id;
					}
				}
				//-------------
				
				//group item
	        	$nama_group 	= $column[6]; 
				$group_code		= $column[5]; 
				
				if($nama_group != "") {
					$sqlmerk = "select id from item_group where code='$group_code'";
					$queryrslt=$conn->query($sqlmerk);
					$data_group = $queryrslt->fetch_object();
					$rowscat=mysqli_num_rows($queryrslt);
					
					if($rowscat == 0) {
						
						if($group_code != "") {
							$sqlinscat="insert into item_group (code, name, active, uid, dlu) values ('$group_code', '$nama_group', '$active', '$uid', '$dlu')";
							echo $sqlinscat."<br>";
							$sql=$conn->query($sqlinscat);
										
							$strlast="select last_insert_id() id";
							$rsltcat=$conn->query($strlast);
							$datacat=$rsltcat->fetch_object();
							$group_id=$datacat->id;
						}
						
					} else {
						$strlast="select id from item_group where code='$group_code'";
						$rsltcat=$conn->query($strlast);
						$datacat=$rsltcat->fetch_object();
						$group_id=$datacat->id;
						
					}
				}
				//-------------
				
	            
	            $code =  str_replace(".","",$column[1]); //$data->val($i, 2);
				$old_code = $column[1]; //$data->val($i, 2);
				$name = petikreplace($column[3]);
				$item_group_id= $group_id;
				$item_subgroup_id="0";
				$item_type_code="0";
				$brand_id=$brand_id;
				$size_id="";
				$minimum_stock="0";
				$maximum_stock="0";
				$photo="";
				$uom = "pcs";
				$item_category_id = "0";
				
				$syscode = random(25);
				
				
				if (!empty($code))	 {
					
					$cekitem="select code from item where code='$code'";
					$qdata=$conn->query($cekitem);
					$rowsitem=mysqli_num_rows($qdata);
					
					if($rowsitem == 0) {
						$query = "insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom', '$uom', '$uom', '$minimum_stock', '$maximum_stock', '$photo', '$active', '$uid', '$dlu', '$syscode')";	   
						$hasil = $conn->query($query);	  
				  
					  
					} else {
						$query="update item set old_code='$old_code', name='$name', item_group_id='$item_group_id' where code='$code'";	
						$hasil = $conn->query($query);
						echo $query."<br>";
					}
				  
				} 
				
			}
			
			$x++;
			
        }
    }
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