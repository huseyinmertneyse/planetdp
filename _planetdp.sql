-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 May 2019, 08:57:18
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `planetdp`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket`
--

CREATE TABLE `anket` (
  `soru` varchar(255) NOT NULL,
  `cevap1` varchar(255) NOT NULL,
  `cevap2` varchar(255) NOT NULL,
  `cevap3` varchar(255) NOT NULL,
  `cevap4` varchar(255) NOT NULL,
  `cevap5` varchar(255) NOT NULL,
  `cevap6` varchar(255) NOT NULL,
  `deger1` int(11) NOT NULL,
  `deger2` int(11) NOT NULL,
  `deger3` int(11) NOT NULL,
  `deger4` int(11) NOT NULL,
  `deger5` int(11) NOT NULL,
  `deger6` int(11) NOT NULL,
  `toplam` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `anket`
--

INSERT INTO `anket` (`soru`, `cevap1`, `cevap2`, `cevap3`, `cevap4`, `cevap5`, `cevap6`, `deger1`, `deger2`, `deger3`, `deger4`, `deger5`, `deger6`, `toplam`) VALUES
('En Sevdiğiniz Dizi', 'Prison Break', 'The Walking Dead', 'Peaky Blinders', 'Game Of Thrones', 'Breaking Bad', 'Black Mirror', 2, 1, 1, 2, 1, 1, 8),
('En Sevdiğiniz Film', 'Titanik', 'Transformers', 'Avengers', 'Iron Man', 'Thor', 'Prestige', 1, 2, 1, 2, 1, 1, 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begenenler`
--

