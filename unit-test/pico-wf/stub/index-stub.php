<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link href="contents/stylesheet.css" rel="stylesheet"/>

<?php

require_once( dirname(__FILE__)."/StubFactory.php" );
require_once( dirname(__FILE__)."/../../../site/pico-wf/PageRenderer.php" );

$factory = new StubFactory();
$site = $factory->makeSite();
if( array_key_exists( "page", $_GET ) ){
    $page = $_GET["page"];
}
else{
    $page = $site->getAllPages()[0];
}
if( array_key_exists( "lang", $_GET ) ){
    $lang = $_GET["lang"];
}
else{
    $lang = array_keys( $site->getAllLanguages() )[0];
}
$pageRenderer = $site->getPageRenderer( $page, $lang );


echo "<title>". $pageRenderer->getTitle()."</title>"; 

?>



</head>
<body>

<nav>
<?php echo $pageRenderer->getMenu(); ?>
</nav>

<article>
<?php 
    echo "<h1>". $pageRenderer->getTitle()."</h1>"; 
    echo $pageRenderer->getArticle(); 
?>
</article>


</body>
</html>
