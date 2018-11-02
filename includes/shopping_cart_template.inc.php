<?php
session_start();
if(isset($_SESSION['id'])) {
  echo "Your session is running " . $_SESSION['id'];
} else {
    $_SESSION["id"] = random_str(64);
    echo "New Session " . $_SESSION['id'];
}
// Kopiert von StackOverflow. Ich will dem User einen random String geben, ohne eine web API zu verwenden, da ich es mir nicht unnötig komplizierter machen will.
// quelle: https://stackoverflow.com/a/31107425/8726350
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Müller's Hofladen -
            <?php print($page_kurztitel);?>
        </title>
        <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!-- modernizr enables HTML5 elements and feature detects -->
        <script src="js/modernizr-1.5.min.js" type="text/javascript">
        </script>
    </head>
    <body>
        <div id="main">
            <header>
                <div id="logo">
                    <div id="logo_text">
                        <!-- class="logo_colour", allows you to change the colour of the text -->
                        <h1>
                            <a href="index.php">
                                müller&apos;s
                                <span class="logo_colour">
                                    _hofladen
                                </span>
                            </a>
                        </h1>
                        <h2>
                            Natürliche Produkte, direkt ab Hof!
                        </h2>
                    </div>
                </div>
                <?php include "includes/navigation.inc.php";?>
            </header>
            <div id="site_content">
                <div class="gallery">
                    <ul class="images">
                        <li class="show">
                            <img alt="photo_one" height="300" src="images/1.jpg" width="950"/>
                        </li>
                        <li>
                            <img alt="seascape" height="300" src="images/2.jpg" width="950"/>
                        </li>
                        <li>
                            <img alt="seascape" height="300" src="images/3.jpg" width="950"/>
                        </li>
                    </ul>
                </div>
                <?php if ($page_news) {?>
                <div id="sidebar_container">
                    <div class="sidebar">
                        <?php include "includes/news.inc.php";?>
                    </div>
                </div>
                <?php }?>
                <div class="content">
                    <h1>
                        <?php print($page_titel);?>
                    </h1>
                    <?php
                            include "shopping_cart_handler.php";
                        ?>
                </div>
            </div>
            <footer>
                <p>
                    Müller's Hofladen | Bauernhofstrasse 10 | 1234 Bauernhausen
                </p>
            </footer>
        </div>
        <p>
        </p>
        <!-- javascript at the bottom for fast page loading -->
        <script src="js/jquery.js" type="text/javascript">
        </script>
        <script src="js/jquery.easing-sooper.js" type="text/javascript">
        </script>
        <script src="js/jquery.sooperfish.js" type="text/javascript">
        </script>
        <script src="js/image_fade.js" type="text/javascript">
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
        </script>
    </body>
</html>
