<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Benvingut al gestor de subvencions</title>
	<meta name="description" content="Gestor de subvencions i ajudes IDI">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/jpg" href="/assets/images/headeridi.jpg" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style-pindust.css"/>
	<script async type="text/javascript" src="./assets/js/pindust.js"></script>	
</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>

	<div class="menu">
		<ul>
			<li class="logo"><a href="https://idi.es" target="_blank"><img height="54" title="IDI Logo"
																					alt="Visita la web oficial del IDI"
																					src="data:image/png;base64,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"></a>
			</li>
			<li class="menu-toggle">
				<button onclick="toggleMenu();">&#9776;</button>
			</li>
			<li class="menu-item hidden"><a href="#">Inici</a></li>
			<li class="menu-item hidden"><a href="https://codeigniter4.github.io/userguide/" target="_blank">Documentació</a>
			</li>
			<li class="menu-item hidden"><a href="https://forum.codeigniter.com/" target="_blank">Expedients</a></li>
			<li class="menu-item hidden"><a
					href="https://testservices.viafirma.com/inbox/app/idi/index.jsf?cid=5628" target="_blank">Portafirmes</a>
			</li>
			<li class="menu-item hidden"><a
					href="<?php echo base_url('home/listaforms/'); ?>">Formularis</a>
			</li>
			<li class="menu-item hidden"><a
					href="https://rec.redsara.es/registro/action/are/acceso.do" target="_blank">Registro Electrónico Común</a>
			</li>
		</ul>
	</div>

	<div class="heroe">

		<h1>Welcome to CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>

		<h2>The small framework with powerful features</h2>

	</div>

</header>

<!-- CONTENT -->

<section>

	<h1>About this page</h1>

	<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

	<p>If you would like to edit this page you will find it located at:</p>

	<pre><code>app/Views/welcome_message.php</code></pre>

	<p>The corresponding controller for this page can be found at:</p>

	<pre><code>app/Controllers/Home.php</code></pre>

</section>

<div class="further">

	<section>

		<h1>Go further</h1>

		<h2>
			<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><rect x='32' y='96' width='64' height='368' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><line x1='112' y1='224' x2='240' y2='224' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='112' y1='400' x2='240' y2='400' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><rect x='112' y='160' width='128' height='304' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><rect x='256' y='48' width='96' height='416' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><path d='M422.46,96.11l-40.4,4.25c-11.12,1.17-19.18,11.57-17.93,23.1l34.92,321.59c1.26,11.53,11.37,20,22.49,18.84l40.4-4.25c11.12-1.17,19.18-11.57,17.93-23.1L445,115C443.69,103.42,433.58,94.94,422.46,96.11Z' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/></svg>
			Learn
		</h2>

		<p>The User Guide contains an introduction, tutorial, a number of "how to"
			guides, and then reference documentation for the components that make up
			the framework. Check the <a href="https://codeigniter4.github.io/userguide"
			target="_blank">User Guide</a> !</p>

		<h2>
			<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
			Discuss
		</h2>

		<p>CodeIgniter is a community-developed open source project, with several
			 venues for the community members to gather and exchange ideas. View all
			 the threads on <a href="https://forum.codeigniter.com/"
			 target="_blank">CodeIgniter's forum</a>, or <a href="https://codeigniterchat.slack.com/"
			 target="_blank">chat on Slack</a> !</p>

		<h2>
			 <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><line x1='176' y1='48' x2='336' y2='48' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><line x1='118' y1='304' x2='394' y2='304' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M208,48v93.48a64.09,64.09,0,0,1-9.88,34.18L73.21,373.49C48.4,412.78,76.63,464,123.08,464H388.92c46.45,0,74.68-51.22,49.87-90.51L313.87,175.66A64.09,64.09,0,0,1,304,141.48V48' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
			 Contribute
		</h2>

		<p>CodeIgniter is a community driven project and accepts contributions
			 of code and documentation from the community. Why not
			 <a href="https://codeigniter.com/en/contribute" target="_blank">
			 join us</a> ?</p>

	</section>

</div>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>
	<div class="environment">

		<p>Page rendered in {elapsed_time} seconds</p>

		<p>Environment: <?= ENVIRONMENT ?></p>

	</div>

	<div class="copyrights">

		<p>&copy; <?= date('Y') ?> CodeIgniter Foundation. CodeIgniter is open source project released under the MIT
			open source licence.</p>

	</div>

</footer>
</body>
</html>
