-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 24, 2021 alle 12:06
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theater`
--

DELIMITER $$
--
-- Procedure
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p1` (IN `Incasso_soglia` FLOAT)  begin
drop temporary table if exists tmp;
create temporary table tmp(
  citta varchar(255),
  indirizzo varchar(255),
  titolo varchar(255),
  Incasso_totale float
);

insert into tmp
select Città, Indirizzo ,Titolo_Opera , Incasso_totale
from vista1
where Incasso_totale > incasso_soglia;

select * from tmp;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `luogo`
--

CREATE TABLE `luogo` (
  `ID` int(11) NOT NULL,
  `Citta` varchar(255) DEFAULT NULL,
  `Indirizzo` varchar(255) DEFAULT NULL,
  `Nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `luogo`
--

INSERT INTO `luogo` (`ID`, `Citta`, `Indirizzo`, `Nome`) VALUES
(1, 'Milano', 'Via Filodrammatici, 2', 'Teatro alla Scala'),
(2, 'Napoli', 'Via Brombeis, 5', 'Teatro di San Carlo'),
(3, 'Roma', 'Via del Teatro, 4', 'Teatro Argentina'),
(4, 'Cremona', 'Corso Vittorio Emanuele II,', 'Teatro Ponchielli'),
(5, 'Lecce', 'Via XXV Luglio, 30', 'Teatro Politeama Greco');

-- --------------------------------------------------------

--
-- Struttura della tabella `opera`
--

CREATE TABLE `opera` (
  `ID` int(11) NOT NULL,
  `Titolo` varchar(255) DEFAULT NULL,
  `Autore` varchar(255) DEFAULT NULL,
  `Descrizione` varchar(255) DEFAULT NULL,
  `Copertina` varchar(255) DEFAULT NULL,
  `Costo_biglietto` float DEFAULT NULL,
  `Incasso_totale` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `opera`
--

INSERT INTO `opera` (`ID`, `Titolo`, `Autore`, `Descrizione`, `Copertina`, `Costo_biglietto`, `Incasso_totale`) VALUES
(0, 'Amleto', 'Shakespeare', 'Amleto è una delle opere drammaturgiche più famose al mondo', 'https://4.bp.blogspot.com/-ZBtMMrx5uY4/VucJexf_NDI/AAAAAAAABXQ/-isK1SlxkcA90MU7fI39TBkjBF4D74pUw/s1600/52bf5d93c7a84395e13ba8fd3f368802.jpg', 150, 600),
(1, 'Gli uccelli', 'Aristofane', 'Gli uccelli viene oggi considerata un\'opera di evasione', 'https://img.ibs.it/images/9788832502848_0_0_626_75.jpg', 25, 25),
(2, 'Tartuffo', 'Molière', 'Satira nei confronti della società nobile francese del 1600. Il Tartuffo è infatti l\'emblema dell\'ipocrita che vive sotto la maschera della devozione religiosa e dell\'amicizia verso Orgone ma in realtà vuole approfittare della sua fiducia per trarne vanta', 'https://images-na.ssl-images-amazon.com/images/I/51Nprm36xbL._SX303_BO1,204,203,200_.jpg', 30, 60),
(3, 'Le beatrici', 'Stefano Benni', 'Realizzata dallo scrittore,giornalista e poeta italiano contemporaneo : Stefano Benni', 'https://m.feltrinellieditore.it/media/copertina/quarta/12/9788807018312_quarta.jpg.444x698_q100_upscale.jpg', 70, 140),
(4, 'Aspettando Godot', 'Samuel Beckett', 'Aspettando Godot è un\'opera teatrale di Samuel Beckett.Dramma associato al cosiddetto teatro dell\'assurdo e costruito intorno alla condizione dell\'attesa', 'https://www.euroclub.it/copertineLarge/871905.gif', 100, 200);

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `User` varchar(255) NOT NULL,
  `ID_opera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`User`, `ID_opera`) VALUES
