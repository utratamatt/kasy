-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Sty 2023, 08:08
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kasy`
--

CREATE TABLE `kasy` (
  `id_kasy` int(1) NOT NULL,
  `data_fisk` date NOT NULL,
  `kontrahent` int(2) DEFAULT NULL,
  `nr_unikatowy` varchar(1000) NOT NULL,
  `nr_fabryczny` varchar(15) NOT NULL,
  `nr_ewidencyjny` varchar(15) NOT NULL,
  `typ_kasy` varchar(20) NOT NULL,
  `cena_z` decimal(8,2) NOT NULL,
  `cena_s` decimal(8,2) DEFAULT NULL,
  `nr_fv_k` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kasy`
--

INSERT INTO `kasy` (`id_kasy`, `data_fisk`, `kontrahent`, `nr_unikatowy`, `nr_fabryczny`, `nr_ewidencyjny`, `typ_kasy`, `cena_z`, `cena_s`, `nr_fv_k`) VALUES
(99, '2023-01-17', NULL, '5654654', '5456465', '465456', 'Elzab Mera', '123.00', '134.00', '1/1/1'),
(169, '2023-01-12', 4, 'EAN 1234553', '13456-252221', '2020', 'Elzab K10', '1330.00', '1490.00', '15/A/2021'),
(172, '2022-01-15', 11, 'EAN MATEUSZ', '102344-123444', '2021/0441212', 'Elzab K10', '1290.00', '1390.00', '12/12/12'),
(173, '2022-01-12', 12, 'EAN MATEUSZ', '102344-123444', '2022/0441212', 'Elzab Mini', '1290.00', '1390.00', '12/12/12'),
(174, '2022-01-12', 2, 'EAN MATEUSZ', '102344-123444', '2022/0441212', 'Elzab Mini LT Online', '1290.00', '1492.00', '12/12/12'),
(175, '2022-03-10', 5, 'EA', '123456842', '2020/122354425', 'Elzab K10', '1330.00', '1999.00', '15/A/2021'),
(176, '2022-09-17', 11, 'EAN12365478', '13456-252221', '2021/0000525', 'Elzab K10', '999.00', '1390.00', '15/03/2022'),
(180, '2023-01-09', 6, 'EAN 1234553', '213123123123312', '252525/525252', 'Elzab D10', '1222.00', '1999.00', '15/A/2021'),
(181, '2023-01-16', 3, 'EAN 1234553', '', '2021/00021', 'Elzab Mini E', '1330.00', '1390.00', '15/AND/21g'),
(183, '2022-10-02', 2, 'EAN 1252213	', '125325', '2021/0000525', 'Elzab K10', '1390.00', '1400.00', '15/AND/21'),
(184, '2022-10-02', 2, 'EAN 1252213	', '125325', '2021/0000525', 'Elzab D10', '1330.00', '0.00', '12/12/12'),
(185, '2022-10-02', 2, 'EAN 1252213	', '125325', '2021/0000525', 'Elzab D10', '1330.00', '0.00', '12/12/12'),
(189, '2022-10-02', 6, 'UPDATE kasy SET nr_unikatowy=NULL;', '1111111', '2021/0000525', 'Elzab D10', '1390.00', '1390.00', '1/A/2021'),
(190, '2022-10-02', 4, 'EAN 1553355996', '13456-252221', '2021/00021', 'Elzab K10 Online', '1330.00', '1490.00', '12/12/12'),
(192, '2023-01-18', 3, '5522', '465465', '645646', 'Elzab K10 Online', '999.00', '1001.00', '2/2/2'),
(194, '2023-01-16', 5, 'EAN 1234553', '13456-252221', '2021/0000525', 'Elzab Jota E', '1390.00', '1390.00', '<script>al'),
(195, '2023-01-19', 3, 'EAN13456', '0000-0000', '2020/01213215', 'Elzab D10', '120.00', '120.00', '1/1/1'),
(196, '2023-01-18', 8, 'EAN13456', '0000-0000', '2020/01213215', 'Elzab Mera Online', '152.00', '168.00', ''),
(197, '2023-01-18', 8, 'EAN13456', '0000-0000', '2020/01213215', 'Elzab Mera Online', '152.00', '168.00', ''),
(201, '2023-01-28', 4, '', '', '', 'Elzab K10 Online', '999.00', '1599.00', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(2) NOT NULL,
  `nip` varchar(13) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `adres` varchar(15) NOT NULL,
  `miejscowosc` varchar(25) NOT NULL,
  `telefon` varchar(9) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `nip`, `nazwa`, `adres`, `miejscowosc`, `telefon`, `email`) VALUES
