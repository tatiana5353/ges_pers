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
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
        <div id="login-page">
            <div class="container">
                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                    <?= $content ?>
                </div>
            </div>  
        </div>
    <?php $this->endBody() ?>
    <script type="template/text/javascript" src="template/lib/jquery.backstretch.min.js"></script>
            <script>
                $.backstretch("template/img/logo.jpg", {
                speed: 500
                });
            </script>
</body>
</html>
<?php $this->endPage();