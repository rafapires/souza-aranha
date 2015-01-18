<?php
/*
Plugin Name: Formidable Registration
Plugin URI: http://formidablepro.com/knowledgebase/formidable-registration/
Description: Register users through a Formidable form
Author: Strategy11
Author URI: http://strategy11.com
Version: 1.11.01
Text Domain: frmreg
*/

include_once(dirname( __FILE__ ) .'/FrmRegAppController.php');
$obj = new FrmRegAppController();

include_once(dirname( __FILE__ ) .'/FrmRegAppHelper.php');
$obj = new FrmRegAppHelper();

// Setup Settings Object
require(dirname( __FILE__ ) .'/models/FrmRegSettings.php');