<html><head>    
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
  <title>黑暗森林mud</title>

 
<link rel="stylesheet" href="/css/weiui.css">
<link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
  <!-- Include these three JS files: -->
  <script type="text/javascript" src="/js/swfobject.js"></script>
  <script type="text/javascript" src="/js/web_socket.js"></script>
  <script type="text/javascript" src="/js/jquery.min.js"></script>


  <script type="text/javascript" src="js/draw.js"></script>
  <script type="text/javascript" src="js/cookie.js"></script>
  <script type="text/javascript" src="js/Cookies.js"></script>
  <script type="text/javascript" src="js/moveto.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
 
  <script type="text/javascript" src="js/school.js"></script>
  <script type="text/javascript" src="js/schooldo.1.js"></script>
  <script type="text/javascript" src="js/resource.js"></script>
  <script type="text/javascript" src="js/mousep.js"></script>
  <script type="text/javascript" src="js/detect.js"></script>
    </head>
<body onload="connect();">
<script type="text/javascript" >

 
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
                $.toptip('探测到'+data['ddx']+', '+data['ddy']+'存在智慧生命行星');
               
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
               
               $.toptip(''+from_client_name+':'+content+'', 1000, 'success'); 
               $("#dialog").css("font-size","0.65em");
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
            	$.toptip(' '+time+' <div ><p  > 有人攻击了<br> '+" x "+x+' '+" y "+y+'</p></div> ');
              
         }
      
   function sayd(from_client_id, from_client_name,time, x,y){
            	$.toptip(' '+time+' <div ><p > 有人探测到了你<br> '+" x "+x+' '+" y "+y+'</p></div> ');
             
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
 //    var myvar44=setInterval(function(){blackhole()}, lagtime);
        

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
    case 77: moveto();return;
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

</script>
    
 <body ontouchstart="">

    <div class="weui-tab">
      <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
          <h1>
              <canvas id="myCanvas" width="350" height="350" 
                style="border:1px solid #000000;"> 
                </canvas>
                  <button class="weui-btn weui-btn_mini weui-btn_primary" id="left" type="button" onclick="moveto()"  >移动</button>
                
                 <button class="weui-btn weui-btn_mini weui-btn_primary" id="right" type="button" onclick="detectlength--;drawaim() "  >-</button>
                 <button class="weui-btn weui-btn_mini weui-btn_primary" id="right" type="button" onclick="detectlength++;drawaim() ;"  >+</button>
                  <button class="weui-btn weui-btn_mini weui-btn_primary" id="down" type="button" onclick="detect1()"  >探测</button>
                 <button class="weui-btn weui-btn_mini weui-btn_primary" id="right" type="button" onclick="attack1()"  >攻击</button>
                </h1></h1>
        </div>
        <div id="tab4" class="weui-tab__bd-item">
          <h1><canvas id="textCanvas" width="300" height="160" margin-bottom:"100px"
                style="border:1px solid #000000;">
                </canvas>
                <canvas id="textCanvas1" width="300" height="300" margin-bottom:"100px"
                style="border:1px solid #000000;">
                </canvas></h1>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
          <h1>
              <div class="caption" id="dialog"></div>
	          
	           <form onsubmit="onSubmit(); return false;">
	                <select style="margin-bottom:8px" id="client_list">
                        <option value="all">所有人</option>
                    </select>
                    <textarea class="textarea thumbnail" id="textarea"></textarea>
                    <div class="say-btn"><input type="submit" class="btn btn-default" value="发表" id="saybutton" />
                    <p>按ctr+回车快速回复</p> <p>可选择对象私聊</p> <p>每次发送信息耗费100金币</p> <p></p> <p></p>
                    </div>

               </form></h1>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
          <h1>
          <div class="weui-flex">   
            <div class="weui-flex__item"><div class="placeholder" id="playername"></div></div>
           </div>

           <div class="weui-flex">   
            <div class="weui-flex__item"><div class="placeholder" id="xzuobiao">x</div></div>
            <div class="weui-flex__item"><div class="placeholder" id="wood">木材</div></div>
            </div>

           <div class="weui-flex">
            
            <div class="weui-flex__item"><div class="placeholder" id="yzuobiao">y</div></div>
            <div class="weui-flex__item"><div class="placeholder" id="gold">黄金</div></div>
            </div>

            

              <div class="weui-flex">
            <div><button class="weui-btn weui-btn_mini weui-btn_primary"  href="javascript:;" id="minerup" class="ce" type="button" onclick="minerup()" >增加矿工</button></div>
            <div class="weui-flex__item"><div class="placeholder" id="minernum" >矿工</div></div>
            <div><button class="weui-btn weui-btn_mini weui-btn_primary"  href="javascript:;" id="minerdown" class="ce"  type="button" onclick="minerdown()" >减少矿工</button></div>
            </div>
            <div class="weui-flex">
            <div><button class="weui-btn weui-btn_mini weui-btn_primary" id="jackerup" class="ce"  type="button" onclick="jackerup()" >增加伐木工</button></div>
            <div class="weui-flex__item"><div class="placeholder" id="jackernum">weui</div></div>
            <div><button class="weui-btn weui-btn_mini weui-btn_primary" id="jackerdown" class="ce"  type="button" onclick="jackerdown()" >减少伐木工</button></div>
            </div>
            <div class="weui-flex">
            <div class="weui-flex__item"><div class="placeholder" id="level">等级</div></div>
            <div class="weui-flex__item"><div class="placeholder" id="population">升级剩余</div></div>
            </div>

            <div class="weui-flex">
            <div><button class="weui-btn weui-btn_mini weui-btn_primary" id="dplus" class="ce"  type="button" onclick="dpluss()" >增加秒伤</button></div>
            <div class="weui-flex__item"><div class="placeholder" id="miaoshang">秒伤</div></div><div class="weui-flex__item"><div class="placeholder" id="dianji">点击</div></div>
            <div><button class="weui-btn weui-btn_mini weui-btn_primary" id="eplus" class="ce"  type="button" onclick="epluss()" >增加点击</button></div>
            </div>
            <div class="weui-progress">
             <div class="weui-flex">   
           </div><div class="placeholder" >  </div>
            <div class="weui-progress__bar">
            <div class="weui-progress__inner-bar js_progress" id="percentbar" style="width: 100%;"></div>
            </div>
             <div class="weui-flex"> <div class="placeholder" >  </div>  
           </div>
            </div>
            <div class="weui-flex" align="center"></div>
            <div class="placeholder" align="center">点击升级</div>
            <div class="weui-flex" align="center"></div>
            
            
            <div class="weui-flex__item"> <button class="weui-btn weui-btn_mini weui-btn_primary" id="save" type="button" onclick="e()" >点击生产资源</button><button class="weui-btn weui-btn_mini weui-btn_primary" id="save" type="button" onclick="e()" >点击生产资源</button></div>
           
              
        </div>
      </div>

      <div class="weui-tabbar">
        <a href="#tab1" class="weui-tabbar__item weui-bar__item--on">
          
          <div class="weui-tabbar__icon">
       
          </div>
          <p class="weui-tabbar__label">作战星图</p>
        </a>
        <a href="#tab2" class="weui-tabbar__item">
          <div class="weui-tabbar__icon">
         
          </div>
          <p class="weui-tabbar__label">控制面板</p>
        </a>
        <a href="#tab3" class="weui-tabbar__item">
         
          <div class="weui-tabbar__icon">
           
          </div>
          <p class="weui-tabbar__label">宇宙广播</p>
        </a>
        <a href="#tab4" class="weui-tabbar__item">
          <div class="weui-tabbar__icon">
            
          </div>
          <p class="weui-tabbar__label">飞船信息</p>
        </a>
      </div>
    </div>

 


  
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
</body>
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7b1919221e89d2aa5711e4deb935debd' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">   startdraw() ; mousep(); </script>

</body>
</html>

