-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jun 2018 um 20:27
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `docs`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `topic` text NOT NULL,
  `parent` text NOT NULL,
  `header` text NOT NULL,
  `description` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `contents`
--

INSERT INTO `contents` (`id`, `name`, `topic`, `parent`, `header`, `description`, `type`) VALUES
(3, 'C-Sharp', 'Informatics', '-', 'What\'s C#?', 'C# ist eine statische, typsichere, objektorientierte, general-purpose Programmiersprache der Firma Microsoft. Die Sprache ist an sich plattformunabh&auml;ngig, wurde aber im Rahmen der .NET-Strategie entwickelt, ist auf diese optimiert und meist in deren Kontext zu finden. Eigentlich wurde C# fast exklusiv f&uuml;r Microsoft Windows entwickelt. Durch Xamarin ist es inzwischen aber auch m&ouml;glich, f&uuml;r macOS, iOS und Android zu entwickeln. C# orientiert sich stark an den Programmiersprachen Java, C++, C und Haskell.', 'content');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `docs`
--

CREATE TABLE `docs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `parent` text NOT NULL,
  `type` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `docs`
--

INSERT INTO `docs` (`id`, `title`, `parent`, `type`, `text`) VALUES
(21, 'MySQL-Connection', 'C-Sharp', 'header', 'Voraussetzungen'),
(22, 'MySQL-Connection', 'C-Sharp', 'text', 'Zum herstellen einer Verbindung wird ein konfigurierter MySQL Server vorausgesetzt. In dem beispiel wurde der Server Ã¼ber XAMPP gehostet. AuÃŸerdem wird die MySql.Data.dll benÃ¶tigt. Diese lÃ¤sst sich im bereich Resources herunterladen. Zum entwickeln von C# Anwendungen wird Visual Studio empfohlen.'),
(23, 'MySQL-Connection', 'C-Sharp', 'header', 'Importieren der DLL'),
(24, 'MySQL-Connection', 'C-Sharp', 'text', 'Um den MySQL-Connector in C# verwenden zu kÃ¶nnen muss die DLL Ã¼ber einen Rechtsklick auf Verweise -> Verweis hinzufÃ¼gen importiert werden. Im folgenden Popup muss Ã¼ber durchsuchen die DLL ausgewÃ¤hlt werden. AnschlieÃŸend muss die Using-Direktive der Connector zum Code hinzugefÃ¼gt werden.'),
(25, 'MySQL-Connection', 'C-Sharp', 'csharp', 'using MySql.Data.MySqlClient; //Import des MySQL-Connectors'),
(26, 'MySQL-Connection', 'C-Sharp', 'header', 'Herstellen der Verbindung'),
(27, 'MySQL-Connection', 'C-Sharp', 'text', 'Um die Verbindung herzustellen muss ein String erstellt werden der die Verbindungsdaten enthÃ¤lt. Die folgenden Attribute mÃ¼ssen wie folgt ausgefÃ¼llt werden:\nServer: Serveradresse (Im beispiel: 127.0.0.1)\nPort: Port des MySQL-Servers (Steht auf der XAMPP OberflÃ¤che)\nDatabase: Die Datenbank auf die das Programm sich Verbinden soll\nuid: Datenbankbenutzer (Standart root)\npassword: SelbsterklÃ¤rend (StandardmÃ¤ÃŸig nicht gesetzt)'),
(28, 'MySQL-Connection', 'C-Sharp', 'csharp', 'string s_connString = \"Server=127.0.0.1;Port=3306;Database=demodb;uid=root;password=;\";'),
(29, 'MySQL-Connection', 'C-Sharp', 'text', 'Die Verbindung kann jetzt Ã¼ber die MySQLConnection-Klasse hergestellt werden. Der Konstruktur muss mit dem String aufgerufen werden der die Verbindungsdaten enthÃ¤lt.'),
(30, 'MySQL-Connection', 'C-Sharp', 'csharp', 'MySqlConnection o_conn = new MySqlConnection(s_connString);'),
(31, 'MySQL-Connection', 'C-Sharp', 'header', 'Abfragen von Daten'),
(32, 'MySQL-Connection', 'C-Sharp', 'text', 'Jetzt kann ein Objekt erstellt werden das den SQL Befehl enthÃ¤lt. Das Attribut CommandText muss den SQL Befehl enthalten.'),
(33, 'MySQL-Connection', 'C-Sharp', 'csharp', 'MySqlCommand o_command = o_conn.CreateCommand();\no_command.CommandText = \"SELECT * FROM test\"; //Selektiert alle Daten auf der Tabelle namens \"test\"'),
(34, 'MySQL-Connection', 'C-Sharp', 'text', 'Als nÃ¤chstes wird die Verbindung geÃ¶ffnet. Hier kann ein Fehler entstehen also mÃ¼ssen wir den mÃ¶glichen Fehler abfangen.'),
(35, 'MySQL-Connection', 'C-Sharp', 'csharp', 'try {\n    o_conn.Open(); //Ã–ffnen der Verbindung\n} catch(Exception ex_connOpenError) {\n    //Hier kann eine Fehlerbehandlung implementiert werden\n    Console.WriteLine(ex_connOpenError.Message); //Ausgeben der Fehlernachricht\n}'),
(36, 'MySQL-Connection', 'C-Sharp', 'text', 'Als nÃ¤chstes wird der SQL Befehl ausgefÃ¼hrt. Das gibt ein Objekt zurÃ¼ck das sich Reader nennt und die gelesenen Daten beinhaltet.'),
(37, 'MySQL-Connection', 'C-Sharp', 'csharp', 'MySqlDataReader o_reader = o_command.ExecuteReader();'),
(38, 'MySQL-Connection', 'C-Sharp', 'text', 'Jetzt kÃ¶nnen die Daten der Datenbankabfrage ausgegeben werden. Auf das Tuple kÃ¶nnen wir so zugreifen: o_reader[\"spaltenname\"]. Damit WriteLine die Daten ausgeben kann werden sie zur Sicherheit zu einem String convertiert mit: .ToString()'),
(39, 'MySQL-Connection', 'C-Sharp', 'header', 'Gesamter Code'),
(40, 'MySQL-Connection', 'C-Sharp', 'text', 'Es folgt der komplette beispiel Code:'),
(41, 'MySQL-Connection', 'C-Sharp', 'csharp', 'using System;\nusing System.Collections.Generic;\nusing System.Linq;\nusing System.Text;\nusing System.Threading.Tasks;\n\nusing MySql.Data.MySqlClient;\n\nnamespace mysql {\n    class Program {\n        static void Main(string[] args) {\n\n            string s_connString = \"Server=127.0.0.1;Port=3306;Database=demodb;uid=root;password=;\";\n            MySqlConnection o_conn = new MySqlConnection(s_connString);\n\n            MySqlCommand o_command = o_conn.CreateCommand();\n            o_command.CommandText = \"SELECT * FROM test\";\n\n            try {\n                o_conn.Open();\n            } catch(Exception ex_connOpenError) {\n                Console.WriteLine(ex_connOpenError.Message);\n            }\n\n            MySqlDataReader o_reader = o_command.ExecuteReader();\n\n            while(o_reader.Read()) {\n                Console.WriteLine(o_reader[\"name\"].ToString());\n            }\n        }\n    }\n}'),
(42, 'MySQL-Connection', 'C-Sharp', 'header', 'Resources'),
(43, 'MySQL-Connection', 'C-Sharp', 'text', 'Download-Links der Resourcen:');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `docs_by_creator`
--

CREATE TABLE `docs_by_creator` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `parent` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `creation_dat` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `lastchange_dat` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `docs_by_creator`
--

INSERT INTO `docs_by_creator` (`id`, `username`, `parent`, `title`, `description`, `creation_dat`, `lastchange_dat`) VALUES
(6, 'FelixWieland', 'C-Sharp', 'MySQL-Connection', 'a Documentation about MySQL-Connections in C#', '2018-06-24 00:00:00', '2018-06-24 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `topic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `topics`
--

INSERT INTO `topics` (`id`, `topic`) VALUES
(1, 'Physics'),
(2, 'Informatics'),
(3, 'Electronics');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `layer` text NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `salt`, `layer`, `avatar`) VALUES
(2, 'felix.wieland@mail.de', 'FelixWieland', 'u%ffLut.eSklo', 'u%aNSnvseZ', '1', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `docs_by_creator`
--
ALTER TABLE `docs_by_creator`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT für Tabelle `docs_by_creator`
--
ALTER TABLE `docs_by_creator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