('GBR11', 3),
('GBR11', 4),
('MDP43C31', 3),
('MDP43C31', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `svolta`
--

CREATE TABLE `svolta` (
  `Luogo` int(11) NOT NULL,
  `Opera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `svolta`
--

INSERT INTO `svolta` (`Luogo`, `Opera`) VALUES
(1, 1),
(2, 2),
(3, 0),
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `CF` varchar(255) NOT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Cognome` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`CF`, `Nome`, `Cognome`, `Username`, `Password`) VALUES
('GBR11', 'Gabriele', 'Rapisarda', 'gabry', '$2y$10$DQirN2kON1uprPYdnZ4gm.hUI1YhYru.rq12m0779l7w.ItZZgWQO'),
('MDP43C31', 'Marco', 'DiProva', 'Marcus', '$2y$10$dppBfKWUqfYukt4HaUBwtODGvCiSydvNUHFCY4/3wdbqob6xENWfK'),
('PROVA123', 'Utente1', 'Utente1', 'User1', '$2y$10$fXQ0ZX3lTonEN3HwMDxsw.roj3QZuJapo5KSv3.nkiPSXIuUnKy0e');

-- --------------------------------------------------------

--
-- Struttura della tabella `visione`
--

CREATE TABLE `visione` (
  `User` varchar(255) NOT NULL,
  `Opera` int(11) NOT NULL,
  `Data` varchar(255) NOT NULL,
  `Ora` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `visione`
--

INSERT INTO `visione` (`User`, `Opera`, `Data`, `Ora`) VALUES
('GBR11', 0, '10-10-2021', '13-00'),
('GBR11', 1, '10-10-2021', '21-00'),
('GBR11', 2, '10-10-2021', '13-00'),
('GBR11', 4, '10-10-2021', '13-00'),
('GBR11', 4, '10-10-2021', '21-00'),
('MDP43C31', 0, '10-10-2021', '13-00'),
('MDP43C31', 3, '10-10-2021', '13-00'),
('MDP43C31', 3, '11-10-2021', '13-00'),
('PROVA123', 0, '10-10-2021', '13-00'),
('PROVA123', 0, '10-10-2021', '18-00'),
('PROVA123', 2, '10-10-2021', '18-00');

--
-- Trigger `visione`
--
DELIMITER $$
CREATE TRIGGER `aggiorna_incassototale_opera` AFTER INSERT ON `visione` FOR EACH ROW begin
if exists(select id from opera where id = new.Opera)
then
    update OPERA set Incasso_totale = Incasso_totale + Costo_biglietto
    where id = new.opera;
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `aggiorna_incassototale_opera2` AFTER DELETE ON `visione` FOR EACH ROW begin
if exists(select id from opera where id = old.Opera)
then
    update OPERA set Incasso_totale = Incasso_totale - Costo_biglietto
    where id = old.opera;
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `vista1`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `vista1` (
`Città` varchar(255)
,`Indirizzo` varchar(255)
,`Titolo_Opera` varchar(255)
,`Incasso_totale` float
);

-- --------------------------------------------------------

--
-- Struttura per vista `vista1`
--
DROP TABLE IF EXISTS `vista1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista1`  AS SELECT `l`.`Citta` AS `Città`, `l`.`Indirizzo` AS `Indirizzo`, `o`.`Titolo` AS `Titolo_Opera`, `o`.`Incasso_totale` AS `Incasso_totale` FROM ((`luogo` `l` join `svolta` `s` on(`l`.`ID` = `s`.`Luogo`)) join `opera` `o` on(`s`.`Opera` = `o`.`ID`)) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `luogo`
--
ALTER TABLE `luogo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `opera`
--
ALTER TABLE `opera`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`User`,`ID_opera`),
  ADD KEY `idx_usr1` (`User`),
  ADD KEY `idx_idop` (`ID_opera`);

--
-- Indici per le tabelle `svolta`
--
ALTER TABLE `svolta`
  ADD PRIMARY KEY (`Luogo`,`Opera`),
  ADD KEY `idx_ope` (`Opera`),
  ADD KEY `idx_luog` (`Luogo`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`CF`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indici per le tabelle `visione`
--
ALTER TABLE `visione`
  ADD PRIMARY KEY (`User`,`Opera`,`Data`,`Ora`),
  ADD KEY `idx_usr` (`User`),
  ADD KEY `idx_ope` (`Opera`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`User`) REFERENCES `user` (`CF`),
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`ID_opera`) REFERENCES `opera` (`ID`);

--
-- Limiti per la tabella `svolta`
--
ALTER TABLE `svolta`
  ADD CONSTRAINT `svolta_ibfk_1` FOREIGN KEY (`Opera`) REFERENCES `opera` (`ID`),
  ADD CONSTRAINT `svolta_ibfk_2` FOREIGN KEY (`Luogo`) REFERENCES `luogo` (`ID`);

--
-- Limiti per la tabella `visione`
--
ALTER TABLE `visione`
  ADD CONSTRAINT `visione_ibfk_1` FOREIGN KEY (`User`) REFERENCES `user` (`CF`),
  ADD CONSTRAINT `visione_ibfk_2` FOREIGN KEY (`Opera`) REFERENCES `opera` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
