<?php
if(isset($_GET))
{
    if(isset($_GET['name']))
    {
        $name = $_GET['name'];
        
        $baglan = mysqli_connect('localhost','root','','planetdp');
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }      
        mysqli_set_charset($baglan,'utf8'); 
        $bul = mysqli_query($baglan,"SELECT * FROM filmler where isim = '$name'");
        $say = mysqli_num_rows($bul);
        if($say > 0)
        {
            $satir = mysqli_fetch_array($bul);
        }
        if(file_exists($satir['dosya']))
        {
            header('Location:'.$satir['dosya'].'');
        }
        else
        {
            $createfile = fopen($satir['dosya'],'w');
            $sayfa = '
                
                
            <?php
            $displaybut = \'block\';
            $displaybar = \'none\';
            $displayg = \'none\';
            $displayp = \'none\';
            $displaygecersiz = \'none\';
            $kadi = \'\';
            $gorunurluk = \'\';
            $yorumdis = \'none\';
            $begeni_hata = \'none\';
            $yorumayorum_button = \'none\';
            $yorumayorum_kullanicisiz_button = \'block\';
            $begenenler_link = \'hidden\';
            $altyorum_begenenler_link = \'hidden\';
            $begenenlerdis = \'visible\';
            $altyorum_begenenlerdis = \'visible\';
            session_start();

            $baglan = mysqli_connect(\'localhost\',\'root\',\'\',\'planetdp\');
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }      
            mysqli_set_charset($baglan,\'utf8\'); 

            if(!isset($_SESSION[\'kadi\']) && isset($_COOKIE[\'cookie\']))
            {
                $veri = unserialize($_COOKIE[\'cookie\']);
                $gadi = $veri[\'kadi\'];
                $pass = $veri[\'pass\'];
                $bul = mysqli_query($baglan,"SELECT * FROM users where (kadi = \'$gadi\' OR email = \'$gadi\') AND pass = \'$pass\'");
                $say = mysqli_num_rows($bul);
                if($say > 0)
                {
                    $satir = mysqli_fetch_array($bul);
                    $_SESSION[\'kadi\'] = $satir[\'kadi\']; 
                    header(\'Location:../'.$satir['dosya'].'\');
                }
                header(\'Location:../'.$satir['dosya'].'\');
            }

            if(isset($_SESSION[\'kadi\']))
            {
                $yorumdis = \'block\';
                $yorumayorum_button = \'block\';
                $displaybut = \'none\';
                $displaybar = \'block\';
                $kadi = $_SESSION[\'kadi\'];
                if(isset($_POST[\'textarea-button\']))
                {
                    $textarea = $_POST[\'textarea\'];
                    $kaydet = mysqli_query($baglan,"INSERT INTO yorumlar (filmadi,kadi,yorum) VALUES(\''.$satir['filmadi'].'\',\'$kadi\',\'$textarea\')");
                }
                if(isset($_POST[\'textarea-yorum-button\']))
                {
                    $textarea_yorum = $_POST[\'textarea-yorum\'];
                    if(isset($_GET[\'yorumid\']))
                    {
                        $yyorumid = $_GET[\'yorumid\'];
                        $kaydet = mysqli_query($baglan,"INSERT INTO yorumayorum (yorumid,kadi,yorum) VALUES(\'$yyorumid\',\'$kadi\',\'$textarea_yorum\')");
                    }
                    else
                    {
                        $satirr = $satir[\'dosya\'];
                        header(\'Location:$satirr\');
                    }
                }
            }
            else
            {  
                $displaybut = \'block\';
                $displaybar = \'none\'; 
            }
            if(isset($_GET[\'like\']))
            {
                if(isset($_SESSION[\'kadi\']))
                {
                    $like_durum = $_GET[\'like\'];
                    if($like_durum == \'like\')
                    {
                        if(isset($_GET[\'yorumid\']))
                        {
                            $yorum_id = $_GET[\'yorumid\'];
                            $bul = mysqli_query($baglan,"SELECT * FROM begenenler where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                            $say = mysqli_num_rows($bul);
                            if($say > 0)
                            {
                                $satir = mysqli_fetch_array($bul);
                                if($satir[\'kontrol\'] == 0)
                                {
                                    mysqli_query($baglan,"UPDATE begenenler SET kontrol = 1 where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                                }
                                else if($satir[\'kontrol\'] == -1)
                                {
                                    mysqli_query($baglan,"UPDATE begenenler SET kontrol = 1 where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                                }
                                else
                                {
                                    mysqli_query($baglan,"UPDATE begenenler SET kontrol = 0 where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                                }
                            }
                            else
                            {
                                mysqli_query($baglan,"INSERT INTO begenenler (yorumid,kadi,kontrol) VALUES (\'$yorum_id\',\'$kadi\',1)");
                            }
                        }                            
                    }
                    if($like_durum == \'dislike\')
                    {
                        if(isset($_GET[\'yorumid\']))
                        {
                            $yorum_id = $_GET[\'yorumid\'];
                            $bul = mysqli_query($baglan,"SELECT * FROM begenenler where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                            $say = mysqli_num_rows($bul);
                            if($say > 0)
                            {
                                $satir = mysqli_fetch_array($bul);
                                if($satir[\'kontrol\'] == 0)
                                {
                                    mysqli_query($baglan,"UPDATE begenenler SET kontrol = -1 where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                                }
                                else if($satir[\'kontrol\'] == 1)
                                {
                                    mysqli_query($baglan,"UPDATE begenenler SET kontrol = -1 where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                                }
                                else
                                {
                                    mysqli_query($baglan,"UPDATE begenenler SET kontrol = 0 where kadi = \'$kadi\' AND yorumid = \'$yorum_id\'");
                                }
                            }
                            else
                            {
                                mysqli_query($baglan,"INSERT INTO begenenler (yorumid,kadi,kontrol) VALUES (\'$yorum_id\',\'$kadi\',-1)");
                            }
                        }
                    }
                }
                else
                {
                    $begeni_hata = \'block\';
                }
            }
            
            if(isset($_GET[\'altyorumlike\']))
            {
                if(isset($_SESSION[\'kadi\']))
                {
                    $altyorum_like_durum = $_GET[\'altyorumlike\'];
                    if($altyorum_like_durum == \'like\')
                    {
                        if(isset($_GET[\'altyorumid\']))
                        {
                            $altyorum_id = $_GET[\'altyorumid\'];
                            $bul = mysqli_query($baglan,"SELECT * FROM yorum_begenenler where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                            $say = mysqli_num_rows($bul);
                            if($say > 0)
                            {
                                $satir = mysqli_fetch_array($bul);
                                if($satir[\'kontrol\'] == 0)
                                {
                                    mysqli_query($baglan,"UPDATE yorum_begenenler SET kontrol = 1 where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                                }
                                else if($satir[\'kontrol\'] == -1)
                                {
                                    mysqli_query($baglan,"UPDATE yorum_begenenler SET kontrol = 1 where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                                }
                                else
                                {
                                    mysqli_query($baglan,"UPDATE yorum_begenenler SET kontrol = 0 where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                                }
                            }
                            else
                            {
                                mysqli_query($baglan,"INSERT INTO yorum_begenenler (yorumid,kadi,kontrol) VALUES (\'$altyorum_id\',\'$kadi\',1)");
                            }
                        }                            
                    }
                    if($altyorum_like_durum == \'dislike\')
                    {
                        if(isset($_GET[\'altyorumid\']))
                        {
                            $altyorum_id = $_GET[\'altyorumid\'];
                            $bul = mysqli_query($baglan,"SELECT * FROM yorum_begenenler where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                            $say = mysqli_num_rows($bul);
                            if($say > 0)
                            {
                                $satir = mysqli_fetch_array($bul);
                                if($satir[\'kontrol\'] == 0)
                                {
                                    mysqli_query($baglan,"UPDATE yorum_begenenler SET kontrol = -1 where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                                }
                                else if($satir[\'kontrol\'] == 1)
                                {
                                    mysqli_query($baglan,"UPDATE yorum_begenenler SET kontrol = -1 where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                                }
                                else
                                {
                                    mysqli_query($baglan,"UPDATE yorum_begenenler SET kontrol = 0 where kadi = \'$kadi\' AND yorumid = \'$altyorum_id\'");
                                }
                            }
                            else
                            {
                                mysqli_query($baglan,"INSERT INTO yorum_begenenler (yorumid,kadi,kontrol) VALUES (\'$altyorum_id\',\'$kadi\',-1)");
                            }
                        }
                    }
                }
                else
                {
                    $begeni_hata = \'block\';
                }
            }

            echo \'
            <!DOCTYPE html>
            <html lang="tr-TR">

            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" type="text/css" href="../planetdp.css">
            </head>

            <body>

                <header>
                    <div class="head-up">
                        <div class="cont">
                            <form action="../arama.php" method = "GET">
                                <div style="position: relative; width: 1110px;">
                                    <input type="text" name="arama" style="font-size: 13px;" class="search-bar" placeholder="Film / Dizi / Oyuncu [ad-soyad] / Yönetmen [ad-soyad] / IMDb No [ttxxxxxxx] giriniz">
                                </div>
                                <button type="submit" class="search-button">
                                    <img style="width: 30px; padding: 2px;" src="../image/search-solid.svg">
                                </button>
                                <div class="user-bar" style="display:\'.$displaybut.\';">
                                    <a type="button" class="user-button" onclick="pencere(1)">Giriş</a>
                                    <a> | </a>
                                    <a type="button" class="user-button" href="../kayit.php?durum=">Kayıt Ol</a>
                                </div>
                                <div class="user-bar-hesap" style="display:\'.$displaybar.\';">
                                    <div class="hesap">
                                        <span class="kullanici-adi" style="float:left;cursor:default;">\'.$kadi.\'</span>
                                        <a class="kullanici-adi" style="float:right;" href="../index.php?main=cikis">Çıkış</a>
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
                                        <a href="../index.php"><img src="../image/planetdplogo3.svg"></a>
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
                            <div style="height: 494px;width: 336px;float: left;">
                                
                                <img src="../'.$satir['filmresmi'].'" style="width:100%;height:100%;">
                            </div>
                            <div style="float: left;margin-left:50px;">
                                <a style="text-decoration: none;color:black;" href="../'.$satir['dosya'].'"><h1>'.$satir['filmadi'].'</h1></a>
                            </div>
                            <div class="clear"></div>   
                        </div>  
                    </div> 
                    <div style="margin-top:60px;">
                        <div class="cont" style="width:1165px;">
                            <div class="icerik">
                                <div style="float:left;margin-left:50px;">
                                    <h1>Altyazılar</h1>
                                </div>  
                                <div class="clear"></div>          
                            </div>  
                        </div> 
                    </div>
                    <div style="margin-top:60px;">
                            <div class="cont" style="width:1165px;">
                                <div class="icerik">
                                    <div style="float:left;margin-left:50px;">
                                        <h1>Yorumlar</h1>
                                    </div>  
                                    <div class="clear"></div>
                                    <div style="margin-top: 50px;display:\'.$yorumdis.\'">
                                        <form action="../'.$satir['dosya'].'" method="POST">
                                            <textarea name="textarea" style="width: 99%;height: 100px;resize: none;"></textarea>
                                            <input type="submit" name="textarea-button" value="Kaydet" class="textarea-button">
                                        </form>
                                    </div>
                                    <br>
                                    <div>
                                    <div style="float:left;"><span style="font-size:12px;color:red;display:\'.$begeni_hata.\'">Begeni yapmanız için giriş yapmanız gerekmektedir.</span></div>
                                    <br>
                                    <div class="clear"></div>\';
                                        

                                        $yorum = mysqli_query($baglan,"SELECT * FROM yorumlar where filmadi = \''.$satir['filmadi'].'\' ORDER BY id DESC");
                                        $yorum_control = mysqli_num_rows($yorum);
                                        if($yorum_control > 0)
                                        {
                                            while($veriler = mysqli_fetch_array($yorum))
                                            {   
                                                
                                                $kullanici = $veriler[\'kadi\'];
                                                $kullanici_yorum = $veriler[\'yorum\'];
                                                $yorumid = $veriler[\'id\'];
                                                $bul = mysqli_query($baglan,"SELECT * FROM begenenler where kontrol = 1 AND yorumid = \'$yorumid\'");
                                                $begeni_sayisi = mysqli_num_rows($bul);
                                                
                                                if($begeni_sayisi == 0)
                                                {
                                                    $begenenlerdis = \'hidden\';
                                                }
                                                else
                                                {   
                                                    $begenenlerdis = \'visible\';
                                                }

                                                $bul = mysqli_query($baglan,"SELECT * FROM begenenler where kontrol = -1 AND yorumid = \'$yorumid\'");
                                                $begenmeme_sayisi = mysqli_num_rows($bul);
                                                echo \'
                                                    <div class="avatar"></div>
                                                    <div class="yorum">
                                                        <span style="font-weight:700;">\'.$kullanici.\'</span>
                                                        <br>
                                                        <span style="font-size:14px;">\'.$kullanici_yorum.\'</span>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div style="float:left;margin-left:45px;">
                                                        <a href="../'.$satir['dosya'].'?like=like&yorumid=\'.$yorumid.\'"><img style="height:13px;width:13px;" src="../image/like-button.png"></a><span style="inline-block;margin:0 5px;">\'.$begeni_sayisi.\'</span>
                                                        <a href="../'.$satir['dosya'].'?like=dislike&yorumid=\'.$yorumid.\'"><img style="height:13px;width:13px;" src="../image/dislike-button.png"></a><span style="inline-block;margin:0 5px;">\'.$begenmeme_sayisi.\'</span>
                                                    </div>
                                                    <div>
                                                        <span style="font-size:13px;font-weight:700;visibility:\'.$begenenlerdis.\';">Beğenenler:</span>\';
                                                        $begenenler = mysqli_query($baglan,"SELECT * FROM begenenler where kontrol = \'1\' AND yorumid = \'$yorumid\' ORDER BY id DESC LIMIT 3");
                                                        $begenenler_control = mysqli_num_rows($yorum);
                                                        if($begenenler_control > 0)
                                                        {
                                                            while($begeniler = mysqli_fetch_array($begenenler))
                                                            {
                                                                $begenen_kullanici = $begeniler[\'kadi\'];
                                                                echo\'
                                                                    <span style="font-size:13px;">\'.$begenen_kullanici.\'</span>
                                                                \';
                                                            }
                                                        }
                                                        if($begeni_sayisi <= 3)
                                                        {
                                                            $begenenler_link = \'hidden\';
                                                        }
                                                        else
                                                        {
                                                            $begenenler_link = \'visible\';     
                                                        }
                                                        echo\'
                                                        <a href="../begeni.php?yorumid=\'.$yorumid.\'&filmadi='.$satir['filmadi'].'" style="visibility:\'.$begenenler_link.\'; text-decoration: none;font-size:15;font-weight:700;">...</a>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div style="display:none;" name="yorum\'.$yorumid.\'">\';
                                                    
                                                        $yoruma_yorum_atanlar = mysqli_query($baglan,"SELECT * FROM yorumayorum where yorumid = \'$yorumid\' ORDER BY id DESC");
                                                        $yoruma_yorum_atanlar_control = mysqli_num_rows($yoruma_yorum_atanlar);
                                                        if($yoruma_yorum_atanlar_control > 0)
                                                        {
                                                            while($yorumlar = mysqli_fetch_array($yoruma_yorum_atanlar))
                                                            {
                                                                $yoruma_yorum_yapan_kullanici = $yorumlar[\'kadi\'];
                                                                $yoruma_yorum = $yorumlar[\'yorum\'];
                                                                $altyorumid = $yorumlar[\'id\'];
                                                                $bul = mysqli_query($baglan,"SELECT * FROM yorum_begenenler where kontrol = 1 AND yorumid = \'$altyorumid\'");
                                                                $altyorum_begeni_sayisi = mysqli_num_rows($bul);
                                                                
                                                                if($altyorum_begeni_sayisi == 0)
                                                                {
                                                                    $altyorum_begenenlerdis = \'hidden\';
                                                                }
                                                                else
                                                                {
                                                                    $altyorum_begenenlerdis = \'visible\';
                                                                }

                                                                $bul = mysqli_query($baglan,"SELECT * FROM yorum_begenenler where kontrol = -1 AND yorumid = \'$altyorumid\'");
                                                                $altyorum_begenmeme_sayisi = mysqli_num_rows($bul);
                                                                echo\'
                                                                <div style="margin-left:45px;">
                                                                    <div class="avatar"></div>
                                                                    <div class="yorum">
                                                                        <span style="font-weight:700;">\'.$yoruma_yorum_yapan_kullanici.\'</span>
                                                                        <br>
                                                                        <span style="font-size:14px;">\'.$yoruma_yorum.\'</span>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <div style="float:left;margin-left:45px;">
                                                                        <a href="../'.$satir['dosya'].'?altyorumlike=like&altyorumid=\'.$altyorumid.\'"><img style="height:13px;width:13px;" src="../image/like-button.png"></a><span style="inline-block;margin:0 5px;">\'.$altyorum_begeni_sayisi.\'</span>
                                                                        <a href="../'.$satir['dosya'].'?altyorumlike=dislike&altyorumid=\'.$altyorumid.\'"><img style="height:13px;width:13px;" src="../image/dislike-button.png"></a><span style="inline-block;margin:0 5px;">\'.$altyorum_begenmeme_sayisi.\'</span>
                                                                    </div>
                                                                    <div>
                                                                        <span style="font-size:13px;font-weight:700;visibility:\'.$altyorum_begenenlerdis.\';">Beğenenler:</span>\';
                                                                        $altyorum_begenenler = mysqli_query($baglan,"SELECT * FROM yorum_begenenler where kontrol = \'1\' AND yorumid = \'$altyorumid\' ORDER BY id DESC LIMIT 3");
                                                                        $begenenler_control = mysqli_num_rows($yorum);
                                                                        if($begenenler_control > 0)
                                                                        {
                                                                            while($altyorum_begeniler = mysqli_fetch_array($altyorum_begenenler))
                                                                            {
                                                                                $altyorum_begenen_kullanici = $altyorum_begeniler[\'kadi\'];
                                                                                echo\'
                                                                                    <span style="font-size:13px;">\'.$altyorum_begenen_kullanici.\'</span>
                                                                                \';
                                                                            }
                                                                        }
                                                                        if($altyorum_begeni_sayisi <= 3)
                                                                        {
                                                                            $altyorum_begenenler_link = \'hidden\';
                                                                        }
                                                                        else
                                                                        {
                                                                            $altyorum_begenenler_link = \'visible\';     
                                                                        }
                                                                        echo\'
                                                                        <a href="../begeni.php?altyorumid=\'.$altyorumid.\'&filmadi='.$satir['filmadi'].'" style="visibility:\'.$altyorum_begenenler_link.\'; text-decoration: none;font-size:15;font-weight:700;">...</a>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                </div> 
                                                                \';
                                                            }
                                                        }

                                                        $altyorum_sayisi_bul = mysqli_query($baglan,"SELECT * FROM yorumayorum where yorumid = \'$yorumid\'");
                                                        $altyorum_sayisi = mysqli_num_rows($altyorum_sayisi_bul);
                                                        if($altyorum_sayisi == 0)
                                                        {
                                                            $altyorum_button = \'none\';
                                                        }
                                                        else
                                                        {
                                                            $altyorum_button = \'block\';
                                                        }
                                                    echo \'
                                                    </div>
                                                    <div style="float:left; margin-top:5px; display: none;margin-left:45px;" name="\'.$yorumid.\'">
                                                        <form action="../'.$satir['dosya'].'?yorumid=\'.$yorumid.\'" method="POST">
                                                            <textarea name="textarea-yorum" style="margin-right:10px;width: 300px;height: 50px;resize: none;"></textarea>
                                                            <input type="submit" name="textarea-yorum-button" value="Kaydet" class="textarea-button"> 
                                                        </form>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div style="float:left;margin-left:45px;">
                                                            
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div style="margin-left:45px;">
                                                        <div style="float:left;margin-right:5px;display:\'.$altyorum_button.\';">
                                                            <input id="yorum\'.$yorumid.\'" style="display:\'.$yorumayorum_kullanicisiz_button.\'" type="button" value="Alt Yorumlar(\'.$altyorum_sayisi.\')" onclick="yorumayorum_kullanicisiz(\'.$yorumid.\',0)" class="yorum-button">
                                                            <input style="display:none;"  type="button" name="yorum\'.$yorumid.\'" value="Yorumları Kapat" onclick="yorumayorum_kullanicisiz(\'.$yorumid.\',1)" class="yorum-button">
                                                        </div>
                                                        <div style="float:left;">
                                                            <input style="display:\'.$yorumayorum_button.\'" type="button" id="\'.$yorumid.\'" value="Yorum Yap" onclick="yorumayorum(\'.$yorumid.\',0)" class="yorum-button">
                                                            <input style="display:none;"  type="button" name="\'.$yorumid.\'" value="Yorum Yapı Kapat" onclick="yorumayorum(\'.$yorumid.\',1)" class="yorum-button">
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>    
                                                    <br>
                                                \';
                                            }
                                        }
                                        echo \'
                                    </div>        
                                </div>  
                            </div> 
                        </div>
                </div>
                
                <script>
                    function yorumayorum(i,j)
                    {
                        var k = document.getElementById(i);
                        var l = document.getElementsByName(i);                        
                        if(j == 0)
                        {
                            k.style.display = "none";
                            l[0].style.display = "block";
                            l[1].style.display = "block";
                        }
                        else if(j == 1)
                        {
                            k.style.display = "block";
                            l[0].style.display = "none";
                            l[1].style.display = "none";
                        }
                    }
                </script>
                <script>
                    function yorumayorum_kullanicisiz(i,j)
                    {
                        var k = document.getElementById("yorum"+i);
                        var l = document.getElementsByName("yorum"+i);                        
                        if(j == 0)
                        {
                            k.style.display = "none";
                            l[0].style.display = "block";
                            l[1].style.display = "block";
                        }
                        else if(j == 1)
                        {
                            k.style.display = "block";
                            l[0].style.display = "none";
                            l[1].style.display = "none";
                        }
                    }
                </script>

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
                            <img src="../image/planetdplogo3.svg" style="width: 150px;float:left;">
                            <span>2017 © Copyright - All Rights Reserved | <a href="#">Planet DP</a></span>
                            <div class="clear"></div>
                        </div>
                    </div>
                </footer>








                <div class="pencere gorunurluk" style="\'.$gorunurluk.\'">
                    <div class="cont">
                        <div class="pencere-ort">
                            <div style="padding: 0 20px;">
                                <a class="pencere-kapa" href="../'.$satir['dosya'].'"></a>
                                <form method="post" action="../index.php?main=giris" class="login">
                                    <div style="text-align: center;">
                                    <img src="../image/planetdplogoblack.svg" style="width:170px;height: auto;">                      
                                    </div>
                                    <div style="padding: 0 40px;margin: 0 auto;">
                                        <span style="display: \'.$displaygecersiz.\';"><p class="zorunlu">Geçersiz kullanıcı adı veya şifre</p></span>
                                        <input type="text" name="gadi" placeholder="Email / Kullanıcı Adı" class="login-input">
                                        <span style="display: \'.$displayg.\';"><p class="zorunlu">Bu alan zorunludur.</p></span>
                                        <input type="password" name="pass" placeholder="Şifre" class="login-input">
                                        <span style="display: \'.$displayp.\';"><p class="zorunlu">Bu alan zorunludur.</p></span>
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
            </body>
            </html>\';
            ?>
        
            
            ';
            fwrite($createfile,$sayfa);
            fclose($createfile);
            header('Location:'.$satir['dosya'].'');
        }
    }
}
?>