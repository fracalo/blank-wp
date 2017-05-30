
<?
/* templater for posts (news)*/


$post = get_post();
$id =  $post->ID;
$lg = get_language();
$fields = get_fields($id);

$title = $fields["l_titolo_$lg"];
$desc = $fields["l_descrizione_$lg"];
$ante = $fields["l_anteprima_$lg"];


$img = $fields['copertina_img'];
$images = $fields['copertina_slide'];

echo '<pre>', print_r($slide, 1), '</pre>';
?>


<?php get_header(); ?>
<style>
.flexslider{
/*  height: 500px;
  height: 40vw;*/
}
.flexslider .slides img {
/*   height: 100%*/
}
</style>
<section class='container single'>
  <div class='row'>
    <div class='col-sm-4 single__txt'>
       <h1 class='single__txt__title'> <? echo $title ?> </h1>
       <div class='single__txt__ante'> <? echo $ante ?> </div>
     </div> 

    <div class='col-sm-8 single__img-wrap'>

      <? if( $images ): ?>
      <div id="carousel" class="flexslider">
          <ul class="slides">
              <?php foreach( $images as $image ): ?>
                  <li>
                      <img src="<?php echo $image['sizes']['slide-post']; ?>" alt="<?php echo $image['alt']; ?>" />
                  </li>
              <?php endforeach; ?>
          </ul>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class='row'>
    <? echo $desc ?>
  </div>
</section>

<script type="text/javascript" charset="utf-8">
  var initFlex =function(){
    $('.flexslider').flexslider();

     // we resize images
    var fixedH= $('.single__txt').height()
    var fixedW= $('.single__img-wrap').width()
    console.log(fixedH, 'dkdkdk', fixedW)

    $('.flexslider .slides img').each(function(){
      var w = $(this).width()
      var h = $(this).height()
      
      var diffW = fixedH - (fixedW * h / w)
      var diffH = fixedW - (fixedH * w / h)
      
    
           console.log(diffW , '   ', diffH)
           console.log('cioa  ',w , '   ', h)
      if (diffW < diffH){
         $(this).height(fixedH)
          return
       }
      $(this).width(fixedW)
    })
  }
  window.addEventListener('load', initFlex)
</script>




<?php get_footer(); ?>
