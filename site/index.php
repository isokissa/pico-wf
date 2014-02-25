<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="contents/stylesheet.css" rel="stylesheet"/>

<?php

require_once( dirname(__FILE__)."/pico-wf/DummyFactory.php" );
require_once( dirname(__FILE__)."/pico-wf/PageRenderer.php" );

$factory = new DummyFactory();

$site = $factory->makeSite();
$page = $factory->makePage( $_GET["page"] );
$stringLoader = $factory->makeStringLoader( $_GET["page"], $_GET["lang"] );

$pageRenderer = new PageRenderer( $site, $page, $stringLoader );



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