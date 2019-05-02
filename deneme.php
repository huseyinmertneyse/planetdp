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
            <script>
                function display(i)
                {
                    var sınıf = document.getElementsByClassName("js");
                    if(i == 0)
                    {
                        sınıf[0].style.display = "none";
                        sınıf[1].style.display = "block";
                    }
                    if(i == 1)
                    {
                        sınıf[1].style.display = "none";
                        sınıf[0].style.display = "block";
                    }
                }
            </script>
            <div class="js">
                <div style="padding: 15px;">
                    <br>
                    <h1 class="kaydol">Kaydolun</h1>
                    <p style="line-height: 20px;color: #8d9aa6;font-size: 16px;text-align: center;">Kayıtlı kullanıcı mısınız? 
                        <a onclick="display(0)" style="color: #3d6594;">Giriş Yap</a>
                    </p>
                </div>
                <div class="kayit-cerceve">
                    <form method="post" style="padding: 30px;">
                        <div style="padding: 15px 15px 0px 15px;">
                            <ul style="list-style: none;">
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label" for="">Kullanıcı Adı
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="text" name="kadi" value="" maxlength="15" class="input">
                                        <span data-role="validationCheck" style="display: none;"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                    </div>
                                </li>
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label" for="">E-Posta Adresi
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="email" name="email" value="" maxlength="15" class="input">
                                        <span data-role="validationCheck" style="display: none;"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                    </div>
                                </li>
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label" for="">Şifre
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="text" name="pass" value="" maxlength="15" class="input">
                                        <span data-role="validationCheck" style="display: none;"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                    </div>
                                </li>
                                <li style="margin-bottom: 15px;">
                                    <label class="kayit-label" for="">Şifre Tekrar
                                        <span class="gerekli"> Gerekli</span>
                                    </label>
                                    <div>
                                        <input type="text" name="pass1" value="" maxlength="15" class="input">
                                        <span data-role="validationCheck" style="display: none;"><p class="zorunlu">Bu alan zorunludur.</p></span>
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
            <div class="js" style="display:none;">
                    <div style="padding: 15px;">
                        <br>
                        <h1 class="kaydol">Giriş Yap</h1>
                        <p style="line-height: 20px;color: #8d9aa6;font-size: 16px;text-align: center;">Hesabınız yok mu?
                            <a onclick="display(1)" style="color: #3d6594;">Kayıt Olun</a>
                        </p>
                    </div>
                    <div class="kayit-cerceve">
                        <form method="post" style="padding: 30px;">
                            <div style="padding: 15px 15px 0px 15px;">
                                <ul style="list-style: none;">
                                    <li style="margin-bottom: 15px;">
                                        <label class="kayit-label" for="">Kullanıcı Adı veya E-Posta
                                            <span class="gerekli"> Gerekli</span>
                                        </label>
                                        <div>
                                            <input type="text" name="gadi" placeholder="Kullanıcı Adı veya E-Posta" maxlength="15" class="input">
                                            <span data-role="validationCheck" style="display: none;"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        </div>
                                    </li>
                                    <li style="margin-bottom: 15px;">
                                        <label class="kayit-label" for="">Şifre
                                            <span class="gerekli"> Gerekli</span>
                                        </label>
                                        <div>
                                            <input type="text" name="pass" placeholder="Şifre" maxlength="15" class="input">
                                            <span data-role="validationCheck" style="display: none;"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        </div>
                                    </li>
                                    <li>
                                        <span>
                                            <input type="checkbox" style="float: left;margin-top: 3px;width: 15px;height: 15px;" checked>
                                        </span>
                                        <div style="margin-left: 24px;">
                                                <label>Beni hatırla</label><br>
                                                <span style="font-size: 12px;color: #8d9aa6;margin-top: 3px;display: inline-block;">Paylaşımlı bilgisayarlarda önerilmez</span>

                                        </div>
                                    </li>
                                    <div class="button-div">
                                        <button class="button" type="submit" name="giris">Giriş Yap</button>
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
</html>
<?php
if(isset($_POST['kayit']))
{
    echo '<div>MERHABAAGDFGADFGADFGDAADFGDFGSFGDSGSDFGSDFSDF</div>';
}
?>
