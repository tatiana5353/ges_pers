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

        "template/lib/bootstrap/css/bootstrap.min.css",
        "template/lib/font-awesome/css/font-awesome.css",
        "template/lib/bootstrap-fileupload/bootstrap-fileupload.css",
        "template/lib/bootstrap-datepicker/css/datepicker.css",
        "template/lib/bootstrap-daterangepicker/daterangepicker.css",
        "template/lib/bootstrap-timepicker/compiled/timepicker.css",
        "template/lib/bootstrap-datetimepicker/datertimepicker.css",
        "template/css/style.css",
        "template/css/style-responsive.css",


        "template/css/https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",
        "template/css/highlight.css",
        "template/css/https://unpkg.com/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css",
        "template/css/https://getbootstrap.com/assets/css/docs.min.css",
        "template/css/main.css",

       "template/lib/bootstrap/css/bootstrap.min.css",
       
       "template/lib/font-awesome/css/font-awesome.css",
        "template/stylesheet","template/css/zabuto_calendar.css",
        "template/stylesheet", "template/lib/gritter/css/jquery.gritter.css",
       "template/css/style.css",
       "template/css/style-responsive.css",
        "template/lib/chart-master/Chart.js",
        

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

        "template/lib/jquery/jquery.min.js",
        "template/lib/bootstrap/js/bootstrap.min.js",
        "template/lib/jquery.dcjqaccordion.2.7.js",
        "template/lib/jquery.scrollTo.min.js",
        "template/lib/jquery.nicescroll.js",

        "template/lib/common-scripts.js",

        "template/lib/jquery-ui-1.9.2.custom.min.js",
        "template/lib/bootstrap-fileupload/bootstrap-fileupload.js",
        "template/lib/bootstrap-datepicker/js/bootstrap-datepicker.js",
        "template/lib/bootstrap-daterangepicker/date.js",
        "template/lib/bootstrap-daterangepicker/daterangepicker.js",
        "template/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js",
        "template/lib/bootstrap-daterangepicker/moment.min.js",
        "template/lib/bootstrap-timepicker/js/bootstrap-timepicker.js",
        "template/lib/advanced-form-components.js",

        "template/lib/jquery/jquery.min.js",

  "template/lib/bootstrap/js/bootstrap.min.js",
   "template/lib/jquery.dcjqaccordion.2.7.js",
  "template/lib/jquery.scrollTo.min.js",
  "template/lib/jquery.nicescroll.js" ,
  "template/lib/jquery.sparkline.js",
 /*  <!--common script for all pages--> */
  "template/lib/common-scripts.js",
 "template/lib/gritter/js/jquery.gritter.js",
 "template/lib/gritter-conf.js",
  /* <!--script for this page--> */
  "template/lib/sparkline-chart.js",
  "template/lib/zabuto_calendar.js",
  
        
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',
    ];
}
