<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- STYLING -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/sweetalert2.min.css">
    <link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- javascript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="alert/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript" src="btn_input.js">

    </script>
    <meta charset="utf-8">
    <title></title>
    <style>
      html{
        background-color: black;
      }
      .formkotak{
        position: absolute;
        top: 90px;
        left: 17px;
        width: 320px;
        height: 50px;
      }
      .forminput{
        width: 100%;
        height: 100%;
        text-align: center;
        font-size: 25px;
      }
      .ip{
        position: absolute;
        top: 250px;
        left: 500px;
        color: white;
      }
      .ip p{
        font-size: 10.5px;
      }
      #tanggalku{
          position: absolute;
          top: 172px;
          left: 560px;
      }
      .animated-button1{
          position: absolute;
          z-index: 1;
          width: 145px;
          top: 160px;
          left: 540px;
      }
      #tanggalku{
          z-index: 2;
      }
      .enter_input{
        position:absolute;
        margin-top:327px;
        margin-left:-105px;
        z-index:2;
        width:105px;
        height:80px;
        opacity:0;
      }
    </style>
    <link rel="stylesheet" href="alert/sweetalert2.min.css">
    <script src="alert/sweetalert2.all.min.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini" onload="waktu()">
    <div align="center">
      <img src="pict/phone.jpg" style="width: 100%; height: 100%;">
      <div class="container">
        <script type="text/javascript">
        // 1 detik = 1000
        window.setTimeout("waktu()",1000);
        function waktu() {
          var tanggal = new Date();
          setTimeout("waktu()",1000);
          document.getElementById("tanggalku").innerHTML = " "+tanggal.getHours()+" : "+tanggal.getMinutes()+" : "+tanggal.getSeconds()+" ";
        }
        </script>

        <font face="Counter-Strike" size="5" color="white">
          <div id="tanggalku"></div>
          <a type="button" class="animated-button1" disabled>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </a>
        </font>
        <div class="ip">
          <div style="margin-left:60px;">
            <h4><b>Informasi Pelanggan</b></h4>
            <p>Masukkan nomor SL Anda untuk mendapatkan <br> informasi pelanggan.</p>
          </div>

          <form action="login_process.php?pel_no=<?php echo $pel_no; ?>" method="get" class="formkotak" name="forminput">
            <input type="text" name='pel_no' size="6" maxlength="6" class="forminput">
            <input class="enter_input" src="pict/enter.jpg" type="submit" name="submit">
          </form>

          <table style="position: absolute; top: 170px; left: 17px;">
            <tr>
              <td><img src="pict/1.jpg" alt="1" onclick="insert(1)"></td>
              <td><img src="pict/2.jpg" alt="2" onclick="insert(2)"></td>
              <td><img src="pict/3.jpg" alt="3" onclick="insert(3)"></td>
            </tr>
            <tr>
              <td><img src="pict/4.jpg" alt="4" onclick="insert(4)"></td>
              <td><img src="pict/5.jpg" alt="5" onclick="insert(5)"></td>
              <td><img src="pict/6.jpg" alt="6" onclick="insert(6)"></td>
            </tr>
            <tr>
              <td><img src="pict/7.jpg" alt="7" onclick="insert(7)"></td>
              <td><img src="pict/8.jpg" alt="8" onclick="insert(8)"></td>
              <td><img src="pict/9.jpg" alt="9" onclick="insert(9)"></td>
            </tr>
            <tr>
              <td><img src="pict/clear.jpg" alt="clear" onclick="clean()"></td>
              <td><img src="pict/0.jpg" alt="0" onclick="insert(0)"></td>
              <td><img src="pict/enter.jpg" alt="enter" onclick="find_data()" name="submit"></td>
            </tr>
          </table>

      </div>
      </div>
    </div>

    <!-- <button type="button" onclick="alertclick()">Alert</button>
    <script>
    function alertclick(){
      alert("Selamat Datang :)");
    }
    </script> -->

    <!-- <button type="button" onclick="sweetalertclick()">checkbox</button> -->
    <script>
      function sweetalertclick(){
        Swal.fire({
          icon: 'success',
          text: 'tes'
        })
      }
    </script>
  </body>
</html>
