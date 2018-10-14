
<?php 
	
	session_start();

	$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

	if($user == null){
		header('Location: http://localhost/web_service4');
	}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jsqrcode/html5-qrcode.min.js"></script>
  <script type="text/javascript" src="js/jsqrcode/jsqrcode-combined.min.js"></script>

</head>

<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Login Segundo Factor</a>
    </div>

   
      <ul class="nav navbar-nav navbar-right">
        <?php if($user['check_token'] == 0): ?>
        <li><a href="index.php">Iniciar Sesion</a></li>
        <li><a href="registro.php">Registrarme</a></li>
      <?php else: ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user['name']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li><a href="app/Controllers/logout.php">Cerrar sesion</a></li>
          </ul>
        </li>
      <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<div class="row">
      <div class="container">
          <div class="col-sm-6">
              <h3>Segundo Factor de autenticacion</h3><hr>
                <p>por favor coloque la imagen recibida de su correco electronico 
                enfrente de su camara web</p>
                
              <div id="reader" style="width: 350px; height: 250px;">
              </div>
                    
               
          </div>
      </div>

  </div>

<script type="text/javascript">

                        $('#reader').html5_qrcode(                            
                           function(data){
                            $.ajax({                              
                                type:'post',
                                url: 'app/Controllers/validatokens.php',
                                data: {codigo:data},
                                dataType:'json',
                                success:function(res){                                                                    
                                    if(res.message.length> 0){
                                      alert(res.message);
                                    }
                                    if(res.status == 1){
                                     
                                      window.location = res.urlMenu;
                                    }
                                }
                            });
                        },
                        function(error){
                          console.log(error); 
                        },
                        function(videoError){
                            console.log(videError);
                        });                  
                    
                    </script>


  
</body>
</html>