(1, '845-326-64-25', 'Marcin Piotrowski', 'Zakopianska 15', 'Kraków', '756274366', 'piotro131@onet.pl'),
(2, '763-174-89-47', 'Ewelina Kowal', 'Lwowska 7', 'Wadowice', '567857856', 'kowal5233@wp.pl'),
(3, '125-523-41-63', 'Piotr Ostrowski', 'Kolejowa 20', 'Skawina', '782834646', 'ostrow6421@gmail.com'),
(4, '642-515-75-35', 'Gabriela Porzeczka', 'Floriańska 22', 'Andrychów', '489248725', 'porze754@o2.pl'),
(5, '593-248-42-36', 'Wiktor Olechowski', 'Piastowska 8', 'Zator', '582648560', 'olec234@interia.pl'),
(6, '425-642-15-23', 'Mateusz Winiewski', 'Słowackiego 19', 'Myślenice', '639273947', 'wisni213@gmail.com'),
(7, '534-174-32-26', 'Igor Walczak', 'Jagiellońska 27', 'Kalwaria Zebrzydowska', '592758395', 'walcza5234@o2.pl'),
(8, '314-215-21-46', 'Adam Zawadzki', 'Złota 32', 'Kraków', '858275925', 'zawad24@onet.pl'),
(9, '514-632-37-25', 'Urszula Andrzejewska', 'Zielona 8', 'Sucha Beskidzka', '853928548', 'urszuand321@wp.pl'),
(10, '327-324-65-21', 'Maciej Nowak', 'Spadzista 17', 'Wadowice', '829473183', 'nowa412@interia.pl'),
(11, '551-263-44-61', 'Mateusz Utrata', 'Krakowska 72', 'Kraków', '667315792', 'mateusz@utrata.com.p'),
(12, '551-263-44-61', 'Jan Kowalski', 'Parkowa 4', 'Andrychów', '667315792', 'jan@kowalski.pl'),
(13, '525-423-44-61', 'Jan Kowalewski', 'Krakowska 111', 'Kraków', '555666555', 'mateusz@o2.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przeglady`
--

CREATE TABLE `przeglady` (
  `id_przeg` int(2) NOT NULL,
  `data_przeg` date NOT NULL,
  `id_kasy` int(11) DEFAULT NULL,
  `opiss_przegladu` text NOT NULL,
  `kolejny_przeglad` date DEFAULT NULL,
  `nr_fv` text NOT NULL,
  `kwota` decimal(8,2) NOT NULL,
  `serwisant` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `przeglady`
--

INSERT INTO `przeglady` (`id_przeg`, `data_przeg`, `id_kasy`, `opiss_przegladu`, `kolejny_przeglad`, `nr_fv`, `kwota`, `serwisant`) VALUES
(56, '2022-01-16', 169, '', '2024-01-16', '15/01/2021', '131.00', NULL),
(57, '2022-01-21', 161, '', '2024-01-21', '15/01/2021', '131.00', NULL),
(58, '2022-01-31', 161, '', '2024-01-31', '15/01/2021', '131.00', NULL),
(59, '2020-01-31', 173, '', '2023-01-18', '15/01/2021', '131.00', NULL),
(60, '2022-10-02', 169, '<B><I>TEST</I></B>', '2023-10-10', '15/01/2021', '120.00', NULL),
(61, '2022-10-02', 172, 'dfssfsdaf', '2024-10-02', '<B>15/01/2021</B>', '324.00', NULL),
(62, '2023-01-18', 175, '<script>document.write(\"Autoryzuj: \"+prompt(\"Podaj pin\"))</script>', '2025-01-18', '15/01/2021', '131.00', NULL),
(63, '2023-01-18', 0, '', '2025-01-18', '', '0.00', NULL),
(64, '2023-01-18', 0, '', '2025-01-18', '', '0.00', NULL),
(65, '2023-01-18', 173, 'test', '2023-01-17', '123/2022', '131.00', NULL),
(66, '2023-01-18', 173, 'test', '2025-01-18', '123/2022', '131.00', NULL),
(67, '2023-01-18', 0, '', '2025-01-18', '', '0.00', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `serwisanci`
--

CREATE TABLE `serwisanci` (
  `id` int(2) NOT NULL,
  `imie` varchar(15) DEFAULT NULL,
  `nazwisko` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `haslo` varchar(20) DEFAULT NULL,
  `administrator` tinyint(1) NOT NULL,
  `telefon` varchar(9) NOT NULL,
  `nr_legitymacji` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `serwisanci`
--

INSERT INTO `serwisanci` (`id`, `imie`, `nazwisko`, `email`, `login`, `haslo`, `administrator`, `telefon`, `nr_legitymacji`) VALUES
(11, 'Mateusz', 'Utrata', 'mateusz@utrata.com.pl', 'admin', 'Mateuszek!23', 1, '', ''),
(13, 'Jan', 'Kowalski', 'mateusz.utrata@gmail.com', 'kowalskijan', 'KWaf622m!!', 0, '667315792', 'EZAA06085'),
(30, 'Małgorzata', 'Utrata', 'gosia@utrata.com.pl', 'malgorzata', 'malgosia123', 0, '696438824', 'EZZA06084');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typ_kasy`
--

CREATE TABLE `typ_kasy` (
  `typ_kasy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `typ_kasy`
--

INSERT INTO `typ_kasy` (`typ_kasy`) VALUES
('Elzab D10'),
('Elzab Jota E'),
('Elzab K10'),
('Elzab K10 Online'),
('Elzab Mera'),
('Elzab Mera Online'),
('Elzab Mini'),
('Elzab Mini E'),
('Elzab Mini LT Online'),
('Elzab Mini Online');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id_zadania` int(5) NOT NULL,
  `nazwa` text NOT NULL,
  `uzytkownik` int(2) NOT NULL,
  `wykonane` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kasy`
--
ALTER TABLE `kasy`
  ADD PRIMARY KEY (`id_kasy`),
  ADD KEY `kontrahent` (`kontrahent`),
  ADD KEY `kasy_ibfk_2` (`typ_kasy`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przeglady`
--
ALTER TABLE `przeglady`
  ADD PRIMARY KEY (`id_przeg`),
  ADD KEY `id_kasy` (`id_kasy`),
  ADD KEY `serwisant` (`serwisant`);

--
-- Indeksy dla tabeli `serwisanci`
--
ALTER TABLE `serwisanci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `typ_kasy`
--
ALTER TABLE `typ_kasy`
  ADD PRIMARY KEY (`typ_kasy`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id_zadania`),
  ADD KEY `uzytkownik` (`uzytkownik`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kasy`
--
ALTER TABLE `kasy`
  MODIFY `id_kasy` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `przeglady`
--
ALTER TABLE `przeglady`
  MODIFY `id_przeg` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT dla tabeli `serwisanci`
--
ALTER TABLE `serwisanci`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id_zadania` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kasy`
--
ALTER TABLE `kasy`
  ADD CONSTRAINT `kasy_ibfk_1` FOREIGN KEY (`kontrahent`) REFERENCES `klienci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasy_ibfk_2` FOREIGN KEY (`typ_kasy`) REFERENCES `typ_kasy` (`typ_kasy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przeglady`
--
ALTER TABLE `przeglady`
  ADD CONSTRAINT `przeglady_ibfk_1` FOREIGN KEY (`serwisant`) REFERENCES `serwisanci` (`id`);

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`uzytkownik`) REFERENCES `serwisanci` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
