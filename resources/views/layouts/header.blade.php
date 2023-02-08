<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1><a href="index.html"><span style="color: #0433ff;">P.G.S.
                        Maccabeus</span> <span style="color: #ff2600;">Voltana</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <!-- <li><a class="nav-link scrollto active" href="#hero">Home</a></li> -->
                <li><a class="nav-link scrollto" href="index.html#about">Chi siamo</a></li>
                <!--  <li><a class="nav-link scrollto" href="index.html#teams">Squadre</a></li> -->
                <li class="dropdown">
                    <a href="index.html#news"><span>News</span> </a>
                </li>
                <li class="dropdown">
                    <a href="index.html#teams"><span>Squadre</span>
                        <div class="bi bi-chevron-down"></div>
                    </a>

                    <ul>
                        @foreach (\App\Models\Season::myActiveTeams() as $team)
                            <li class="dropdown">
                                <a href="squadra_ril.html"> {{ $team->name }}
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <ul>
                                    <li><a href="regolamento_rilanciata.html">La squadra</a></li>
                                    <li><a href="#">Risultati &amp; classifiche</a></li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- prossime gare, ultimi risultati, varie -->
                <li><a class="nav-link scrollto" href="index.html#sponsor">Sponsor</a></li>
                <!-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> -->
                <!-- <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
                <li class="dropdown"><a href="#"><span>PhotoGallery</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">XXXX</a></li>
                        <li class="dropdown"><a href="#"><span>NNNN</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">AAAA</a></li>
                                <li><a href="#">BBBB</a></li>
                                <!--<li><a href="#">Maggio</a></li>  -->
                                <!-- <li><a href="#">Settembre</a></li> -->
                                <!--<li><a href="#">Ottobre</a></li> -->
                            </ul>
                        </li>
                        <li><a href="#">2022/2023</a></li>
                        <!-- <li><a href="#">YYYY</a></li>  -->
                        <!-- <li><a href="#">Drop Down 3</a></li>  -->
                        <!-- <li><a href="#">2010</a></li>  -->
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Archivio</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">XXXX</a></li>
                        <li class="dropdown"><a href="#"><span>AAAA</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <!-- <li><a href="#">vvvv</a></li> -->
                                <!-- <li><a href="#">zzzz</a></li> -->
                                <!-- <li><a href="#">Maggio</a></li> -->
                                <!-- <li><a href="#">Settembre</a></li> -->
                                <!-- <li><a href="#">Ottobre</a></li> -->
                            </ul>
                        </li>
                        <li><a href="#">2022/2023</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="index.html#contact">Contatti</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->
