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
    <input type="button"  id="btnStart" value="开始添加"/></form>
    </td>
    </tr>
</tr>
</table>

<table id="resultTable" class="sortable">
	        <thead>
	            <tr>
	                <td>成功添加粉丝</td>
	            </tr>
	        </thead>
	        <tbody>
	            <!-- 此处显示ajax返回数据 -->
	        </tbody>
	        <tfoot>
	            <!-- 此处显示ajax返回数据 -->
	        </tfoot>
</table>

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript">

//获取表单中的表单域
var whosfollowers=document.forms[0].elements["whosfollowers"];
var area=document.forms[0].elements["area"];
var sex=document.forms[0].elements["sex"];
var haspic=document.forms[0].elements["haspic"];
var followers=document.forms[0].elements["followers"];
var friends=document.forms[0].elements["friends"];
var blogs=document.forms[0].elements["blogs"];
var btnStart=document.forms[0].elements["btnStart"];

//定义定时器的id
var id;
//每10毫秒该值增加1
var seed=0; 
//获取粉丝的位置
var cursor=0;
//每次获取粉丝数
var count=1;

$(document).ready(function (){

    $('#btnStart').click(function (){
          //根据按钮文本来判断当前操作
          if(this.value=="开始添加"){ 
                  //使按钮文本变为停止
                  this.value="停止添加";
                  //设置定时器，每0.01s跳一次
                  addfollower();
                  id=window.setInterval(addfollower,1000*60);//一分钟执行一次
          }else{
                  //使按钮文本变为开始
                  this.value="开始添加";
                  //取消定时
                  window.clearInterval(id);
          }
    });
});


function addfollower(){
    $.ajax({
        type: "POST",
        url: "/addfollower.php",
        dataType: 'json',
        async:false,
        cache:false,
        timeout:10000,     //ajax请求超时时间10秒
        data: {
            'whosfollowers': whosfollowers.value,
            'area': area.value,
            'sex': sex.value,
            'haspic': haspic.checked?haspic.value:"",
            'followers': followers.value,
            'friends': friends.value,
            'blogs': blogs.value,
            'cursor': cursor,
            'count': count
        },
        beforeSend: function() {},
        success: function(data) {
            //$("#msg").empty(); //清空前一次刷新数据，不清除索表会出错
            //$("#msg").append(data); 
            if(data==undefined || data==""){
                alert("return null");
            }else{
                //alert(data.addedusers);
                //$.each(data, function(idx,item){  
                $("#resultTable").find('tbody').append("<tr class='text-en-9pt'><td nowrap>"+data.addedusers+"&nbsp;</td></tr>");
                        //alert(item.addedusers[0]);
                    
                //})
            }
        },
        error:function(data){     
            //$("#msg").append("链接有误，请查看网络链接");   
        }       
    });
    cursor = cursor+count;
}

</script>


</body>
</html>