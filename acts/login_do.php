<?php
$username = $http->get('username');
$password = $http->get('password');

$sql = 'select * from user where '.'username='.fixDb($username).' and '.'password='.fixDb(md5($password)).' and '.'is_active=1';
$res = $db->getArray($sql);

if($res === false)
{
    $sess->set('login_error', tr('Viga sisselogimisel'));

    $link = $http->getLink(array('act'=>'login'), array('username'));
    $http->redirect($link);
}
else
{
    $sess->createSession($res[0]);
    $http->redirect();
}