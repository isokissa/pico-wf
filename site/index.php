<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="contents/stylesheet.css" rel="stylesheet"/>

<?php

require_once( dirname(__FILE__)."/pico-wf/FileSystemBackend/FileFactory.php" );
require_once( dirname(__FILE__)."/pico-wf/PageRenderer.php" );

$factory = new FileFactory();
$site = $factory->makeSite();
$pageRenderer = $site->getPageRenderer( $_GET["page"], $_GET["lang"] );


echo "<title>". $pageRenderer->getTitle()."</title>"; 

?>



</head>
<body>

<nav>
<?php echo $pageRenderer->getMenu(); ?>
</nav>

<article>
<?php echo $pageRenderer->getArticle(); ?>
</article>


</body>
</html>
