<?php
global $global, $config;
if(!isset($global['systemRootPath'])){
    require_once '../videos/configuration.php';
}
$metaDescription = "About Page";
?>
<!DOCTYPE html>
<html lang="<?php echo $config->getLanguage(); ?>">
    <head>
        <title><?php echo $config->getWebSiteTitle(); ?> :: <?php echo __("About").getSEOComplement(); ?></title>
        <?php
        include $global['systemRootPath'] . 'view/include/head.php';
        ?>
    </head>

    <body class="<?php echo $global['bodyClass']; ?>">
        <?php
        include $global['systemRootPath'] . 'view/include/navbar.php';
        ?>

        <div class="container">
            <div class="bgWhite">
                <?php
                $custom = "";
                if (AVideoPlugin::isEnabled("c4fe1b83-8f5a-4d1b-b912-172c608bf9e3")) {
                    require_once $global['systemRootPath'] . 'plugin/Customize/Objects/ExtraConfig.php';
                    $ec = new ExtraConfig();
                    $custom = $ec->getAbout();
                }
                if(empty($custom)){
                ?>
                <h1><?php echo __("Video's gemaakt door INCOTECH worden hier gehost. | Videos created by INCOTECH are hosted here."); ?></h1>
                <blockquote class="blockquote">
                    <h1><?php echo __("Door aanpassingen in het YouTube beleid zijn we begonnen de video's ook zelf te hosten. <br> <hr> <br> Due to changes to the YouTube policy, we started hosting the videos ourselves. "); ?></h1>
                    <footer class="blockquote-footer">Apostle Paul in <cite title="Source Title">Romans 11:36</cite></footer>
                </blockquote>
                <div class="btn-group btn-group-justified">
                    <a href="https://www.incotech.online/" class="btn btn-success">Main Site</a>
                    <a href="https://www.youtube.com/c/incotechonline" class="btn btn-danger">YouTube</a>
                </div>
                <span class="label label-success">
                    <?php printf(__("You have %s minutes of videos!"), number_format(getSecondsTotalVideosLength() / 6, 2)); ?>
                </span>
                <?php
                }else{
                    echo $custom;
                }
                ?>

            </div>

        </div><!--/.container-->
        <?php
        include $global['systemRootPath'] . 'view/include/footer.php';
        ?>

        <script>
            $(document).ready(function () {



            });

        </script>
    </body>
</html>
