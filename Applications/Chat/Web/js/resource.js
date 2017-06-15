
var level=8;
var gold=2000;
var wood=2000;

var miner=4;
var jacker=4;

var collectspeed=2;
var collecttime=1000;
var myVar1=setInterval(function(){collectgold()},collecttime);
function collectgold(){
    gold =gold+ miner*collectspeed;
    wood =wood+ jacker*collectspeed;
    if(gold<0){gold=0};
    if(wood<0){wood=0};
    save();
    drawtext();
    startdraw()
    updateinfo()
       }
function updateinfo(){
     $("#xzuobiao").text("x坐标："+player.x);
     $("#yzuobiao").text("y坐标："+player.y);
     $("#wood").text("能量："+wood+"+"+jacker*2+"/s");
     $("#gold").text("矿石："+gold+"+"+miner*2+"/s");
     
     $("#population").text("建造进度："+lefthp);
     $("#level").text("船舱数量："+level);
     $("#playername").text("玩家名字："+name);
     $("#minernum").text("采矿器舱："+miner);
     $("#jackernum").text("反应堆舱："+jacker);    
     $("#detectlevel").text("探测距离："+detectlevel);  
     $("#movespeed").text("移动速度："+movespeed);  
     $("#attackr").text("攻击半径："+attackr);  
     miaoshang=2+dplus;
     dianji=10+eplus;
     $("#miaoshang").text("自动建造速度："+miaoshang);
     $("#dianji").text("手动建造速度："+dianji);
     hppercent=(1000-lefthp)/10;
     var hpppp=hppercent+"%";
     $("#percentbar").attr("style","width:"+hpppp);
}
function drawtext(){
     var c=document.getElementById("textCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.font="20px Arial";
    ctx.fillText("能量:",150,80);
    ctx.fillText(gold,210,80);
    ctx.fillText("反应堆:",10,80);
    ctx.fillText(miner,80,80);

    ctx.fillText("矿石:",150,40);
    ctx.fillText(wood,210,40);
    ctx.fillText("采矿船:",10,40);
    ctx.fillText(jacker,80,40);


    ctx.fillText("船舱:",10,120);
    ctx.fillText(level,80,120);
    }

function minerup(){
    if (miner + jacker>=level){return;}
     else{ miner=miner+1;
     save() ;
      drawtext();
   
       $("#minernum").text("矿工："+miner);
    }
    }
function minerdown(){   
     if (miner + jacker<1||miner<1){return;}
      else{ miner=miner-1;
         save();
          drawtext();
       
         
       $("#minernum").text("矿工："+miner);
          }
       }
function jackerup(){
     if (miner + jacker>=level){return;}
   else{ jacker=jacker+1;
        save();
        drawtext();
       
         
       $("#jackernum").text("伐木工："+jacker);
        }
    }
function jackerdown(){
     if (miner + jacker<1||jacker<1){return;}
   else{ jacker=jacker-1;
        drawtext();
        save();}
        
       $("#jackernum").text("伐木工："+jacker);
    }

function goldadd(){
    gold=gold+eplus;
    updateinfo();
}

function woodadd(){
    wood=wood+eplus
    updateinfo();
}