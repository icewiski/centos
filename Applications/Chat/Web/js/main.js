

var t=1;
var t2=1;
var pp=0
var pu=1;
var c =Math.round( 50*(Math.random())+100 )  ;
var d =Math.round( 50*(Math.random())+100 )  ;
var player={
    x:c,
    y:d,
    a:"10",
    b:"",
    d:1,
    speed:1,
    range:20,
  
           }

 var t1=1;

       


pu=t2;
function speed(){
    document.getElementById("demo8").innerHTML=player.speed; 
  
    if (t2-pu > 1 )
    {player.speed=player.speed + 5;
    pu=pu+1}
    document.getElementById("demo8").innerHTML=player.speed; 
    }

function range(){
    document.getElementById("demo9").innerHTML=player.range; 
  
    if (t2-pu > 1 )
   {player.range=player.range + 20;
       pu=pu+1}
    document.getElementById("demo9").innerHTML=player.range; 
    }