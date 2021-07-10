<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <div class="text-center">
          <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo-pelindo-2.png')))}}" alt=""
          width="318"
          height="87">
          <p style="margin:0pt; text-align:center; padding-top:15px">
            <span
             style="font-family:&#39;Liberation Serif&#39;; font-size:20pt; font-weight:bold"
             >Laporan Aduan</span
            ><br /><span style="font-family:&#39;Liberation Serif&#39;; font-size:12pt"
             >rentang tanggal {{$mulaiTanggal}} s/d {{$sampaiTanggal}}
            </span>
           </p>
           <br>
           <table class="table">
            <thead>
              <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Divisi</th>
                <th scope="col">Nama Pelapor</th>
                <th scope="col">Permasalahan</th>
                <th scope="col">PIC</th>
                <th scope="col">Solusi</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $aduan)
              <tr>
                <th scope="row">{{$aduan->tgl_dibuat}}</th>
                <td>{{$aduan->divisi->nama_divisi}}</td>
                <td>{{$aduan->nama_pelapor}}</td>
                <td>{{$aduan->keterangan}}</td>
                <td>
                    @foreach ($aduan->pic as $picnya)
                    <li style="list-style-type: circle;">{{ $picnya->nama_pegawai }}</li>
                    @endforeach
                </td>
                <td>{{$aduan->solusi}}</td>
                <td>{!! $aduan->is_approv == 1 ? "Selesai" : "Belum" !!}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
