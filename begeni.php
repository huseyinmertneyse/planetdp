<?php
$displaybut = 'block';
$displaybar = 'none';
$displayg = 'none';
$displayp = 'none';
$displaygecersiz = 'none';
$kadi = '';
$gorunurluk = '';

$anketbut1 = 'none';
$anketspan11 = 'none';
$anketspan12 = 'block';
$anketbos1 = 'none';

$anketbut2 = 'none';
$anketspan21 = 'none';
$anketspan22 = 'block';
$anketbos2 = 'none';
session_start();

$baglan = mysqli_connect('localhost','root','','planetdp');
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}      
mysqli_set_charset($baglan,'utf8'); 

if(!isset($_SESSION['kadi']) && isset($_COOKIE['cookie']))
{
    $veri = unserialize($_COOKIE['cookie']);
    $gadi = $veri['kadi'];
    $pass = $veri['pass'];
    $bul = mysqli_query($baglan,"SELECT * FROM users where (kadi = '$gadi' OR email = '$gadi') AND pass = '$pass'");
    $say = mysqli_num_rows($bul);
    if($say > 0)
    {
        $satir = mysqli_fetch_array($bul);
        $_SESSION['kadi'] = $satir['kadi']; 
        header('Location:index.php');
    }
    header('Location:index.php');
}

if(isset($_SESSION['kadi']))
{

    $anketbut = 'block';
    $anketspan1 = 'none';
    $anketspan2 = 'none';  
    $anketbos = 'none';
    $kadi = $_SESSION['kadi'];
    if(!isset($_GET))
    {
        $displaybut = 'none';
        $displaybar = 'block';
    }
    else if(!isset($_GET['main']))
    {
        $displaybut = 'none';
        $displaybar = 'block';
    }
    else if($_GET['main'] == 'cikis')
    {
        $_SESSION = array();
        session_destroy();
        setcookie('cookie',0,time()-8400);
        $displaybut = 'block';
        $displaybar = 'none';
        header('Location:index.php');
    }
}
else
{  
    if(!isset($_GET))
    {
        $gorunurluk = 'opacity: 0;visibility: hidden;';
        $displayg = 'none';
        $displayp = 'none';
    }
    else if(!isset($_GET['main']))
    {
        $gorunurluk = 'opacity: 0;visibility: hidden;';
        $displayg = 'none';
        $displayp = 'none';
    }
    else if($_GET['main'] == 'giris')
    {
        $displayg = 'none';
        $displayp = 'none';
        if(isset($_POST['giris']))
        { 
            $displayg = 'none';
            $displayp = 'none';
            $gadi = $_POST['gadi'];
            $pass = $_POST['pass'];
            if($gadi == '' || $pass == '')
            {
                $gorunurluk = 'opacity: 1;visibility: visible;';
                if($gadi == '')
                {
                    $displayg = 'block';
                }
                if($pass == '')
                {
                    $displayp = 'block';
                }
            }
            else
            { 
                $bul = mysqli_query($baglan,"SELECT * FROM users where (kadi = '$gadi' OR email = '$gadi') AND pass = '$pass'");
                $say = mysqli_num_rows($bul);
                if($say > 0)
                {
                    $satir = mysqli_fetch_array($bul);
                    $_SESSION['kadi'] = $satir['kadi'];
                    $kadipass = array('kadi'=>$satir['kadi'],'pass'=>$satir['pass']);
                    if(isset($_POST['hatirla']))
                    {
                        $hatirla = $_POST['hatirla'];
                        if($hatirla == 1)
                        {
                            setcookie('cookie',serialize($kadipass),time()+8400);
                        }
                    }
                    header('location:index.php');
                }
                else
                {
                    $gorunurluk = 'opacity: 1;visibility: visible;';
                    $displaygecersiz = 'block';
                }
            }
        }
    }    
}

