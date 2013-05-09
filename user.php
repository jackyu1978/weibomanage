<?php

/**
 * @author Jack
 * @copyright 2013
 */

session_start();

include_once ('config.php');
include_once ('saetv2.ex.class.php');
include_once ('include.php');

$c = new SaeTClientV2(WB_AKEY, WB_SKEY, $_SESSION['token']['access_token']);
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];

$userid = $_GET['id'];

echo $userid;
$userinfo = $c->show_user_by_id($userid);

print_r($userinfo);
?>