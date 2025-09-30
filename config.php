<?php

/* Language settings */
define("RES_LANGUAGE", "Default");

/* MySQL settings */
define("DB_NAME", "b2_20250917");	/* The name of the database */
define("DB_USER", "root");		    /* Your MySQL username */
define("DB_PASSWORD", "123456");	/* ...and password */
define("DB_HOST", "localhost");	    /* 99% chance you won't need to change this value */

/*
 * If mysqli error reporting is enabled (MYSQLI_REPORT_ERROR) and the requested operation fails, 
 * a warning is generated. If, in addition, the mode is set to MYSQLI_REPORT_STRICT, 
 * a mysqli_sql_exception is thrown instead.
 * 
 * error_reporting(0);
 * mysqli_report(MYSQLI_REPORT_OFF);
 */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>