if(isset($_POST['anket1g']))
{
    $name = $_SESSION['kadi'];
    $bul = mysqli_query($baglan,"SELECT * FROM oyatanlar where kadi = '$name' AND soru = 'En Sevdiğiniz Dizi'");
    $control = mysqli_num_rows($bul);
    if($control > 0)
    {
        $anketbut1 = 'none';
        $anketspan11 = 'block';
        $anketspan12 = 'none';
    }
    else
    {
        if(isset($_POST['anket1']))
        {
            if($_POST['anket1'] == '1')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Dizi','Prison Break')");
                $update = mysqli_query($baglan,"UPDATE anket set deger1 = deger1 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Dizi'");  
            }
            else if($_POST['anket1'] == '2')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Dizi','The Walking Dead')");
                $update = mysqli_query($baglan,"UPDATE anket set deger2 = deger2 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Dizi'");  
            }
            else if($_POST['anket1'] == '3')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Dizi','Peaky Blinders')");
                $update = mysqli_query($baglan,"UPDATE anket set deger3 = deger3 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Dizi'");  
            }
            else if($_POST['anket1'] == '4')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Dizi','Game of Thrones')");
                $update = mysqli_query($baglan,"UPDATE anket set deger4 = deger4 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Dizi'");  
            }
            else if($_POST['anket1'] == '5')
            {   
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Dizi','Breaking Bad')");
                $update = mysqli_query($baglan,"UPDATE anket set deger5 = deger5 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Dizi'");  
            }
            else if($_POST['anket1'] == '6')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Dizi','Black Mirror')");
                $update = mysqli_query($baglan,"UPDATE anket set deger6 = deger6 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Dizi'");          
            }
        }
        else
        {
            $anketbos1 = 'block';
        }
    }
}

if(isset($_POST['anket2g']))
{
    $name = $_SESSION['kadi'];
    $bul = mysqli_query($baglan,"SELECT * FROM oyatanlar where kadi = '$name' AND soru = 'En Sevdiğiniz Film'");
    $control = mysqli_num_rows($bul);
    if($control > 0)
    {
        $anketbut2 = 'none';
        $anketspan21 = 'block';
        $anketspan22 = 'none';
    }
    else
    {
        if(isset($_POST['anket2']))
        {
            if($_POST['anket2'] == '1')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Film','Titanik')");
                $update = mysqli_query($baglan,"UPDATE anket set deger1 = deger1 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Film'");  
            }
            else if($_POST['anket2'] == '2')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Film','Transformers')");
                $update = mysqli_query($baglan,"UPDATE anket set deger2 = deger2 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Film'");  
            }
            else if($_POST['anket2'] == '3')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Film','Avengers')");
                $update = mysqli_query($baglan,"UPDATE anket set deger3 = deger3 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Film'");  
            }
            else if($_POST['anket2'] == '4')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Film','Iron Man')");
                $update = mysqli_query($baglan,"UPDATE anket set deger4 = deger4 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Film'");  
            }
            else if($_POST['anket2'] == '5')
            {   
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Film','Thor')");
                $update = mysqli_query($baglan,"UPDATE anket set deger5 = deger5 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Film'");  
            }
            else if($_POST['anket2'] == '6')
            {
                $ekle = mysqli_query($baglan,"INSERT INTO oyatanlar (kadi,soru,oy) values ('$name','En Sevdiğiniz Film','Prestige')");
                $update = mysqli_query($baglan,"UPDATE anket set deger6 = deger6 + 1, toplam = toplam + 1 where soru = 'En Sevdiğiniz Film'");          
            }
        }
        else
        {
            $anketbos2 = 'block';
        }
    }
}



$anketsonuc = mysqli_query($baglan,"SELECT * FROM anket where soru = 'En Sevdiğiniz Dizi'");
$veriler = mysqli_fetch_array($anketsonuc);
$sonuc11 = ($veriler['deger1'] / $veriler['toplam'])*100;
$sonuc11 = ceil($sonuc11);//yuvarlama
$sonuc12 = ($veriler['deger2'] / $veriler['toplam'])*100;
$sonuc12 = ceil($sonuc12);//yuvarlama
$sonuc13 = ($veriler['deger3'] / $veriler['toplam'])*100;
$sonuc13 = ceil($sonuc13);//yuvarlama
$sonuc14 = ($veriler['deger4'] / $veriler['toplam'])*100;
$sonuc14 = ceil($sonuc14);//yuvarlama
$sonuc15 = ($veriler['deger5'] / $veriler['toplam'])*100;
$sonuc15 = ceil($sonuc15);//yuvarlama
$sonuc16 = ($veriler['deger6'] / $veriler['toplam'])*100;
$sonuc16 = ceil($sonuc16);//yuvarlama

