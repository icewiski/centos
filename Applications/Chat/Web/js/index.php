
 
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
       
 //       if ($.cookie('level')>=5){
 //              load();
 //             }
        
              }

    // 连接建立时发送登录信息
 function onopen()
    {
        if(!name)
        {
            show_prompt();
        }
        // 登录
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>","level":"'+level+'"}';
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
                attack(data['x'],data['y'],data['fromx'],data['fromy']);
                vs(data['x'],data['y']);

            //探测
             case 'detect':
                
                detect2(data['fromx'],data['fromy'],data['ad'],data['dl'],data['da'],data['from_client_id']);
                
             break;
              
              case 'report':
                
                drawreport(data['ddx'],data['ddy']);
                $("#dialog").append('探测到'+data['ddx']+', '+data['ddy']+'存在智慧生命行星');
                $('#dialog').animate({scrollTop:9999999+'px'},10)
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
         if(gold<=20){alert("发送广播需要20黄金，黄金不足")}
    else{
            gold=gold-20;
      var input = document.getElementById("textarea");
      var to_client_id = $("#client_list option:selected").attr("value");
      var to_client_name = $("#client_list option:selected").text();
      ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'","gold":"'+gold+'"}');
      input.value = "";
      input.focus();
    }}

//被击中
  function ondead() {
    //  console.log(name,level);
            
      ws.send('{"type":"say","to_client_id":"all","to_client_name":"all","content":"'+name+'被消灭了，等级'+level+'"}');
    //  console.log(name,level);
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
               
              
               
            	$("#dialog").append(''+from_client_name+' <br> '+time+'<div ><p  >'+content+'</p></div>');
               $('#dialog').animate({scrollTop:9999999+'px'},10)
    }
    
//回车提交
  $(document).ready(function(){ 
      $("#textarea").keydown(function(e){ 
      var curKey = e.which; 
      if(curKey == (13&&17)){ 
      $("#saybutton").click(); 
       return false; 
      } 
       }); 
      }); 
//聊天框 攻击
  function saya(from_client_id, from_client_name,time, x,y){
            	$("#dialog").append(' '+time+' <div ><p  > 有人攻击了<br> '+" x "+x+' '+" y "+y+'</p></div> ');
               $('#dialog').animate({scrollTop:9999999+'px'},10)
         }
      
   function sayd(from_client_id, from_client_name,time, x,y){
            	$("#dialog").append(' '+time+' <div ><p > 有人探测到了你<br> '+" x "+x+' '+" y "+y+'</p></div> ');
               $('#dialog').animate({scrollTop:9999999+'px'},10)
         }

//攻击
  function attack1(time){
            if(gold<=100){alert("黄金不足")}
    else{
            gold=gold-100;
       
    	ws.send('{"type":"attack","to_client_id":"all","to_client_name":"all","time":"'+time+'","x":"'+target.x+'","y":"'+target.y+'","fromx":"'+player.x+'","fromy":"'+player.y+'"}');
     //   console.log(x,y);
    }
    }

 //黑洞
 var lagtime= Math.round(10000*Math.random()+10000)  ;
      function blackhole(){
          lagtime= Math.round(10000*Math.random()+10000) 
          var blackx=Math.round(1+500*Math.random())   ;
          var blacky=Math.round(1+300*Math.random()) ;
            vs(blackx,blacky);
            attackblack(blackx,blacky);
     //       console.log(lagtime,blackx,blacky);
        }
     var myvar44=setInterval(function(){blackhole()}, lagtime);
        

//键盘事件
$(document).keydown(function(event){
   switch(event.keyCode){
       
    case 13:var input1 = document.getElementById("textarea");
                input1.focus();
                return ; 
    //wsad控制方向
    case 65:left();return;
    case 87:up();return;
    case 68:right();return;
    case 83:down();return;
    //上下左右控制瞄准
    case 37: xminus(1);return;
    case 38: yminus(1);return;
    case 39: xplus(1);return;
    case 40: yplus(1);return;
     //资源操作
    case  53:minerup();return;
    case  54:minerdown();return;
    case  55:jackerup();return;
    case  56:jackerdown();return;
    //鼠标攻击
    
    case 32: attack1();return;

  case 73: detect1() ;return;
    case  74:detectlength--;
             drawaim() ;
                return;
    case  76:detectlength++;
              drawaim() ;
                return;
    case 79:aimdirection++;
              drawaim() ;
                return;
    case 85:aimdirection--;
              drawaim() ;
                return;      

    //esc退出聊天
    case 27:var input1 = document.getElementById("textarea");
                input1.blur();
                return ;
   }
  });
//选中
$(function(){
    	select_client_id = 'all';
	    $("#client_list").change(function(){
	         select_client_id = $("#client_list option:selected").attr("value");
	    });
    });

