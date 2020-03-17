<?php
header_remove("X-Powered-By");
$VoimteLink = 'https://'.$_SERVER['HTTP_HOST'];
$img_src 	= $VoimteLink.'/assets/img/i/voimte_logo.png';
?>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="revisit-after" content="1 days">

	<!-- Icon -->
	<link rel="icon" href="<?php echo $VoimteLink; ?>/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php echo $VoimteLink; ?>/favicon.ico" type="image/x-icon">

	<!-- Lang -->
	<link rel="alternate" hreflang="en-gb" href="<?php echo $VoimteLink; ?>/en" />
	<link rel="alternate" hreflang="ru" href="<?php echo $VoimteLink; ?>/ru" />
	<link rel="alternate" hreflang="sr-RS" href="<?php echo $VoimteLink; ?>/me" />
	<link rel="alternate" hreflang="x-default" href="<?php echo $VoimteLink; ?>" />

	<!-- Links -->
	<link rel="canonical" 					href="<?php echo $VoimteLink; ?>" />
	<link rel='shortlink' 					href='<?php echo $VoimteLink; ?>' />

	<!-- The Open Graph protocol -->
	<meta property="og:site_name" 			content="Voimte.com" />
	<meta property="og:url" 				content="<?php echo $VoimteLink; ?>" />
	<meta property="og:locale" 				content="en_US" />
    <meta property="og:type" 				content="article" />
    <meta property="og:title" 				content="Voimte.com" />
    <meta property="og:description" 		content="VOIMTE.com is a mini platform for leaving messages to a loved one. The platform is designed to deliver a text or audio message to a loved one." />
    <meta property="og:updated_time" 		content="<?php echo date(DATE_ATOM, time()); ?>" />
    <meta property="og:image"              	content="<?php echo $img_src; ?>" />
	<meta property="og:image:alt"          	content="Voimte.com" />

	<!-- Twitter -->
	<meta name="twitter:title" 				content="Voimte.com" />
	<meta name="twitter:description"		content="VOIMTE.com is a mini platform for leaving messages to a loved one. The platform is designed to deliver a text or audio message to a loved one.">
	<meta name="twitter:card" 				content="summary" />
	<meta name="twitter:site" 				content="@mskokome" />
	<meta name="twitter:creator" 			content="@mskokome" />
	<meta name="twitter:image" 				content="<?php echo $img_src; ?>" />

	<!-- Other -->
	<meta itemprop="name" 					content="Voimte.com" />
	<meta itemprop="url" 					content="<?php echo $VoimteLink; ?>" />
	<meta itemprop="description" 			content="VOIMTE.com is a mini platform for leaving messages to a loved one. The platform is designed to deliver a text or audio message to a loved one." />

	<meta name="keywords" 					content="<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/tags.php'); ?>" />

	<meta name="abstract" 					content="Voimte.com" />
	<meta name="distribution" 				content="global" />
	
	<meta name="googlebot" 					content="index, follow" />
	<meta name="audience" 					content="all" />
	
	<meta itemprop="thumbnailUrl" 			content="<?php echo $img_src; ?>" />
	<meta itemprop="image" 					content="<?php echo $img_src; ?>" />
	<link rel="image_src" 					href="<?php echo $img_src; ?>" />

	<meta name="author" 					content="Muhamed Skoko | mskoko.me@gmail.com">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   	<!-- Style -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="/assets/css/bs_reset.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="/assets/css/header.css">


    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">

	<!--[if IE]>
    	<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  	<![endif]-->
    
	<!--[if lt IE 9]>
		<script src="/assets/theme/js/respond.min.js"></script>
	<![endif]-->


	<!-- Web masterserver -->
	
	<!-- google -->

	<!-- yandex -->

	<!-- bing -->