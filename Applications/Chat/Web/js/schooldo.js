       var l=3;  //当前使用数组顺序
       var level=1;
       var  lefthp=ssc[l];
var dplus = 10;
var eplus = 10;

var myVar3=setInterval(function(){d()},1000);
function drawlevel(){
     var c=document.getElementById("textCanvas1");
    var ctx=c.getContext("2d");
    c.height=c.height
    var miaoshang=sx[l]+dplus;
    var dianji=ssz[l]+eplus;
    
    ctx.font="20px Arial";
    ctx.fillText("殖民地:",10,40);
    ctx.fillText(level,150,40);
    ctx.fillText("自然增长人口:",10,80);
    ctx.fillText(miaoshang,150,80);
   
   ctx.fillText("可容纳人口:",10,120);
    ctx.fillText(ssc[l],150,120);
     ctx.fillText("人口上限:",10,160);
    ctx.fillText(lefthp,150,160);
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
        level=level;
       lefthp=ssc[l]
        drawlevel();
          }
       else{lefthp= lefthp-sx[l]-dplus;
           if(lefthp<=0){lefthp=0}
           drawlevel();
    }
 
     }

function e(){

    if (lefthp<=0){
    
       l=l+1;
        level=level+1; 
        level=level;
       lefthp=ssc[l]
        drawlevel();
          }
       else{lefthp= lefthp-ssz[l]-dplus;
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
   }
   else {return}
   }

function epluss(){
  if (wood>=100){
   wood=wood-100;
   eplus=eplus+20;
    save();
  drawtext();
drawlevel();}
  else {return}
}