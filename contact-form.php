<?php 
/* 
Template Name: Contact Form
*/ 
?>
<?php get_header(); ?>


<?
$lg = get_language();

$post = get_post();
$id = $post->ID;

$fields = get_fields($id);

?>

<div class='container contact-form'>
  <div class='contact-form__title'>
    <h1>
      <? echo $lg === 'ita' ? 'Contatti' : 'Contact us' ?>
    </h1>
  </div>
  <? echo $fields["l_descrizione_$lg"] ?>
</div>





<?php get_footer(); ?>
