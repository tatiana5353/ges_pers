<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

            "template/css/https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",
            "template/css/highlight.css",
            "template/css/https://unpkg.com/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css",
            "template/css/https://getbootstrap.com/assets/css/docs.min.css",
            "template/css/main.css",

        //'css/site.css',
/////////////////////////// lien pris dans le blank de dashio//////////////////////////////////////////////////////////////
        "template/lib/bootstrap/css/bootstrap.min.css",
        //<!--external css-->
        "template/lib/font-awesome/css/font-awesome.css",
        //<!-- Custom styles for this template -->
        "template/css/style.css",
        "template/css/style-responsive.css",
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
"template/lib/bootstrap/css/bootstrap.min.css", 
  //<!--external css-->
  "template/lib/font-awesome/css/font-awesome.css", 
  //<!-- Custom styles for this template -->
  "template/css/style.css", 
  "template/css/style-responsive.css", 

];
    public $js = [

/////////////////////////// lien pris dans le blank de dashio//////////////////////////////////////////////////////////////

        "template/lib/jquery/jquery.min.js",
        "template/lib/bootstrap/js/bootstrap.min.js",
        "template/lib/jquery-ui-1.9.2.custom.min.js",
        "template/lib/jquery.ui.touch-punch.min.js",
        "template/lib/jquery.dcjqaccordion.2.7.js",
        "template/lib/jquery.scrollTo.min.js",
        "template/lib/jquery.nicescroll.js", 
        // <!--common script for all pages-->
        "template/lib/common-scripts.js",
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
/////////////////////////// lien pris dans le login de dashio//////////////////////////////////////////////////////////////


        "template/lib/jquery/jquery.min.js",
        "template/lib/bootstrap/js/bootstrap.min.js",
       /*  "template/text/javascript",  */
        "template/lib/jquery.backstretch.min.js",

        "template/lib/https://code.jquery.com/jquery-3.1.1.min.js",
        "template/lib/https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js",
        "template/lib/js/highlight.js",
        "template/lib/https://unpkg.com/bootstrap-switch",
        "template/lib/js/main.js",

    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',
    ];
}
