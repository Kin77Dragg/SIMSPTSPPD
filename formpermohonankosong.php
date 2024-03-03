
<!DOCTYPE html>
<html>
    <head>
        <title>Surat Permohonaan Dinas Luar</title>
        <style>
            table tr td{
                font-size: 13px;
            }
            table tr .text{
                text-align: right;
                font-size: 13px;
            }
            .tujuan{
                text-align: center;
                font-size: 13px;
            }
        </style>
    </head>
    <body>
        <center>
            <form method="post">
            <table width="680">
                <tr>
                    <td><img src="images/LogoDPRD.png" tyle="width: 75;" alt="logo"  height="80"></td>
                    <td>
                        <center>
                            <font size="5" style="font-family: time new romance;"><b>DEWAN PERWAKILAN RAKYAT DAERAH</b></font><br>
                            <font size="5"><b>KOTA BENGKULU</b></font><br>
                            <font size="2"><i>JL. WR. Supratman Kel. Bentiring Permai Telp. (0736) 7310026-7310454-7310455 Fax 7310026</i></font><br> 
                            <font size="3" style="font-family: time new romance;"><b>BENGKULU</b></font><br><br>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
            </table>
            <table width="615">
                <tr>
                    <td class="text">
                        <div class="col">
                            <input type="date" class="form-control" id="TglSurat" name="TglSurat">
                        </div>
                    </td>
                </tr>
            </table>
            <table width="615">
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Nomor</td>
                    <td width="100">:
                        <input style="font-size: 12px; font-family: time new romance; width: 182px;" id="NomorSurat" name="NomorSurat" type="text" >
                    </td> 
                    <td width="500" style="font-size: 12px; font-family: time new romance; line-height:1.5;">
                        Kepada Yth.
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Sifat</td>
                    <td width="100">:
                        <input style= "font-size: 12px; font-family: time new romance; width: 182px;" id="SifatSurat" name="SifatSurat" type="text" >
                    </td> 
                    <td style="line-height:1.5;" class="">
                        <input style="font-size: 12px; font-family: time new romance; width: 150px;" id="TujuanSurat" name="TujuanSurat" 
                        type="text" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Lampiran</td>
                    <td width="100">:
                        <input style="font-size: 12px; font-family: time new romance; width: 182px;" id="Lampiran" name="Lampiran" type="text" >
                    </td> 
                    <td style="font-size: 12px; font-family: time new romance; line-height:1.5;">
                        Di-
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Perihal</td>
                    <td width="581">: 
                        <textarea style="font-size: 12px; font-family: time new romance; width: 320px;" id="Perihal" name="Perihal" class="form-control" cols="50" rows="2"></textarea>
                    </td>
                    <td style="line-height:1.5;" class="tujuan" style="font-size: 12px; font-family: time new romance;">
                        <b>Bengkulu</b>
                    </td>
                </tr>
            </table>
            <br>
            <table width="612">
                <tr>
                    <td width="55"></td>
                    <td align="justify" style="font-size: 12px; font-family: time new romance; line-height:1.5;">
                                Dengan Hormat,
                            <p style="text-align:justify; text-indent: 0.5in;">Sehubungan dengan ditetapkannya Program Kerja Pimpinan dan Anggota DPRD 
                                Kota Bengkulu yaitu melaksanakan <input type="text" name="program_kerja" style="font-size: 12px; font-family: time new romance;">, maka dengan ini kami 
                                beritahukan bahwa Anggota DPRD Kota Bengkulu bermaksud melaksanakan
                                <input type="text" name="kegiatan" style="font-size: 12px; font-family: time new romance;"> yang akan dilaksanakan pada :
                            </p> 
                    </td>
                </tr>
            </table>
            <br>
            <table width="612">
                <tr>
                    <td width="55"></td>
                    <td style="font-size: 12px; font-family: time new romance;">Tanggal</td>
                    <td class="col"> :
                        <input style="font-size: 12px; font-family: time new romance;" type="date" class="form-control" id="TanggalAwal" name="TanggalAwal">
                        s/d <input style="font-size: 12px; font-family: time new romance;" id="TanggalAkhir" name="TanggalAkhir" 
                        type="date" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td width="55"></td>
                    <td style="font-size: 12px; font-family: time new romance;">Tempat</td>
                    <td style="line-height:1.5;">:
                        <textarea style="font-size: 12px; font-family: time new romance; width: 320px;" id="TempatKegiatan" name="TempatKegiatan" class="form-control" cols="50" rows="1"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="55"></td>
                    <td style="font-size: 12px; font-family: time new romance;">Acara</td>
                    <td style="line-height:1.5;">:
                        <textarea style="font-size: 12px; font-family: time new romance; width: 320px;" id="AcaraKegiatan" name="AcaraKegiatan" class="form-control" cols="50" rows="1"></textarea>
                    </td>
                </tr>
            </table>
			<table width="614">
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary" style="font-family: time new romance;">Simpan</button>
                </div>
                </div>
			</table>

            <?php 
                if (isset($_POST['submit'])) {
                    $TglSurat=filter_var($_POST['TglSurat'],FILTER_SANITIZE_STRING);
                    $NomorSurat=filter_var($_POST['NomorSurat'],FILTER_SANITIZE_STRING);
                    $SifatSurat=filter_var($_POST['SifatSurat'],FILTER_SANITIZE_STRING);
                    $TujuanSurat=filter_var($_POST['TujuanSurat'],FILTER_SANITIZE_STRING);
                    $Lampiran=filter_var($_POST['Lampiran'],FILTER_SANITIZE_STRING);
                    $Perihal=filter_var($_POST['Perihal'],FILTER_SANITIZE_STRING);
                    $TanggalAwal=filter_var($_POST['TanggalAwal'],FILTER_SANITIZE_STRING);
                    $TanggalAkhir=filter_var($_POST['TanggalAkhir'],FILTER_SANITIZE_STRING);
                    $TempatKegiatan=filter_var($_POST['TempatKegiatan'],FILTER_SANITIZE_STRING);
                    $AcaraKegiatan=filter_var($_POST['AcaraKegiatan'],FILTER_SANITIZE_STRING);
                    include('koneksi.db.php');
                    $sql="INSERT INTO `headersurat`(`TglSurat`, `NomorSurat`, `SifatSurat`, `TujuanSurat`, `Lampiran`, `Perihal`, `TanggalAwal`, `TanggalAkhir`, `TempatKegiatan`, `AcaraKegiatan`) VALUES ('".$TglSurat."','".$NomorSurat."','".$SifatSurat."','".$TujuanSurat."','".$Lampiran."','".$Perihal."','".$TanggalAwal."','".$TanggalAkhir."','".$TempatKegiatan."','".$AcaraKegiatan."')";
                    $q=mysqli_query($koneksi,$sql);
                    if ($q) {
                        echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Success!</strong>Record Sudah disimpan.
                        </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Gagal!</strong>Record Gagal disimpan.
                        </div>';
                    }
                }
            ?>
        </form>
        </center>
    </body>
</html>
