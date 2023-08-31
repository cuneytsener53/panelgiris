<?php
include("baglanti.php");

$username_err = "";
$email_err= "";
$parola_err= "";
$parolatkr_err= "";



//BU ALAN İF SORGUSU İLE KAYDET BUTONUNDAN GELEN DEĞERLERİ DEĞİŞKENLERE ATAYIP BUTONUN CLİCK OLAYINDAN YOLLAMA POST İŞLEMİ YAPTIK
if (isset($_POST["kaydet"])) 


    //KULLANICI ADI DOĞRULAMA İŞLEMLERİ YAPILDIĞI YER
    {
    if (empty($_POST["kullaniciadi"])) 
    
    {
        $username_err = "Kullanıcı Adı Boş Geçilemez";
    } 
    
    else if (strlen($_POST["kullaniciadi"]) < 6) 
    
    {
        $username_err = "Kullanıcı adı en az 6 karakterden oluşmalıdır";
    }

    else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullaniciadi"])) {
        $username_err="Kullanıcı adı büyük küçük harf ve rakamdan oluşmalıdır.";
    }

    else 
    {
        $username=$_POST["kullaniciadi"];
    }


    //EMAİL DOĞRULAMA İŞLEMLERİ YAPILAN YER

    if (empty($_POST["email"])) {
        $email_err="Email Boş Geçilemez";
    }
    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Geçer E-Mail Formatı Giriniz";}

    else {
        $email=$_POST["email"];
    }

    //PAROLA DOĞRULAMA KISMI


    if (empty($_POST["parola"])) {
        $parola_err="Parola kısmı boş geçilemez";
    }
    else {
        $parola=password_hash($_POST["parola"],PASSWORD_DEFAULT);;
    }


    //PAROLA TEKRAR DOĞRULUMA KISMI

    if (empty($_POST["parolatkr"])) {
        $parolatkr_err="Parola Tekrar Kısmı Boş Geçilemez.";
    }
    elseif ($_POST["parola"]!=$_POST["parolatkr"]) 
    {
        $parolatkr_err="Parolalar Eşleşmiyor Lütfen Kontrol Ediniz";
    }
    else {
        $parolatkr=$_POST["parolatkr"];
    }
    
    
    
    
    //VERİ TABANI İŞLELERİ BAĞLANDIĞI YER

    if (isset($username) && ($email) && ($parola))
    {
        # code...
    
     $ekle = "INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES ('$username','$email','$parola')";
    $calistirekle = mysqli_query($baglanti, $ekle);

    if ($calistirekle) {
        echo '<div class="alert alert-success" role="alert">
        Kayıt Başarılı Bir Şekilde Eklenmiştir.
      </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Kayıt Eklemede Bir Problem Olmuştur.
      </div>';
    }

    mysqli_close($baglanti);
}
}





?>

<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>ÜYE KAYIT İŞLEMLERİ!</title>
</head>


<!-- BU ALANA EKRANDA DÜZENLEME YAPILAN BODY ALANDINI -->

<body>
    <div class="container p-5"> SNRSOFT YAZILIM HİZMETLERİ
        <div class="card p-5">

            <form action="kayit.php" method="POST">
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

                    <!-- EMAİL ADRES KOD PARÇACIGI KISMI -->

                    <label for="exampleInputEmail1" class="form-label">Email Adress</label>
                    <input type="text" class="form-control
                    
                    <?php                         
                        if (!empty($email_err))
                        {
                            echo "is-invalid";
                        }
                        ?>                 
                    "
                    
                    id="exampleInputEmail1" name="email">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php
                            echo $email_err;
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

                <!-- PARDOLA TEKRARI KOD PARÇACIGI -->
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Şifre Tekrarı</label>
                    <input type="password" class="form-control

                    <?php                         
                        if (!empty($parolatkr_err))
                        {
                            echo "is-invalid";
                        }
                        ?>
                    
                    "
                  
                     id="exampleInputEmail1" name="parolatkr">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php 
                        echo $parolatkr_err;
                        ?>
                    </div>
                </div>
                
                <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
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