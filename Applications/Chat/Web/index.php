<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>黑暗森林mud</title>
  <script type="text/javascript">
  //WebSocket = null;
 
  </script>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <!-- Include these three JS files: -->
  <script type="text/javascript" src="/js/swfobject.js"></script>
  <script type="text/javascript" src="/js/web_socket.js"></script>
  <script type="text/javascript" src="/js/jquery.min.js"></script>

<script type="text/javascript" src="js/draw.js"></script>
<script type="text/javascript" src="js/cookie.js"></script>
<script type="text/javascript" src="js/Cookies.js"></script>

<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/school.js"></script>
<script type="text/javascript" src="js/schooldo.1.js"></script>
<script type="text/javascript" src="js/resource.js"></script>

</head>
<body onload="connect();">
    <div class="container">
	    <div class="row clearfix">


 <script type="text/javascript">
           if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
    // 如果浏览器不支持websocket，会使用这个flash自动模拟websocket协议，此过程对开发者透明
    WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
    // 开启flash的websocket debug
    WEB_SOCKET_DEBUG = true;
	  
    var ws, name, client_list={};
    var x;
    var y;
    // 连接服务端
    function connect() {
       // 创建websocket
       ws = new WebSocket("ws://"+document.domain+":7272");
       // 当socket连接打开时，输入用户名
       ws.onopen = onopen;
       // 当有消息时根据消息类型显示不同信息
       ws.onmessage = onmessage; 
       ws.onclose = function() {
    	  console.log("连接关闭，定时重连");
          connect();
       };
       ws.onerror = function() {
     	  console.log("出现错误");
       };
       
        if ($.cookie('l')>=4){
               load();
              }
        
              }

    // 连接建立时发送登录信息
    function onopen()
    {
        if(!name)
        {
            show_prompt();
        }
        // 登录
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>","gold":"'+gold+'"}';
        console.log("websocket握手成功，发送登录数据:"+login_data);
        ws.send(login_data);
    }

    // 服务端发来消息时
    function onmessage(e)
    {
        console.log(e.data);
      
        var data = eval("("+e.data+")");
       
        switch(data['type']){
            // 服务端ping客户端
            case 'ping':
                ws.send('{"type":"pong"}');
                break;;
            // 登录 更新用户列表
            case 'login':
                //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                say(data['client_id'], data['client_name'],  data['client_name']+' 加入了黑暗森林', data['time']);
                if(data['client_list'])
                {
                    client_list = data['client_list'];
                }
                else
                {
                    client_list[data['client_id']] = data['client_name']; 
                }
                flush_client_list();
                console.log(data['client_name']+"登录成功");
             
                break;
            // 发言
            case 'say':
                
                //{"type":"say","from_client_id":xxx,"to_client_id":"all/client_id","content":"xxx","time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['content'], data['time'] );
               
                break;
        
             //攻击
             case 'attack':
                
                saya(data['from_client_id'], data['from_client_name'], data['time'],data['x'],data['y'] );
                attack(data['x'],data['y']);
                vs(data['x'],data['y']);
                
             break;
            // 用户退出 更新用户列表
            case 'logout':
                //{"type":"logout","client_id":xxx,"time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['from_client_name']+' 退出了', data['time']);
                delete client_list[data['from_client_id']];
                flush_client_list();
             
        }
    }

    // 输入姓名
    function show_prompt(){  
        name = prompt('输入你的名字：', '');
   

        if(!name || name=='null'){  
            name = '游客';
            }
            }
 
    // 提交对话
    function onSubmit() {
      var input = document.getElementById("textarea");
      var to_client_id = $("#client_list option:selected").attr("value");
      var to_client_name = $("#client_list option:selected").text();
      ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'","gold":"'+gold+'"}');
      input.value = "";
      input.focus();
    }

    //被击中
     function ondead() {
      console.log(name,level);
            
      ws.send('{"type":"say","to_client_id":"all","to_client_name":"all","content":"'+name+'被消灭了，等级'+level+'"}');
      console.log(name,level);
      alert("你被清除了，资源归零，点击确定后在任意点重生")
       location.reload([true]);
    }

    // 刷新用户列表框
    function flush_client_list(){
    	var userlist_window = $("#userlist");
    	var client_list_slelect = $("#client_list");
    	userlist_window.empty();
    	client_list_slelect.empty();
    	userlist_window.append('<h4>在线用户</h4><ul>');
    	client_list_slelect.append('<option value="all" id="cli_all">所有人</option>');
    	for(var p in client_list){
            userlist_window.append('<li id="'+p+'">'+client_list[p]+'</li>');
             client_list_slelect.append('<option value="'+p+'">'+client_list[p]+'</option>');
        }
    	$("#client_list").val(select_client_id);
    	userlist_window.append('</ul>');
    }

    // 发言
    function say(from_client_id, from_client_name, content, time,gold){
            	$("#dialog").append(''+from_client_name+' <br> '+time+'<div style="clear:both;"><p class="triangle-isosceles top">'+content+'</p></div>');
               $('#dialog').animate({scrollTop:9999999+'px'},10)
    }
   
    //聊天框 攻击
    function saya(from_client_id, from_client_name,time, x,y){
            	$("#dialog").append(' '+time+' <div style="clear:both;"><p class="triangle-isosceles top"> 有人攻击了<br> '+" x "+x+' '+" y "+y+'</p></div> ');
               $('#dialog').animate({scrollTop:9999999+'px'},10)
    }


    //攻击
     function attack1(from_client_id, from_client_name, time,x,y){
            if(gold<=100){alert("黄金不足")}
    else{

         
             var inputx = document.getElementById("x");
        x=inputx.value;
        var inputy = document.getElementById("y");
        y=inputy.value;
    	ws.send('{"type":"attack","to_client_id":"all","to_client_name":"all","time":"'+time+'","x":"'+x+'","y":"'+y+'"}');
        console.log(x,y);
    }
    }

    //移动
