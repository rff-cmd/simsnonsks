<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getalamat":
		
		$client_code = $_POST["client_code"];	
		
?>	
		<!----------start discount member --------------\/------->
	      <?php		   
	       	$k = 0;
	      	$querydisc = $select->get_client_discount_member($client_code);
	      	$sql=$dbpdo->prepare($querydisc);
			$sql->execute();
	      	$rowsdisc = $sql->rowCount();
	      	
	      	if($rowsdisc > 0) {
	      		while($datadisc = mysql_fetch_object($querydisc)) {
	      		
	      			$amount_member = $datadisc->amount_member;
		  ?>
			  		<input type="hidden" id="discmember<?php echo $k ?>" name="discmember<?php echo $k ?>" value="<?php echo $datadisc->discount ?>">
			  		<input type="hidden" id="memberlimit<?php echo $k ?>" name="memberlimit<?php echo $k ?>" value="<?php echo $datadisc->amount_limit ?>">
		  				  		
		  <?php		
		  			$k++;
				}
		  ?>
		  
		  			<input type="hidden" id="amount_member" name="amount_member" value="<?php echo $amount_member ?>">
		      		<input type="hidden" id="jumlahmember" name="jumlahmember" value="<?php echo $k-1 ?>">
		  <?php
				
			} 
	      ?>    	
	      <!----------end discount member --------------/\------->	
	      
<?php	
		break;
			
	default:
	
}
?>