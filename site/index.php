<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="contents/stylesheet.css" rel="stylesheet"/>

<?php

require_once( __DIR__."/pico-wf/FileSystemBackend/FileFactory.php" );
require_once( __DIR__."/pico-wf/PageRenderer.php" );

$factory = new FileFactory();
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


<div class="page">

<header class="global">
    <?php echo $pageRenderer->getGlobalHeader(); ?>
</header>
    
<div class="middle">
    <nav class="main_menu">
        <?php echo $pageRenderer->getMenu(); ?>
    </nav>

    <article>
    <?php 
        echo "<h1>". $pageRenderer->getTitle()."</h1>"; 
        echo $pageRenderer->getArticle(); 
    ?>
    </article>
</div>


<nav class="lang_selector">
    <?php echo $pageRenderer->getLanguageSelector(); ?>
</nav>

<footer class="global">
    <?php echo $pageRenderer->getGlobalFooter(); ?>
</footer>

</div>


</body>
</html>
