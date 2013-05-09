<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
include_once( 'include.php' );


$c         = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get   = $c->get_uid();
$uid       = $uid_get['uid'];

$perpage   = 50;
$page      = intval($_REQUEST['page']);
$page      = $page < 1 ? 1 : $page;
$next      = ($page - 1) * $perpage;

$friends = $c->friends_by_id( $uid, $next );//根据ID获取用户粉丝列表

$total   = $friends['total_number'];
$page    = $page > $total ? $total : $page;

$mpurl   = 'http://www.okeydns.com/friends.php';
$multi   = multipage($total, $perpage, $page, $mpurl);

if(isset($_POST['page'])){
	foreach( $friends['users'] as $item ){
		//var_dump($friends['users']);
		//echo 'unfollow';echo $item['id'];
		$ret = $c->unfollow_by_id( $item['id'] );	//取消关注
		sleep(3);
	}
	header("Location: ./friends.php?page=$page");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>超级管家</title>
</head>

<body>

<form method="post" action="./friends.php">
	<input type="hidden" name="page" value="<?php echo $page;?>" />
	<input value="删除该页关注用户" type="submit" />
</form>

<?php
	$page_friends = $friends['users'];
	if( is_array( $page_friends ) ){
		foreach( $page_friends as $item ){
?>
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


<?php echo $multi;?>
</body>
</html>