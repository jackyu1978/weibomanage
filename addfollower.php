<?php

/**
 * @author Jack
 * @copyright 2013
 * @date 2013��5��10��
 */

    session_start();

    include_once( 'config.php' );
    include_once( 'saetv2.ex.class.php' );
    include_once( 'include.php' ); 

    $c         = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
    //$uid_get   = $c->get_uid();
    //$uid       = $uid_get['uid'];
    
    $whosfollowers = "";
    $area = "����";
    $sex = "����";
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
            echo $followers;
            echo $area; 
            echo $cursor;
            echo $count;
            echo $whosfollowers;
             
            $c_followers = $c->followers_by_name($whosfollowers, $cursor, $count);
            echo $c_followers;
            foreach ($c_followers['users'] as $item){
                
                   
                   $relation = $c->is_followed_by_id($item['id'], $uid); 
                   $addedusers[]="1";
                   if($relation['source']['following']==true && $relation['target']['followed_by']==true){//�Ƿ��Ѿ���ע
                        continue;
                   }
                   $addedusers[]="2";
                   $addedusers[]=$area;
                   echo $area;
                   if($area != "" && $area !="����"){
                    if (strstr($item['location'], $area) == NULL){//�����ϵ���Ҫ��
                        continue;
                    }    
                   }
                   $addedusers[]="3";
                   if($haspic == "yes" && $item['profile_image_url']== ""){//û��ͼ��
                        continue;
                   }
                   $addedusers[]="4";
                   echo $followers;
                   echo $item['followers_count'];
                   if($followers > $item['followers_count']){//�������˿������
                        continue;
                   }
                   $addedusers[]="5";
                   if($friends > $item['friends_count']){//�������ע������
                        continue;
                   }
                   $addedusers[]="6";
                   if($blogs > $item['statuses_count']){//������΢��������
                        continue;
                   }
                   $addedusers[]="7";
                   //��ӹ�ע
                   $c->follow_by_id($item['id']);
                   
                   $addedusers[] = $item['screen_name'];
                   
                   //echo '<div style="padding:8px;margin:5px;border:1px solid #ccc;background-color:#B5E188">';
        	       //echo $item['screen_name'];
                   //echo '</div>';
            }
            
            return $addedusers;
        }

?>