CREATE TABLE `begenenler` (
  `id` int(11) NOT NULL,
  `yorumid` int(11) NOT NULL,
  `kadi` varchar(255) NOT NULL,
  `kontrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `begenenler`
--

INSERT INTO `begenenler` (`id`, `yorumid`, `kadi`, `kontrol`) VALUES
(1, 4, 'omer', 1),
(2, 3, 'omer', 0),
(3, 2, 'omer', 1),
(4, 1, 'omer', 1),
(5, 4, 'aaa', 1),
(6, 4, 'hmn', -1),
(7, 4, 'hm', -1),
(8, 6, 'hmn', 1),
(9, 5, 'hmn', -1),
(10, 7, 'deneme', 1),
(11, 4, 'deneme', 1),
(12, 7, 'aaa', 1),
(13, 10, 'hmn', 0),
(14, 8, 'hmn', 1),
(15, 2, 'hmn', 1),
(16, 7, 'hmn', 1),
(17, 3, 'hmn', 1),
(18, 7, 'hm', 1),
(19, 3, 'aaa', 1),
(20, 11, 'aaa', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filmler`
--

CREATE TABLE `filmler` (
  `id` int(11) NOT NULL,
  `filmadi` varchar(255) NOT NULL,
  `isim` varchar(255) NOT NULL,
  `filmturu` varchar(255) NOT NULL,
  `filmresmi` varchar(255) NOT NULL,
  `dosya` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `filmler`
--

INSERT INTO `filmler` (`id`, `filmadi`, `isim`, `filmturu`, `filmresmi`, `dosya`) VALUES
(1, 'Cobra Kai (2018)', 'cobrakai', 'film', 'image/cobra.jpg', 'film/cobra.php'),
(2, 'Attack on Titan (2013)', 'attackontitan', 'anime', 'image/attack.jpg', 'film/attackontitan.php'),
(3, 'iZombie (2015)', 'izombie', 'dizi', 'image/izombie.jpg', 'film/izombie.php'),
(4, 'Simmba (2018)', 'simba', 'film', 'image/simba.jpg', 'film/simba.php'),
(5, 'Himatsuri (1985)', 'himatsuri', 'film', 'image/himatsuri.jpg', 'film/himatsuri.php'),
(6, 'Game Of Thrones (2011)', 'gameofthrones', 'dizi', 'image/gameofthrones.jpg', 'film/gameofthrones.php'),
(7, 'Peaky Blinders (2013)', 'peakyblinders', 'dizi', 'image/peakyblinders.jpg', 'film/peakyblinders.php'),
(8, 'Hakumei to Mikochi (2018)', 'hakumeitomikochi', 'anime', 'image/hakumeitomikochi.jpg', 'film/hakumeitomikochi.php'),
(9, 'Dororo (2019)', 'dororo', 'anime', 'image/dororo.jpg', 'film/dororo.php'),
(10, 'Gosick (2011)', 'gosick', 'anime', 'image/gosick.jpg', 'film/gosick.php'),
(11, 'Narcos (2015)', 'narcos', 'dizi', 'image/narcos.jpg', 'film/narcos.php'),
(12, 'The Kid Who Would Be King (2019)', 'thekidwhowouldbeking', 'film', 'image/thekidwhowouldbeking.jpg', 'film/thekidwhowouldbeking.php'),
(14, 'Spring Must Be Coming (2019)', 'springmustbecoming', 'drama', 'image/springmustbecoming.jpg', 'film/springmustbecoming.php'),
(15, 'Big Issue (2019)', 'bigissue', 'drama', 'image/bigissue.jpg', 'film/bigissue.php'),
(16, 'Item (2019)', 'item', 'drama', 'image/item.jpg', 'film/item.php');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oyatanlar`
--

CREATE TABLE `oyatanlar` (
  `id` int(11) NOT NULL,
  `kadi` varchar(255) NOT NULL,
  `soru` varchar(255) NOT NULL,
  `oy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `oyatanlar`
--

INSERT INTO `oyatanlar` (`id`, `kadi`, `soru`, `oy`) VALUES
(1, 'hmn', 'En Sevdiğiniz Dizi', 'Prison Break'),
(2, 'hmn', 'En Sevdiğiniz Film', 'Iron Man'),
(3, 'deneme', 'En Sevdiğiniz Dizi', 'Game of Thrones'),
(4, 'deneme', 'En Sevdiğiniz Film', 'Transformers');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kadi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `kadi`, `email`, `pass`) VALUES
(1, 'hmn', 'hmn@hmn.com', '12345'),
(2, 'hm', 'hm@hm.com', '12345'),
(3, 'huseyin', 'huseyin@msn.com', '1234'),
(4, 'asda', 'asda@asd.com', '123'),
(5, 'asdas', 'asdas@asd.com', '123'),
(6, 'abc', 'abc@abc.com', '123456'),
(7, 'aaa', 'aaa@aaa.com', 'aaa'),
(8, 'omer', 'omer@gm.com', '12345'),
(9, 'mirket', 'mirket@gmail.com', 'mirket60'),
(10, 'pilavyer21', 'pilavyer21@gmail.com', '12345'),
(11, 'deneme', 'deneme@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumayorum`
--

CREATE TABLE `yorumayorum` (
  `id` int(11) NOT NULL,
  `yorumid` int(11) NOT NULL,
  `kadi` varchar(255) NOT NULL,
  `yorum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorumayorum`
--

INSERT INTO `yorumayorum` (`id`, `yorumid`, `kadi`, `yorum`) VALUES
(1, 7, 'hmn', 'deneme'),
(2, 2, 'hmn', 'testt'),
(3, 3, 'hmn', 'tesst'),
(4, 7, 'hmn', 'testet'),
(5, 6, 'hmn', 'adadsasda'),
(6, 10, 'hmn', 'yorum deneme'),
(7, 7, 'hmn', 'denenme'),
(8, 7, 'hmn', 'deneme4'),
(9, 3, 'hmn', 'teeeest'),
(10, 4, 'aaa', 'denenenen'),
(11, 1, 'aaa', 'yorum deneme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `filmadi` varchar(255) NOT NULL,
  `kadi` varchar(255) NOT NULL,
  `yorum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `filmadi`, `kadi`, `yorum`) VALUES
(1, 'Cobra Kai (2018)', 'hmn', 'Kaydet'),
(2, 'Cobra Kai (2018)', 'hmn', 'yorum'),
(3, 'Cobra Kai (2018)', 'hmn', 'ömer'),
(4, 'Cobra Kai (2018)', 'omer', 'dasdasda'),
(5, 'iZombie (2015)', 'hmn', 'asdasda'),
(6, 'iZombie (2015)', 'hmn', 'test'),
(7, 'Cobra Kai (2018)', 'deneme', 'test11'),
(8, 'Item (2019)', 'aaa', 'test1'),
(9, 'Big Issue (2019)', 'hmn', 'testt'),
(10, 'Dororo (2019)', 'hmn', 'deneme anime'),
(11, 'Cobra Kai (2018)', 'aaa', 'yorumsuz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum_begenenler`
--

CREATE TABLE `yorum_begenenler` (
  `id` int(11) NOT NULL,
  `yorumid` int(11) NOT NULL,
  `kadi` varchar(255) NOT NULL,
  `kontrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorum_begenenler`
--

INSERT INTO `yorum_begenenler` (`id`, `yorumid`, `kadi`, `kontrol`) VALUES
(1, 8, 'hmn', 1),
(2, 8, 'aaa', 1),
(3, 8, 'omer', 1),
(4, 8, 'hm', 1),
(5, 10, 'aaa', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anket`
--
ALTER TABLE `anket`
  ADD PRIMARY KEY (`soru`);

--
-- Tablo için indeksler `begenenler`
--
ALTER TABLE `begenenler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `filmler`
--
ALTER TABLE `filmler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `oyatanlar`
--
ALTER TABLE `oyatanlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumayorum`
--
ALTER TABLE `yorumayorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorum_begenenler`
--
ALTER TABLE `yorum_begenenler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `begenenler`
--
ALTER TABLE `begenenler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `filmler`
--
ALTER TABLE `filmler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `oyatanlar`
--
ALTER TABLE `oyatanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `yorumayorum`
--
ALTER TABLE `yorumayorum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `yorum_begenenler`
--
ALTER TABLE `yorum_begenenler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
