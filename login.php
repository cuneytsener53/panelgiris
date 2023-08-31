<?php
include("baglanti.php");

$username_err = "";
$parola_err= "";



//BU ALAN İF SORGUSU İLE KAYDET BUTONUNDAN GELEN DEĞERLERİ DEĞİŞKENLERE ATAYIP BUTONUN CLİCK OLAYINDAN YOLLAMA POST İŞLEMİ YAPTIK
if (isset($_POST["giris"])) 


    //KULLANICI ADI DOĞRULAMA İŞLEMLERİ YAPILDIĞI YER
    {
    if (empty($_POST["kullaniciadi"])) 
    
    {
        $username_err = "Kullanıcı Adı Boş Geçilemez";
    } 
    else 
    {
        $username=$_POST["kullaniciadi"];
    }

    //PAROLA DOĞRULAMA KISMI


    if (empty($_POST["parola"])) {
        $parola_err="Parola kısmı boş geçilemez";
    }
    else {
        $parola=($_POST["parola"]);;
    }
   
    
    
    //VERİ TABANI İŞLELERİ BAĞLANDIĞI YER

    if (isset($username) && ($parola))
    {

        $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi ='$username'";
        $calistir = mysqli_query($baglanti,$secim);
        $kayitsayisi = mysqli_num_rows($calistir); // BURDAN ÇIKACAK SONUCUM YA SIFIR YA DA BİRDİR BU KOD KAÇ TANE AYNI KULLLANICI OLUP OLMADIĞINA BAKIYOR

        if ($kayitsayisi>0) {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $haslisifre=$ilgilikayit["parola"];
            if (password_verify($parola,$haslisifre)) 
            
            {
                session_start();
                $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
                $_SESSION["email"]=$ilgilikayit["email"];
                $_SESSION["parola"]=$ilgilikayit["parola"];
                header("location:profile.php");
            }

            else {
                echo '<div class="alert alert-danger" role="alert">
            Parola Yanlıştır.
          </div>';
            }
        }
        else {
            echo '<div class="alert alert-danger" role="alert">
            Kullanıcı Adı Yanlıştır.
          </div>';
        }

    mysqli_close($baglanti);
    }


}?>


<!-- HEAD İŞLEMLERİ BAŞLANGIC EKRANI -->

<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>ÜYE GİRİŞ</title>
</head>


<!-- BU ALANA EKRANDA DÜZENLEME YAPILAN BODY ALANDINI -->

<body>
    <div class="container p-5"> SNRSOFT GİRİŞ EKRANI
        <div class="card p-5">

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kullanıcı ADI</label>
                        <input type="text" class="form-control
                        <?php                         
                        if (!empty($username_err))
                        {
                            echo "is-invalid";
                        }
                        ?>                    
                        "
                                                
                        id="exampleInputEmail1" name="kullaniciadi">
                        <div id="validationServer03Feedback" class="invalid-feedback">

                            <?php
                            echo $username_err;
                            ?>
                        </div>
                    </div>

                                  
                <!-- PAROLA KISMI KOD PARÇAÇIGI -->

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Şifre</label>
                    <input type="password" class="form-control

                    <?php                         
                        if (!empty($parola_err))
                        {
                            echo "is-invalid";
                        }
                        ?>
                    
                    "
                    
                    id="exampleInputEmail1" name="parola">
                    <div id="validationServer03Feedback" class="invalid-feedback">


                        <?php 
                        
                        echo $parola_err;
                        
                        ?>
                    </div>
                </div>
              
                <button type="submit" name="giris" class="btn btn-primary">Giriş Yap</button>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>