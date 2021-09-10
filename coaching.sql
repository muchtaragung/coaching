-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Sep 2021 pada 10.53
-- Versi server: 10.3.31-MariaDB-cll-lve
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `korpora2018_coachingapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `action_plan`
--

CREATE TABLE `action_plan` (
  `id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` enum('berhasil','tidak berhasil','butuh waktu lama') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goals_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'adminIT', '$2y$10$9r9gQ7pJ46NaVuuZYH/c8eoQ1Qdb.bLB5O8Qk7tuTyJxqaVjTNQbe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coach`
--

CREATE TABLE `coach` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `coach`
--

INSERT INTO `coach` (`id`, `name`, `email`, `password`) VALUES
(1, 'Vonny Ramali', 'ramalivonny@gmail.com', '$2y$10$PUNWlltZBFcqux41dGrQqOYZQujGNnP7vqcSmUnRe/y4kd9lpyfZC'),
(2, 'Adiwinata Liem', 'adiwinata.liem@gmail.com', '$2y$10$vVW0q5lAs8TCAJBn/GZieOBDUus1roPRJzEF27.PFDewIonce2DQW'),
(3, 'PHILIPUS INDRA TJAHJANA', 'tjahjana2012@gmail.com', '$2y$10$qTX1P0n0soBZkb9pOvHcDePhrNscJWE8AkC956d3SkJkonYPTQo0m'),
(4, 'SALIM SUTIONO', 'Salim.sutiono@gmail.com', '$2y$10$SgC65z11XWb4HkmO2gHM8ugow0PIEiKbWtYSdKzeflLbofZISvaZi'),
(5, 'ADITHIA AMIDJAYA', 'amidjaya73@gmail.com', '$2y$10$WUae0TfmDHHq6fPLQKxJUu3qDbHRrQPktECYn8FivUNP6pgkQ/8Gu'),
(6, 'RAHMADSYAH', 'rahmadnlp@gmail.com', '$2y$10$Wqh3d0XlamIzHki0aMTCn.j9scSRSOoyut/RgdcZ.zf5gj..APy16'),
(7, 'SUSANA DEWI', 'susana_m30@yahoo.com', '$2y$10$Z.5DF7.yvI8i8VcvgQoaruiGMgkXHByFhqxlXrNTtY4GyMuUyxmSi'),
(8, 'VERLY NURSANTO', 'verlyquick@gmail.com', '$2y$10$yK3M/5rX3fae7WMXZ1LsS.Mqrczui9/x/f0BBvynHwFNcBBLsSBxe'),
(9, 'IKA PARAMITA', 'Ika.brisha@gmail.com', '$2y$10$t4VLXsvWJehZ.j.qLdkDGOpb3pcVqX25UkadG2.cIGwfBKlsjEvmi'),
(10, 'Handoko', 'handokowarriors@gmail.com', '$2y$10$qbeJIgslhd0OXz/lvB7S9uhRcHMXV4Z5TVpO2IqvUVt9AItTeICGa'),
(11, 'Avner', 'avner_id@yahoo.com', '$2y$10$quLCfrZI1UPZsrrsi8ajPe0Ao5UsNyJfiURaRsGcb5rgMZZj/BY/C'),
(12, 'Andre Wijaya', 'interisti89@gmail.com', '$2y$10$t46LJQ9.5.dd/jzHwfYCqeGs1WJ9iVgBQmcq76iNW9KOu20tc6fZC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coachee`
--

CREATE TABLE `coachee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach_id` int(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `coachee`
--

INSERT INTO `coachee` (`id`, `name`, `email`, `password`, `coach_id`, `company_id`, `status`) VALUES
(20, 'Fikri Arif', 'FIKRI.ARIF@TRAKINDO.CO.ID', '$2y$10$N/6S4aXgg3GBaF0CC67mNuvibvhRUG87b4yAhs8H8gNHU9ejSmN7m', 11, 1, 0),
(21, 'A.Akram Ali', 'AKRAM.ALI@TRAKINDO.CO.ID', '$2y$10$B1KzTubBN2qeiJXOQ2YafetCIaH4HqfkEMQiFmLFHV0tOPLrUETcS', 11, 1, 0),
(22, 'I Putu Maygrey Havero Subagia', 'I.SUBAGIA@TRAKINDO.CO.ID', '$2y$10$JuY6qZMbAL1WdzWqIWAgL.mF257Iud410ZAZ27XDkIDA4Cnm7by3C', 11, 1, 0),
(23, 'Wahyudianto Siswo Pranoto', 'WAHYUDIANTO.PRANOTO@TRAKINDO.CO.ID', '$2y$10$phnKBqJRxly9muuGMjHs2uPukIhitkRduAgPIUguTAQ1o0iB9xbkG', 11, 1, 0),
(24, 'Randika', 'RANDIKA@TRAKINDO.CO.ID', '$2y$10$E0zMx/ubHGqt4tBeLACyvuaP.DKLU9CmIYmPCgavdrDEYdFVW/40S', 11, 1, 0),
(25, 'Pujiono', 'PUJIONO@TRAKINDO.CO.ID', '$2y$10$lpZ52LbRj63N8O4XVljxP.ulilum/LfcveeSjPSbJF/AXfLhrdo7C', 11, 1, 0),
(26, 'Erizon', 'ERIZON@TRAKINDO.CO.ID', '$2y$10$8TuzIwCaSRgEBaUufvB/zOAZfZ9MD.CWXm23ddPG9FFClCO59ic1q', 11, 1, 0),
(27, 'I Gede Suparcana', 'ISUPARCA@TRAKINDO.CO.ID', '$2y$10$gjUMgkJpzZuQKF4lSoj9NOgf1rEzT1NoTc43l2WoKaVtQbzuqDciS', 11, 1, 0),
(28, 'Muhammad Isra', 'MUHAMMAD.ISRA@TRAKINDO.CO.ID', '$2y$10$okqdHFDSXMBvllKWau7nj.aos7MmBPoXhChJTutaLlrBOe/Mtf/RO', 11, 1, 0),
(29, 'Eko Ainal Firdaus', 'EKO.A.FIRDAUS@TRAKINDO.CO.ID', '$2y$10$6HwQDeRvZLkS2adN8x5h2eCPvM8qnldJ2irj3tqAFaVHnf1gjYEgC', 11, 1, 0),
(30, 'Riski Ariyandi', 'RISKI.ARIYANDI@TRAKINDO.CO.ID', '$2y$10$FvV29T4bDE0IOlRVBD/0UO7X6z4cNDWHok64ClXbFDyW9FBqPU5cO', 11, 1, 0),
(31, 'Andy Kastryanto', 'ANDY.KASTRYANTO@TRAKINDO.CO.ID', '$2y$10$qKcsAT8mhAfj8lN//lfrLO6XxiqY6.OyvrJHFnU8311Nft0/Dc/uq', 11, 1, 0),
(32, 'Andyka Candra Claudfi', 'ANDYKA.C.CLAUDFI@TRAKINDO.CO.ID', '$2y$10$T0XbULZaTcqMzcI8YIikhelcTyH.n6MTWgUWKQwwoLXmGgdds9VMC', 11, 1, 0),
(33, 'Agung Avianto', 'AGUNG.AVIANTO@TRAKINDO.CO.ID', '$2y$10$KqDE2Bn0o4fc6avlAlUc1uEH8tHCmx9hs9OUcSXYj9YvIO/aozSwu', 11, 1, 0),
(34, 'Rizky Adrian', 'RIZKY.ADRIAN@TRAKINDO.CO.ID', '$2y$10$YX3KGIzEWNLiuJK9SeHJj.XyWp5oef6k1ZBk7FwX/Q9AoiM3H5uwS', 4, 1, 0),
(35, 'Thomi Indaryanto', 'THOMI.INDARYANTO@TRAKINDO.CO.ID', '$2y$10$D3cnU9.ohEP6p2ppV41OgOK9GKL/ditFXFoO1c3Z6Ai9nwIywjrBy', 4, 1, 0),
(36, 'Johan Carlos Hutagalung', 'JOHAN.HUTAGALUNG@TRAKINDO.CO.ID', '$2y$10$RE/zgc9gQnQoFqSR3H6q6O8SET1oDgnmX7j0PqcNg20QdiLR1r0OS', 4, 1, 0),
(37, 'Muhammad Firdaus', 'MUHAMMAD.FIRDAUS@TRAKINDO.CO.ID', '$2y$10$1Z82fjnHQmBmVngv2roEDuz0wrg0m.V/iyihpce2isxk0Y0k7PTTG', 4, 1, 0),
(38, 'Najib Makhfudh', 'NAJIB.MAKHFUDH@TRAKINDO.CO.ID', '$2y$10$4DQbelj2CM.15jQqM/SeSOwC/.PrDjVtHNQJUC4O5cZ.e2Csg614y', 4, 1, 0),
(39, 'Rio Arintapraja', 'RIO.ARINTAPRAJA@TRAKINDO.CO.ID', '$2y$10$EfK4yHAjkB3kONh6QDHQQuIzgdyAO4psbbOqxCJLGTjp1Hc33m3ta', 4, 1, 0),
(40, 'Jefrizal Kerry', 'JEFRIZAL.KERRY@TRAKINDO.CO.ID', '$2y$10$9r0GBL633AEX3VedUVLDmu//WJgW3wosganDKQTP4ScQ0feauWjH2', 10, 1, 0),
(41, 'Aulia Rahman Purba', 'AULIA.PURBA@TRAKINDO.CO.ID', '$2y$10$MmiSf36HmhMMiQyYQ/7M/.J9eBejuJhxofIigq3IF3273bn.CorhS', 10, 1, 0),
(42, 'Zul Afriyandi', 'ZUL.AFRIYANDI@TRAKINDO.CO.ID', '$2y$10$cr6W06A0BPstYp0SHiJ53.9Z1UXbBl8SW7wK/gwzzlJgJLQ91raRW', 10, 1, 0),
(43, 'Dedi Marzuki', 'DEDI.MARZUKI@TRAKINDO.CO.ID', '$2y$10$BK.9TRVeZRxtAx0WYb6NXOSTdhEhchSiVY6btwBHn0QkngvQTtkrm', 10, 1, 0),
(44, 'Fulkan Hadiyan', 'FULKAN.HADIYAN@TRAKINDO.CO.ID', '$2y$10$4CSWU6F3mZjvgPua7lAzfeFk2vobzvVbK2iY4L85qRHR3scCaa3l2', 7, 1, 0),
(45, 'Oemar Kamal', 'OEMAR.KAMAL@TRAKINDO.CO.ID', '$2y$10$sV3FmFxpHaPxz.y.2rpJ4.SS1Pi7YHhw9fpJWwAs6RDqM6iST4y5e', 7, 1, 0),
(46, 'Eko Deddy Setiawan', 'EKO.SETIAWAN@TRAKINDO.CO.ID', '$2y$10$MGcbpMKLYRbpAxPl73JFmuP9B7Zs3eDu..uTFIlFfXJi8iE4D4CXa', 5, 1, 0),
(47, 'Barliansyah Adi Wijaya', 'BARLIANSYAH.WIJAYA@TRAKINDO.CO.ID', '$2y$10$kXCsyoW/K9CBrupWvLlzbeShjNLdloKjUHYDYRV6D1qUUTWvS6g0.', 5, 1, 0),
(48, 'Erwin Ramli', 'erwin.ramli@trakindo.co.id', '$2y$10$YEAgNtQ5Y5euI6YVWBeH0ezfI9oWccR0Ip5sj5HeSy6CoYgyMDVTa', 4, 2, 0),
(49, 'Amir Hamzah', 'amir.hamzah@trakindo.co.id', '$2y$10$EpBZ/eL3IYlY2AerJrn/cuEF5s8PdZtMZQHnDjZOPhDSvA1F7wFuu', 4, 2, 0),
(50, 'Cepy Firmansyah', 'cepy.firmansyah@trakindo.co.id', '$2y$10$bE/jkCNHE7.uTcKiBA.GgOPEgDYDrnzI6ADg8NCdFoXT/.mneIZ0u', 7, 2, 0),
(51, 'Yodie Triwibowo', 'yodie.triwibowo@trakindo.co.id', '$2y$10$iMGsaozuZmPaBQOIrOfiauK2B43zBEh1jHdV83EhaxMo1nB9oc4xu', 7, 2, 0),
(52, 'Risa Perdana Kurniawan', 'risa.kurniawan@trakindo.co.id', '$2y$10$ZKShx2H7sNke6GApeXXjLeYYdLHTmZMGphXLWfwSgp8dIUS/m0JOC', 7, 2, 0),
(53, 'Dito Ferandy', 'dito.raditya@trakindo.co.id', '$2y$10$vbDxYch.nL5xpFmIQhgZeuQrtR4oMUPWRRNDEp4j4p62brfZvdYDS', 7, 2, 0),
(54, 'Ario Wirawan', 'awirawan@trakindo.co.id', '$2y$10$EDBXDscGmz7AraB65g0WvOcfiKi63Zg3v8p2SMNOuqdo70u2RX08y', 5, 2, 0),
(55, 'Berton Gurning', 'berton.gurning@trakindo.co.id', '$2y$10$GDCZkQZRg8v14a92WS25xebAMSHlTZNwUVpMvA/RxKerpFgcuCcwG', 5, 2, 0),
(56, 'Ivanlie', 'ivanlie@trakindo.co.id', '$2y$10$zXQTkix8GrjxaQKkwFSL7O/dzHfMvYh8jNcUaC42mR4rhGq5363.S', 5, 2, 0),
(57, 'Mochamad Pradana', 'moch.pradana@trakindo.co.id', '$2y$10$gcZwY8oXyg7PVeVtWjXlt.Fsg7KzwBvOSXZha0iV6Pr/z5YHfgdN6', 5, 2, 0),
(58, 'Zairin Pratondo', 'zpratondo@trakindo.co.id', '$2y$10$d4XCbrvGj/rh8sVg/UreQOY3JwNExuJbFrc3a36vwHVsdhoE.w316', 5, 2, 0),
(59, 'Saiful Anam', 'saiful.pasha@trakindo.co.id', '$2y$10$UCvwVIlveG64izVottZ7.OaznEAZG47K7tsmd42zIGsidPYyNJivG', 5, 2, 0),
(60, 'Bob Agus Perdana', 'bob.perdana@trakindo.co.id', '$2y$10$sOWnEa101Ftxhb1r2cVFgulzLn4j4CrsHTxsGQCJVzL7I7nQ.sGIi', 6, 2, 0),
(61, 'Nuzula Sakti Ramadhan ', 'nuzula.ramadhan@trakindo.co.id', '$2y$10$5cNAtkKin81iJA.bW6pUAOkByoZS4N0ilkGs5rolGxiO1ZQquF1qi', 6, 2, 0),
(62, 'Ramadhan Mahmud Habibie', 'ramadhan.m.habibie@trakindo.co.id', '$2y$10$Rn8nWKJd2v1lSUOxXtIr1uIas/b3FBNklXMVM8uGWM43Wxj7.CxCS', 6, 2, 0),
(63, 'Rajif Rahman', 'rajif.rahman@trakindo.co.id', '$2y$10$gcXKVTBBmElj.MbXOTbonuazldijm6CJ8Cosnm6FnwJCQS2Mm2gxq', 6, 2, 0),
(64, 'Arthur Edgar Wijaya', 'arthur.wijaya@trakindo.co.id', '$2y$10$PmpKv2mL4Qha8l9fcJtXI.797uYeieU9tjRO1aqIhz6//fUau2n4u', 3, 2, 0),
(65, 'Fekky Irawan', 'fekky.irawan@trakindo.co.id', '$2y$10$VXivl.0wXO3yJGu4Wjkig.cfTWSjhVt.yfNSNZ499FiQeLjl/cknO', 3, 2, 0),
(66, 'Julianto', 'j.julianto@trakindo.co.id', '$2y$10$xBGDqWEfgdnBMH6MbeW8CO0VyOqcpeDBaEalCXGFF2wV.aQqys7Pu', 3, 2, 0),
(67, 'Wahyullah Nasmar', 'wahyullah.nasmar@trakindo.co.id', '$2y$10$Xzqk.avGZIDH3nnNAHLvqOohzakJk8HnxdpF36SFHPdAAvRaREx6O', 3, 2, 0),
(68, 'Toga Parulian Sitanggang', 'toga.sitanggang@trakindo.co.id', '$2y$10$OF4ukuaW.5No67Np8T1cjeU3NC.FZ1czxZQTki4sEjRCpqGP4fW4S', 3, 2, 0),
(69, 'Rezky Septian Abdillah', 'rezky.s.abdillah@trakindo.co.id', '$2y$10$fEf08uypPVSY6XNkwoYhZ.VIDPwk16iHS/fIwJU8qMmRhcEYPcJEO', 3, 2, 0),
(70, 'Sagian Safrudin', 'sagian.safrudin@trakindo.co.id', '$2y$10$JXqCtT.fbeQ/kRV0mQDWOeXjBiD8r4iy1UgRK5JZKBG733kno82m2', 3, 2, 0),
(71, 'Steven', 'steven.tandungan@trakindo.co.id', '$2y$10$DVaS11/BL983Y7knRJTg9O0QSsiWGkIlf.RBgD.Z/WoSm.FOvpgHq', 8, 2, 0),
(72, 'Immanuel Romeo Simanjuntak', 'immanuel.simanjuntak@trakindo.co.id', '$2y$10$kfG5Ebj3rtOyZGXtTkGIuuoe3Al0q4I/oVeHnEIwTezkmXbX568rC', 8, 2, 0),
(73, 'Michael Tetelpta ', 'michael.tetelepta@trakindo.co.id', '$2y$10$XlUSTMHnZRDvc2n6cWd1LuCbtn/4RDhSR7/UG/kNNlP9KSp9zioTG', 9, 2, 0),
(74, 'Reynold Valentino Pateh', 'reynold.pateh@trakindo.co.id', '$2y$10$IKVgscfSY1xjV6vm8D/lv.bgALlvqKmU62Jf/W6AMuIQXTdR53BQO', 9, 2, 0),
(75, 'AHMAD GHALIB ', 'ahmad.gholib@trakindo.co.id', '$2y$10$opIINCWHp7ymdzsD3HX/3.um08QV4yycoH5VrxUNMiJlmlcFuK1rK', 2, 3, 0),
(76, 'TISNA HAMIJAYA', 'tisna.hamijaya@trakindo.co.id', '$2y$10$gjS1YaCMCFCn1EsMO44XAe.esr8zBpjfH8FViI8QgZb2b2/mXFJwG', 2, 3, 0),
(77, 'HERIZAR SALIM', 'herizar.salim@trakindo.co.id', '$2y$10$N89U.d4rw2s0Wp4hParX3ujZ3BRsd3xSOgeAsUv3N5H9b6OltxhEO', 2, 3, 0),
(78, 'ACHMAD FEBY SUPUFI', 'achmad.supufi@trakindo.co.id', '$2y$10$sFb83gu.8VEWION/ZQrOtuT2XCjZkFqHgS4WySvDIoTurT3vhDEXi', 2, 3, 0),
(79, 'IMRAN RUSYADI', 'imran.r.rusyadi@trakindo.co.id', '$2y$10$gsvgUdSQxnzQPujsIpIW7u7zZl0ZTctKKbi72RcfU2UJTISjFW2Q2', 2, 3, 0),
(80, 'AGUNG PRIYANTOMO', 'apriyant@trakindo.co.id', '$2y$10$Hzn.R9mM3zX.jfvb13YIBu8qgF6LlOQTfDDr9p1GKJjuRvTJr6eKW', 2, 3, 0),
(81, 'DODY SUWONDO', 'dody.suwondo@trakindo.co.id', '$2y$10$.PsHtfUBrJGRVh8TsZpOBuOFzevIKrP28rybNbOcpkQrMOKsoOH7.', 1, 3, 0),
(82, 'SIROJUDIN ABBAS', 'sirojudin.abbas@trakindo.co.id', '$2y$10$duW/llRpZ1WPqLo1jJPd8OiZl6UcH74vpoeTwMqYhveGLgEQhEq/a', 1, 3, 0),
(83, 'RAFAEL YUDHISTIRA ARIE BAWANA', 'ryudhistira@trakindo.co.id', '$2y$10$U4emZQztY2ocOBViTWPa7evmvKkQMEjs44yYZyD6z989Eu8yiUQ1S', 1, 3, 0),
(84, 'PATMOS KABAN', 'patmos.kaban@trakindo.co.id', '$2y$10$5EBmkedfM1J6plkx8O3eMePkXR3szUu3JN1tz.Qzdm4NHIXOjWyy2', 1, 3, 0),
(85, 'ZULHIRMAN', 'zulhirman@trakindo.co.id', '$2y$10$b9BfNxkavBN3pya2Uw2Er.PSCrB3wFVTAShqgU5uXF4N439V0oQeq', 1, 3, 0),
(86, 'FAUZI WARDI', 'fauzi.wardi@trakindo.co.id', '$2y$10$NmDe0uVkvX.ZIGIIzQxKT.1U.KENHM7alD0dmO7bQJlZpXNoRjOz.', 1, 3, 0),
(87, 'FREDDY SEMBIRING', 'freddy.sembiring@trakindo.co.id', '$2y$10$PB.iq3kOee9EJzWBcQfyduyaw6lNdaxKtoK1wxCCaeXZfXHtslmwS', 1, 3, 0),
(88, 'ANDRE KURNIAWAN', 'andre.kurniawan@trakindo.co.id', '$2y$10$7O4QaNDzMRB.ueObLTaBaedF5GoaeiQqnlBLpr2rh.Yq3I1r4OeNi', 1, 3, 0),
(89, 'NOFRIZAL', 'nofrizal.sardiman@trakindo.co.id', '$2y$10$VBhguMnOPheQ4vNfCuCOeetBzJHHtGCuFU93vu.s/Hxi05Aqy62Nm', 4, 3, 0),
(90, 'TRI HERU IMAN SUSILO', 'theru@trakindo.co.id', '$2y$10$AMOOf10TDdM67r2l5HZOH.5gQ.e0OIJRjLGncbZ.T1Gf6jcsQypgu', 4, 3, 0),
(91, ' LUKAS', 'lukas.goh@trakindo.co.id', '$2y$10$58MiZoTee3jlSSlvZn1Y8..dxqNDnFAyQM4SzO/TBBcebY3ndvuiq', 7, 3, 0),
(92, 'DON TRIPOL', 'don.tripol@trakindo.co.id', '$2y$10$PP06eUuFVGUskegRybJ5BekdHZCE2xcscjraGsEJP3pM63jUP/vae', 7, 3, 0),
(93, 'ROZY ANDRIANTO', 'randrianto@trakindo.co.id', '$2y$10$HkW/CHAjj5xrU3GB0P6b5.NEQnuHqKcllE7VdlxXY0HiOzNMUlnLm', 5, 3, 0),
(94, 'ARIF PRAWIRA', 'aprawira@trakindo.co.id', '$2y$10$BZBYpNDwo0qGfBErJnTpE.7hrmrgxbtz5Y8IpM8i/TjyqRuUQGFcm', 5, 3, 0),
(95, 'FRANKY LUKAS MAKATIPU', 'frangky.makatipu@trakindo.co.id', '$2y$10$AyJ/BY46UthDK8S4eg447eOZGg9GAp4zwnc64WXXi3TkCxIRzviu2', 5, 3, 0),
(96, 'MOH KHATAMSI', 'mohammad.khatamsi@trakindo.co.id', '$2y$10$pPE5mtwmUJMjxpMbT7f8BeOsytI7.vm7vBJVlUdrrmxSpOazV/uHm', 5, 3, 0),
(97, 'M FIRSON APRIANDI', 'muhammad.apriandi@trakindo.co.id', '$2y$10$W5RTw.7Jugpgt3YMT/XydOKI3NVpE5FY02yAp2X9jilcUcqQhbjHe', 6, 3, 0),
(98, 'ENDY ARDAPUTRA', 'endy.ardaputra@trakindo.co.id', '$2y$10$3RyKZhPAzbf4pRs6/kk0yeIGEgQnU5R20Kt5EcDhclBxTCi/WUJNe', 6, 3, 0),
(99, 'AGGY RESTU PROBADI', 'aggy.pribadi@trakindo.co.id', '$2y$10$V.PEWeJ6oVMzKo9VSNtz8uZ0IxzxNRNcjdAXDDz7g2KA.ufkVxF.e', 3, 3, 0),
(100, 'FAJRI ARDI', 'fajri.ardi@trakindo.co.id', '$2y$10$op2H5aCqEeoq25/XgGl7fuVGHAlP5wiwwH631a7F.gjOZTA15YRjG', 3, 3, 0),
(101, 'KENDIAN FETRIKO', 'kendian.fetriko@trakindo.co.id', '$2y$10$95DR.5y1xLUwIclL0OUyi.Os9Oqg.R7EJhIDa3JdxCj8ma5Njl18i', 3, 3, 0),
(102, 'JOKO SANTOSO S ', 'joko.sudiyono@trakindo.co.id', '$2y$10$EJ0kKa/5p7FwoCh8iys8Y.5sKQl4VYXkpxq9F0TRqijfsjbU3ndjG', 3, 3, 0),
(103, 'WAHYU ZULKARNAIN', 'wahyu.zulkarnain@trakindo.co.id', '$2y$10$Jps2JvixKBWXG4lJ7XRVYe90kMLp5QAAr9LQJbacQNGOWExlciiaW', 8, 3, 0),
(104, 'EZZY NORMANSYAH', 'ezi.noormansyah@trakindo.co.id', '$2y$10$4R6jl1kFVpQ6hk96RMXbbO7PUdUfH25eOHSlrjGTjfQ2MxOytnZMa', 8, 3, 0),
(106, 'Rahmat Gibran Zulbadriansyah', 'rgibran234@gmail.com', '$2y$10$69qkVoiUOOdD6w.kk6tRH.H9faA8yGvYYjyy8F2FIQP9.e2DPau6e', 12, 5, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'Trakindo Batch 4'),
(2, 'Trakindo Batch 3'),
(3, 'Trakindo Batch 2'),
(5, 'Coba Perusahaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `criteria`
--

CREATE TABLE `criteria` (
  `id` int(50) NOT NULL,
  `criteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `goals`
--

CREATE TABLE `goals` (
  `id` int(50) NOT NULL,
  `goal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `coachee_id` int(50) NOT NULL,
  `status` enum('selesai','belum selesai') COLLATE utf8mb4_unicode_ci DEFAULT 'belum selesai',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `milestone`
--

CREATE TABLE `milestone` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `coachee_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `goals_id` int(11) NOT NULL,
  `milestone` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_sesi`
--

CREATE TABLE `penilaian_sesi` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `coachee_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `komunikasi` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kehadiran` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `effort` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `komitment` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `report`
--

CREATE TABLE `report` (
  `id` int(255) NOT NULL,
  `coach` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `coachee` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `success_criteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_plan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penilaian_sesi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `milestone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `status` enum('belum mulai','belum selesai','selesai') COLLATE utf8mb4_unicode_ci DEFAULT 'belum mulai',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `coachee_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `action_plan`
--
ALTER TABLE `action_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `coachee`
--
ALTER TABLE `coachee`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `milestone`
--
ALTER TABLE `milestone`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penilaian_sesi`
--
ALTER TABLE `penilaian_sesi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `action_plan`
--
ALTER TABLE `action_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `coach`
--
ALTER TABLE `coach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `coachee`
--
ALTER TABLE `coachee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `milestone`
--
ALTER TABLE `milestone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penilaian_sesi`
--
ALTER TABLE `penilaian_sesi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `report`
--
ALTER TABLE `report`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
