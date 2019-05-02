<?php
$displayk = 'none';
$displaye = 'none';
$displayp = 'none';
$displayp1 = 'none';
$displayg = 'none';
$displaygp = 'none';
$displayhata = 'none';
$displaygecersiz = 'none';
$baglan = mysqli_connect('localhost','root','','planetdp');
if (mysqli_connect_errno())
{
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($baglan,'utf8');
session_start();

if(isset($_SESSION['kadi']) || isset($_COOKIE['cookie']))
{
    header('Location:index.php');
}
$displaygiris = 'none';
$displaykayit = 'block';
if(!isset($_GET))
{
    $displaygiris = 'none';
    $displaykayit = 'block';
}
else if(!isset($_GET['durum']))
{
    $displaygiris = 'none';
    $displaykayit = 'block';
}
else if($_GET['durum'] == 'kayit')
{
    $displaygiris = 'none';
    $displaykayit = 'block';
    if(isset($_POST['kayit']))
    {
        $kadi = $_POST['kadi'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass1 = $_POST['pass1'];
        if($_POST['kadi'] == '' || $_POST['email'] == '' || $_POST['pass'] == '' || $_POST['pass1'] == '')
        {
            if($kadi == '')
            {
                $displayk = 'block';
            }
            if($email == '')
            {
                $displaye = 'block';
            }
            if($pass == '')
            {
                $displayp = 'block';
            }
            if($pass1 == '')
            {
                $displayp1 = 'block';
            }
            if($pass != $pass1)
            {
                $displayhata = 'block';
            }
        }
        else
        {
            if($pass != $pass1)
            {
                $displayhata = 'block';
            }
            else
            {
                mysqli_query($baglan,"INSERT INTO users (kadi,email,pass) VALUES('$kadi','$email','$pass')");
                $_SESSION['kadi'] = $kadi;
                $_SESSION['oturum'] = true;
                header('Location:index.php');
            }
        }
    }
}
else if($_GET['durum'] == 'giris')
{
    $displaygiris = 'block';
    $displaykayit = 'none';
    if(isset($_POST['giris']))
    { 
        $gadi = $_POST['gadi'];
        $pass = $_POST['pass'];
        if($gadi == '' || $pass == '')
        {
            if($gadi == '')
            {
                $displayg = 'block';
            }
            if($pass == '')
            {
                $displaygp = 'block';
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
                header('Location:index.php');
            }
            else
            {
                $displaygecersiz = 'block';
            }
        }
    }
}

echo '
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="kayit.css">
</head>
<body>
    <div class="head">
        <header>
            <div class="cont">
                <a href="/planetdp/index.php">
                    <img src="image/planetdplogo3.svg" style="width: 230px; height: 85px;">
                </a>
            </div>
        </header>
        <div class="cont" style="margin-top: -40px;">
            <div style="padding-bottom: 10px;top: 0;margin-top: 4px;">
                <a href="/planetdp/index.php" style="padding: 0 0 12px 0;color: #fff;">Anasayfa</a>
            </div>

        </div>
    </div>
    <div class="clear"></div>
    <div class="cont">
        <div style="padding:15px">   
            <div style="display:'.$displaykayit.'">
                <div style="padding: 15px;">
                    <br>
                    <h1 class="kaydol">Kaydolun</h1>
                    <p style="line-height: 20px;color: #8d9aa6;font-size: 16px;text-align: center;">Kayıtlı kullanıcı mısınız? 
                        <a href="kayit.php?durum=giris" style="color: #3d6594;">Giriş Yap</a>
                    </p>
                </div>
                <div class="kayit-cerceve">
                    <form method="post" action="kayit.php?durum=kayit" style="padding: 30px;">
                        <div style="padding: 15px 15px 0px 15px;">
                            <ul style="list-style: none;">
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label"  >Kullanıcı Adı
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="text" name="kadi" value="" maxlength="15" class="input">
                                        <span style="display: '.$displayk.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                    </div>
                                </li>
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label"  >E-Posta Adresi
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="email" name="email" value="" maxlength="30" class="input">
                                        <span style="display: '.$displaye.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                    </div>
                                </li>
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label"  >Şifre
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="password" name="pass" value="" maxlength="15" class="input">
                                        <span style="display: '.$displayp.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        </div>
                                </li>
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label"  >Şifre Tekrar
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="password" name="pass1" value="" maxlength="15" class="input">
                                        <span style="display: '.$displayp1.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        <span style="display: '.$displayhata.';"><p class="zorunlu">Şifreleriniz eşleşmedi.</p></span>
                                    </div>
                                </li>
                                <div class="button-div">
                                    <button class="button" type="submit" name="kayit">Hesabımı Oluştur</button>
                                </div>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="hizli">
                    <div class="hizli-icerik">
                        <h2>Daha hızlı başlayın</h2>
                        <p style="color: #8d9aa6;line-height: 21px;font-size: 14px;">Bu sitelerden birinden bağlanın.</p>
                        <br>
                        <form action="">
                            <div style="text-align: center;padding: 7px;">
                                <button type="submit"class="hizli-button" style="background-color: #008b00;color: #fff;">Microsoft ile giriş yapın</button>
                            </div>
                            <div style="text-align: center;padding: 7px;">
                                <button type="submit"class="hizli-button" style="background-color: #3a579a;color: #fff;">Facebook ile giriş yapın</button>
                            </div>
                            <div style="text-align: center;padding: 7px;">
                                <button type="submit"class="hizli-button" style="background-color: #00abf0;color: #fff;">Twitter ile giriş yapın</button>
                            </div>
                            <div style="text-align: center;padding: 7px;">
                                <button type="submit"class="hizli-button" style="background-color: #4285F4;color: #fff;">Google ile giriş yapın</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div style="display:'.$displaygiris.'">
                    <div style="padding: 15px;">
                        <br>
                        <h1 class="kaydol">Giriş Yap</h1>
                        <p style="line-height: 20px;color: #8d9aa6;font-size: 16px;text-align: center;">Hesabınız yok mu?
                            <a href="kayit.php?durum=kayit" style="color: #3d6594;">Kayıt Olun</a>
                        </p>
                    </div>
                    <div class="kayit-cerceve">
                        <form method="post" action="kayit.php?durum=giris" style="padding: 30px;">
                            <div style="padding: 15px 15px 0px 15px;">
                                <ul style="list-style: none;">
                                    <li style="margin-bottom: 15px;">
                                        <span style="display: '.$displaygecersiz.';"><p class="zorunlu">Geçersiz kullanıcı adı veya şifre</p></span>
                                        <label class="kayit-label"  >Kullanıcı Adı veya E-Posta
                                            <span class="gerekli"> Gerekli</span>
                                        </label>
                                        <div>
                                            <input type="text" name="gadi" placeholder="Kullanıcı Adı veya E-Posta" maxlength="30" class="input">
                                            <span style="display: '.$displayg.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        </div>
                                    </li>
                                    <li style="margin-bottom: 15px;">
                                        <label class="kayit-label"  >Şifre
                                            <span class="gerekli"> Gerekli</span>
                                        </label>
                                        <div>
                                            <input type="password" name="pass" placeholder="Şifre" maxlength="15" class="input">
                                            <span style="display: '.$displaygp.';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        </div>
                                    </li>
                                    <li>
                                        <span>
                                            <input type="checkbox" name="hatirla" value="1" style="float: left;margin-top: 3px;width: 15px;height: 15px;">
                                        </span>
                                        <div style="margin-left: 24px;">
                                                <label>Beni hatırla</label><br>
                                                <span style="font-size: 12px;color: #8d9aa6;margin-top: 3px;display: inline-block;">Paylaşımlı bilgisayarlarda önerilmez</span>

                                        </div>
                                    </li>
                                    <div class="button-div">
                                        <button onclick="display(0)" class="button" type="submit" name="giris">Giriş Yap</button>
                                    </div>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="hizli">
                        <div class="hizli-icerik">
                            <h2>Daha hızlı başlayın</h2>
                            <p style="color: #8d9aa6;line-height: 21px;font-size: 14px;">Bu sitelerden birinden bağlanın.</p>
                            <br>
                            <form action="">
                                <div style="text-align: center;padding: 7px;">
                                    <button type="submit"class="hizli-button" style="background-color: #008b00;color: #fff;">Microsoft ile giriş yapın</button>
                                </div>
                                <div style="text-align: center;padding: 7px;">
                                    <button type="submit"class="hizli-button" style="background-color: #3a579a;color: #fff;">Facebook ile giriş yapın</button>
                                </div>
                                <div style="text-align: center;padding: 7px;">
                                    <button type="submit"class="hizli-button" style="background-color: #00abf0;color: #fff;">Twitter ile giriş yapın</button>
                                </div>
                                <div style="text-align: center;padding: 7px;">
                                    <button type="submit"class="hizli-button" style="background-color: #4285F4;color: #fff;">Google ile giriş yapın</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="clear"></div>
    </body>
    </html> ';
    

?>
