var movespeed=200;
function moveto(){
    clearInterval(movetox);
  var a=target.x-player.x;
  var b=target.y-player.y;
  var movetox=setInterval(function(){movetotarget()},movespeed);
  function movetotarget(){
   console.log(a,b)
      if(Math.abs(a)>0){
         
          player.x=player.x+a/Math.abs(a);
          a=target.x-player.x;
         }
   else {if(Math.abs(b)>0){
           
          player.y=player.y+b/Math.abs(b);
          b=target.y-player.y;
        }
        else{clearInterval(movetox)}
 //    if(a+b=0){clearInterval(movetox) } 
  }}
}


function detectleveladd(){
  if(gold<=1000){alert("黄金不足")}
       else{
         gold=gold-1000;
             detectlevel=detectlevel+10;
         updateinfo();
                   }
}

function movespeedadd(){
  if(wood<=1000){alert("黄金不足")}
       else{  
         wood=wood-1000;
           movespeed=movespeed*0.9;
         updateinfo();
                   }
}

function attackradd(){
  if(gold<=1000){alert("黄金不足")}
       else{ 
         gold=gold-1000;
            attackr=attackr+1;
         updateinfo();
                   }
}