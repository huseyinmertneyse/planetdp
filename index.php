<?php
$displaybut = 'block';
$displaybar = 'none';
$displayg = 'none';
$displayp = 'none';
$displaygecersiz = 'none';
$kadi = '';
$gorunurluk = '';
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
                <form>
                    <div style="position: relative; width: 1110px;">
                        <input type="text" style="font-size: 13px;" class="search-bar" placeholder="Film / Dizi / Oyuncu [ad-soyad] / Yönetmen [ad-soyad] / IMDb No [ttxxxxxxx] giriniz">
                    </div>
                    <button type="submit" class="search-button">
                        <img style="width: 30px; padding: 2px;" src="image/search-solid.svg">
                    </button>
                    <div class="user-bar" style="display:'.$displaybut.';">
                        <a type="button" class="user-button" onclick="pencere(1)">Giriş</a>
                        <a> | </a>
                        <a type="button" class="user-button" href="/planetdp/kayit.php?durum=">Kayıt Ol</a>
                    </div>
                    <div class="user-bar-hesap" style="display:'.$displaybar.';">
                        <div class="hesap">
                            <a class="kullanici-adi" href="index.php?main=cikis">'.$kadi.'</a>
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
                            <a><img src="image/planetdplogo3.svg"></a>
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
                <div class="sol">
                    <div class = "gecisli">
                        <script>
                            var i = 0;
                            var images = ["image/5cb4c1daa00b8.jpg","image/5cb8aa5ee9a97.jpg","image/5cbbad6ba37c6.jpg"]
                            var sure = 3000;
                            function slider()
                            {
                                document.slide.src = images[i];
                                if(i < images.length - 1)
                                {
                                    i++;
                                }
                                else
                                {
                                    i = 0;
                                }
                                setTimeout(slider,sure);
                            }
                            window.onload = slider;
                        </script>
                        <img name="slide" width="100%" height="360px">
                    </div>
                    <div class="film-list">
                        <div class="sag-menu">
                            <ul>
                                <li><a href="">HEPSİ</a></li>
                                <li><a href="">FİLM</a></li>
                                <li><a href="">DİZİ</a></li>
                                <li><a href="">ANİME</a></li>
                                <li><a href="">DRAMA</a></li>
                            </ul>
                        </div>
                        <div class="altyazi">
                            <ul>
                                <script>
                                    function tip(i)
                                    {
                                        if(i == 1)
                                        {
                                            document.getElementById(1).style.padding = "29px 18px 24px 18px";
                                            document.getElementById(1).style.fontWeight = "700";
                                            document.getElementById(1).style.background = "#f5f5f5";
                                            document.getElementById(2).style.padding = "29px 20px 24px 20px";
                                            document.getElementById(2).style.fontWeight = "400";
                                            document.getElementById(2).style.background = "#fafafa";
                                        }
                                        if(i == 2)
                                        {
                                            document.getElementById(2).style.padding = "29px 18px 24px 18px";
                                            document.getElementById(2).style.fontWeight = "700";
                                            document.getElementById(2).style.background = "#f5f5f5";
                                            document.getElementById(1).style.padding = "29px 20px 24px 20px";
                                            document.getElementById(1).style.fontWeight = "400";
                                            document.getElementById(1).style.background = "#fafafa";
                                        }
                                    }    
                                </script>
                                <li><a  id="1" onclick="tip(1)">YENİ TÜRKÇE ALTYAZILAR</a></li>
                                <li><a  id="2" onclick="tip(2)">YENİ İNGİLİZCE ALTYAZILAR</a></li>
                            </ul>
                        </div>  
                    </div>
                    <div>
                        
                    </div>
                </div>
                
                <div class="sag">
                    
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
    <footer class="footer">
        <div class="cont">

        </div>
    </footer>
</body>
</html>';
?>