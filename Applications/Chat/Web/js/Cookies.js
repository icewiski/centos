function check(){
    if ($.cookie('l')>=3){
       
        t1=$.cookie('t1');
        load();
        }
    else {return}
}

function save(){
	 $.cookie('gold',gold ,{expires:7}) ;
	 $.cookie('wood',wood ,{expires:7}) ;
     $.cookie('miner',miner ,{expires:7}) ;
	 $.cookie('jacker',jacker ,{expires:7}) ;
     $.cookie('x',player.x ,{expires:7}) ;
     $.cookie('y',player.y ,{expires:7}) ;
     $.cookie('l',l ,{expires:7}) ;
     $.cookie('t1',t1 ,{expires:7}) ;
     $.cookie('dplus',dplus ,{expires:7}) ;
     $.cookie('eplus',eplus ,{expires:7}) ;
            	 }

 function deletecookie(){
     console.log(wood,gold,l,level);
   
    gold=0;
     wood=0;
     miner=1;
     jacker=1;
     l=3;
     level=2;
     dplus=0;
     eplus=0;
     lefthp=100;
     $.cookie('gold',null ) ;
	 $.cookie('wood',null ) ;
     $.cookie('miner',null ) ;
	 $.cookie('jacker',null ) ;
     $.cookie('x',null ) ;
     $.cookie('y',null ) ;
     $.cookie('l',null ) ;
     $.cookie('t1',null ) ;
     $.cookie('dplus',null ) ;
    $.cookie('eplus',null ) ;
      drawtext();
    drawlevel();
    startdraw();
  console.log(wood,gold,l,level); }

function load(){
	gold=$.cookie('gold'); 
	var str= gold;
    var x = str-0;
    x = x*1;
    gold=x;

    wood=$.cookie('wood'); 
	var str1= wood;
    var x1 = str1-0;
    x1 = x1*1;
    wood=x1;
    
    miner=$.cookie('miner'); 
	var str2= miner;
    var x2 = str2-0;
    x2 = x2*1;
    miner=x2;

    jacker=$.cookie('jacker'); 
	var str3= jacker;
    var x3 = str3-0;
    x3 = x3*1;
    jacker=x3;

    player.x=$.cookie('x'); 
	var str4= player.x;
    var x4 = str4-0;
    x4 = x4*1;
    player.x=x4;

     player.y=$.cookie('y'); 
	var str5= player.y;
    var x5 = str5-0;
    x5 = x5*1;
    player.y=x5;
    
    l=$.cookie('l'); 
	var str6= l;
    var x6 = str6-0;
    x6 = x6*1;
    l=x6;

    t1=$.cookie('t1'); 
	var str7=t1;
    var x7 = str7-0;
    x7 = x7*1;
    t1=x7;

     dplus=$.cookie('dplus'); 
	var str8=dplus;
    var x8 = str8-0;
    x8 = x8*1;
    dplus=x8;

     eplus=$.cookie('eplus'); 
	var str9=eplus;
    var x9 = str9-0;
    x9 = x9*1;
    eplus=x9;
     
    
     level=l-2;
     l=l-1;
     startdraw();
       drawtext();
       drawlevel();

    }
  
  