var sx = new Array();
var sy = new Array();
var sz = new Array();   //攻击力
var sa = new Array();
var sb = new Array();
var sc = new Array();   //生命值
var ss = new Array();   //升级时间
var sss = new Array();
var ssc = new Array(); 
var ssz = new Array(); 
var i=2;
var h=1;



sx[0]=1;
sa[0]=3;



for (i=2;i<100;i++){  

    for(h=1;h<i;h++){
    sx[i]=h*h;
    sa[i]=h*h*4.151;
    }
    
    sy[i]=(1.524151)* sx[i]+i;
    sb[i]=(10.384725)* sa[i]+i;
          sz[i]=sx[i]+sy[i];
          sc[i]=(sa[i]+sb[i])*i*i/10;
          ss[i]=sc[i]/sz[i];
        sss[i]=Math.round(ss[i]);
        ssz[i]=Math.round(sz[i]);
        ssc[i]=Math.round(sc[i]);
     
        }