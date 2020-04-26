<?php

function isLoggedIn()
{
	if (isset($_SESSION['userID'])) {
		return true;
	}else{
		return false;
	}
}

function isAdmin()
{
	if (isset($_SESSION['userID']) && $_SESSION['userRole'] == "admin" ) {
		return true;
	}else{
		return false;
	}
}