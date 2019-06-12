<!DOCTYPE html>

<html lang="es">

<head>

<title>MedeGreen</title>

<!-- for-mobile-apps -->

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script>

        addEventListener("load", function () {

            setTimeout(hideURLbar, 0);

        }, false);



        function hideURLbar() {

            window.scrollTo(0, 1);

        }

    </script>

	

	<!-- css files -->

	

    <link href="{{ asset('css/app.css') }}" rel='stylesheet' type='text/css' /><!-- bootstrap css -->

    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' /><!-- custom css -->

	<link href="{{ asset('css/css_slider.css') }}" type="text/css" rel="stylesheet" media="all">

    <link href="{{ asset('fontawesome/fontawesome-free-5.9.0-web/css/all.css') }}" rel="stylesheet"><!-- fontawesome css -->

	<!-- //css files -->

	<!-- google fonts -->

	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">

	<!-- //google fonts -->

	<!-- Icon -->
	<link href="{{ asset('images/logo.png') }}" rel="icon">
	

</head>

<body>



<!-- header -->

<header>

	<div class="container">

		<!-- nav -->

		<nav class="py-3 d-lg-flex">

			<div id="logo">

				<h1> <a href="#"><img src="images/logo.png" alt="logo"> MedeGreen </a></h1>

			</div>

			<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>

			<input type="checkbox" id="drop" />

			<ul class="menu ml-auto mt-1">

				<li class="active"><a href="#">Inicio</a></li>

				<!--<li class=""><a href="#about">Acerca de nosotros</a></li>-->

				<li class=""><a href="#posts">Publicaciones</a></li>

				<li class=""><a href="#stats">Estadisticas</a></li>

				@auth
					
				@else
					<li class="">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal">
						Inicia sesion
						</button>

						<!-- Modal -->
						<div class="modal fade" id="loginModal" tabindex="1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form method="POST" action="{{ route('login') }}">
									@csrf
										<div class="modal-header">
											<h5 class="modal-title" id="loginModalLabel">Inicia sesion en Medegreen</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">

											<div class="form-group row">
												<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

												<div class="col-md-6">
													<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

													@error('email')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>

											<div class="form-group row">
												<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

												<div class="col-md-6">
													<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

													@error('password')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>

											<div class="form-group row">
												<div class="col-md-6 offset-md-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

														<label class="form-check-label" for="remember">
															{{ __('Remember Me') }}
														</label>
													</div>
												</div>
											</div>

											<div class="form-group row mb-0">
												<div class="col-md-8 offset-md-4">
													<button type="submit" class="btn btn-primary">
														{{ __('Login') }}
													</button>

													@if (Route::has('password.request'))
														<a class="btn btn-link" href="{{ route('password.request') }}">
															{{ __('Forgot Your Password?') }}
														</a>
													@endif
												</div>
											</div>
									
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-outline-success">Entrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</li>
				@endauth
				

			</ul>

		</nav>

		<!-- //nav -->

	</div>

</header>

<!-- //header -->



<!-- banner -->

<div class="banner" id="home">

	<div class="layer">

		<div class="container">

			<div class="row">

				<div class="col-lg-7 banner-text-w3pvt">

					<!-- banner slider-->

					<div class="csslider infinity" id="slider1">

						<input type="radio" name="slides" checked="checked" id="slides_1" />

						<input type="radio" name="slides" id="slides_2" />

						<input type="radio" name="slides" id="slides_3" />

						<ul class="banner_slide_bg">

							<li>

								<div class="container-fluid">

									<div class="w3ls_banner_txt">

										<h3 class="b-w3ltxt text-capitalize mt-md-4">Bienvenido</h3>

										<h4 class="b-w3ltxt text-capitalize mt-md-2">Ayudanos a salvar el planeta</h4>

										<p class="w3ls_pvt-title my-3">Aporta con tus ideas, cada dia somos mas.</p>

									</div>

								</div>

							</li>

							<li>

								<div class="container-fluid">

									<div class="w3ls_banner_txt">

										<h3 class="b-w3ltxt text-capitalize mt-md-4">MedeGreen.</h3>

										<p class="b-w3ltxt text-capitalize mt-md-2">Una plataforma para informarte, aportar y formar comunidad</p>	

									</div>

								</div>

							</li>

							<li>

								<div class="container-fluid">

									<div class="w3ls_banner_txt">

										<h3 class="b-w3ltxt text-capitalize mt-md-4">Conoce tu ciudad.</h3>

										<h4 class="b-w3ltxt text-capitalize mt-md-2">Propone soluciones para los problemas de tu ciudad</h4>

									</div>

								</div>

							</li>

						</ul>

						<div class="navigation">

							<div>

								<label for="slides_1"></label>

								<label for="slides_2"></label>

								<label for="slides_3"></label>

							</div>

						</div>

					</div>

					<!-- //banner slider-->

				</div>

				@auth
					<div class="col-lg-5 col-md-8 px-lg-3 px-0">

						<div class="banner-form-w3 ml-lg-5">

								<!-- banner form -->

								<h2 class="my-3 text-white">Bienvenido, {{ \Auth::user()->name }}</h2>

								<a href="{{ url('home') }}" class="btn btn-banner my-3">Ver publicaciones</a>

								<!-- //banner form -->

						</div>

					</div>
				@else
				<div class="col-lg-5 col-md-8 px-lg-3 px-0">

				<div class="banner-form-w3 ml-lg-5">

					<div class="padding">

						<!-- banner form -->

						<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
						@csrf

							<h5 class="mb-3">Unete a la comunidad</h5>

							<div class="form-style-w3ls">

								<input placeholder="Nombre" name="name" type="text" required>

								<input placeholder="Email" name="email" type="email" required>

								<input placeholder="Contraseña" name="password" type="password" required>

								<input placeholder="Confirmar contraseña" name="password_confirmation" type="password" required>

								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="validatedCustomFile" name="profile_pic" >
									<label class="custom-file-label" for="validatedCustomFile">Selecciona foto / video.</label>
									<div class="invalid-feedback">Selecciona un archivo valido</div>
								</div>

								<button class="btn">Registrate</button>

							</div>

						</form>

						<!-- //banner form -->

					</div>

				</div>

				</div>
				@endauth

			</div>

		</div>

	</div>

