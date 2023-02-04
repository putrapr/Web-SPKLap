<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <div class="pembungkus">
      <div class="butir">
        <div class="logo">
          <img src="images/50x50 logo.png" alt="Logo" />
        </div>
        <div class="bab">
          <div class="webname">
            <a href="#">SPKLap</a>
          </div>          
        </div>        
      </div>

      <form action="proses/cek-masuk.php" method="post">
        <div class="card text-end formulir-masuk">
          <h5 class="card-header judul-masuk">Masuk</h4>
          <div class="card-body">
            <div class="input-group mb-3">
              <span class="input-group-text masuk-input" id="inputGroup-sizing-default">Nama</span>
              <input type="text" class="form-control" name="nama" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text masuk-input" id="inputGroup-sizing-default">Sandi</span>
              <input type="password" class="form-control" name="sandi" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <input type="submit" class="btn btn-dark" name="submit" value="Masuk"></input>
          </div>
        </div>

        <div class="card formulir-masuk">
          <div class="card-body">
            <p>
                Klik
                <a href="halaman/lupa-sandi.php">
                    <button type="button" class="btn btn-secondary btn-sm">Lupa Sandi</button>
                </a> 
                  untuk memulihkan sandi.
            </p>
            <p>
                Belum mempunyai akun? Klik 
                <a href="halaman/daftar.php">
                    <button type="button" class="btn btn-warning btn-sm">Daftar</button>
                </a>
            </p>
            <p><br> Jika anda admin ceklis di bawah ini</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="cek_admin" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">Admin</label>
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
