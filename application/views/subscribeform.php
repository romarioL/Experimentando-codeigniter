<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Subscribe form </title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/materialize.min.css">
</head>
<body class="cyan darken-3">

  <div class="container">

     <div class="container">

      <div class="card" style="padding: 10px;">

        <div class="container">

         <form method="post" action="/codeigniter/index.php/Welcome/criar">

          <div class=" input-field">
          <?php echo form_error("titulo"); ?> 
         	<label for="titulo">Título</label>

         	<input type="text" name="titulo"><br>

          </div>

          <div class="input-field">
          <?php echo form_error("conteudo"); ?> 
         	<label for="conteudo">Contéudo</label>

         	<textarea  name="conteudo" class="materialize-textarea"></textarea><br>

          </div>

         	<button type="submit"  class="light-blue darken-2 white-text  waves-effect waves-light btn" >Enviar</button>

         </form>

       </div>

       </div>

     </div>

      
      
        <div class="row">

          <?php foreach($posts  as $post): ?>

          <div class="col s12 m6">

            <div class="card" style=" padding: 10px;">

                <h1><?php  echo $post->titulo; ?></h1>

                <p><?php  echo $post->conteudo;?></p>
            </div>

          </div>

          <?php endforeach; ?>
          <?php echo $links; ?>
        </div>

      </div>

 <script type="text/javascript" src="<?php  echo base_url();?>static/js/materialize.min.js"></script>
      
</body>

</html>