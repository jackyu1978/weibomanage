<?php

/**
 * @author 大眼仔~旭
 * @copyright 2013
 */
 
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
include_once( 'include.php' );


$c         = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get   = $c->get_uid();
$uid       = $uid_get['uid'];

//是表单提交过来的数据，并且设置了要拉粉的账号，则开始加粉。
$start = 0;
//var_dump($_POST);
if(isset($_POST['whosfollowers'])){
    $whosfollowers = $_POST['whosfollowers'];
    $followers = $c->followers_by_name($whosfollowers, $start);
    foreach ($followers['users'] as $item){
           $flag = true;
           sleep(60);
           $relation = $c->is_followed_by_id($item['id'], $uid);
           echo $item['screen_name']; 
           if($relation['source']['following']==true && $relation['target']['followed_by']==true){//是否已经关注
                continue;
           }
           if($_POST['area'] != "" && $_POST['area'] !="不限"){
            if (strstr($item['location'], $_POST['area']) == NULL){//不符合地区要求
                continue;
            }    
           }
           if($_POST['haspic'] == "yes" && $item['profile_image_url']== ""){//没有图像
                continue;
           }
           if($_POST['floowers'] > $item['followers_count']){//不满足粉丝数条件
                continue;
           }
           if($_POST['friends'] > $item['friends_count']){//不满足关注数条件
                continue;
           }

           if($_POST['blogs'] > $item['statuses_count']){//不满足微博数条件
                continue;
           }
           
           //添加关注
           $c->follow_by_id($item['id']);
           echo "follow id :";
           echo $item['id'];
    }
    $start += 50;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>加粉操作</title>
</head>

<body>

<form method="post" action="./addfollowers.php">

<table>
<tr>
    <tr bgcolor="#B5E188">
    	<td colspan="2">
        <div align="center"><b>添加的粉丝需满足以下条件</b></div>
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div>是该账号的粉丝：</div>
        </td>
        <td>
        <input type="text" size="100" name="whosfollowers"/>
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div align='left'>地区:</div>
        </td>
        <td>
        <input type="text" size="100" name="area" value="不限" />
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div align='left'>性别：</div>
        </td>
        <td>
        <select name="sex" "size="1">
        	<option selected value="0">不限</option>
        	<option value="1">男</option>
        	<option value="2">女</option>
        </select>
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div align='left'>是否有图像：</div>
        </td>
        <td>
        <input type="checkbox" value="yes" name="haspic" />
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div align='left'>关注数大于：</div>
        </td>
        <td>
        <input type="text" size="100" name="followers" value="0"/>
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div align='left'>粉丝数大于：</div>
        </td>
        <td>
        <input type="text" size="100" name="friends" value="0"/>
        </td>
    </tr>
    <tr bgcolor="#B5E188">
        <td>
        <div align='left'>微博数大于：</div>
        </td>
        <td>
        <input type="text" size="100" name="blogs" value="0"/>
        </td>
    </tr>
    <tr bgcolor="#B5E188" align="center">
    <td colspan="2">
    <input type="submit"  name="addfollows" value="开始添加"/></form>
    </td>
    </tr>
</tr>
</table>

</body>
</html>