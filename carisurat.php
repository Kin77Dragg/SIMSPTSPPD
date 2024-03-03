<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Surat Permohonan</h2>
<form method="post" target="frmhasilsurat" action="formcekpermohonan.php">
  <div class="form-group row">
    <label for="NomorSurat" class="col-4 col-form-label">Nomor Surat</label> 
    <div class="col-8">
      <input id="NomorSurat" name="NomorSurat" placeholder="Ketik Nomor Surat" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Cek</button>
    </div>
  </div>
</form>
<iframe width="100%" height="500px" name="frmhasilsurat"></iframe>