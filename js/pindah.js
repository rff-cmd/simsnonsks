/*function pindah field*/
function pindahKolom(evt,id1,id2)
 {
 var id1;
 var id2;
	var textBox = getObject(id1);
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode == 13) document.getElementById(id2).focus();//  enter	 
}

function getKode(evt,id1,id2)
 {
 var id1;
 var id2;
	var textBox = getObject(id1);
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode == 13) document.getElementById(id2).focus();//  enter
}

function getKodeUp(evt,id1,id2)
 {
 var id1;
 var id2;
	var textBox = getObject(id1);
	 var charCode = (evt.which) ? evt.which : event.keyCode;
	 	 alert(charCode);	 
	 if (charCode == 38) document.getElementById(id2).focus();//  arrow up
	 
}

function getObject(obj)
 {
 	  var theObj;
	  if (document.all) {
		  if (typeof obj=='string') {
			  return document.all(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  if (document.getElementById) {
		  if (typeof obj=='string') {
			  return document.getElementById(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  return null;
  }