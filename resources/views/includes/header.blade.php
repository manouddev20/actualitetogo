<!-- Offcanvas START -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu">
	<div class="offcanvas-header justify-content-end">
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body d-flex flex-column pt-0">
		<div>
			<a class="navbar-brand" href="/">
				<img class="navbar-brand-item light-mode-item" src="/assets/images/logo.png" style="height: 85px; width: 150px; object-fit: cover;" alt="logo togoactualite">
			</a> <br>
			<!-- Nav START -->
			<ul class="nav d-block flex-column my-4">
				<li class="nav-item h5">
					<a class="nav-link" href="/">Accueil</a>
				</li>
				<li class="nav-item h5">
					<a class="nav-link" href="/about">Qui Sommes nous</a>
				</li>
                <li class="nav-item h5">
					<a class="nav-link" href="/privacy">Politique de confidentialité</a>
				</li>
                <li class="nav-item h5">
					<a class="nav-link" href="/terms">Conditions d'utilisations</a>
				</li>
				<li class="nav-item h5">
					<a class="nav-link" href="/contact">Contactez Nous</a>
				</li>
				<li class="nav-item h5">
                    <off-canvas></off-canvas>
                </li>
                
			</ul>
			<!-- Nav END -->
		</div>
		<div class="mt-auto pb-3">
			<!-- Address -->
			<p class="text-body mb-2 fw-bold">Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.</p>
				<p>Email: <a href="mailto:contact@togoactualite.com" class="text-reset"><u>contact@togoactualite.com</u></a></p>
				<p>Heures de services:
					Lundi à Vendredi de  9:30 à 18h30
					<br>
				</p>
		</div>
	</div>
</div>
<!-- Offcanvas END -->

<header class="bg-transparent">

    <div class="navbar-top d-none bg-header navbar-dark d-lg-block small">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- Top bar left -->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link ps-0" href="/about">Qui sommes nous ?</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/publicites">Publicités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/forum">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contactez Nous</a>
                    </li>
                    <li class="nav-item">
                        <in-first-menu></in-first-menu> 
                    </li>
                    <li class="nav-item">
                        {{-- <change-data-status-publications></change-data-status-publications>  --}}
                    </li>
                </ul>
                <!-- Top bar right -->
                <div class="d-flex align-items-center">

                    <div>
                        <p class="mb-0 text-white"> <i class="bi bi-calendar-event"></i> &nbsp;{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('d F Y') }} &nbsp; | &nbsp; </p>
                    </div>

                    <ul class="nav mt-2" >
                        <li class="nav-item">
                            <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-facebook" href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank">
								<i class="fab fa-facebook-square align-middle"></i>
							</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-dark" href="https://twitter.com/Togoactualite" target="_blank">
                                X
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-linkedin" href="https://fr.linkedin.com/in/togoactualite-togo-actualit%C3%A9-3a076648" target="_blank">
								<i class="fab fa-linkedin align-middle"></i>
							</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-youtube" href="https://youtube.com" target="_blank">
								<i class="fab fa-youtube-square align-middle"></i>
							</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-success"  href="https://wa.link/qf0v9s" target="_blank">
								<i class="fab fa-whatsapp align-middle"></i>
							</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Divider -->
            <div class="border-bottom border-2 border-primary opacity-1"></div>
        </div>
    </div>

    <div class="container">
        <div class="d-sm-flex justify-content-sm-between align-items-sm-center my-2">
            <!-- Logo START -->
            <div class="row g-4">  
                <a class="navbar-brand d-block" href="/">
                    <img class="navbar-brand-item light-mode-item" src="/assets/images/logo.png" alt="logo togoactualite" style="height: 85px; width: 150px; object-fit: cover;">
                </a> 
            </div>
        </div>
    </div>

    <!-- Navbar START -->
    <div class="navbar-sticky header-static">
        <nav class="navbar navbar-light  navbar-expand-lg">
            <div class="container">
                <div class="w-100 bg-light  d-flex">

                    <!-- Responsive navbar toggler -->
                    <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="text-muted h6 ps-3">MENU</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Main navbar START -->
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav navbar-nav-scroll navbar-lh-sm" >

                            <li class="nav-item">
                                <a style="font-size: 12px" class="nav-link  " href="/"  id="homeMenu">ACCUEIL</a>
                            </li>

                            <li class="nav-item dropdown dropdown-fullwidth">
                                <a style="font-size: 12px" class="nav-link  dropdown-toggle" href="#"  id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">TOGO ACTUALITE</a>
                                <div class="dropdown-menu" aria-labelledby="megaMenu" >
                                    <div>
                                        <togoactualite-header></togoactualite-header>
                                    </div>
                                </div>
                            </li>

                            <!-- Nav item 3 Post -->
                            <li class="nav-item dropdown dropdown-fullwidth">
                                <a style="font-size: 12px" class="nav-link  dropdown-toggle" href="#"  id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RUBRIQUES+</a>
                                <div class="dropdown-menu" aria-labelledby="megaMenu">
                                    <div>
                                        <rubriques-header></rubriques-header>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-fullwidth">
                                <a style="font-size: 12px" class="nav-link  dropdown-toggle" href="#"  id="megaMenuH" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ECONOMIE</a>
                                <div class="dropdown-menu" aria-labelledby="megaMenuH">
                                    <div>
                                        <economie-header></economie-header>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-fullwidth">
                                <a style="font-size: 12px" class="nav-link  dropdown-toggle" href="#"  id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DIASPORA</a>
                                <div class="dropdown-menu" aria-labelledby="megaMenu">
                                    <div>
                                        <diaspora-header></diaspora-header>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-fullwidth">
                                <a style="font-size: 12px" class="nav-link  dropdown-toggle" href="#"  id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">INTERNATIONAL</a>
                                <div class="dropdown-menu" aria-labelledby="megaMenu">
                                    <div>
                                        <international-header></international-header>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-fullwidth">
                                <a style="font-size: 12px" class="nav-link  dropdown-toggle" href="#"  id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SPORT</a>
                                <div class="dropdown-menu" aria-labelledby="megaMenu">
                                    <div>
                                        <sports-header></sports-header>
                                    </div>
                                </div>
                            </li>
                            
                            <li class="nav-item"> <a style="font-size: 12px" class="nav-link "  href="/infos-pratiques">INFOS PRATIQUES</a></li>

                        </ul>
                    </div>
                    <!-- Main navbar END -->

                    <!-- Nav right START -->
                    <div class="nav flex-nowrap align-items-center me-2">

                        <in-second-menu></in-second-menu>

                        <!-- Nav Search -->
                        <div class="nav-item dropdown nav-search dropdown-toggle-icon-none">
                            <a style="font-size: 12px" class="nav-link  text-uppercase dropdown-toggle" role="button" href="/search-posts" >
                                <i class="bi bi-search fs-4"> </i>
                            </a>

                        </div>


                        <!-- Offcanvas menu toggler -->
                        <div class="nav-item">
                            <a style="font-size: 12px" class="nav-link  pe-0" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                                <i class="bi bi-text-right rtl-flip fs-2" data-bs-target="#offcanvasMenu"> </i>
                            </a>
                        </div>
                    </div>
                    <!-- Nav right END -->
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar END -->

</header>
