<?php
// Patch Management Framework

function ApplyModulePatch() 
{
	if (file_exists("$relPath/include/module.patch.install.php"))
	{
		require_once("$relPath/include/module.patch.install.php");
		InstallModulePatch($relPath);
		
		unlink("$relPath/include/module.patch.install.php");
	}
}

?>