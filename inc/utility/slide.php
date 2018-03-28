<?php
	$slides = returnDBObject("SELECT * FROM datatype_slidehome ORDER BY ordine ASC",array(),1); 
?>
<div class="wrap-main-slide">
  	<div id="carousel-home" class="carousel slide">
  		<?php if(count($slides)>1){?>
	     <ol class="carousel-indicators">
	     	<?php $i=0; foreach($slides as $slide){ ?>
	        	<li data-target="#carousel-home" data-slide-to="<?php echo $i; ?>" <?php if($i==0){ ?>class="active"<?php } ?>></li>
	        <?php $i++; } ?>
	      </ol>
	     <?php } ?>
	      <div class="carousel-inner" role="listbox">
	      	<?php $i=0; foreach($slides as $slide){ ?>
		        <div class="item <?php if($i==0){ ?>active<?php } ?>">
		          <div class="slide-img" style="background-image:url('/contents/file_slidehome/<?php echo $slide['file_immagine']; ?>')"></div>
				  <div class="shadow"></div>
				  <div class="slide-details text-center">
				  	<h1><?php echo $slide['titolo_slide_'.$language]; ?></h1>
				  	<?php echo $slide['html_slide_'.$language]; ?>
				  </div>
		        </div><!--item-->
	        <?php $i++; } ?>
	      </div>
	      <a class="left carousel-control hidden" href="#carousel-home" role="button" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
	      </a>
	      <a class="right carousel-control hidden" href="#carousel-home" role="button" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
	      </a>
	</div><!--carousel-->
</div><!--main-slide-->