</div>

<!-- //banner -->



<!-- what we Serve -->

<section class="banner-bottom py-5" id="posts">

	<div class="container py-lg-5">

		<h2 class="heading mb-sm-5 mb-4"> Ultimas publicaciones</h2>

		<div class="row bottom-grids">

			@if($medias->count() == 4)
				@foreach($medias as $media)
					<div class="col-md-3 col-sm-6">

						<div class="three-grids-w3pvt-1 d-flex text-right" style="background: url({{  $media->link }}); background-size: cover">

							<div class="text-effect-wthree midd-text-w3ls p-3 w-100">

								<h5 class="text-capitalize text-bl font-weight-bold">{{ $media->publicacion->descripcion }}</h5>

							</div>

						</div>

					</div>
				@endforeach
			@else
				<div class="col-md-3 col-sm-6">

					<div class="three-grids-w3pvt-1 d-flex text-right">

						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">

							<h5 class="text-capitalize text-bl font-weight-bold">Metabolismo urbano</h5>

						</div>

					</div>

				</div>

				<div class="col-md-3 col-sm-6 mt-sm-0 mt-4">

					<div class="three-grids-w3pvt-2 d-flex text-right">

						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">

							<h5 class="text-capitalize text-bl font-weight-bold">Residuos solidos</h5>

						</div>

					</div>

				</div>

				<div class="col-md-3 col-sm-6 mt-md-0 mt-4">

					<div class="three-grids-w3pvt-3 d-flex text-right">

						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">

							<h5 class="text-capitalize text-bl font-weight-bold">Sobras de alimentos</h5>						

						</div>

					</div>

				</div>

				<div class="col-md-3 col-sm-6 mt-md-0 mt-4">

					<div class="three-grids-w3pvt-4 d-flex text-right">

						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">

							<h5 class="text-capitalize text-bl font-weight-bold">Otros</h5>

						</div>

					</div>

				</div>
			@endif

			<div class="col-lg-6">

				<p class="mt-4">Somos una comunidad para aportar ideas que ayuden al desarrollo y 

					mejora del medio ambiente en tu ciudad para su posterior implementacion.</p>

			</div>


			<div class="col-lg-6">

				<p class="mt-4"> Tendremos tambien una plataforma para que usuarios aporten con residuos solidos que puedan ser utilizados para generar combustibles, estos permitiran que 

					el usuario genere puntos que podran ser cambiados por pasajes en el transporte publico. </p>

			</div>

		</div>

	</div>

</section>

<!-- //what we Serve -->

<!-- stats section -->

<section class="section-stats" id="stats">

	<div class="py-5">

		<div class="container py-lg-5">

		<h3 class="heading mb-sm-5 mb-4">Nuestras estadisticas</h3>

			<div class="row text-center">

				<div class="col-lg-4 col-sm-12">

					<div class="w3layouts_stats_left w3_counter_grid">

						<div class="stats-icon">

							<i class="fas fa-users"></i>

						</div>

						<p class="counter">15.230</p>

						<p class="para-text-w3ls">Usuarios proponiendo</p>

					</div>

				</div>

				<div class="col-lg-4 col-sm-12">

					<div class="w3layouts_stats_left w3_counter_grid2">	

						<div class="stats-icon">

							<span class="fa fa-city"></span>

						</div>

						<p class="counter">12</p>

						<p class="para-text-w3ls">Ciudades</p>

					</div>

				</div>

				<div class="col-lg-4 col-sm-12">

					<div class="w3layouts_stats_left w3_counter_grid1">	

						<div class="stats-icon">

							<i class="fas fa-dumpster-fire"></i>

						</div>

						<p class="counter">40.000kg</p>

						<p class="para-text-w3ls">Residuos reutilizados</p>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

<!-- //stats section -->	

<!-- footer -->

<footer>

	<div class="footer-layer py-sm-5 pt-5 pb-3">

		<div class="container py-md-3">

			<div class="footer-grid_section text-center">

				<div class="footer-title mb-3">

					<a style="color: white"><img src="images/s2.png" alt=""> MedeGreen</a>

				</div>

				<div class="footer-text">

					<p>El cambio comienza desde cada uno de nosotros.</p>

				</div>

			</div>

		</div>

	</div>

</footer>

<!-- //footer -->



<!-- move top -->

<div class="move-top text-right">

	<a href="#home" class="move-top"> 

		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>

	</a>

</div>

<!-- move top -->

<!-- JQuery -->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<!-- Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
	$('#loginModal').appendTo("body") 
</script>

</body>

</html>
