<?php

	
	
/**
*
* (c) roadthemes.com /Init widgets
*
*/

?>
<div class="style-1">

	<section class="wrap col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			
			<div class="row" style="padding: 20px">
				
				<section class="content col-md-12">
					<h1><?php echo esc_html('Import data demo with 1 click');?></h1>
					
					<?php 
						
						if( !empty( $_POST['importSampleData'] ) ){
					
					?>
					
						<div id="errorImportMsg" class="p" style="width:100%;"></div>
						<div id="importWorking">
							<h2 style="color: #1D9126;">The importer is working</h2>
							
							<i>Status: <span id="import-status" style="font-size: 12px;color: maroon;">Preparing for importing...</span></i>
							<div id="importStatus" style="width:0%"></div>
						</div>
					
					    <script type="text/javascript">
					    	
					    	var docTitle = document.title;
					    	var el = document.getElementById('importStatus');
					    	
					    	function istaus( is ){
					    		
					    		var perc = parseInt( is*100 )+'%';
					    		el.style.width = perc;
					    		
					    		if( perc != '100%' ){
					    			el.innerHTML = perc+' Complete';
					    		}	
					    		else{
						    		el.innerHTML = 'Download Completed!  &nbsp;  Initializing Data...';	
					    		}
					    		document.title = el.innerHTML+'  - '+docTitle;
					    	}
					    	
					    	function tstatus( t ){ 
					    		document.getElementById('import-status').innerHTML = t;
					    	}
					    	
					    	function iserror( msg ){
						    	document.getElementById('errorImportMsg').innerHTML += '<div class="alert alert-danger">'+msg+'</div>';
						    	document.getElementById('errorImportMsg').style.display = 'inline-block';
					    	}
					    </script>
					<?php	
							include THEME_DIRECTORY.DS.'road_importdata'.DS.'importer.php';							
					?>		
						<script type="text/javascript">document.getElementById('importWorking').style.display = 'none';</script>
						<h2 style="color: blue;">The data have imported succesfully</h2>
					<?php	
						}else{
						
					?> 
					<form action="" method="post" onsubmit="doSubmit(this)"> 
						<div class="p">
							<p>
								<input type="submit" id="submitbtn" value="Click here to import demo" class="btn submit-btn" />
								<div id="loading"><img src="<?php echo THEME_URI; ?>/road_importdata/images/loading.gif" /></div>
								<h3 id="imp-notice">
									
								</h3>
								<input type="hidden" value="1" name="importSampleData" />

							</p>
						</div>
					</form>		
					<?php } ?>
				</section><!-- /content -->

			</div><!-- /row -->
	
			<div class="row">
	
			
			</div><!-- /row -->

	  </section>
</div>		
<script type="text/javascript">

	var loading = jQuery('#loading');
		loading.hide(); 
	function doSubmit( form ){
		var btn = document.getElementById('submitbtn');
		btn.className+=' disable';
		btn.disabled=true;
		btn.value='The demo data is preparing for importing.....';
		loading.show();
		
		document.getElementById('imp-notice').style.display = 'block';
	}
	
</script>  

<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
}
</style>


