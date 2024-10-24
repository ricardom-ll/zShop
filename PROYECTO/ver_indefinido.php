<?php 
//Incluimos el fichero de configuracion
include 'config.php';
//Establecemos conexion con la base de datos
try{
	$con = new PDO($dsn,$usuario,$contrasena);
} catch (PDOException $e){

}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>zShop</title>
	<meta name="description" content="Free Responsive Html5 Css3 Templates | Zerotheme.com">
	<meta name="author" content="http://www.Zerotheme.com">
	
    <!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
	================================================== -->
  	<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/style.css">
	
	<!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	
	<link rel="stylesheet" href="css/menu.css">
	<!-- jQuery Core Javascript -->
	<script src="js/jquery.min.js"></script>
	<script src="js/script.js"></script>
	
	<!-- Owl Carousel Assets -->
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
	
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/Items/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
	<![endif]-->
	
</head>

<body class="sub-page">
	<div class="wrap-body">
		
		<header class="main-header">
			<div class="zerogrid">
				<div class="row">
					<div class="col-1-3">
						<a class="site-branding" href="index.php">
							<img src="images/logo.png"/>	
						</a><!-- .site-branding -->
					</div>
					<div class="col-2-3">
						<!-- Menu-main -->
						<div id='cssmenu' class="align-right">
							<ul>
							   <li><a href='index.php'><span>Inicio</span></a></li>
							   <li class="active"><a href='single.html'><span>About</span></a></li>
							   <li><a href='contact.html'><span>Contacto</span></a></li>
							   <li class='last'><a href='login.php'><span>Identificate</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<!--////////////////////////////////////Container-->
		<section id="container" class="zerogrid">
			<div class="wrap-container">
				<!-----------------Content-Box-------------------->
				<article class="single-post">
					<div class="row wrap-post"><!--Start Box-->
						<div class="entry-header">
                        <?php
                        try {
                            $sql="SELECT * from indefinido";
                            $stmt=$con->prepare($sql);
                            if  ($stmt->execute()){
                                if  ($fila=$stmt->fetch()){
                                    $fecha= new DateTime();
                                    $fechaN= $fecha->format('F j, Y');
                        ?>
                                    <span class="time"><?=$fechaN?></span>
							        <h1 class="entry-title"><?=$fila['nombre']?></h1>
                                    </div>
						                <div class="post-thumbnail-wrap">
							            <img src="<?=$fila['imagen']?>">
						                </div>
                        <?php
                                }
                            }
                        } catch (PDOException $e){
                            die ("error al conectar". $e->getMessage());
                        }
                        ?>
						<div class="entry-content">
                        <p><?=$fila['texto']?></p>
						</div>
					</div>
				</article>
			</div>
		</section>
		
		<!--////////////////////////////////////Footer-->
		<footer>
			<div class="zerogrid">
				<div class="wrap-footer">
					<div class="row">
						<div class="col-1-3 col-footer-1">
							<div class="wrap-col">
								<h3 class="widget-title">Sobre nosotros</h3>
								<p>En ZSHOP, nuestra pasión es ofrecerte una experiencia de compra en línea única y satisfactoria. Nos enorgullece ser más que una simple tienda de ropa en línea; somos tu destino de moda personal, donde encontrarás prendas que no solo se adaptan a tu estilo, sino que también cuentan historias de innovación, calidad y autenticidad.</p>
							</div>
						</div>
						<div class="col-1-3 col-footer-2">
							<div class="wrap-col">
								<h3 class="widget-title">Ultimos Productos</h3>
								<ul>
								<?php
									try{
									//Montamos la consulta para mostrar los 4 ultimos productos dados de alta
									$sql="SELECT nombre, precio FROM productos ORDER BY fecalta LIMIT 4 ";
									$stmt=$con->prepare($sql);
									if	($stmt->execute()){
										while	($fila=$stmt->fetch()){
								?>
											<li><a href="#"><?=$fila['nombre']?> Precio: <?=$fila['precio']?>€</a></li>
								<?php
										}	
							        }
									} catch (PDOException $e){
										die ("Error al mostrar datos");
									} catch (Exception $e){
										die ("Error de acceso");
									}
								?>
								</ul>
							</div>
						</div>
						<div class="col-1-3 col-footer-3">
							<div class="wrap-col">
								<h3 class="widget-title">Donde nos puedes encontrar</h3>
								<div class="row">
									<address>
										<strong>Murcia</strong>
										<br>
										Gran Via 27
										<br>
									</address><br>
									<p>
										<strong>Horario de apertura:</strong>
										<br>
										Lun - Vie: 9:00 - 21:00
										<br>
										Sab - Dom: 9:00 - 14:00
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="bottom-footer">
					<div class="bottom-social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-vimeo"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-youtube"></i></a>
					</div>
					<div class="copyright">
						Copyright @ - Designed by <a href="https://www.zerotheme.com">ZEROTHEME</a>
					</div>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>