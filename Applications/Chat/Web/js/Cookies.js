function check(){
    if ($.cookie('l')>=3){
       
        t1=$.cookie('t1');
        load();
        }
    else {return}
}

function save(){
//	 $.cookie('gold',gold ,{expires:7}) ;
////	 $.cookie('wood',wood ,{expires:7}) ;
 //    $.cookie('miner',miner ,{expires:7}) ;
//	 $.cookie('jacker',jacker ,{expires:7}) ;
//     $.cookie('x',player.x ,{expires:7}) ;
///     $.cookie('y',player.y ,{expires:7}) ;
 //    $.cookie('level',level ,{expires:7}) ;
 //    $.cookie('lefthp',lefthp ,{expires:7}) ;
 //    $.cookie('dplus',dplus ,{expires:7}) ;
 //    $.cookie('eplus',eplus ,{expires:7}) ;
            	 }

 function deletecookie(){
  //   console.log(wood,gold,l,level);
   
    gold=2000;
     wood=2000;
     miner=5;
     jacker=5;
     
     level=8;
     dplus=0;
     eplus=0;
     lefthp=100;
    $.cookie('gold',null ) ;
//	 $.cookie('wood',null ) ;
//     $.cookie('miner',null ) ;
//	 $.cookie('jacker',null ) ;
 //    $.cookie('x',null ) ;
//     $.cookie('y',null ) ;
//     $.cookie('level',null ) ;
//     $.cookie('lefthp',null ) ;
//     $.cookie('dplus',null ) ;
 //   $.cookie('eplus',null ) ;
      drawtext();
    drawlevel();
    startdraw();
//  console.log(wood,gold,l,level);
 }

function load(){
//	gold=$.cookie('gold'); 
	var str= gold;
    var x = str-0;
    x = x*1;
    gold=x;

//    wood=$.cookie('wood'); 
	var str1= wood;
    var x1 = str1-0;
    x1 = x1*1;
    wood=x1;
    
//    miner=$.cookie('miner'); 
	var str2= miner;
    var x2 = str2-0;
    x2 = x2*1;
    miner=x2;

 //   jacker=$.cookie('jacker'); 
	var str3= jacker;
    var x3 = str3-0;
    x3 = x3*1;
    jacker=x3;

 //   player.x=$.cookie('x'); 
	var str4= player.x;
    var x4 = str4-0;
    x4 = x4*1;
    player.x=x4;

 //    player.y=$.cookie('y'); 
	var str5= player.y;
    var x5 = str5-0;
    x5 = x5*1;
    player.y=x5;
    
 //   level=$.cookie('level'); 
	var str6= level;
    var x6 = str6-0;
    x6 = x6*1;
    level=x6;

 //   lefthp=$.cookie('lefthp'); 
	var str7=lefthp;
    var x7 = str7-0;
    x7 = x7*1;
    lefthp=x7;

//     dplus=$.cookie('dplus'); 
	var str8=dplus;
    var x8 = str8-0;
    x8 = x8*1;
    dplus=x8;

 //    eplus=$.cookie('eplus'); 
	var str9=eplus;
    var x9 = str9-0;
    x9 = x9*1;
    eplus=x9;
     
    
    
    
     startdraw();
       drawtext();
       drawlevel();

    }
  
  