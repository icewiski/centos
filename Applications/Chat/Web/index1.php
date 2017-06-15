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

  <script type="text/javascript" src="js/index.php"></script>
  <script type="text/javascript" src="js/draw.js"></script>
  <script type="text/javascript" src="js/cookie.js"></script>
  <script type="text/javascript" src="js/Cookies.js"></script>

  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/school.js"></script>
  <script type="text/javascript" src="js/schooldo.1.js"></script>
  <script type="text/javascript" src="js/resource.js"></script>
  <script type="text/javascript" src="js/mousep.js"></script>
  <script type="text/javascript" src="js/detect.js"></script>
    </head>
<body onload="connect();">
    <div class="container">
	    <div class="row clearfix">


 
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
                    <div class="say-btn"><input type="submit" class="btn btn-default" value="发表" id="saybutton" /></div>
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
<script type="text/javascript">   startdraw() ; mousep(); </script>
</body>
</html>

