<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <img class="logo-icon me-2" src="../../assets/images/logo.png"
                    alt="logo">

        </div>
        <!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link <?= ($menu == 'Dashboard') ? 'active' : '' ?>" href="../dashboard">
                        <span class="nav-icon">
                            <i class="fa fa-dashboard"></i>
                        </span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                    <!--//nav-link-->
                </li>
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link <?= ($menu == 'Kriteria') ? 'active' : '' ?>" href="../kriteria">
                        <span class="nav-icon">
                            <i class="fa fa-gear"></i>
                        </span>
                        <span class="nav-link-text">Data Kriteria</span>
                    </a>
                    <!--//nav-link-->
                </li>

                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link <?= ($menu == 'Sub Kriteria') ? 'active' : '' ?>" href="../sub-kriteria">
                        <span class="nav-icon">
                            <i class="fa fa-gears"></i>
                        </span>
                        <span class="nav-link-text">Data Sub Kriteria</span>
                    </a>
                    <!--//nav-link-->
                </li>

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link <?= ($menu == 'Alternatif') ? 'active' : '' ?>" href="../alternatif">
                        <span class="nav-icon">
                        <i class="fa fa-map-location-dot"></i>
                        </span>
                        <span class="nav-link-text">Data Lokasi Alternatif</span>
                    </a>
                    <!--//nav-link-->
                </li>

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link <?= ($menu == 'Penilaian') ? 'active' : '' ?>" href="../penilaian">
                        <span class="nav-icon">
                            <i class="fa fa-tasks"></i>
                        </span>
                        <span class="nav-link-text">Penilaian Data</span>
                    </a>
                    <!--//nav-link-->
                </li>

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link <?= ($menu == 'Perhitungan') ? 'active' : '' ?>" href="../perhitungan">
                        <span class="nav-icon">
                            <i class="fa fa-calculator"></i>
                        </span>
                        <span class="nav-link-text">Hasil Perhitungan</span>
                    </a>
                    <!--//nav-link-->
                </li>

            </ul>
            <!--//app-menu-->
        </nav>
        <!--//app-nav-->

        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?= ($menu == 'Admin') ? 'active' : '' ?>" href="../admin">
                            <span class="nav-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <span class="nav-link-text">Data Admin</span>
                        </a>
                        <!--//nav-link-->
                    </li>

                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link alert-logout" href="#">
                            <span class="nav-icon">
                                <i class="fa fa-share"></i>
                            </span>
                            <span class="nav-link-text">Log Out</span>
                        </a>
                        <!--//nav-link-->
                    </li>
                </ul>
                <!--//footer-menu-->
            </nav>
        </div>
        <!--//app-sidepanel-footer-->
    </div>
    <!--//sidepanel-inner-->
</div>
<!--//app-sidepanel-->
</header>
<!--//app-header-->

<div class="app-wrapper">