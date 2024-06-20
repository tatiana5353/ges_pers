<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <style>
        .custom-bg {
            position: relative;
            background-image: url('template/img/product.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .custom-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Couleur noire semi-transparente */
        }
    </style>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition login-page custom-bg">
    <?php $this->beginBody() ?>
    <?= $content ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
