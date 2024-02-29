<?php 
if (!isset($_SESSION)) session_start();
if (empty($_SESSION['SB_u'])) {
echo "<script>window.location.href='login.php';</script>";
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SIM SPT SPPD</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<!--link href="https://seruni-wilayah2.kemdikbud.go.id/plugins/sweetalert/sweetalert.css" rel="stylesheet" /-->
	<link href="css/login.css" rel="stylesheet">
	<!--link href="https://seruni-wilayah2.kemdikbud.go.id/plugins/animate-css/animate.css" rel="stylesheet" />
	<script src="https://seruni-wilayah2.kemdikbud.go.id/js/jquery.ui.shake.js"></script>
	<script src="https://seruni-wilayah2.kemdikbud.go.id/plugins/bootstrap/js/bootstrap.js"></script>
	<link href="https://seruni-wilayah2.kemdikbud.go.id/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
   <script src="https://seruni-wilayah2.kemdikbud.go.id/plugins/bootstrap-notify/bootstrap-notify.js"></script>
	<link href="https://seruni-wilayah2.kemdikbud.go.id/css/style.css" rel="stylesheet"-->
		<script>
	
	function animateCSS(element, animationName, callback) {
		const node = document.querySelector(element)
		node.classList.add('animated', animationName)

		function handleAnimationEnd() {
			node.classList.remove('animated', animationName)
			node.removeEventListener('animationend', handleAnimationEnd)
			if(typeof callback === 'function') callback()
		}
		node.addEventListener('animationend', handleAnimationEnd)
	}
	$(document).ready(function() {

		$('.page-loader-wrapper').hide();
	});
	</script>
    </head>
	<style>
 .wrapper {
   background-image: url(https://seruni-wilayah2.kemdikbud.go.id/file/background05112022170409bgne.jpg);
background-repeat: no-repeat;
background-position: center center;
background-attachment: fixed;
background-size: cover;

   }
   
.bg-bubbles {
    position: unset;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: unset;
}
   </style>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">SIM SPT SPPD</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!--div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary btn-sm" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div-->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
			    <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-music fa-fw"></i></a>
				   <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
				     <li>
				<!-- Audio Background Controls -->
			<audio id="myAudio" loop controls  class="d-flex align-items-center justify-content-between small">
			 <source src="https://server7.mp3quran.net/basit/Almusshaf-Al-Mojawwad/001.mp3" type="audio/mp3" ended="nextAudioNode.play();" class="text-muted">
  <source src="https://server7.mp3quran.net/basit/Almusshaf-Al-Mojawwad/002.mp3"
   type="audio/mp3" class="text-muted" ended="nextAudioNode.play();"> <!-- "https://s9d5.tx11.idrivee2-3.com/mp3pw/y2mate.com%20-%20Kenny%20G%20%20Sentimental.mp3" -->
</audio></li>
<li><hr class="dropdown-divider" /></li>
<li>
				<!-- Audio Background Controls -->
			<audio id="myAudio" loop controls  class="d-flex align-items-center justify-content-between small">
  <source src="https://server7.mp3quran.net/basit/Almusshaf-Al-Mojawwad/002.mp3"
   type="audio/mp3" class="text-muted" ended="nextAudioNode.play();"> <!-- "https://s9d5.tx11.idrivee2-3.com/mp3pw/y2mate.com%20-%20Kenny%20G%20%20Sentimental.mp3" -->
</audio></li>
<li><hr class="dropdown-divider" /></li>
<li>
				<!-- Audio Background Controls -->
			<audio id="myAudio" loop controls  class="d-flex align-items-center justify-content-between small">
  <source src="https://s9d5.tx11.idrivee2-3.com/mp3pw/y2mate.com%20-%20Kenny%20G%20%20Sentimental.mp3"
   type="audio/mp3" class="text-muted" ended="nextAudioNode.play();"> <!-- "" -->
</audio></li>
<li><hr class="dropdown-divider" /></li>
</ul>
				</li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="ubahpassuser.php" target="frmmain">Profil Pengguna</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">&#8416; &nbsp; Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
					    <div class="small"><img src="images/upe.png" width="25%" height="25%"></div>
                        <div class="nav">
						    
                            <div class="sb-sidenav-menu-heading">Menu Utama</div>
                            <a class="nav-link" href="beranda.php" target="frmmain">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               &#1769; Beranda
                            </a>
                            <div class="sb-sidenav-menu-heading">Silahkan pilih:</div>
							<a class="nav-link" href="carisurat.php" target="frmmain">
                                <div class="sb-nav-link-icon"><i class="fas fa-people"></i></div>
                                &#128106; Pengajuan SPPD
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="anggotadewan.php" target="frmmain">Anggota Dewan</a>
                                    <a class="nav-link" href="Pendamping.php" target="frmmain">Pendamping</a>
									<a class="nav-link" href="vanggota.php" target="frmmain">validasi anggota</a>
									<a class="nav-link" href="vaketua.php" target="frmmain">validasi ketua</a>
									<a class="nav-link" href="vasekwan.php" target="frmmain">validasi sekwan</a>
									<a class="nav-link" href="vapendamping.php" target="frmmain">validasi pendamping</a>
									<a class="nav-link" href="cesptanggota.php" target="frmmain">cetak spt anggota</a>									
									<a class="nav-link" href="vakabag.php" target="frmmain">validasi kabag</a>
									<a class="nav-link" href="cesptpendamping.php" target="frmmain">cetak spt pendamping</a>									
                                </nav>
                            </div>
							 <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsb" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsb" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="formlevel.php" target="frmmain">Level</a>
                                    <a class="nav-link" href="formunit.php" target="frmmain">Unit</a>
									<a class="nav-link" href="formpengguna.php" target="frmmain">Pengguna</a>
									<!--a class="nav-link" href="vaketua.php" target="frmmain">validasi ketua</a>
									<a class="nav-link" href="vasekwan.php" target="frmmain">validasi sekwan</a>
									<a class="nav-link" href="vapendamping.php" target="frmmain">validasi pendamping</a>
									<a class="nav-link" href="cesptanggota.php" target="frmmain">cetak spt anggota</a>									
									<a class="nav-link" href="vakabag.php" target="frmmain">validasi kabag</a>
									<a class="nav-link" href="cesptpendamping.php" target="frmmain">cetak spt pendamping</a-->									
                                </nav>
                            </div>
							
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLaporan" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Laporan 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
							
                            <div class="collapse" id="collapseLaporan" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
								    <a class="nav-link" href="lappelanggan.php" target="frmmain">&#128188; Laporan daftar sppd</a>
									<?php if ($_SESSION['SB_level'] == '5') { ?>
									<a class="nav-link" href="lapterimaikr.php" target="frmmain">&#129534; Laporan Penerimaan IKR</a>
									<a class="nav-link" href="lapkaskeluar.php" target="frmmain">&#128181; Laporan Kas Pengeluaran</a>
									<?php } ?>
                                    <!--a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div-->
                                </nav>
                            </div>
                            <!--div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div-->
						
						<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSetting" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pengaturan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSetting" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
								
								<?php if ($_SESSION['SB_level'] == '5') { ?>
                                    <a class="nav-link" href="aturpetugas.php" target="frmmain">&#128110; Petugas</a>
									<a class="nav-link" href="JenisBangunan.php" target="frmmain">&#127968; Jenis Bangunan</a> 
									<a class="nav-link" href="jenispemasangan.php" target="frmmain">&#127968; Jenis Pemasangan</a>
                                    <a class="nav-link" href="jenisidentitas.php" target="frmmain">&#128199; Jenis Identitas</a> 
									<a class="nav-link" href="jenisusaha.php" target="frmmain">&#128332; Jenis Usaha</a> 
                                    <a class="nav-link" href="levelpetugas.php" target="frmmain">&#128332; Level Petugas</a>
                                    <a class="nav-link" href="statuspenghuni.php" target="frmmain">&#128332; Status Penghuni</a>
							    <?php } ?>
									
                                </nav>
                            </div> <!-- endi a #collapseSetting-->
							
                    </div> <!-- end div class="nav"-->8
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['SB_u'];?>						
                    </div>
                </nav>
				
            </div> <!-- end div class="sb-sidenav-menu"-->
            <div id="layoutSidenav_content">
                <main>
                    <iframe src="beranda.php" name="frmmain" width="100%" height="600px"></iframe>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SIM SPT SPPD</div>
                            <div>	
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div> <!-- end div id="layoutSidenav_content"-->
        </div> <!-- end div id="layoutSidenav_nav"-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
		<ul class="bg-bubbles">
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
</ul>
    </body>
</html>
