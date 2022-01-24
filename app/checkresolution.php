<?php
@session_start();

if (isset($_REQUEST['r']))
{
header("location: testlayar.php");
}

echo "<html><head>";

if(!isset($_SESSION['lebarlayar']))
{
echo "><script language=\"JavaScript\">

document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&Height=\"+screen.height;

</script>";

if(isset($_GET['width']) && isset($_GET['Height'])) 
{
$_SESSION['lebarlayar'] = $_GET['width'];
$_SESSION['tinggilayar'] = $_GET['Height'];
}
}

/*
else if (isset($_SESSION['lebarlayar']) && isset($_SESSION['tinggilayar']))
{
if ( $_SESSION['lebarlayar'] == 1024 && $_SESSION['tinggilayar'] == 768 )
{
echo "<link rel='stylesheet' type='text/css' href='./templates/template.1024×768.css'/>";
}

else if ( $_SESSION['lebarlayar'] == 1280 && $_SESSION['tinggilayar'] == 800 )
{
echo "<link rel='stylesheet' type='text/css' href='./templates/template.1280×800.css'/>";
}
}

else
{
echo "<html><head><script language=\"JavaScript\">
<!– 
document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&Height=\"+screen.height;
//–>
</script>";
}*/

?>