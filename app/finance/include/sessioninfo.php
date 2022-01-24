<?php
session_name("jbskeu");
session_start();

function getUserName() 
{
	return $_SESSION['namakeuangan'];
}

function getUserTheme() 
{
	return $_SESSION['temakeuangan'];
}

function getLevel() 
{
	return $_SESSION['tingkatkeuangan'];
}

function getAccess() 
{
	if ($_SESSION['tingkatkeuangan'] == 2)
		return $_SESSION['departemenkeuangan'];
	else 
		return "ALL";
}

function getIdUser() 
{
	return $_SESSION['login'];
}

function SI_USER_ID() 
{
	return $_SESSION['login'];
}

?>