//     function movemove(from_client_id, from_client_name, time,player.x,player.y){
//            if(wood<=100){alert("木材不足")}
 //   else{
//      	ws.send('{"type":"attack","to_client_id":"all","to_client_name":"all","time":"'+time+'","playerx":"'+player.x+'","playery":"'+player.y+'"}');
 //       console.log(x,y);
//    }
 //   }



    $(function(){
    	select_client_id = 'all';
	    $("#client_list").change(function(){
	         select_client_id = $("#client_list option:selected").attr("value");
	    });
    });

 </script>
	        <div class="header">
	         <div class="thumbnail">
	               <div class="caption" id="head">
                       每级提供一个人口，每100木材提供10点秒伤，每100黄金提供20点击伤害.
                       每次移动消耗100木材，每次攻击消耗100黄金
                      <a href="/check.php">设备检测</a>
                      <p></p>
                      <div class="btn-group">
		<button type="button" class="btn btn-default">按钮 4</button>
		<button type="button" class="btn btn-default">按钮 5</button>
		<button type="button" class="btn btn-default">按钮 6</button>
        <button type="button" class="btn btn-default">按钮 6</button>
	</div>
                   </div>
	           </div>
            </div> 

	        <div class="col-md-3 column">   
                
	           <div class="thumbnail">
	               <div class="caption" id="dialog"></div>
	           </div>
	           <form onsubmit="onSubmit(); return false;">
	                <select style="margin-bottom:8px" id="client_list">
                        <option value="all">所有人</option>
                    </select>
                    <textarea class="textarea thumbnail" id="textarea"></textarea>
                    <div class="say-btn"><input type="submit" class="btn btn-default" value="发表" /></div>
               </form>

              
              
	          </div>
            
	        <div class="col-md-2 column">
	           <div class="thumbnail">
                   <div class="caption" id="userlist"></div>
               </div>
            x<input id='x' ></input>
            y<input id='y' ></input>
	         <button id="attack11" class="ce"  type="button" onclick="attack1()" >攻击</button>
            </div> 
         
           <div class="col-md-7 column">
	           <div class="thumbnail">
                   <div class="caption" id="map">
                <canvas id="myCanvas" width="600" height="400" 
                style="border:1px solid #000000;"> 
                </canvas>
                <canvas id="textCanvas" width="300" height="300" margin-bottom:"100px"
                style="border:1px solid #000000;">
                </canvas>
                <canvas id="textCanvas1" width="300" height="300" margin-bottom:"100px"
                style="border:1px solid #000000;">
                </canvas>

                
                <button id="minerup" class="ce" type="button" onclick="minerup()" >增加矿工</button>
                <button id="minerdown" class="ce"  type="button" onclick="minerdown()" >减少矿工</button>
                <button id="jackerup" class="ce"  type="button" onclick="jackerup()" >增加伐木工</button>
                <button id="jackerdown" class="ce"  type="button" onclick="jackerdown()" >减少伐木工</button>
                <button id="dplus" class="ce"  type="button" onclick="dpluss()" >增加秒伤</button>
                <button id="eplus" class="ce"  type="button" onclick="epluss()" >增加点击伤害</button>
                <button id="save" type="button" onclick="e()" style="width:100px;height:50px">点击按钮手动攻击</button>
                <p></p>
                <button id="left" type="button" onclick="left()"  >left</button>
                <button id="right" type="button" onclick="right()"  >right</button>
                <button id="up" type="button" onclick="up()"  >up</button>
                <button id="down" type="button" onclick="down()"  >down</button>
                
            
                   </div> 
               </div>
           </div>
            
                 </div>
                </div>
    <script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7b1919221e89d2aa5711e4deb935debd' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">   startdraw()  </script>
</body>
</html>

