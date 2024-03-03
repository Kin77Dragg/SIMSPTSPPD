<?php
		include('koneksi.db.php');
		if (isset($_GET['NomorSurat'])){
			$NomorSurat=filter_var($_GET['NomorSurat'],FILTER_SANITIZE_STRING);
			$sql="SELECT * FROM `headersurat` WHERE NomorSurat='".$NomorSurat."'";
			$q=mysqli_query($koneksi, $sql);
			$r=mysqli_fetch_array($q);
		} 
			?>
<!DOCTYPE html>
<html>
    <head>
        <title>Surat Permohonaan Dinas Luar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
                        <input type="date" class="form-control" id="TglSurat" name="TglSurat" value="<?php echo $r['TglSurat'];?>">
                        </div>
                    </td>
                </tr>
            </table>
            <table width="615">
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Nomor</td>
                    <td width="100">:
                        <input style="font-size: 12px; font-family: time new romance; width: 182px;" id="NomorSurat" name="NomorSurat" type="text" value="<?php echo $r['NomorSurat']; ?>">
                        <input style="font-size: 12px; font-family: time new romance; width: 182px;" id="IdSurat" name="IdSurat" type="hidden" value="<?php echo $r['IdSurat']; ?>">
                    </td> 
                    <td width="500" style="font-size: 12px; font-family: time new romance; line-height:1.5;">
                        Kepada Yth.
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Sifat</td>
                    <td width="100">:
                        <input style= "font-size: 12px; font-family: time new romance; width: 182px;" id="SifatSurat" name="SifatSurat" type="text" value="<?php echo $r['SifatSurat'];?>">
                    </td> 
                    <td style="line-height:1.5;" class="">
                        <input style="font-size: 12px; font-family: time new romance; width: 150px;" id="TujuanSurat" name="TujuanSurat" 
                        type="text" class="form-control" value="<?php echo $r['TujuanSurat'];?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Lampiran</td>
                    <td width="100">:
                        <input style="font-size: 12px; font-family: time new romance; width: 182px;" id="Lampiran" name="Lampiran" type="text" value="<?php echo $r['Lampiran']; ?>">
                    </td> 
                    <td style="font-size: 12px; font-family: time new romance; line-height:1.5;">
                        Di-
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: time new romance;">Perihal</td>
                    <td width="581">: 
                        <textarea style="font-size: 12px; font-family: time new romance; width: 320px;" id="Perihal" name="Perihal" class="form-control" cols="50" rows="2" value="<?php echo $r['Perihal']; ?>"></textarea>
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
                                Kota Bengkulu yaitu melaksanakan Kunjungan Kerja, maka dengan ini kami 
                                beritahukan bahwa Anggota DPRD Kota Bengkulu bermaksud melaksanakan
                                Kunjungan Kerja yang akan dilaksanakan pada :
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
                        <input style="font-size: 12px; font-family: time new romance;" type="date" class="form-control" id="TanggalAwal" name="TanggalAwal" value="<?php echo $r['TanggalAwal'];?>">
                        s/d <input style="font-size: 12px; font-family: time new romance;" id="TanggalAkhir" name="TanggalAkhir" 
                        type="date" class="form-control" value="<?php echo $r['TanggalAkhir'];?>">
                    </td>
                </tr>
                <tr>
                    <td width="55"></td>
                    <td style="font-size: 12px; font-family: time new romance;">Tempat</td>
                    <td style="line-height:1.5;">:
                        <textarea style="font-size: 12px; font-family: time new romance; width: 320px;" id="TempatKegiatan" name="TempatKegiatan" class="form-control" cols="50" rows="1" value="<?php echo $r['TempatKegiatan'];?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="55"></td>
                    <td style="font-size: 12px; font-family: time new romance;">Acara</td>
                    <td style="line-height:1.5;">:
                        <textarea style="font-size: 12px; font-family: time new romance; width: 320px;" id="AcaraKegiatan" name="AcaraKegiatan" class="form-control" cols="50" rows="1" value="<?php echo $r['AcaraKegiatan'];?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="55"></td>
                    <td style="font-size: 12px; font-family: time new romance;">Alat Transportasi</td>
                    <td style="line-height:1.5;">:
                        <input style="font-size: 12px; font-family: time new romance; width: 320px;" id="AlatAngkutan" name="AlatAngkutan" class="form-control" cols="50" rows="1">
                    </td>
                </tr>
            </table>
            <br>
            <div class="form-group row">
			<div class="offset-4 col-8">
			<button name="submit" type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
		<?php
			if (isset($_POST['submit'])){
                $NomorSurat=filter_var($_POST['NomorSurat'],FILTER_SANITIZE_STRING);
                $IdSurat=filter_var($_POST['IdSurat'],FILTER_SANITIZE_STRING);
				$TglSurat=filter_var($_POST['TglSurat'],FILTER_SANITIZE_STRING);
                $SifatSurat=filter_var($_POST['SifatSurat'],FILTER_SANITIZE_STRING);
                $TujuanSurat=filter_var($_POST['TujuanSurat'],FILTER_SANITIZE_STRING);
                $Lampiran=filter_var($_POST['Lampiran'],FILTER_SANITIZE_STRING);
                $Perihal=filter_var($_POST['Perihal'],FILTER_SANITIZE_STRING);
                $TanggalAwal=filter_var($_POST['TanggalAwal'],FILTER_SANITIZE_STRING);
                $TanggalAkhir=filter_var($_POST['TanggalAkhir'],FILTER_SANITIZE_STRING);
                $TempatKegiatan=filter_var($_POST['TempatKegiatan'],FILTER_SANITIZE_STRING);
                $AcaraKegiatan=filter_var($_POST['AcaraKegiatan'],FILTER_SANITIZE_STRING);
                $AlatAngkutan=filter_var($_POST['AlatAngkutan'],FILTER_SANITIZE_STRING);
                include('koneksi.db.php');
				$sql="UPDATE `headersurat` SET `TglSurat`='".$TglSurat."',`NomorSurat`='".$NomorSurat."', `SifatSurat`='".$SifatSurat."',`TujuanSurat`='".$TujuanSurat."',`Lampiran`='".$Lampiran."',`Perihal`='".$Perihal."',`TanggalAwal`='".$TanggalAwal."',`TanggalAkhir`='".$TanggalAkhir."',`TempatKegiatan`='".$TempatKegiatan."',`AcaraKegiatan`='".$AcaraKegiatan."',`AlatAngkutan`='".$AlatAngkutan."' WHERE IdSurat='".$IdSurat."'";
				$q=mysqli_query($koneksi,$sql); //echo $sql;
				
                if ($q){
                    ?><div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='carisurat.php';"></button>
                    <strong>Success!</strong>Record Sudah diganti.
                    </div><?php
                } else {
                    ?><div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='carisurat.php';"></button>
                    <strong>Gagal!</strong>Record Gagal diganti.
                    </div><?php
                }
			}
		?>
        </center>
    </body>
</html>
