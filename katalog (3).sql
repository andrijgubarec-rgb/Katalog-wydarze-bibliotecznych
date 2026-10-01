-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 01, 2026 at 04:08 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katalog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `start_time`, `end_time`, `room_id`, `event_type_id`, `max_participants`) VALUES
(3, 'Spotkanie zarządu', 'Spotkanie strategiczne firmy', '2026-10-20', '08:00:00', '10:00:00', 5, 3, 15),
(4, 'Wykład o AI', 'Otwarte wystąpienie o sztucznej inteligencji', '2026-11-02', '12:00:00', '14:00:00', 4, 4, 200),
(5, 'Szkolenie BHP', 'Obowiązkowe szkolenie dla pracowników', '2026-09-30', '09:00:00', '11:00:00', 1, 5, 50),
(6, 'Seminarium naukowe', 'Prezentacja wyników badań', '2026-10-05', '13:00:00', '16:00:00', 2, 6, 100),
(7, 'Konferencja Cloud 2026', 'Konferencja o rozwiązaniach chmurowych', '2026-10-01', '09:00:00', '16:00:00', 2, 1, 110),
(9, 'Spotkanie projektowe Alpha', 'Przegląd postępów projektu Alpha', '2026-10-02', '14:00:00', '15:30:00', 5, 3, 12),
(10, 'Wykład o blockchain', 'Wprowadzenie do technologii blockchain', '2026-10-03', '11:00:00', '13:00:00', 4, 4, 180),
(11, 'Szkolenie RODO', 'Szkolenie z ochrony danych osobowych', '2026-10-06', '09:00:00', '12:00:00', 1, 5, 45),
(12, 'Seminarium doktoranckie', 'Prezentacja postępów prac doktorskich', '2026-10-07', '13:00:00', '16:00:00', 2, 6, 90),
(13, 'Konferencja Medyczna', 'Nowoczesne metody diagnostyki', '2026-10-08', '08:30:00', '15:30:00', 4, 1, 190),
(15, 'Spotkanie z klientem XYZ', 'Prezentacja oferty dla klienta XYZ', '2026-10-09', '15:00:00', '16:00:00', 5, 3, 10),
(16, 'Wykład o machine learning', 'Podstawy uczenia maszynowego', '2026-10-13', '12:00:00', '14:00:00', 2, 4, 100),
(17, 'Szkolenie pierwszej pomocy', 'Kurs udzielania pierwszej pomocy', '2026-10-14', '09:00:00', '13:00:00', 1, 5, 48),
(18, 'Seminarium ekologiczne', 'Zrównoważony rozwój w praktyce', '2026-10-16', '10:00:00', '13:00:00', 4, 6, 150),
(19, 'Konferencja FinTech', 'Innowacje w sektorze finansowym', '2026-10-19', '09:00:00', '17:00:00', 2, 1, 115),
(21, 'Spotkanie zarządu Q4', 'Podsumowanie kwartału i plany', '2026-10-22', '08:00:00', '10:00:00', 5, 3, 15),
(22, 'Wykład o cyberbezpieczeństwie', 'Zagrożenia w sieci i ochrona danych', '2026-10-23', '13:00:00', '15:00:00', 4, 4, 200),
(23, 'Szkolenie z obsługi klienta', 'Standardy obsługi i komunikacji', '2026-10-26', '09:00:00', '12:00:00', 1, 5, 50),
(24, 'Seminarium psychologiczne', 'Psychologia w miejscu pracy', '2026-10-27', '14:00:00', '17:00:00', 2, 6, 80),
(25, 'Konferencja Edukacja 2026', 'Nowe trendy w nauczaniu', '2026-10-28', '09:30:00', '15:00:00', 4, 1, 175),
(27, 'Spotkanie zespołu IT', 'Planowanie sprintu', '2026-10-30', '09:00:00', '10:30:00', 5, 3, 14),
(28, 'Wykład o sztucznej inteligencji', 'Etyka AI i jej zastosowania', '2026-11-03', '11:00:00', '13:00:00', 2, 4, 120),
(29, 'Szkolenie z Excela', 'Zaawansowane funkcje arkusza', '2026-11-04', '09:00:00', '14:00:00', 1, 5, 45),
(30, 'Seminarium historyczne', 'Badania nad historią regionu', '2026-11-05', '13:00:00', '16:00:00', 4, 6, 160),
(31, 'Konferencja Marketing 360', 'Kompleksowe strategie marketingowe', '2026-11-06', '09:00:00', '16:00:00', 2, 1, 110),
(33, 'Spotkanie z inwestorami', 'Prezentacja wyników finansowych', '2026-11-10', '08:00:00', '09:30:00', 5, 3, 12),
(34, 'Wykład o astronomii', 'Odkrywanie tajemnic kosmosu', '2026-11-12', '18:00:00', '20:00:00', 4, 4, 195),
(35, 'Szkolenie przeciwpożarowe', 'Procedury bezpieczeństwa pożarowego', '2026-11-13', '09:00:00', '11:00:00', 1, 5, 50),
(36, 'Seminarium medyczne', 'Nowe terapie w leczeniu chorób', '2026-11-16', '12:00:00', '15:00:00', 2, 6, 100),
(37, 'Konferencja Logistyka 2026', 'Optymalizacja łańcucha dostaw', '2026-11-17', '09:00:00', '15:00:00', 4, 1, 200),
(39, 'Spotkanie działu HR', 'Rekrutacja i rozwój pracowników', '2026-11-19', '10:00:00', '11:30:00', 5, 3, 15),
(40, 'Wykład o klimacie', 'Zmiany klimatyczne i ich skutki', '2026-11-20', '13:00:00', '15:00:00', 2, 4, 115),
(41, 'Szkolenie z negocjacji', 'Techniki skutecznych negocjacji', '2026-11-23', '09:00:00', '13:00:00', 1, 5, 40),
(42, 'Seminarium technologiczne', 'Przyszłość technologii kwantowych', '2026-11-24', '14:00:00', '17:00:00', 4, 6, 180),
(43, 'Konferencja Prawa 2026', 'Zmiany w przepisach prawnych', '2026-11-25', '09:00:00', '16:00:00', 2, 1, 105),
(45, 'Spotkanie budżetowe', 'Planowanie budżetu na rok 2027', '2026-11-27', '08:30:00', '10:00:00', 5, 3, 13),
(46, 'Wykład o filozofii', 'Filozofia współczesna', '2026-11-30', '12:00:00', '14:00:00', 4, 4, 190),
(47, 'Szkolenie z prezentacji', 'Skuteczne wystąpienia publiczne', '2026-12-01', '09:00:00', '12:00:00', 1, 5, 45),
(49, 'Konferencja IT Security', 'Bezpieczeństwo systemów informatycznych', '2026-12-03', '09:00:00', '17:00:00', 4, 1, 200),
(51, 'Spotkanie strategiczne 2027', 'Planowanie strategiczne na rok 2027', '2026-12-07', '08:00:00', '11:00:00', 5, 3, 15),
(52, 'Wykład o neuronauce', 'Jak działa mózg człowieka', '2026-12-08', '12:00:00', '14:00:00', 2, 4, 110),
(55, 'Konferencja Startup Day', 'Prezentacja młodych firm technologicznych', '2026-12-11', '09:00:00', '16:00:00', 2, 1, 118),
(57, 'Zapusk zywota artioma', 'Zapusk', '2026-10-22', '13:46:00', '14:49:00', 12, 7, 34),
(58, 'Warsztaty PHP', 'Praktyczne warsztaty programowania w PHP', '2026-12-14', '09:00:00', '13:00:00', 6, 2, 40),
(59, 'Konferencja AI 2026', 'Najnowsze zastosowania sztucznej inteligencji', '2026-12-15', '09:00:00', '17:00:00', 9, 1, 240),
(60, 'Spotkanie zespołu programistów', 'Omówienie postępów prac nad projektem', '2026-12-16', '10:00:00', '12:00:00', 5, 3, 15),
(61, 'Wykład o cyberbezpieczeństwie', 'Podstawowe zasady bezpieczeństwa w internecie', '2026-12-17', '11:00:00', '13:00:00', 7, 4, 80),
(62, 'Szkolenie SQL', 'Praktyczne wykorzystanie języka SQL', '2026-12-18', '09:00:00', '14:00:00', 1, 5, 50),
(63, 'Seminarium o nowych technologiach', 'Omówienie najnowszych trendów technologicznych', '2026-12-21', '13:00:00', '16:00:00', 11, 6, 100),
(64, 'Hackathon Winter 2026', 'Konkurs programistyczny dla zespołów IT', '2026-12-22', '08:00:00', '20:00:00', 14, 10, 280),
(65, 'Panel dyskusyjny o AI', 'Dyskusja na temat przyszłości sztucznej inteligencji', '2026-12-28', '15:00:00', '17:00:00', 4, 8, 180),
(66, 'Targi pracy IT', 'Spotkanie studentów z firmami technologicznymi', '2027-01-08', '10:00:00', '16:00:00', 9, 9, 250),
(67, 'Konferencja Web Development', 'Nowoczesne technologie tworzenia aplikacji internetowych', '2027-01-11', '09:00:00', '16:00:00', 2, 1, 120),
(68, 'Warsztaty JavaScript', 'Tworzenie interaktywnych aplikacji internetowych', '2027-01-12', '09:00:00', '14:00:00', 8, 2, 25),
(69, 'Spotkanie projektowe Beta', 'Planowanie kolejnego etapu projektu Beta', '2027-01-13', '14:00:00', '16:00:00', 5, 3, 12),
(70, 'Wykład o bazach danych', 'Projektowanie i optymalizacja relacyjnych baz danych', '2027-01-14', '12:00:00', '14:00:00', 10, 4, 60),
(71, 'Szkolenie Git i GitHub', 'Podstawy pracy z systemem kontroli wersji Git', '2027-01-15', '09:00:00', '12:00:00', 6, 5, 40),
(72, 'Seminarium o chmurze', 'Architektura i zastosowanie usług chmurowych', '2027-01-18', '13:00:00', '16:00:00', 7, 6, 75),
(73, 'Webinar Python', 'Wprowadzenie do programowania w Pythonie', '2027-01-19', '17:00:00', '19:00:00', 12, 7, 30),
(74, 'Debata o przyszłości technologii', 'Debata dotycząca kierunków rozwoju branży IT', '2027-01-20', '16:00:00', '18:00:00', 14, 12, 250),
(75, 'Konferencja Start-upów', 'Prezentacje młodych firm technologicznych', '2027-01-21', '09:00:00', '15:00:00', 11, 1, 100),
(76, 'Warsztaty UX/UI', 'Projektowanie wygodnych i intuicyjnych interfejsów', '2027-01-22', '10:00:00', '14:00:00', 15, 2, 45),
(77, 'Spotkanie administracyjne', 'Omówienie organizacji wydarzeń na kolejny miesiąc', '2027-01-25', '08:30:00', '10:00:00', 5, 3, 15),
(78, 'Konferencja DevOps 2027', 'Automatyzacja procesów tworzenia i wdrażania aplikacji', '2027-01-26', '09:00:00', '16:00:00', 2, 1, 115),
(79, 'Warsztaty Docker', 'Praktyczne wykorzystanie kontenerów Docker', '2027-01-27', '10:00:00', '14:00:00', 6, 2, 40),
(80, 'Spotkanie zarządu styczeń', 'Omówienie wyników i planów firmy', '2027-01-28', '08:00:00', '10:00:00', 5, 3, 15),
(81, 'Wykład o sztucznej inteligencji', 'Rozwój modeli językowych i generatywnej AI', '2027-01-29', '12:00:00', '14:00:00', 4, 4, 190),
(82, 'Szkolenie z administracji Linux', 'Podstawy administracji serwerami Linux', '2027-02-01', '09:00:00', '13:00:00', 1, 5, 45),
(83, 'Seminarium o robotyce', 'Robotyka przemysłowa i automatyzacja', '2027-02-02', '13:00:00', '16:00:00', 11, 6, 100),
(84, 'Webinar o PHP', 'Nowoczesne tworzenie aplikacji webowych w PHP', '2027-02-03', '17:00:00', '19:00:00', 12, 7, 30),
(85, 'Panel dyskusyjny IT', 'Dyskusja o przyszłości rynku technologicznego', '2027-02-04', '15:00:00', '17:00:00', 7, 8, 80),
(86, 'Targi technologiczne', 'Prezentacja nowych rozwiązań technologicznych', '2027-02-05', '09:00:00', '17:00:00', 14, 9, 280),
(87, 'Hackathon Spring', 'Konkurs tworzenia aplikacji internetowych', '2027-02-08', '08:00:00', '20:00:00', 9, 10, 250),
(88, 'Konferencja bezpieczeństwa', 'Bezpieczeństwo danych i infrastruktury IT', '2027-02-09', '09:00:00', '16:00:00', 2, 1, 120),
(89, 'Warsztaty React', 'Budowanie aplikacji frontendowych w React', '2027-02-10', '09:00:00', '14:00:00', 8, 2, 25),
(90, 'Spotkanie zespołu marketingowego', 'Planowanie kampanii na pierwszy kwartał', '2027-02-11', '10:00:00', '12:00:00', 5, 3, 15),
(91, 'Wykład o blockchain', 'Technologia blockchain i jej zastosowania', '2027-02-12', '11:00:00', '13:00:00', 10, 4, 60),
(92, 'Szkolenie z komunikacji', 'Skuteczna komunikacja w pracy zespołowej', '2027-02-15', '09:00:00', '12:00:00', 6, 5, 40),
(93, 'Seminarium ekonomiczne', 'Aktualne trendy gospodarcze', '2027-02-16', '13:00:00', '16:00:00', 11, 6, 100),
(94, 'Webinar o MySQL', 'Projektowanie i optymalizacja baz danych', '2027-02-17', '18:00:00', '20:00:00', 12, 7, 35),
(95, 'Debata technologiczna', 'Wpływ nowych technologii na społeczeństwo', '2027-02-18', '16:00:00', '18:00:00', 14, 12, 250),
(96, 'Konferencja edukacyjna', 'Nowoczesne metody nauczania', '2027-02-19', '09:00:00', '15:00:00', 9, 1, 230),
(97, 'Warsztaty Git', 'Praca zespołowa z wykorzystaniem Git i GitHub', '2027-02-22', '10:00:00', '13:00:00', 8, 2, 25),
(98, 'Spotkanie projektowe Gamma', 'Omówienie realizacji projektu Gamma', '2027-02-23', '14:00:00', '16:00:00', 5, 3, 12),
(99, 'Wykład o programowaniu', 'Najważniejsze paradygmaty programowania', '2027-02-24', '12:00:00', '14:00:00', 4, 4, 180),
(100, 'Szkolenie z Excela', 'Zaawansowana analiza danych w Excelu', '2027-02-25', '09:00:00', '13:00:00', 1, 5, 50),
(101, 'Seminarium biologiczne', 'Nowoczesne metody badań biologicznych', '2027-02-26', '13:00:00', '16:00:00', 7, 6, 75),
(102, 'Webinar o cyberbezpieczeństwie', 'Bezpieczne korzystanie z internetu', '2027-03-01', '17:00:00', '19:00:00', 12, 7, 35),
(103, 'Panel ekspertów IT', 'Rozmowa specjalistów o przyszłości branży', '2027-03-02', '15:00:00', '17:00:00', 11, 8, 100),
(104, 'Targi edukacyjne 2027', 'Prezentacja szkół i uczelni', '2027-03-03', '09:00:00', '16:00:00', 14, 9, 300),
(105, 'Hackathon AI', 'Tworzenie projektów wykorzystujących sztuczną inteligencję', '2027-03-04', '08:00:00', '20:00:00', 9, 10, 250),
(106, 'Konferencja Python', 'Nowoczesne zastosowania języka Python', '2027-03-05', '09:00:00', '16:00:00', 2, 1, 120),
(107, 'Warsztaty SQL', 'Ćwiczenia z zapytań i relacji baz danych', '2027-03-08', '09:00:00', '13:00:00', 6, 2, 40),
(108, 'Spotkanie kierowników', 'Omówienie bieżących problemów organizacyjnych', '2027-03-09', '08:30:00', '10:00:00', 5, 3, 15),
(109, 'Wykład o sieciach komputerowych', 'Podstawy działania sieci komputerowych', '2027-03-10', '12:00:00', '14:00:00', 4, 4, 190),
(110, 'Szkolenie z zarządzania projektami', 'Metodyki prowadzenia projektów IT', '2027-03-11', '09:00:00', '13:00:00', 1, 5, 45),
(111, 'Seminarium astronomiczne', 'Najnowsze odkrycia astronomiczne', '2027-03-12', '14:00:00', '17:00:00', 7, 6, 80),
(112, 'Webinar o JavaScript', 'Nowoczesny JavaScript i jego zastosowania', '2027-03-15', '18:00:00', '20:00:00', 12, 7, 30),
(113, 'Debata o edukacji', 'Przyszłość edukacji cyfrowej', '2027-03-16', '16:00:00', '18:00:00', 14, 12, 220),
(114, 'Konferencja MedTech', 'Technologie wykorzystywane we współczesnej medycynie', '2027-03-17', '09:00:00', '16:00:00', 9, 1, 240),
(115, 'Warsztaty fotografii', 'Podstawy fotografii cyfrowej', '2027-03-18', '10:00:00', '14:00:00', 15, 2, 45),
(116, 'Spotkanie organizatorów', 'Planowanie kolejnych wydarzeń', '2027-03-19', '09:00:00', '11:00:00', 5, 3, 13),
(117, 'Wykład o bazach NoSQL', 'MongoDB i inne nierelacyjne bazy danych', '2027-03-22', '12:00:00', '14:00:00', 10, 4, 60),
(118, 'Szkolenie z prezentacji', 'Jak przygotować dobrą prezentację', '2027-03-23', '09:00:00', '12:00:00', 6, 5, 40),
(119, 'Seminarium prawnicze', 'Najnowsze zmiany w prawie gospodarczym', '2027-03-24', '13:00:00', '16:00:00', 11, 6, 100),
(120, 'Webinar o chmurze', 'Podstawy AWS, Azure i Google Cloud', '2027-03-25', '17:00:00', '19:00:00', 12, 7, 35),
(121, 'Panel o sztucznej inteligencji', 'Szanse i wyzwania związane z rozwojem AI', '2027-03-26', '15:00:00', '17:00:00', 7, 8, 80),
(122, 'Targi pracy 2027', 'Spotkania kandydatów z pracodawcami', '2027-03-29', '10:00:00', '16:00:00', 14, 9, 300),
(123, 'Hackathon Web', 'Tworzenie aplikacji webowych w zespołach', '2027-03-30', '08:00:00', '20:00:00', 9, 10, 250),
(124, 'Konferencja przyszłości IT', 'Najważniejsze trendy w branży IT', '2027-03-31', '09:00:00', '16:00:00', 2, 1, 120),
(125, 'Warsztaty UX', 'Projektowanie interfejsów użytkownika', '2027-04-01', '10:00:00', '14:00:00', 8, 2, 30),
(126, 'Spotkanie zespołu administracji', 'Planowanie zadań na drugi kwartał', '2027-04-02', '08:00:00', '10:00:00', 5, 3, 15),
(127, 'Wykład o kryptografii', 'Podstawy szyfrowania i ochrony informacji', '2027-04-05', '12:00:00', '14:00:00', 4, 4, 180),
(128, 'Szkolenie z PHP i MySQL', 'Tworzenie aplikacji internetowych z bazą danych', '2027-04-06', '09:00:00', '14:00:00', 1, 5, 50),
(129, 'Seminarium informatyczne', 'Rozwój technologii komputerowych', '2027-04-07', '13:00:00', '16:00:00', 11, 6, 100);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_types`
--

CREATE TABLE `event_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `name`) VALUES
(1, 'Konferencjaa'),
(2, 'Warsztaty'),
(3, 'Spotkanie biznesowe'),
(4, 'Wykład'),
(5, 'Szkolenie'),
(6, 'Seminarium'),
(7, 'Webinar'),
(8, 'Panel dyskusyjny'),
(9, 'Targi'),
(10, 'Hackathon'),
(11, 'Konferencja prasowa'),
(12, 'Debata'),
(15, 'Warsztaty praktyczne'),
(16, 'Spotkanie networkingowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `capacity`, `location`) VALUES
(1, 'Sala A1', 50, 'Budynek Główny, piętro 1'),
(2, 'Sala B2', 120, 'Centrum Konferencyjne, piętro 2'),
(4, 'Sala D4', 200, 'Aula Główna'),
(5, 'Sala E5', 15, 'Budynek Główny, piętro 3'),
(6, 'Sala F6', 40, 'Budynek Główny, piętro 2'),
(7, 'Sala G7', 80, 'Centrum Konferencyjne, piętro 1'),
(8, 'Sala H8', 25, 'Budynek Techniczny, piętro 1'),
(9, 'Aula Nova', 250, 'Nowe Skrzydło, parter'),
(10, 'Sala I10', 60, 'Budynek Główny, parter'),
(11, 'Sala J11', 100, 'Centrum Konferencyjne, piętro 3'),
(12, 'Sala K12', 35, 'Budynek Techniczny, piętro 2'),
(13, 'Sala L13', 18, 'Budynek Główny, piętro 4'),
(14, 'Aula Magna', 300, 'Aula Główna, poziom -1'),
(15, 'Sala M15', 45, 'Nowe Skrzydło, piętro 1'),
(18, 'Sala N16', 70, 'Nowe Skrzydło, piętro 2'),
(19, 'Sala O17', 30, 'Budynek Techniczny, piętro 3'),
(20, 'Sala P18', 150, 'Centrum Konferencyjne, parter'),
(21, 'Sala Q19', 90, 'Budynek Główny, piętro 2'),
(22, 'Aula Beta', 350, 'Nowe Skrzydło, parter'),
(23, 'Sala R21', 55, 'Budynek Główny, piętro 3'),
(24, 'Sala S22', 20, 'Budynek Techniczny, parter'),
(25, 'Sala T23', 100, 'Centrum Konferencyjne, piętro 4');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room_id` (`room_id`),
  ADD KEY `fk_event_type_id` (`event_type_id`);

--
-- Indeksy dla tabeli `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_type_id` FOREIGN KEY (`event_type_id`) REFERENCES `event_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
