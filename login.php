<?php 
if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login SIM SPT SPPD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 
  <style>
  .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
  </style>
  
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="images/logobv.jpeg"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Assalamu'alaikum</h4>
                </div>


<?php 
if (isset($_POST['bLogin'])) {
	include("koneksi.db.php");
	$uname=filter_var($_POST['Username'],FILTER_SANITIZE_STRING);
	$upass=filter_var($_POST['Password'],FILTER_SANITIZE_STRING);
	$sql="select * from pengguna where username='".$uname."' and password='".$upass."'";
	//echo $sql;exit();
	@$q=mysqli_query($koneksi,$sql);
	$r=mysqli_fetch_array($q);
	if (empty($r)) {
	echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Gagal login! </strong>Periksa Kode Login dan Password anda.
</div>'; 
	}
	if (!empty($r)) {
		$_SESSION['SB_u']=$uname;
		//$_SESSION['SB_unit']=$r['unit'];
		$_SESSION['SB_level']=$r['IdLevel'];
		echo "<script>window.location.href='index.php';</script>";
	}
}
?>
                <form method="post" action="">
                  <p>Silahkan login dengan akun yang telah diberikan</p>

                  <div class="form-outline mb-4">
                    <input type="text" id="Username" name="Username" class="form-control"
                      placeholder="Ketik kode login anda" required autocomplete="off"/>
                    <label class="form-label" for="Username">Username</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="Password" Name="Password" class="form-control" />
                    <label class="form-label" for="Password" required autocomplete="off" />Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <input name="bLogin" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" value="Login">
                    <!--a class="text-muted" href="#!">Forgot password?</a-->
                  </div>

                  <!--div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger">Create new</button>
                  </div-->

                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">اللهم وفقنا لطاعتك وأثيم تقصيرنا وتقبل منا إنك أنت السميع العليم وصلى الله على سيدنا محمد وآله وصحبه وسلم والحمد لله رب العالمين
<br>
“Allahumma waffiqna li tha‘atika, wa atmim taqshirana, wa taqabbal minna, innaka antas sami‘ul ‘alim. Wa shallallahu ‘ala sayyidina muhammadin wa ‘alihi wa shahbihi wa sallam. Walhamdulillahi rabbil ‘alamin.”<br>
Artinya: Ya Allah, bimbinglah jalan kami pada jalan ketaatan kepada-Mu, sempurnakanlah kekurangan kami, terimalah ibadah kami. Sungguh, Kau maha mendengar lagi mengetahui. Semoga Allah melimpahkan shalawat dan salam-Nya kepada Nabi Muhammad SAW, keluarga, dan para sahabatnya.
</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>