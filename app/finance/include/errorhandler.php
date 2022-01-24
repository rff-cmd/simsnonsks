<?php
set_error_handler('errorHandler');

function errorHandler ($errno, $errstr, $errfile, $errline, $errcontext) 
{
   switch ($errno) 
   {
      case E_USER_WARNING:
      case E_USER_NOTICE:
      case E_WARNING:
      case E_NOTICE:
      case E_CORE_WARNING:
      case E_COMPILE_WARNING:
         break;
      case E_USER_ERROR:
      case E_ERROR:
      case E_PARSE:
      case E_CORE_ERROR:
      case E_COMPILE_ERROR:
		 		
		 $r = rand(1, 30000);
		 
		 if (file_exists("displayerror.php"))
		 {
			 echo  "<script language='javascript'>";
			 echo  "if (self == top || parent == top)";
			 echo  "    document.location.href = 'displayerror.php?$r';";
			 echo  "else if (parent.parent != top)";
			 echo  "    parent.parent.location.href = 'displayerror.php?$r';";
			 echo  "else";
			 echo  "    parent.location.href = 'displayerror.php?$r';";
			 echo  "</script>";
		 }
		 elseif (file_exists("include/displayerror.php"))
   		 {
			 echo  "<script language='javascript'>";
			 echo  "if (self == top || parent == top)";
			 echo  "    document.location.href = 'include/displayerror.php?$r';";
			 echo  "else if (parent.parent != top)";
			 echo  "    parent.parent.location.href = 'include/displayerror.php?$r';";
			 echo  "else ";
			 echo  "    parent.location.href = 'include/displayerror.php?$r';";
			 echo  "</script>";
		 }
		 elseif (file_exists("../include/displayerror.php"))
		 {
			 echo  "<script language='javascript'>";
			 echo  "if (self == top || parent == top)";
			 echo  "    document.location.href = '../include/displayerror.php?$r';";
			 echo  "else if (parent.parent != top)";
			 echo  "    parent.parent.location.href = '../include/displayerror.php?$r';";
			 echo  "else ";
			 echo  "    parent.location.href = '../include/displayerror.php?$r';";
			 echo  "</script>";
		 }
		 elseif (file_exists("../../include/displayerror.php"))
		 {
			 echo  "<script language='javascript'>";
			 echo  "if (self == top || parent == top)";
			 echo  "    document.location.href = '../../include/displayerror.php?$r';";
			 echo  "else if (parent.parent != top)";
			 echo  "    parent.parent.location.href = '../../include/displayerror.php?$r';";
			 echo  "else ";
			 echo  "    parent.location.href = '../../include/displayerror.php?$r';";
			 echo  "</script>";
		 }
			
      default:
         break;
   } // switch
} // errorHandler
?>