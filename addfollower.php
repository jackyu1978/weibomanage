<?php

/**
 * @author Jack
 * @copyright 2013
 * @date 2013年5月10日
 */

    session_start();

    include_once( 'config.php' );
    include_once( 'saetv2.ex.class.php' );
    include_once( 'include.php' ); 

    $c         = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
    //$uid_get   = $c->get_uid();
    //$uid       = $uid_get['uid'];
    
    $whosfollowers = "";
    $area = "不限";
    $sex = "不限";
    $haspic = "";
    $followers = 0;
    $frienders = 0;
    $blogs = 0;
    $cursor = 0;
    $count = 1;
    
    if(isset($_POST['whosfollowers'])){
        $whosfollowers = $_POST['whosfollowers'];
        $area = $_POST['area'];
        $sex = $_POST['sex'];
        $haspic = $_POST['haspic'];
        $followers = $_POST['followers'];
        $frienders = $_POST['frienders'];
        $blogs = $_POST['blogs'];
        $cursor = $_POST['cursor'];
        $count = $_POST['count'];
        
        $addedusers = addfollows($c,$whosfollowers,$cursor,$count,$area,$sex,$haspic,$followers,$friends,$blogs);
        //header('Content-type: text/json');
        $result = array ( "addedusers" => $addedusers );
        echo json_encode($result);
        exit();
    }
    
    
    
    function addfollows($c,$whosfollowers,$cursor,$count,$area,$sex,$haspic,$followers,$friends,$blogs){
            
            if($c==NULL || $whosfollowers == "")
                return;
                
            $addedusers = array (); 
            $c_followers = $c->followers_by_name($whosfollowers, $cursor, $count);
            foreach ($c_followers['users'] as $item){
                
                   
                   $relation = $c->is_followed_by_id($item['id'], $uid); 
            
                   if($relation['source']['following']==true && $relation['target']['followed_by']==true){//是否已经关注
                        continue;
                   }

                   if($area != "不限"){
                    if (strstr($item['location'], $area) == NULL){//不符合地区要求
                        continue;
                    }    
                   }

                   if($haspic == "yes" && $item['profile_image_url']== ""){//没有图像
                        continue;
                   }

                   if($followers > $item['followers_count']){//不满足粉丝数条件
                        continue;
                   }

                   if($friends > $item['friends_count']){//不满足关注数条件
                        continue;
                   }

                   if($blogs > $item['statuses_count']){//不满足微博数条件
                        continue;
                   }
                   
                   //添加关注
                   $c->follow_by_id($item['id']);
                   
                   $addedusers[] = $item['screen_name'];
                   
                   //echo '<div style="padding:8px;margin:5px;border:1px solid #ccc;background-color:#B5E188">';
        	       //echo $item['screen_name'];
                   //echo '</div>';
            }
            
            return $addedusers;
        }

?>