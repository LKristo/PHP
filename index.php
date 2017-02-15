<?php
// import configuration
require_once 'conf.php';
// create an template object,
// set up the file name for template

// load template file content
$tmpl = new template('main');

require_once 'lang.php';
require_once 'menu.php';
require_once 'act.php';
$tmpl->set('nav_bar', $sess->user_data['username']);
$tmpl->set('header', 'Pealkiri');
// $tmpl->set('lang_bar', 'minu keeleriba');
// $tmpl->set('content', 'minu sisu');
// output template content set up with real values
echo $tmpl->parse();
// control actions


echo $tmpl->parse();
// control database object
// create test query
$sql = 'SELECT NOW();';
$res = $db->getArray($sql);
$sql = 'SELECT NOW();';
$res = $db->getArray($sql);
$sql = 'SELECT NOW();';
$res = $db->getArray($sql);
// control database query result
$sess->flush();
// query time control
$db->showHistory();
// control session output
$sess->flush();