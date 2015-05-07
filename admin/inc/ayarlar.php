<?php

$query=query("SELECT * FROM ayarlar");
$row=row($query);


?>
		
		<article class="module width_full">
			<header><h3>GENEL AYARLAR</h3></header>
			<?php
			if($_POST){
			$site_url=p("site_url",true);
			$site_baslik=p("site_baslik",true);
			$site_desc=p("site_desc",true);
			$site_keyw=p("site_keyw",true);
			$site_durum=p("site_durum",true);
			
			if(!$site_url || !$site_baslik){
			
			echo '<h4 class="alert_error">Gerekli Alanlari Doldurmaniz Gerekmektedir...</h4>';
			                               }
			   else{
			$update=query("UPDATE ayarlar SET
			site_url='$site_url',
			site_baslik='$site_baslik',
			site_desc='$site_desc',
			site_keyw='$site_keyw',
			site_durum='$site_durum'");
			      
			   if($update){
			      echo '<h4 class="alert_success">Yeni Ayarlar Basariyla Kaydedildi...Yonlendiriliyorsunuz</h4>';	
                  go(URL."/admin/index.php?do=".g("do"),1);
			              }
			    
			         
			  else{
			      echo '<h4 class="alert_error">Mysql Hatasi: '.mysql_Error().'</h4>';
			      }
			    }
			  }
			?>
				<form action="" method="post">
				<div class="module_content">
						<fieldset>
							<label>SITE URL</label>
							<input type="text" name="site_url" value="<?php echo ss($row["site_url"]);?>">
						</fieldset>
							<fieldset>
							<label>SITE BASLIK</label>
							<input type="text" name="site_baslik" value="<?php echo ss($row["site_baslik"]);?>">
						</fieldset>
						<fieldset>
							<label>SITE ACIKLAMASI</label>
							<textarea rows="3" name="site_desc"> <?php echo ss($row["site_desc"]);?></textarea>
						</fieldset>
						<fieldset>
							<label>SITE KEYWORD</label>
							<textarea rows="3" name="site_keyw"> <?php echo ss($row["site_keyw"]);?></textarea>
						</fieldset>
						<fieldset> 
							<label>SITE DURUMU</label>
							<select name="site_durum" >
								<option value="1" <?php echo $row["site_durum"] ? 'selected': null;?>>Online</option>
								<option value="1" <?php echo !$row["site_durum"] ? 'selected': null;?>>Offline</option>
							
							</select>
						</fieldset>
						
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Ayarlari Guncelle" class="alt_btn">
				</div>
			</footer>
			</form>
		</article><!-- end of post new article -->
		
	
		</article><!-- end of styles article -->
		<div class="spacer"></div>