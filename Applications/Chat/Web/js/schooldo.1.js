       var l=3;  //当前使用数组顺序
     
       var  lefthp=1000;
       var  hppercent=10;
var dplus = 10;
var eplus = 10;
    var miaoshang=2+dplus;
    var dianji=10+eplus;
var myVar3=setInterval(function(){d()},1000);
function drawlevel(){
     var c=document.getElementById("textCanvas1");
    var ctx=c.getContext("2d");
    c.height=c.height

    
    ctx.font="20px Arial";
    ctx.fillText("殖民地:",10,40);
    ctx.fillText(level,150,40);
    ctx.fillText("自然增长人口:",10,80);
    ctx.fillText(miaoshang,150,80);
   
   ctx.fillText("可容纳人口:",10,120);
    ctx.fillText(1000,150,120);
     ctx.fillText("人口:",10,160);
    ctx.fillText(1000-lefthp,150,160);
      ctx.fillText("规模复制人口:",10,200);
    ctx.fillText(dianji,150,200);
     ctx.fillText("x坐标:",10,240);
    ctx.fillText(player.x,150,240);
      ctx.fillText("y坐标:",10,280);
    ctx.fillText(player.y,150,280);
   save();
    
   
    }
function d(){

    if (lefthp<=0){
    
       l=l+1;
        level=level+1; 
      
   
        drawlevel();
          }
       else{lefthp= lefthp-10-dplus;
          
           if(lefthp<=0){lefthp=0}
           drawlevel();
    }
 
     }

function e(){

    if (lefthp<=0){
    
       l=l+1;
        level=level+1; 
     
       lefthp=1000;
        drawlevel();
          }
       else{lefthp= lefthp-2-eplus;
           if(lefthp<=0){lefthp=0}
           drawlevel();
    }
 
     }

function dpluss(){
   if(gold>=100){ gold=gold-100;
    dplus=dplus+10;
    save();
    drawtext();
    drawlevel();
    updateinfo();
   }
   else {return}
   }

function epluss(){
  if (wood>=100){
   wood=wood-100;
   eplus=eplus+20;
    save();
  drawtext();
  drawlevel();
  updateinfo();}
  else {return}
  }

var target={
  x:player.x,
  y:player.y,
  }

function  xplus(e){
    target.x=target.x+e;
    drawtarget(target.x,target.y);
  };
  function  xminus(e){
    target.x=target.x-e;
    drawtarget(target.x,target.y);
  };
  function  yplus(e){
    target.y=target.y+e;
    drawtarget(target.x,target.y);
  };
  function  yminus(e){
    target.y=target.y-e;
    drawtarget(target.x,target.y);
  };

function drawtarget(x,y){
  var  c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  c.height=c.height
  ctx.beginPath();
  ctx.moveTo(x,1);
  ctx.lineTo(x,600);
  ctx.moveTo(1,y);
  ctx.lineTo(600,y);
  ctx.closePath();
  ctx.stroke();
  
}