$anketsonuc = mysqli_query($baglan,"SELECT * FROM anket where soru = 'En Sevdiğiniz Film'");
$veriler = mysqli_fetch_array($anketsonuc);
$sonuc21 = ($veriler['deger1'] / $veriler['toplam'])*100;
$sonuc21 = ceil($sonuc21);//yuvarlama
$sonuc22 = ($veriler['deger2'] / $veriler['toplam'])*100;
$sonuc22 = ceil($sonuc22);//yuvarlama
$sonuc23 = ($veriler['deger3'] / $veriler['toplam'])*100;
$sonuc23 = ceil($sonuc23);//yuvarlama
$sonuc24 = ($veriler['deger4'] / $veriler['toplam'])*100;
$sonuc24 = ceil($sonuc24);//yuvarlama
$sonuc25 = ($veriler['deger5'] / $veriler['toplam'])*100;
$sonuc25 = ceil($sonuc25);//yuvarlama
$sonuc26 = ($veriler['deger6'] / $veriler['toplam'])*100;
$sonuc26 = ceil($sonuc26);//yuvarlama

echo '
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="planetdp.css">
</head>

<body>

    <header>
        <div class="head-up">
            <div class="cont">
                <form action="arama.php" method = "GET">
                    <div style="position: relative; width: 1110px;">
                        <input type="text" name="arama" style="font-size: 13px;" class="search-bar" placeholder="Film / Dizi / Oyuncu [ad-soyad] / Yönetmen [ad-soyad] / IMDb No [ttxxxxxxx] giriniz">
                    </div>
                    <button type="submit" class="search-button">
                        <img style="width: 30px; padding: 2px;" src="image/search-solid.svg">
                    </button>
                    <div class="user-bar" style="display:'.$displaybut.';">
                        <a type="button" class="user-button" onclick="pencere(1)">Giriş</a>
                        <a> | </a>
                        <a type="button" class="user-button" href="kayit.php?durum=">Kayıt Ol</a>
                    </div>
                    <div class="user-bar-hesap" style="display:'.$displaybar.';">
                        <div class="hesap">
                        <span class="kullanici-adi" style="float:left;cursor:default;">'.$kadi.'</span>
                        <a class="kullanici-adi" style="float:right;" href="index.php?main=cikis">Çıkış</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clear"></div>

        <div class="head-down">
            <div class="cont">
                <div class="head-down-bar">
                    <div class="planet">
                        <div class="planet-logo">
                            <a href="index.php"><img src="image/planetdplogo3.svg"></a>
                        </div>
                        <div class="menu-bar">
                            <ul class="menu">
                                <li><a href="#">VİDEO</a></li>
                                <li><a href="#">DRAMA</a></li>
                                <li><a href="#">ANİME</a></li>
                                <li><a href="#">DİZİ</a></li>
                                <li><a href="#">SİNEMA</a></li>
                                <li><a href="#">ALTYAZI</a></li>
                                <li><a href="#">HABERLER</a></li>
                                <li><a href="#">FORUM</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </header>

    <div class="clear"></div>
    
    <div class="middle">
        <div class="cont" style="width:1165px;">
            <div class="icerik">
                <div class="sol">';
                if(isset($_GET))
                {
                    if(isset($_GET['filmadi']))
                    {
                        $filmadi = $_GET['filmadi'];
                        $bul = mysqli_query($baglan,"SELECT * FROM filmler where filmadi = '$filmadi'");
                        $say = mysqli_num_rows($bul);
                        if($say > 0)
                        {
                            $veriler = mysqli_fetch_array($bul);
                            $film_link = $veriler['dosya'];
                            echo '<a style="color:black;text-decoration:none;" href="'.$film_link.'"><h1>Film: '.$filmadi.'</h1></a><br>';
                        }
                        else
                        {
                            echo '<h1>'.$filmadi.'</h1>';
                        }
                                 
                    }
                }
                if(isset($_GET))
                {
                    if(isset($_GET['yorumid'])) 
                    {
                        $yorumid = $_GET['yorumid'];
                        if(isset($_GET['filmadi']))
                        {
                            $filmadi = $_GET['filmadi'];
                        }
                        
                        $bul = mysqli_query($baglan,"SELECT * FROM begenenler where yorumid = '$yorumid' AND kontrol = 1 ORDER BY id DESC");
                        $say = mysqli_num_rows($bul);
                        if($say > 0)
                        {
                            $yorum_bul = mysqli_query($baglan,"SELECT * FROM yorumlar where id = '$yorumid'");
                            $kullanici_bul = mysqli_fetch_array($yorum_bul);
                            echo '
                                <span style="font-size:20px;font-weight:700;">'.$kullanici_bul['kadi'].' Adlı Kullanıcının Yorumunu Beğenenler</span><br><br>
                            ';
                            while($veriler = mysqli_fetch_array($bul))
                            {
                                echo '
                                    <span style="display:inline-block;margin-right:10px;font-size:15px;">'.$veriler['kadi'].'</span>
                                ';
                            }
                
                        }
                    }
                    else if(isset($_GET['altyorumid'])) 
                    {
                        $altyorumid = $_GET['altyorumid'];
                        $bul = mysqli_query($baglan,"SELECT * FROM yorum_begenenler where yorumid = '$altyorumid' AND kontrol = 1 ORDER BY id DESC");
                        $say = mysqli_num_rows($bul);
                        if($say > 0)
                        {
                            $altyorum_bul = mysqli_query($baglan,"SELECT * FROM yorumayorum where id = '$altyorumid'");
                            $altkullanici_bul = mysqli_fetch_array($altyorum_bul);
                            echo '
                                <span style="font-size:20px;font-weight:700;">'.$altkullanici_bul['kadi'].' Adlı Kullanıcının Yorumunu Beğenenler</span><br><br>
                            ';
                            while($veriler = mysqli_fetch_array($bul))
                            {
                                echo '
                                    <span style="display:inline-block;margin-right:10px;font-size:15px;">'.$veriler['kadi'].'</span>
                                ';
                            }
                
                        }
                    }
                }

                    echo '
                    <div class="clear"></div>
                </div>
                
                <div class="sag">
                    <div>
                        <h1>En Sevdiğiniz Dizi</h1>
                        <form action="index.php" method="POST"> 
                            <ul style="list-style:none;line-height: 25px;">
                                <li>
                                    <input type="radio" name="anket1" value="1">Prison Break
                                </li>
                                <li>
                                    <input type="radio" name="anket1" value="2">The Walking Dead
                                </li>
                                <li>
                                    <input type="radio" name="anket1" value="3">Peaky Blinders
                                </li>
                                <li>
                                    <input type="radio" name="anket1" value="4">Game of Thrones
                                </li>
                                <li>
                                    <input type="radio" name="anket1" value="5">Breaking Bad
                                </li>
                                <li>
                                    <input type="radio" name="anket1" value="6">Black Mirror
                                </li>
                            </ul>
                            <span class="zorunlu" style="display:'.$anketspan11.'">Daha önce oylama yapmışsınız.</span>
                            <span class="zorunlu" style="display:'.$anketspan12.'">Lütfen giriş yapınız.</span>
                            <span class="zorunlu" style="display:'.$anketbos1.'">Boş oy gönderemezsiniz</span>
                            <input type="submit" name="anket1g" style="display:'.$anketbut1.'" value="Gönder">
                        </form>
                    </div>
                    <br>

                    <div>
                        <h1>SONUÇLAR</h1>
                            <ul style="list-style:none;">
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Prison Break
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc11.'</span>
                                                    <div class="sonuc-i" style="background: gray; width:'.$sonuc11.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    The Walking Dead
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc12.'</span>
                                                    <div class="sonuc-i" style="background: red; width:'.$sonuc12.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Peaky Blinders
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc13.'</span>
                                                    <div class="sonuc-i" style="background: purple; width:'.$sonuc13.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Game Of Thrones
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc14.'</span>
                                                    <div class="sonuc-i" style="background: orange; width:'.$sonuc14.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Breaking Bad
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc15.'</span>
                                                    <div class="sonuc-i" style="background: blue; width:'.$sonuc15.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Black Mirror
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc16.'</span>
                                                    <div class="sonuc-i" style="background: green; width:'.$sonuc16.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                            </ul>
                    </div>
                    <br>
                    <div>
                        <h1>En Sevdiğiniz Film</h1>
                        <form action="index.php" method="POST"> 
                            <ul style="list-style:none;line-height: 25px;">
                                <li>
                                    <input type="radio" name="anket2" value="1">Titanik
                                </li>
                                <li>
                                    <input type="radio" name="anket2" value="2">Transformers
                                </li>
                                <li>
                                    <input type="radio" name="anket2" value="3">Avengers
                                </li>
                                <li>
                                    <input type="radio" name="anket2" value="4">Iron Man
                                </li>
                                <li>
                                    <input type="radio" name="anket2" value="5">Thor
                                </li>
                                <li>
                                    <input type="radio" name="anket2" value="6">Prestige
                                </li>
                            </ul>
                            <span class="zorunlu" style="display:'.$anketspan21.'">Daha önce oylama yapmışsınız.</span>
                            <span class="zorunlu" style="display:'.$anketspan22.'">Lütfen giriş yapınız.</span>
                            <span class="zorunlu" style="display:'.$anketbos2.'">Boş oy gönderemezsiniz</span>
                            <input type="submit" name="anket2g" style="display:'.$anketbut2.'" value="Gönder">
                        </form>
                    </div>
                    <br>

                    <div>
                        <h1>SONUÇLAR</h1>
                            <ul style="list-style:none;">
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Titanik
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc21.'</span>
                                                    <div class="sonuc-i" style="background: gray; width:'.$sonuc21.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Transformers
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc22.'</span>
                                                    <div class="sonuc-i" style="background: red; width:'.$sonuc22.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Avengers
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc23.'</span>
                                                    <div class="sonuc-i" style="background: purple; width:'.$sonuc23.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Iron Man
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc24.'</span>
                                                    <div class="sonuc-i" style="background: orange; width:'.$sonuc24.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Thor
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc25.'</span>
                                                    <div class="sonuc-i" style="background: blue; width:'.$sonuc25.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                                <li>
                                    <table align="center">
                                        <tr>
                                            <td style="width: 150px;">
                                                    Prestige
                                            </td>
                                            <td style="padding-top: 2px;">
                                                <div class="sonuc-d">
                                                <span style="float: right; font-size: 10px; padding-right: 2px">%'.$sonuc26.'</span>
                                                    <div class="sonuc-i" style="background: green; width:'.$sonuc26.'%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                     
                                </li>
                            </ul>
                    </div>
                    <br>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="pencere gorunurluk" style="'.$gorunurluk.'">
        <div class="cont">
            <div class="pencere-ort">
                <div style="padding: 0 20px;">
                    <a class="pencere-kapa" href="index.php"></a>
                    <form method="post" action="index.php?main=giris" class="login">
                        <div style="text-align: center;">
                        <img src="image/planetdplogoblack.svg" style="width:170px;height: auto;">                      
                        </div>
                        <div style="padding: 0 40px;margin: 0 auto;">
                            <span style="display: '.$displaygecersiz.';"><p class="zorunlu">Geçersiz kullanıcı adı veya şifre</p></span>
                            <input type="text" name="gadi" placeholder="Email / Kullanıcı Adı" class="login-input">
                            <span style="display: '.$displayg.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                            <input type="password" name="pass" placeholder="Şifre" class="login-input">
                            <span style="display: '.$displayp.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                            <input type="checkbox" name="hatirla" value="1" style="float: left">
                            <label class="login-bh">Beni hatırla</label>
                        </div>    
                        <div style="text-align: center;">
                            <button type="submit" name="giris" class="pencere-button">GİRİŞ</button>
                        </div>                         
                    </form> 
                    <script>
                        function pencere(i)
                        {
                            var k = document.getElementsByClassName("gorunurluk");
                            if(i == 1)
                            {
                                k[0].style.opacity = "1";
                                k[0].style.visibility = "visible";
                                k[0].style.transition = "opacity .5s";
                            }
                            if(i == 0)
                            {
                                k[0].style.opacity = "0";
                                k[0].style.visibility = "hidden";
                                k[0].style.transition = "opacity .5s , visibility 0s .5s";
                            }
                        }
                    </script>
                </div>
            </div>                                 
        </div>
    </div>
    <div class="clear"></div>
    <footer class="footer">
        <div class="cont" style="width:1165px;">
            <div class="footer-up">
                <div style="float: left;">
                    <h5 style="padding-bottom:10px;color:orangered;font-weight: 700;">ALTYAZI</h5>
                    <ul>
                        <li>Son Yüklenenler</li>
                        <li>En Çok İndirilenler</li>
                        <li>Film Altyazıları</li>
                        <li>Dizi Altyazıları</li>
                        <li>Anime Altyazıları</li>
                    </ul>
                </div>
                <div style="float: left;margin-left:50px;">
                    <h5 style="padding-bottom:10px;color:orangered;font-weight: 700;">SİNEMA</h5>
                    <ul>
                        <li>Vizyonda Ne Var?</li>
                        <li>Yakında Vizyonda</li>
                        <li>Sinema Haberleri</li>
                        <li>Dizi Haberleri</li>
                        <li>Anime Haberleri</li>
                    </ul>
                </div>
                <div style="float: left;margin-left:120px;">
                    <h5 style="padding-bottom:10px;color:orangered;font-weight: 700;">İLETİŞİM</h5>
                    <ul>
                        <li>İletişim Bilgileri</li>
                        <li>Hakkımızda</li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="footer-bot">
                <img src="image/planetdplogo3.svg" style="width: 150px;float:left;">
                <span>2017 © Copyright - All Rights Reserved | <a href="#">Planet DP</a></span>
                <div class="clear"></div>
            </div>
        </div>
    </footer>
</body>
</html>';
?>