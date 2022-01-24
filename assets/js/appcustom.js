
function formatangka(field) {
	 //a = rci.amt.value;
	 a = document.getElementById(field).value;
	 //alert(a);
	 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
	 c = "";
	 panjang = b.length;
	 j = 0;
	 for (i = panjang; i > 0; i--)
	 {
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1))
		 {
		 	c = b.substr(i-1,1) + "," + c;
		 } else {
		 	c = b.substr(i-1,1) + c;
		 }
	 }
	 //rci.amt.value = c;
	 c = c.replace(",.",".");
	 c = c.replace(".,",".");
	 //for (var i = 0; i < Math.floor((c.length-(1+i))/3); i++)
		//c = c.substring(0,c.length-(4*i+3))+','+
		//c.substring(c.length-(4*i+3));
	 document.getElementById(field).value = c;		
	 
}