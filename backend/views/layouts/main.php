<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>

    <!-- <div class="wrap"> -->

    <?=
    $this->render('_haut') ?>
    <?= $this->render('_gauche')
    ?>
    <?= $this->beginBody() ?>
    <div class="container">

        <section id="main-content">
            <section class="wrapper site-min-height">

                <div class="row mt">
                    <div class="col-lg-12">


                        <?= $content ?>

                    </div>

                </div>
            </section>
            <!-- /wrapper -->
        </section>


    </div>
    <!-- </div> -->

    <footer class="footer">
        <?= $this->render('_bas') ?>
    </footer>

    <?php $this->endBody() ?>

    <script type="/text/javascript" src="template/lib/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("template/img/logo.jpg", {
            speed: 500
        });
    </script>
</body>

</html>
<?php $this->endPage() ?>