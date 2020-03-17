<?php
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		// Database for my localhost
		define("DB_HOST", "localhost"); 	// MySQL Database Host
		define("DB_USER", "root");			// MySQL Username
		define("DB_PASS", "");  			// MySQL Password
		define("DB_NAME", "voimte_com");  	// Database Name
	} else if ($_SERVER['HTTP_HOST'] == '192.168.8.52') {
		// Database for my localhost
		define("DB_HOST", "localhost"); 	// MySQL Database Host
		define("DB_USER", "root");			// MySQL Username
		define("DB_PASS", "");  			// MySQL Password
		define("DB_NAME", "voimte_com");  	// Database Name
	} else {
		// Database for public
		define("DB_HOST", "localhost"); 	// MySQL Database Host
		define("DB_USER", "");				// MySQL Username
		define("DB_PASS", "");  			// MySQL Password
		define("DB_NAME", "");  			// Database Name
	}

	//Facebook config
	define("APP_ID", "asd");  							// APP ID
	define("APP_SECRET", "asd");  						// APP SECRET
?>