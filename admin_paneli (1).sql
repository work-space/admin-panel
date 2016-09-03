-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 02 Eyl 2016, 16:23:46
-- Sunucu sürümü: 10.1.13-MariaDB
-- PHP Sürümü: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `admin_paneli`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basliklar`
--

CREATE TABLE `basliklar` (
  `id` int(11) NOT NULL,
  `link` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `label` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sira` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `basliklar`
--

INSERT INTO `basliklar` (`id`, `link`, `label`, `sira`) VALUES
(1, 'http://localhost/admin-panel/index.php', 'Ana Sayfa', 1),
(3, 'http://localhost/admin-panel/create.php', 'Slider FotoÄŸraf Ekleme', 3),
(7, 'bgr_settings.php', 'Arka Plan Rengi Ayarla', 4),
(15, 'urun_ekle.php', 'ÃœrÃ¼n Ekleme', 5),
(23, 'baslik_ekle.php', 'BaÅŸlÄ±k Ekle', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `header_color`
--

CREATE TABLE `header_color` (
  `id` int(11) NOT NULL,
  `background` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `label` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `list_back` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `hover` varchar(256) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `header_color`
--

INSERT INTO `header_color` (`id`, `background`, `label`, `list_back`, `hover`) VALUES
(1, '#2980b9', '#ecf0f1', '#2980b9', '#e67e22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `src` text COLLATE utf8_turkish_ci NOT NULL,
  `dsc` text COLLATE utf8_turkish_ci NOT NULL,
  `baslik` varchar(256) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `src`, `dsc`, `baslik`) VALUES
(20, 'img/resim930352244940.271819001472468275.jpg', 'Eyfel', 'Paris'),
(21, 'img/resim906535305770.458876001472468304.jpg', 'Nehir', 'Venedik'),
(22, 'img/resim78888062500.963455001472468319.jpg', 'DoÄŸal', 'DoÄŸra'),
(23, 'img/resim575766798650.794345001472468334.jpg', 'DoÄŸasal ', 'DoÄŸa 2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `etiket` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(256) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `etiket`, `aciklama`, `resim`) VALUES
(1, 'KÃ¼Ã§Ã¼k resim etiketi', '242x200 img dosyasÄ± iÃ§in alan link vs ling\r\n                      skgdlfgdflkghjdfyklhmÅŸdlkgmdmlghdlfkghmdfl\r\n                      sdoÅŸgÄ±dÅŸgkm sdklmgtdÄ±ÅŸomdfkgmsdfk sdfgÅŸdmlk\r\n                      sdf dgimsrg sdrpokrgsdi sdgommÃ¶ts dporgks', 'urun_resim/resim170528068780.582182001472628891.jpg'),
(2, 'KÃ¼Ã§Ã¼k resim etiketi', '242x200 img dosyasÄ± iÃ§in alan link vs ling\r\n                      skgdlfgdflkghjdfyklhmÅŸdlkgmdmlghdlfkghmdfl\r\n                      sdoÅŸgÄ±dÅŸgkm sdklmgtdÄ±ÅŸomdfkgmsdfk sdfgÅŸdmlk\r\n                      sdf dgimsrg sdrpokrgsdi sdgommÃ¶ts dporgks', 'urun_resim/resim160430195730.095079001472629074.jpg'),
(3, 'Etkiket Ekleme Yeri', 'AÃ§Ä±klama Yeri', 'urun_resim/resim107923426740.286022001472721639.jpg'),
(7, 'Yeni ÃœrÃ¼n Etiketi', 'Yeni ÃœrÃ¼n AÃ§Ä±klamasÄ±', 'urun_resim/resim407782576520.869921001472770142.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `basliklar`
--
ALTER TABLE `basliklar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `header_color`
--
ALTER TABLE `header_color`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `basliklar`
--
ALTER TABLE `basliklar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Tablo için AUTO_INCREMENT değeri `header_color`
--
ALTER TABLE `header_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
