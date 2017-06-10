

var t=1;
var t2=1;
var pp=0
var pu=1;
var c =Math.round( 50*(Math.random())+10 )  ;
var d =Math.round( 50*(Math.random())+10);
var player={
    x:c,
    y:d,
    a:"10",
    b:"",
    d:1,
    speed:1,
    range:20,
    age:"3424"
           }


var myVar=setInterval(function(){age()},1000);
function myTimer(){
	    t=t+1;
        document.getElementById("demo1").innerHTML=t;
                   }
        



 var t1=1;

       
function age(){
     save();
    var b1=new Date();    
    var b2=b1.getTime();

      if (l>=3) {
         var b=new Date();
         var t1=b.getTime();
         t2=Math.round((b2-t1)/10000);
 
}
    else {
        var b=new Date();
        var t1=b.getTime();
        t2=Math.round((b2-t1)/10000);
  
}
    
    
   
     }

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