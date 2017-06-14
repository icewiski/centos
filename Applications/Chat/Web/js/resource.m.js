
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
       }
function drawtext(){
     var c=document.getElementById("textCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.font="20px Arial";
    ctx.fillText("黄金:",150,80);
    ctx.fillText(gold,210,80);
    ctx.fillText("矿工:",10,80);
    ctx.fillText(miner,80,80);

    ctx.fillText("木材:",150,40);
    ctx.fillText(wood,210,40);
    ctx.fillText("伐木工:",10,40);
    ctx.fillText(jacker,80,40);


    ctx.fillText("人口:",10,120);
    ctx.fillText(level,80,120);
    }

function minerup(){
    if (miner + jacker>=level){return;}
     else{ miner=miner+1;
     save() ;
      drawtext();
    }
    }
function minerdown(){   
     if (miner + jacker<1||miner<1){return;}
      else{ miner=miner-1;
         save();
          drawtext();
          }
       }
function jackerup(){
     if (miner + jacker>=level){return;}
   else{ jacker=jacker+1;
        save();
        drawtext();
        }
    }
function jackerdown(){
     if (miner + jacker<1||jacker<1){return;}
   else{ jacker=jacker-1;
        drawtext();
        save();}
    }