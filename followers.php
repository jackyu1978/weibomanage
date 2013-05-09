<?php

session_start();

include_once ('config.php');
include_once ('saetv2.ex.class.php');
include_once ('include.php');


$c = new SaeTClientV2(WB_AKEY, WB_SKEY, $_SESSION['token']['access_token']);
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];

$perpage = 50;
$page = intval($_GET['page']);
$page = $page < 1 ? 1 : $page;
$next = ($page - 1) * $perpage;
$followers = $c->followers_by_id($uid, $next); //根据ID获取用户粉丝列表

$total = $followers['total_number'];
$page = $page > $total ? $total : $page;

$mpurl = 'http://www.okeydns.com/followers.php';
$multi = multipage($total, $perpage, $page, $mpurl);
//var_dump($followers);<script type="text/javascript">


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>超级管家</title>
</head>

<body>

<p>
  <?php

$page_followers = $followers['users'];
var_dump($page_followers);
if (is_array($page_followers))
{
    foreach ($page_followers as $item)
    {

?>
</p>
<div style="padding:10px;margin:5px;border:1px solid #ccc">

<?php

        echo "<a href='./user.php?id=$item[id]'>";
        echo $item['screen_name'];
        echo " </a> ";
?>
</div>
<?php

    }
    //if($followers['next_cursor']<>NULL)
    //$followers = $c->followers_by_id( $uid, $followers['next_cursor']);//根据ID获取用户粉丝列表
    //$page_followers = $followers['users'];
}

?>
<?php

echo $multi;

?>
</body>
</html>