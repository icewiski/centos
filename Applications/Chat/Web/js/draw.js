
function startdraw(){

  var cc=document.getElementById("myCanvas");
  var ctx=cc.getContext("2d");
  cc.height=cc.height
  ctx.beginPath();
  ctx.arc(player.x,player.y,1,0,2*Math.PI);
  ctx.stroke();
  drawaim();
  drawtarget(target.x,target.y);
  }

function attack(x,y,fromx,fromy,r){
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.fillStyle="#DC143C";
    ctx.beginPath();
    ctx.arc(x,y,r,0,2*Math.PI);
    ctx.closePath();
    ctx.moveTo(player.x,player.y)
    ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.fill();
    ctx.fillStyle="red";
    ctx.moveTo(x,y);
    ctx.lineTo(fromx,fromy);
    ctx.stroke()
	  setTimeout(function refrash(){
   
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.beginPath();
    ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.stroke()}   ,2000);
        
    }
function attackblack(x,y){
     
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    c.height=c.height
    ctx.fillStyle="black";
    ctx.beginPath();
    ctx.arc(x,y,5,0,2*Math.PI);
    ctx.closePath();
    ctx.moveTo(player.x,player.y)
    ctx.arc(player.x,player.y,1,0,2*Math.PI);
    ctx.fill();
    

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
 // console.log(player.x,player.y);
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
 //  console.log(player.x,player.y);
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
 //   console.log(player.x,player.y);
  drawtext();}
  }

var attackr=5;
function vs(x,y){
  var xc=player.x-x;
  var yc=player.y-y;
  var zc=Math.sqrt(xc*xc+yc*yc);
  if (zc<attackr)
          {
   //          console.log(xc,yc);
        
           ondead();
          deletecookie();
        //  location.reload([true]);
        
      }
            else{console.log(zc);}
  }