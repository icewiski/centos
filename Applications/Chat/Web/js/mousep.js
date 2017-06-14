//set up the canvas and context 
 function mousep(){
 var c = document.getElementById("myCanvas"); 
 var ctx = c.getContext("2d"); 
 ctx.fillStyle ="rgba(1,1,1,1)"; 


 //report the mouse position on click 
 c.addEventListener("click", function (evt) { 
  var mousePos = getMousePos(c, evt); 
  target.x=Math.round(mousePos.x);
  target.y=Math.round(mousePos.y);
  drawtarget(target.x,target.y); 
  
 }, false); 


 //Get Mouse Position 
 function getMousePos(c, evt) { 
   var rect = c.getBoundingClientRect(); 
   return { 
     x: evt.clientX - rect.left * (c.width / rect.width),
     y: evt.clientY - rect.top * (c.height / rect.height)
   }
 }
 }

function  drawtarget(x,y){

var a=target.x-player.x;
var b=target.y-player.y;
aimdirection=Math.atan2(b,a)/Math.PI*180+90;
console.log(aimdirection)
  var cc=document.getElementById("myCanvas");
  var ctx=cc.getContext("2d");
  
  ctx.beginPath();
  ctx.moveTo(x-3,y);
  ctx.lineTo(x+3,y);
  ctx.moveTo(x,y-3);
  ctx.lineTo(x,y+3);
  ctx.fill();
  ctx.stroke();
  
}