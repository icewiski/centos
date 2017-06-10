
function startdraw(){
  var cc=document.getElementById("myCanvas");
  var ctx=cc.getContext("2d");
  cc.height=cc.height
  ctx.beginPath();
  ctx.arc(player.x,player.y,1,0,2*Math.PI);
  ctx.stroke();
  }

function attack(x,y){
   
    gold=gold-100;
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.fillStyle="#DC143C";
    ctx.beginPath();
    ctx.arc(x,y,5,0,2*Math.PI);
    ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.stroke()
	  setTimeout(function refrash(){
   
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.beginPath();
    ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.stroke()}   ,2000);
        
    }

function left(){
  if(wood<=100){alert("木材不足")}
    else{
  player.x=player.x-player.speed;
  wood=wood-100;
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  c.height=c.height
  ctx.beginPath();
  ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.stroke();
  drawtext();}
  }


function right(){
   if(wood<=100){alert("木材不足")}
    else{
  player.x=player.x+player.speed;
  wood=wood-100;
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  c.height=c.height
  ctx.beginPath();
  ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.stroke();
  drawtext();}
  }

function up(){
   if(wood<=100){alert("木材不足")}
    else{
  player.y=player.y-player.speed;
  wood=wood-100;
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  c.height=c.height
  ctx.beginPath();
  ctx.arc(player.x,player.y,1,0,2*Math.PI);
   console.log(player.x,player.y);
    ctx.stroke();
  drawtext();}
  }

function down(){
   if(wood<=100){alert("木材不足")}
    else{
  player.y=player.y+player.speed;
  wood=wood-100;
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  c.height=c.height
  ctx.beginPath();
  ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.stroke();
  drawtext();}
  }


function vs(x,y){
  var xc=player.x-x;
  var yc=player.y-y;
  var zc=Math.sqrt(xc*xc+yc*yc);
  if (zc<5)
          { console.log(xc,yc);
        
           ondead();
          deletecookie();
        //  location.reload([true]);
        
      }
            else{console.log(zc);}
  }