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
	
	<!-- Owl Stylesheets -->
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
	
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
	<style>
	.imagen {
		position: absolute;
  		bottom: 0;
  		right: 0;
	}
	</style>
</head>

<body class="home-page">
	<div class="wrap-body">
		
		<header class="main-header">
			<div class="zerogrid">
				<div class="row">
					<div class="col-1-3">
						<a class="site-branding" href="index.html">
							<img src="images/logo.png"/>	
						</a><!-- .site-branding -->
					</div>
					<div class="col-2-3">
						<!-- Menu-main -->
						<div id='cssmenu' class="align-right">
							<ul>
							   <li class="active"><a href='index.php'><span>Inicio</span></a></li>
							   <li><a href='single.php'><span>About</span></a></li>
							   <li ><a href='contact.html'><span>Contacto</span></a></li>
							   <li class='last'><a href='login.php'><span>Identifícate</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<!--////////////////////////////////////Container-->
		<section id="container" class="zerogrid">
			<div class="wrap-container">
				
				<!-----------------content-box-1-------------------->
				<section class="content-box box-1">
					<div class="wrap-box"><!--Start Box-->
						<div id="owl-travel" class="owl-carousel">
							<?php
							
							try{
							//Montamos la consulta para mostrar las slides 
							$sql="SELECT nombre, imagen from slides";
							$stmt=$con->prepare($sql);
							if	($stmt->execute()){
								while	($fila=$stmt->fetch()){
									echo "<div class='item'>";
									echo "<img src='".$fila['imagen']."'/>";	
									echo "</div>";
								}	
							}
							} catch (PDOException $e){
								die ("Error al mostrar datos");
							} catch (Exception $e){
								die ("Error de acceso");
							}
							?>
						</div>
					</div>
				</section>
				
				<!-----------------content-box-2-------------------->
				<section class="content-box box-2">
					<div class="wrap-box"><!--Start Box-->
						<div class="row">
							<?php
							try{
							//Montamos la consulta para mostrar las categorias con sus datos 
							$sql="SELECT id,nombre, imagen from categorias";
							$stmt=$con->prepare($sql);
							if	($stmt->execute()){
								$stilos=array("col-2-5 box-item","col-3-5 box-item","col-3-5 box-item","col-2-5 box-item","col-1-2 box-item","col-1-2 box-item");
								$stilos2=array("box-item-image gradient-1", "box-item-image gradient-2", "box-item-image gradient-3","box-item-image gradient-4","box-item-image gradient-5","box-item-image gradient-6");
								$cont2=0;
								$cont=0;
								while	($fila=$stmt->fetch()){
									$stmt_count_productos = $con->prepare("SELECT count(id) FROM productos WHERE idcat=:idcat");
									$stmt_count_productos->execute([':idcat'=>$fila['id']]);
									$count_productos = $stmt_count_productos->fetch()['count(id)'];
									?>
									<div class="<?=$stilos[$cont++]?>">
										<a class="box-item-inner" href="ver_productos.php?idpro=<?=$fila['id']?>">
											<div class="<?=$stilos2[$cont2++]?>" style="background-image: url('<?=$fila['imagen']?>')"></div>
											<h3 class="sub-title"><?=$fila['id']?></h3>
											<div class="box-item-detail">
												<h2 class="title"><strong>#</strong><?=$fila['nombre']?></h2>
												<p><strong><?=$count_productos?></strong> Productos</p>
											</div>
										</a>
									</div>
									<?php
								}	
							}
							} catch (PDOException $e){
								die ("Error al mostrar datos");
							} catch (Exception $e){
								die ("Error de acceso");
							}
							?>
						</div>
					</div>
				</section>
				
				<!-----------------content-box-3-------------------->
				<section class="content-box box-3 box-style-1">
					<div class="row wrap-box"><!--Start Box-->
						<div class="col-1-2">
							<div class="wrap-col">
								<div class="box-text">
								<?php
									try{
									//Montamos la consulta para mostrar los datos de indefinido 
									$sql="SELECT nombre, imagen, texto from indefinido";
									$stmt=$con->prepare($sql);
									if	($stmt->execute()){
										if	($fila=$stmt->fetch()){
								?>
											<h1><?=$fila['nombre']?></h1>
											<p class="lead"><?=$fila['texto']?></p>
											<a class="button button-skin" href="ver_indefinido.php">Read More</a>
								<?php
										}	
							        }
									} catch (PDOException $e){
										die ("Error al mostrar datos");
									} catch (Exception $e){
										die ("Error de acceso");
									}
								?>
								</div>
							</div>
						</div>
						
					</div>
				</section>
				
				<!-----------------content-box-5-------------------->
				<section class="content-box box-5 box-style-3">
					<div class="row wrap-box"><!--Start Box-->
						<div class="col-full">
							<div class="box-text">
								<div class="heading">
									<h2>Contact Me</h2>
									<span class="intro">Get subscriber only insights & news delivered by John Doe</span>
								</div>
								<div class="content">
									<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming<br> id quod mazim placerat facer possim assum. </p>
									<div class="subscribe-form">
										<form name="form1" id="subs_form" method="post" action="contact.php">
											<label class="row">
												<div class="col-2-3">
													<div class="wrap-col">
														<input type="text" name="name" id="name" placeholder="Enter Your Email" required="required" />
													</div>
												</div>
												<div class="col-1-3">
													<div class="wrap-col">
														<input class="button button-skin button-subscribe" type="submit" name="Submit" value="Subscribe">
													</div>
												</div>
											</label>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
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
									$sql="SELECT nombre, precio FROM productos ORDER BY fecalta desc LIMIT 4 ";
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
	
	
	<!-- Owl Carusel JavaScript -->
	<script src="owlcarousel/owl.carousel.js"></script>
	<script>
	$(document).ready(function() {
	  $("#owl-travel").owlCarousel({
		autoplay:true,
		autoplayTimeout:3000,
		loop:true,
		items : 1,
		nav:true,
		navText: ['<i class="fa fa-chevron-left fa-2x"></i>', '<i class="fa fa-chevron-right fa-2x"></i>'],
		pagination:false
	  });
	});
	</script>
	
</body>
</html>