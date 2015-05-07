<?php

      require_once "sistem/fonksiyonlar.php";
	  
	  
	  ##Tema İçerik Fonksiyonu##
	  function tema_icerik(){
	  $do=g("do");
	  switch($do){
	  
	  case "konu":
	  if($link=g("link")){
	        $query=query("SELECT * FROM konular WHERE konu_link='$link'");
		    if(mysql_affected_rows()){
			$row=row($query);
			$konuid=$row["konu_id"];
			 $konu=explode("-------------------",$row["konu_aciklama"]);
			 $konu=$konu[1];
			 $baslik=ss($row["konu_baslik"]);
			 $link=URL."/".$row["konu_link"].".html"; 
			 $katlink=URL."/kategori/".$row["kategori_link"];
			 $kategori=ss($row["kategori_adi"]);
			 $okunma=number_format($row["konu_hit"]);
			 $tarihExplode=explode(" ",$row["konu_tarih"]);
			 $etiketler=$row["konu_etiket"];
			 $tarih=$tarihExplode[0];
			 $zaman=$tarihExplode[1];
			 
			 require TEMA."default/konu_full.php";
			}else{
			go(URL);
			}
			
      }else{
			go(URL);		 
	       }
	  break;
	  
	  case "kategori":
	   if($link=g("link")){
	      
		   }else{
		     go(URL);
		   }
	  
	  break;
	  
	  case "uye":
	  
	  break;
	  case "giris":
	     if(session("login")){
		 go(URL);
		 } else{
		 require_once TEMA."default/giris.php";
		 }
	  break;
	  
	  case "cikis":
	  if(session("login")){
	      session_destroy();
		  go(URL);
	  }else{
	      go(URL);
	  }
	  break;
	  
	  case "etiket":
	  if($link=g("link")){
	      echo $link;
		   }else{
		     go(URL);
		   }
	  
	  break;
	  
	  case "kayit":
	  if(session("login")){
	      go(URL);
	  }else{
	  require_once TEMA."default/kayit.php";
	  }
	  break;
	  default:
	  require_once TEMA."default/default.php";
	  break;
	  
	  }
	  }
	  ##Tema Kategoriler Fonksiyonu##
	  function tema_kategoriler(){
	  
	  $query=query("SELECT * FROM kategoriler ORDER BY kategori_adi ASC");
	  while($row=row($query)){
	  echo  '<li><a href="'.URL.'/kategori/'.$row["kategori_link"].'">'.ss($row["kategori_adi"]).'</a></li>';
	  }
	  
	  
	  }
	  
	  ##Tema Anasayfa Konu Fonksiyonu##
	  
	  function tema_anasayfa_konu(){
	      $sayfa=g("s") ? g("s"): 1;
		  $ksayisi=rows(query("SELECT konu_id FROM konular WHERE konu_onay=1 && konu_anasayfa=1"));
		  
		   if(mysql_affected_rows()){
		   $limit=5;
		   $ssayisi=ceil($ksayisi/$limit);
		   $baslangic=($sayfa*$limit)-$limit;
		   $query=query("SELECT * FROM konular INNER JOIN uyeler ON uyeler.uye_id=konular.konu_ekleyen INNER JOIN kategoriler ON kategoriler.kategori_id=konular.konu_kategori WHERE konu_onay=1 && konu_anasayfa=1 ORDER BY konu_id DESC LIMIT $baslangic,$limit");
		   while($row=row($query)){
		     $konu=explode("-------------------",$row["konu_aciklama"]);
			 $konu=$konu[0];
			 $baslik=ss($row["konu_baslik"]);
			 $link=URL."/".$row["konu_link"].".html"; 
			 $katlink=URL."/kategori/".$row["kategori_link"];
			 $kategori=ss($row["kategori_adi"]);
			 $okunma=number_format($row["konu_hit"]);
			 $tarihExplode=explode(" ",$row["konu_tarih"]);
			 $tarih=$tarihExplode[0];
			 $zaman=$tarihExplode[1];
			 
			 require TEMA."default/konu_anasayfa.php";
		   }
		   }else{
		   $hata="Henüz hiç içerik eklenmemiş.";
		   require_once  TEMA."default/hata.php";
		   }
	  
	  }
	  
	  ##Tema Anasayfa Sayfalama
	  
	   function tema_anasayfa_sayfalama(){
	    $sayfa=g("s") ? g("s"): 1;
		$limit=5;
		$ksayisi=rows(query("SELECT konu_id FROM konular WHERE konu_onay=1 && konu_anasayfa=1"));
	    $ssayisi=ceil($ksayisi/$limit);
				   if($ksayisi>$limit){
				   ##Onceki Sayfalama
				   $oncekiSayfa=$sayfa >0 ? $sayfa-1 : 1;
				   $onceki=URL.'/sayfa/'.$oncekiSayfa;
				   
				    ##Sonraki Sayfalama
				   $sonrakiSayfa=$sayfa < $ssayisi ? $sayfa+1 : $ssayisi;
				   $sonraki=URL.'/sayfa/'.$sonrakiSayfa;
				   
				   require_once TEMA."default/sayfala.php";
		  }
	   
	   }
	   
	   ##Konu Etiketler Fonksiyonu ##
	   
	   function konu_etiketler($etiketler){
	   $bol=explode(",",$etiketler);
	   $etikets=array();
	   foreach($bol as $etiket){
	      $etiket='<a href="'.URL.'/etiket/'.ss(trim($etiket)).'">'.ss(trim($etiket)).'</a>';
	      array_push($etikets,$etiket);
	   }
	   echo implode(",",$etikets);
	   
	   }
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	  
?>