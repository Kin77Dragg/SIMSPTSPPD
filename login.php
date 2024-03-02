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
      background: #fccb90;
      background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
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

    .custom-heading {
        font-family: 'Perpetua', sans-serif; 
        font-size: 26px; 
        font-weight: bold; 
        color: #white; 
    }

    .custom-paragraph {
        font-family: 'Open Sans', sans-serif; 
        font-style: italic;
        font-size: 16px; 
        line-height: 1.5; 
        color: #white; 
        text-align: justify;
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

              <div class="text-center" style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                <img src="images/LogoDPRD.png" style="width: 110px;" alt="logo">
                <h5 class="mt-1 mb-5 pb-1" style="margin-top: 1em; margin-bottom: 5em; padding-bottom: 1em; font-size: 1.5em; font-weight: bold;">DPRD KOTA BENGKULU</h5>
                <p style="font-style: italic;"><i>Silahkan Masukkan Username dan Password Anda !</i></p>
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
                  <div class="form-outline mb-4">
                    <label class="form-label" for="Username"><b>Username :</b></label>
                    <input type="text" id="Username" name="Username" class="form-control" placeholder="Masukkan Username" required autocomplete="off"/>
                    </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="Password" required autocomplete="off"><b>Password :</b></label>
                    <input type="password" id="Password" Name="Password" class="form-control" placeholder="Masukkan Password" />
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <input name="bLogin" class="btn btn-outline-success btn-block fa-lg  mb-3" type="submit" value="Login">
                    <!--a class="text-muted" href="#!">Forgot password?</a-->
                  </div>

                  <!--div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger">Create new</button>
                  </div-->

                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center" style="background-image: url('./images/pakis.jpg'); background-size: cover; background-position: center;">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
              <h4 class="mb-4 custom-heading">Bersama, Kita Ciptakan Kemajuan</h4>
                <p class="small mb-0 custom-paragraph">"Bersama-sama, kita mengukir kemajuan yang lebih baik untuk melayani masyarakat dengan sepenuh hati. Mari kita jadikan setiap langkah sebagai batu loncatan untuk mencapai tujuan bersama, demi kebaikan bersama.  Bersatu kita teguh, bercerai kita runtuh. Bersama, kita mewujudkan cita-cita yang mulia untuk negeri tercinta."
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