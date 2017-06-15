//探测
     function detect1(){
            if(gold<=100){alert("黄金不足")}
       else{    
           gold=gold-100;
                drawdetect();
               	ws.send('{"type":"detect","to_client_id":"all","to_client_name":"all","fromx":"'+player.x+'","fromy":"'+player.y+'","ad":"'+aimdirection+'","dl":"'+detectlength+'","da":"'+detectangle+'"}');
             }
      }
     var detectlevel=100; 
     var detecteara = detectlevel*5+75*Math.PI;
     var aimdirection = 10;
     var detectlength = 40 ;
     var detectangle  = 360*detecteara/(detectlength*detectlength*Math.PI);
  function drawaim()  {   
     // console.log(aimdirection);
        var hudu = (2*Math.PI/360)*aimdirection;  //初始孤 度 为0
        var x=player.x+Math.sin(hudu)*detectlength;
        var y=player.y-Math.cos(hudu)*detectlength;
        var c=document.getElementById("myCanvas");
        var ctx=c.getContext("2d");
        ctx.fillStyle="#DC143C";
        ctx.beginPath();
        ctx.moveTo(player.x,player.y);
        ctx.lineTo(x,y);
        ctx.stroke()
        drawdetect();      }


//player.x,player.y,,target.y,aimdirection,detectlength,detectangle
  function detect2(fx,fy,ad,dl,da,fromplayer){
    var ux ,uy, theta;
    var dx=player.x -fx;
    var dy=fy -player.y;
    var hudu = (2*Math.PI/360)*ad;
    theta = (2*Math.PI/360)*da;
    ux=Math.sin(hudu)*dl;
    uy=Math.cos(hudu)*dl;
    var length =Math.sqrt(dx*dx+dy*dy);
     if (length > dl){
        
        }
    else{
        var dianji=(dx*ux+dy*uy)
        var moji= Math.sqrt(Math.abs(dx*dx+dy*dy))*Math.sqrt(Math.abs(ux*ux+uy*uy))
   //      console.log(dx,dy,ux,uy,dianji,moji);
        var gama=Math.acos(dianji/moji);
   //      console.log(gama);
        if( 
        gama<theta){
           
            $("#dialog").append('<p>你被探测到了</p>');
            $('#dialog').animate({scrollTop:9999999+'px'},10)
             ws.send('{"type":"report","to_client_id":"all","to_client_name":"all","ddx":"'+player.x+'","ddy":"'+player.y+'","ddlevel":"'+level+'","content":"探测到一颗生命行星，坐标'+player.x+''+player.y+'，等级'+level+'"}');
           $.alert('<p>你被探测到了</p>'); 
        }
        
   //  console.log(length,hudu,theta,gama,player.x,player.y,ux,uy,px,target.y);
    }    }    



function drawdetect(e){
    detectangle  = 360*detecteara/(detectlength*detectlength*Math.PI);
    var hudu = (2*Math.PI/360)*aimdirection;  
 //   var dx=player.x+Math.sin(hudu)*detectlength;
  //  var dy=player.y-Math.cos(hudu)*detectlength;
    var shudu= (2*Math.PI/360)*(aimdirection-detectangle);
    var ehudu= (2*Math.PI/360)*(aimdirection+detectangle);
    var sx=player.x+Math.sin(shudu)*detectlength;
    var sy=player.y-Math.cos(shudu)*detectlength;
    var ex=player.x+Math.sin(ehudu)*detectlength;
    var ey=player.y-Math.cos(ehudu)*detectlength;
//    console.log(detectangle,detecteara,detectlength);
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    ctx.fillStyle="#DC143C";
    ctx.beginPath();
    ctx.moveTo(player.x,player.y);
    sshudu=shudu-(Math.PI/2);
    eehudu=ehudu-(Math.PI/2);
    ctx.arc(player.x,player.y,detectlength,sshudu,eehudu,false);
    ctx.closePath();
    ctx.stroke()
}

function drawreport(x,y){
    console.log(x,y);
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    ctx.fillStyle="#87CEFA";
    ctx.beginPath();
    ctx.fill();
    ctx.arc(x,y,10,0,2*Math.PI);
    ctx.stroke();
     ctx.fill();
}