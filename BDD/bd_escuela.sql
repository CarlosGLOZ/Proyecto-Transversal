-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2022 a las 12:30:38
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curs`
--
CREATE DATABASE IF NOT EXISTS `curs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `curs`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_alumne`
--

CREATE TABLE `tbl_alumne` (
  `id_alumne` int(10) NOT NULL,
  `dni_alu` varchar(9) DEFAULT NULL,
  `nom_alu` varchar(20) NOT NULL,
  `cognoms_alu` varchar(60) DEFAULT NULL,
  `telf_alu` varchar(9) DEFAULT NULL,
  `email_alu` varchar(50) DEFAULT NULL,
  `classe` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_alumne`
--

INSERT INTO `tbl_alumne` (`id_alumne`, `dni_alu`, `nom_alu`, `cognoms_alu`, `telf_alu`, `email_alu`, `classe`) VALUES
(51, 'PZHDSPYZ2', 'AS', 'Kegley', '12332', 'lkegley15@tiny.cc', 4),
(81, '14877344Q', 'Kelwin', 'Gopsell', '343973649', 'kgopsell0@indiegogo.com', 3),
(82, '27278144U', 'Joelle', 'Algy', '974133402', 'jalgy1@google.co.jp', 4),
(83, '83666437M', 'Chan', 'Cafe', '481064887', 'ccafe2@umich.edu', 3),
(84, '23913667L', 'Rosalie', 'Egdal', '583823443', 'regdal3@netlog.com', 4),
(85, '10065947G', 'Alexis', 'Moxstead', '717760288', 'amoxstead4@weather.com', 2),
(86, '59067077V', 'Loria', 'Dmych', '150418269', 'ldmych5@nsw.gov.au', 2),
(87, '90307983L', 'Mariska', 'Cohrs', '244046412', 'mcohrs6@xing.com', 4),
(88, '50615278Y', 'Florie', 'Garrat', '974053892', 'fgarrat7@shinystat.com', 5),
(89, '23119465X', 'Chip', 'Paynter', '352204721', 'cpaynter8@theatlantic.com', 2),
(90, '49291306K', 'Billy', 'Baudasso', '175676533', 'bbaudasso9@unicef.org', 5),
(91, '77106133E', 'Davon', 'Penzer', '804164490', 'dpenzera@google.cn', 2),
(92, '57161369O', 'Ephrem', 'de la Tremoille', '717707097', 'edelatremoilleb@microsoft.com', 2),
(93, '79062449F', 'Whitney', 'Satterfitt', '136954943', 'wsatterfittc@google.it', 3),
(94, '79573902K', 'Max', 'Kemsley', '357731844', 'mkemsleyd@earthlink.net', 5),
(95, '92035225D', 'Livy', 'Stote', '923094196', 'lstotee@networksolutions.com', 4),
(96, '25460653A', 'Sonny', 'Kupker', '918011285', 'skupkerf@vistaprint.com', 2),
(97, '40871685F', 'Elia', 'McCallam', '656296417', 'emccallamg@nature.com', 2),
(98, '80111847S', 'Bryon', 'Flori', '682956518', 'bflorih@list-manage.com', 2),
(99, '21403741K', 'Zsazsa', 'Gomm', '637078050', 'zgommi@newsvine.com', 3),
(100, '74296487J', 'Valdemar', 'Janauschek', '387371204', 'vjanauschekj@wunderground.com', 5),
(101, '82894451Y', 'Fay', 'Zellner', '063694078', 'fzellnerk@live.com', 4),
(102, '69437521S', 'Denny', 'Rooksby', '142664612', 'drooksbyl@last.fm', 2),
(103, '02710803X', 'Bev', 'Folca', '441972746', 'bfolcam@intel.com', 3),
(104, '32126973I', 'Darell', 'Rivilis', '250447779', 'drivilisn@tinypic.com', 4),
(105, '38660516G', 'Tedda', 'Dowden', '805796856', 'tdowdeno@liveinternet.ru', 3),
(106, '79683016U', 'Wyn', 'Ethridge', '294094332', 'wethridgep@ning.com', 4),
(107, '10912426P', 'Fonz', 'Cestard', '743171316', 'fcestardq@sciencedirect.com', 2),
(108, '08656032H', 'Carmon', 'Pattillo', '281623508', 'cpattillor@cbslocal.com', 3),
(109, '92531505V', 'Wyatan', 'Wycliffe', '402805987', 'wwycliffes@t.co', 5),
(110, '67578328U', 'Lyndy', 'Gillian', '135885638', 'lgilliant@cnbc.com', 2),
(111, '33966033J', 'Finlay', 'Gallaher', '966177620', 'fgallaheru@merriam-webster.com', 2),
(112, '12248397N', 'Lauralee', 'Morewood', '125878132', 'lmorewoodv@google.cn', 2),
(113, '54285969B', 'Allis', 'Wilcock', '107099098', 'awilcockw@ftc.gov', 5),
(114, '57648893J', 'Neala', 'Kohn', '096547828', 'nkohnx@guardian.co.uk', 2),
(115, '99787066F', 'Monique', 'Eastup', '217287739', 'meastupy@weebly.com', 5),
(116, '22952709Z', 'Adrien', 'Woodall', '809913357', 'awoodallz@wikispaces.com', 4),
(117, '64589090K', 'Camey', 'Giovannacci', '378235594', 'cgiovannacci10@smh.com.au', 2),
(118, '52677013I', 'Arlyn', 'Ville', '379002620', 'aville11@si.edu', 4),
(119, '90773528E', 'Filia', 'Jado', '527324057', 'fjado12@opera.com', 3),
(120, '41447496P', 'Reynold', 'Paunsford', '831095378', 'rpaunsford13@vistaprint.com', 3),
(121, '52908021L', 'Maible', 'Harber', '537415736', 'mharber14@acquirethisname.com', 5),
(122, '25404163J', 'Norean', 'Lethby', '547846805', 'nlethby15@wikimedia.org', 4),
(123, '84866739X', 'Ricky', 'Heathcoat', '021453768', 'rheathcoat16@wordpress.org', 4),
(124, '18379827G', 'Robinette', 'Landes', '823460639', 'rlandes17@sakura.ne.jp', 5),
(125, '26920934T', 'Blair', 'Jeffries', '365078224', 'bjeffries18@senate.gov', 4),
(126, '07713372H', 'Fabe', 'MacNally', '850262777', 'fmacnally19@rambler.ru', 3),
(127, '53991473O', 'Clevie', 'Deadman', '591275313', 'cdeadman1a@vkontakte.ru', 2),
(128, '24169911Z', 'Merissa', 'Bywaters', '966265881', 'mbywaters1b@elegantthemes.com', 4),
(129, '51072869O', 'Kimberli', 'Brooker', '092978710', 'kbrooker1c@fastcompany.com', 3),
(130, '83758964N', 'Ginni', 'St Pierre', '346849797', 'gstpierre1d@smh.com.au', 2),
(131, '51177823M', 'Cristal', 'Chafer', '860516399', 'cchafer1e@360.cn', 4),
(132, '37309234I', 'Ethelda', 'Ackwood', '493772684', 'eackwood1f@walmart.com', 2),
(133, '45915350T', 'Flori', 'Chartman', '341162441', 'fchartman1g@miitbeian.gov.cn', 3),
(134, '71559005V', 'Welch', 'Witul', '765424056', 'wwitul1h@amazonaws.com', 5),
(135, '75254252A', 'Felizio', 'Scalera', '223413847', 'fscalera1i@mit.edu', 5),
(136, '23977535O', 'Sebastiano', 'Lilloe', '286437531', 'slilloe1j@usnews.com', 2),
(137, '63741375R', 'Katie', 'Dumini', '194824936', 'kdumini1k@odnoklassniki.ru', 2),
(138, '11664553R', 'Gabriellia', 'Swigger', '058029235', 'gswigger1l@moonfruit.com', 4),
(139, '90727659X', 'Claudina', 'McGarvie', '816004455', 'cmcgarvie1m@webmd.com', 4),
(140, '37331864A', 'Isabelle', 'Semerad', '812989516', 'isemerad1n@nasa.gov', 4),
(141, '41752933D', 'Fredia', 'Wrathmell', '275992986', 'fwrathmell1o@jiathis.com', 5),
(142, '59395396F', 'Bartram', 'Raithby', '320116935', 'braithby1p@independent.co.uk', 3),
(143, '29994202C', 'Marmaduke', 'Carthew', '219174194', 'mcarthew1q@yandex.ru', 3),
(144, '66816144I', 'Christie', 'Richemont', '520956841', 'crichemont1r@tripod.com', 4),
(145, '68289144Q', 'Wendall', 'Sherrum', '487099551', 'wsherrum1s@bbb.org', 3),
(146, '09719630M', 'Fidelity', 'Wadforth', '473569239', 'fwadforth1t@answers.com', 3),
(147, '91507632I', 'Venus', 'Nilles', '602659767', 'vnilles1u@parallels.com', 2),
(148, '04521864M', 'Berte', 'Faucett', '723770158', 'bfaucett1v@bing.com', 5),
(149, '20875971T', 'Franciska', 'Yabsley', '777389218', 'fyabsley1w@de.vu', 2),
(150, '42012642L', 'Griffy', 'Castanie', '914328498', 'gcastanie1x@google.co.uk', 3),
(151, '01889373C', 'Devon', 'Gynne', '501320156', 'dgynne1y@ycombinator.com', 5),
(152, '92804680U', 'Kimberley', 'Fissenden', '851638220', 'kfissenden1z@zimbio.com', 4),
(153, '76541545D', 'Andee', 'Trayes', '303452565', 'atrayes20@time.com', 4),
(154, '51743550D', 'Farlee', 'MacAllan', '662015506', 'fmacallan21@foxnews.com', 2),
(155, '41215765M', 'Karalee', 'Pregel', '748778148', 'kpregel22@hexun.com', 2),
(156, '27445982S', 'Any', 'Rigmond', '654088999', 'arigmond23@blog.com', 5),
(157, '78254896A', 'Jacky', 'Duxbarry', '609659763', 'jduxbarry24@fastcompany.com', 3),
(158, '10944340R', 'Helge', 'Ferretti', '117636827', 'hferretti25@statcounter.com', 5),
(159, '86285126M', 'Dionysus', 'Chanders', '009102540', 'dchanders26@freewebs.com', 5),
(160, '11921575O', 'Hinda', 'Frid', '714053578', 'hfrid27@trellian.com', 4),
(161, '41595661L', 'Auria', 'Dewis', '476009580', 'adewis28@ustream.tv', 5),
(162, '72671469O', 'Gery', 'Messier', '139511292', 'gmessier29@ebay.co.uk', 4),
(163, '58531333W', 'Cecilia', 'Lincoln', '341128830', 'clincoln2a@bbb.org', 3),
(164, '57766130I', 'Meggi', 'Antonijevic', '227583775', 'mantonijevic2b@com.com', 4),
(165, '13428685V', 'Shayla', 'Tregien', '820720645', 'stregien2c@businessweek.com', 4),
(166, '04730018G', 'Shermie', 'Brinson', '343550536', 'sbrinson2d@so-net.ne.jp', 4),
(167, '28120138I', 'Danya', 'Davidovsky', '842480114', 'ddavidovsky2e@jalbum.net', 5),
(168, '78231517F', 'Ewan', 'Tyzack', '181199428', 'etyzack2f@blogspot.com', 5),
(169, '89507272P', 'Shermy', 'Yggo', '445847307', 'syggo2g@redcross.org', 4),
(170, '65870245J', 'Gradey', 'Stubbington', '012273511', 'gstubbington2h@noaa.gov', 2),
(171, '60075582X', 'Johnnie', 'Fear', '340354087', 'jfear2i@va.gov', 2),
(172, '38253180Z', 'Meara', 'Drioli', '570328286', 'mdrioli2j@google.com.hk', 2),
(173, '43556754Q', 'Fannie', 'Smidmore', '007596944', 'fsmidmore2k@amazon.co.jp', 4),
(174, '47204786T', 'Doretta', 'Barth', '674094152', 'dbarth2l@scientificamerican.com', 4),
(175, '06428402S', 'Mari', 'Gockeler', '684639467', 'mgockeler2m@ow.ly', 2),
(176, '72482199T', 'Krissy', 'Presser', '447041733', 'kpresser2n@mlb.com', 5),
(177, '64458124K', 'Tommy', 'Pletts', '818829141', 'tpletts2o@patch.com', 2),
(178, '97567841Y', 'Paulina', 'Wind', '280306237', 'pwind2p@statcounter.com', 5),
(179, '87981320F', 'Koo', 'Mungin', '944961568', 'kmungin2q@networksolutions.com', 3),
(180, '81559328I', 'Gaylene', 'Goodere', '267522501', 'ggoodere2r@xinhuanet.com', 4),
(181, '33654439V', 'Cher', 'Butt', '327640741', 'cbutt0@goo.gl', 5),
(182, '11768850E', 'Edita', 'Cuncarr', '231847538', 'ecuncarr1@cbslocal.com', 3),
(183, '72953508F', 'Cherida', 'Shyre', '637640725', 'cshyre2@istockphoto.com', 2),
(184, '83567699T', 'Harris', 'Southcott', '863656105', 'hsouthcott3@webnode.com', 2),
(185, '95020696P', 'Celina', 'Timeby', '209018720', 'ctimeby4@google.com.au', 3),
(186, '96582675F', 'Gerek', 'Totterdell', '421558416', 'gtotterdell5@whitehouse.gov', 5),
(187, '31543385U', 'Claudia', 'Eglington', '741708345', 'ceglington6@chicagotribune.com', 2),
(188, '21835119Q', 'Mike', 'Manus', '604888546', 'mmanus7@digg.com', 3),
(189, '92451560Y', 'Erena', 'Fish', '590753603', 'efish8@delicious.com', 2),
(190, '59656548K', 'Allissa', 'Pegler', '848291981', 'apegler9@dion.ne.jp', 4),
(191, '81799967J', 'Holmes', 'Mapis', '732619812', 'hmapisa@netscape.com', 5),
(192, '52783647D', 'Conni', 'Jandac', '876813855', 'cjandacb@npr.org', 5),
(193, '17351803K', 'Eleen', 'Hurche', '134639208', 'ehurchec@over-blog.com', 3),
(194, '12905837V', 'Hyacinthe', 'Lutzmann', '300542277', 'hlutzmannd@nps.gov', 5),
(195, '01399669I', 'Randi', 'Hamlin', '659109026', 'rhamline@spiegel.de', 3),
(196, '32261529A', 'Jaquelyn', 'Baxstar', '287642081', 'jbaxstarf@drupal.org', 3),
(197, '92846574Q', 'Boycie', 'OHegertie', '560337612', 'bohegertieg@hud.gov', 4),
(198, '22771958X', 'Maure', 'Slimm', '970520403', 'mslimmh@furl.net', 2),
(199, '55608704X', 'Dene', 'Driutti', '065485168', 'ddriuttii@google.com.br', 5),
(200, '37371014U', 'Eddy', 'Brough', '288985323', 'ebroughj@networksolutions.com', 4),
(201, '83240460R', 'Allsun', 'Sailor', '352372247', 'asailork@hostgator.com', 3),
(202, '14757272K', 'Decca', 'Flobert', '490310955', 'dflobertl@ow.ly', 3),
(203, '87659934Q', 'Dareen', 'Domenichelli', '865153712', 'ddomenichellim@springer.com', 4),
(204, '00851140M', 'Suki', 'Macbeth', '637058327', 'smacbethn@aol.com', 3),
(205, '61984918A', 'Phaidra', 'De Bernardis', '608355540', 'pdebernardiso@cam.ac.uk', 4),
(206, '77417514Q', 'Raviv', 'Lafflina', '039323076', 'rlafflinap@yolasite.com', 4),
(207, '74369671M', 'Gunter', 'Auchterlonie', '067001671', 'gauchterlonieq@tamu.edu', 5),
(208, '95403359E', 'Gabey', 'Dendle', '926411101', 'gdendler@redcross.org', 5),
(209, '16607114Q', 'Jessalin', 'Alwell', '665795935', 'jalwells@hhs.gov', 2),
(210, '10353745G', 'Tamma', 'MacAne', '975589127', 'tmacanet@unc.edu', 5),
(211, '61639474Q', 'Ebba', 'Hrinchenko', '745058221', 'ehrinchenkou@homestead.com', 4),
(212, '98172031S', 'Abagael', 'Sesser', '003675125', 'asesserv@ucoz.com', 4),
(213, '68873840A', 'Lola', 'Fakeley', '689522665', 'lfakeleyw@blog.com', 2),
(214, '46808860L', 'Ilyse', 'Ambler', '305482782', 'iamblerx@sohu.com', 4),
(215, '00128165C', 'Reinaldo', 'Holliar', '659066498', 'rholliary@twitter.com', 3),
(216, '32459612R', 'Louie', 'Cumpton', '059990694', 'lcumptonz@qq.com', 2),
(217, '75184055D', 'Annabal', 'Hunnywell', '559488882', 'ahunnywell10@pagesperso-orange.fr', 3),
(218, '74923742T', 'Tiler', 'Nockles', '598274751', 'tnockles11@jugem.jp', 4),
(219, '15727210N', 'Nobie', 'Dukesbury', '505454225', 'ndukesbury12@answers.com', 4),
(220, '41228492Z', 'Shari', 'Beeden', '362806126', 'sbeeden13@fotki.com', 5),
(221, '94758128Y', 'Joela', 'Motherwell', '851029299', 'jmotherwell14@nature.com', 5),
(222, '05765990T', 'Valle', 'Yurchenko', '552409016', 'vyurchenko15@gravatar.com', 5),
(223, '69827391K', 'Griffith', 'Peppard', '713250399', 'gpeppard16@ucla.edu', 4),
(224, '87437658Q', 'Arlinda', 'Aird', '362297956', 'aaird17@com.com', 2),
(225, '52412154Q', 'Vannie', 'Williamson', '140283229', 'vwilliamson18@arizona.edu', 2),
(226, '07847152Z', 'Clifford', 'Gifford', '334383536', 'cgifford19@is.gd', 4),
(227, '85711354S', 'Gratia', 'Gotthard.sf', '585080597', 'ggotthardsf1a@stanford.edu', 5),
(228, '53898836I', 'Sampson', 'Cookes', '529283301', 'scookes1b@multiply.com', 2),
(229, '79206390G', 'Hubey', 'Gundrey', '933319891', 'hgundrey1c@vk.com', 2),
(230, '94274152L', 'Hillard', 'Paskell', '481385107', 'hpaskell1d@myspace.com', 3),
(231, '03217589G', 'Carla', 'Winn', '396419547', 'cwinn1e@sina.com.cn', 5),
(232, '66228751V', 'Yvon', 'Nano', '807800365', 'ynano1f@edublogs.org', 2),
(233, '87376488M', 'Meg', 'Lote', '979251229', 'mlote1g@toplist.cz', 3),
(234, '99110068M', 'Devlin', 'Drust', '574375007', 'ddrust1h@ow.ly', 4),
(235, '63955543F', 'Letizia', 'Lissenden', '604071644', 'llissenden1i@google.de', 5),
(236, '21151526U', 'Sher', 'Cowles', '673364407', 'scowles1j@army.mil', 2),
(237, '27614654L', 'Persis', 'Woodroffe', '098828688', 'pwoodroffe1k@cdbaby.com', 3),
(238, '02568992B', 'Shawnee', 'Meakes', '034908609', 'smeakes1l@unesco.org', 4),
(239, '71439585A', 'Briney', 'Lambkin', '828878713', 'blambkin1m@shop-pro.jp', 3),
(240, '05429887N', 'Doralyn', 'Crummay', '322052939', 'dcrummay1n@jalbum.net', 3),
(241, '44063751R', 'Ali', 'Wasteney', '678881616', 'awasteney1o@examiner.com', 4),
(242, '38565723K', 'Lavina', 'Loreit', '037712216', 'lloreit1p@ycombinator.com', 2),
(243, '29908296E', 'Mead', 'Benet', '582288209', 'mbenet1q@kickstarter.com', 5),
(244, '33945301I', 'Brion', 'Trobey', '643130092', 'btrobey1r@lycos.com', 3),
(245, '14117432L', 'Alexandre', 'Norvill', '314520847', 'anorvill1s@1und1.de', 2),
(246, '90141571R', 'Sigismondo', 'Colenutt', '692119813', 'scolenutt1t@istockphoto.com', 2),
(247, '72459810T', 'Leonard', 'Cahen', '531731075', 'lcahen1u@nature.com', 4),
(248, '54778170K', 'Dillon', 'Cronin', '834391654', 'dcronin1v@icio.us', 5),
(249, '57403181Y', 'Cinda', 'Lobell', '763162285', 'clobell1w@skyrock.com', 3),
(250, '66633961H', 'Ezmeralda', 'Relfe', '479223136', 'erelfe1x@moonfruit.com', 2),
(251, '52136874Z', 'Thedric', 'Agutter', '732419553', 'tagutter1y@eventbrite.com', 2),
(252, '63725238K', 'Fitz', 'Jandac', '835920351', 'fjandac1z@princeton.edu', 3),
(253, '96572856L', 'Ediva', 'Frankton', '413768237', 'efrankton20@nifty.com', 4),
(254, '89940250I', 'Lynnett', 'MacParlan', '068600196', 'lmacparlan21@cbc.ca', 5),
(255, '00773791N', 'Andie', 'Redborn', '648203400', 'aredborn22@cnbc.com', 3),
(256, '97783483F', 'Meier', 'Fearns', '058189169', 'mfearns23@theatlantic.com', 3),
(257, '42068286L', 'Aprilette', 'Tenney', '731169636', 'atenney24@ft.com', 5),
(258, '72237108G', 'Gibb', 'Justun', '257096678', 'gjustun25@ifeng.com', 2),
(259, '30458454W', 'Aubine', 'Patroni', '523171837', 'apatroni26@marketwatch.com', 2),
(260, '70414859G', 'Emyle', 'Shillam', '110729595', 'eshillam27@narod.ru', 5),
(261, '87721738O', 'Neale', 'Mayhead', '613839464', 'nmayhead28@flavors.me', 4),
(262, '07896735Q', 'Shurlock', 'Goom', '499420294', 'sgoom29@opensource.org', 4),
(263, '82438173G', 'Rhonda', 'Trewett', '783944613', 'rtrewett2a@businesswire.com', 5),
(264, '44239166K', 'Barny', 'Merrick', '293024486', 'bmerrick2b@alibaba.com', 4),
(265, '37556943B', 'Brodie', 'Shaughnessy', '753437724', 'bshaughnessy2c@geocities.com', 3),
(266, '74727070M', 'Gayler', 'Ebenezer', '120075535', 'gebenezer2d@fotki.com', 2),
(267, '85246380I', 'Reiko', 'Groundwator', '471854128', 'rgroundwator2e@answers.com', 5),
(268, '53402175F', 'Terza', 'Dubery', '952449933', 'tdubery2f@goo.gl', 5),
(269, '35622447C', 'Almeria', 'Blackborow', '010053068', 'ablackborow2g@mac.com', 2),
(270, '40612466L', 'Nick', 'Rustan', '573213152', 'nrustan2h@cdbaby.com', 5),
(271, '29696730Q', 'Ophelie', 'Camplin', '762777568', 'ocamplin2i@chron.com', 3),
(272, '94300025Q', 'Malissa', 'Dax', '603280672', 'mdax2j@howstuffworks.com', 2),
(273, '62007663E', 'Mersey', 'Middiff', '968702993', 'mmiddiff2k@1und1.de', 5),
(274, '82244261L', 'Letitia', 'Rishworth', '068345811', 'lrishworth2l@aboutads.info', 5),
(275, '74860334P', 'Barny', 'Moores', '817269492', 'bmoores2m@gov.uk', 5),
(276, '62444006L', 'Loy', 'Tirte', '299870264', 'ltirte2n@wix.com', 5),
(277, '05685020Y', 'Leora', 'Grummitt', '295335404', 'lgrummitt2o@sciencedirect.com', 5),
(278, '92854873Q', 'Jerome', 'Mumbey', '337079810', 'jmumbey2p@vkontakte.ru', 3),
(279, '76702121I', 'Jamie', 'Sherme', '601378542', 'jsherme2q@scribd.com', 2),
(280, '77529892F', 'Mavra', 'Nibley', '137531985', 'mnibley2r@devhub.com', 4),
(281, '65219379Z', 'Alvie', 'Badsey', '721737062', 'abadsey0@soup.io', 4),
(282, '36377245N', 'Floris', 'Bulstrode', '663259884', 'fbulstrode1@skyrock.com', 4),
(283, '25040722Y', 'Julia', 'Bett', '681259928', 'jbett2@etsy.com', 4),
(284, '34097988D', 'Charissa', 'Pillinger', '667074030', 'cpillinger3@businesswire.com', 5),
(285, '98994882J', 'Forster', 'Saynor', '771793782', 'fsaynor4@mac.com', 4),
(286, '91823375G', 'Lethia', 'Starford', '030588348', 'lstarford5@hostgator.com', 5),
(287, '94856293U', 'Fidelity', 'Pauleau', '644057964', 'fpauleau6@buzzfeed.com', 2),
(288, '08547144T', 'Ailee', 'Perks', '822240474', 'aperks7@latimes.com', 3),
(289, '65081721F', 'Emery', 'Draper', '175572297', 'edraper8@i2i.jp', 2),
(290, '67668288V', 'Kristien', 'Ipgrave', '556427766', 'kipgrave9@blogspot.com', 2),
(291, '42536716X', 'Tania', 'Laming', '852336684', 'tlaminga@ox.ac.uk', 4),
(292, '87827827P', 'Eustace', 'Glasspool', '368268062', 'eglasspoolb@fda.gov', 4),
(293, '96159804Z', 'Emory', 'Spensley', '840367505', 'espensleyc@addthis.com', 3),
(294, '08623455K', 'Shirlene', 'Freke', '225957785', 'sfreked@army.mil', 4),
(295, '68968268A', 'Robinett', 'Pittoli', '025192977', 'rpittolie@weibo.com', 3),
(296, '58602060T', 'Nicko', 'Martel', '982610239', 'nmartelf@cdbaby.com', 2),
(297, '30254578M', 'Karena', 'Chilvers', '129248963', 'kchilversg@tinypic.com', 3),
(298, '32734886J', 'Dinnie', 'Matthesius', '094596198', 'dmatthesiush@bloomberg.com', 3),
(299, '33960947D', 'Clive', 'Poundford', '326485500', 'cpoundfordi@whitehouse.gov', 3),
(300, '86125932E', 'Linnell', 'Peyto', '372336610', 'lpeytoj@csmonitor.com', 3),
(301, '33989325V', 'Flory', 'Forge', '528148948', 'fforgek@dyndns.org', 3),
(302, '40513576H', 'Marsh', 'Pennrington', '757307785', 'mpennringtonl@jalbum.net', 2),
(303, '44277987J', 'Neddy', 'Legge', '397154080', 'nleggem@prnewswire.com', 4),
(304, '46977229Y', 'Lexi', 'McCadden', '690219926', 'lmccaddenn@sakura.ne.jp', 4),
(305, '84496412D', 'Jareb', 'Bordiss', '222983052', 'jbordisso@about.com', 5),
(306, '82230863Y', 'Chere', 'Di Carlo', '051465483', 'cdicarlop@geocities.com', 5),
(307, '36446548Q', 'Grace', 'Sigfrid', '185539013', 'gsigfridq@nyu.edu', 4),
(308, '11535210K', 'Loraine', 'Persitt', '539609138', 'lpersittr@answers.com', 4),
(309, '47380207K', 'Melisa', 'Fairweather', '051608863', 'mfairweathers@webmd.com', 2),
(310, '84293154T', 'Marni', 'Chiverstone', '673881834', 'mchiverstonet@mlb.com', 3),
(311, '20833319R', 'Lewie', 'Baulk', '060619316', 'lbaulku@privacy.gov.au', 2),
(312, '45844212K', 'Nonna', 'Elmar', '039537523', 'nelmarv@aboutads.info', 5),
(313, '99581554Q', 'Madelena', 'Krout', '057904226', 'mkroutw@phoca.cz', 5),
(314, '42961700W', 'Rainer', 'Kynan', '293718521', 'rkynanx@princeton.edu', 4),
(315, '63742284I', 'Bennett', 'Kirby', '760204526', 'bkirbyy@plala.or.jp', 4),
(316, '79742394Q', 'Dena', 'Lowin', '429533259', 'dlowinz@myspace.com', 3),
(317, '82882314Q', 'Tudor', 'Hadgkiss', '318186363', 'thadgkiss10@pagesperso-orange.fr', 3),
(318, '57635243E', 'Pascal', 'McElree', '776130459', 'pmcelree11@phpbb.com', 4),
(319, '98737963F', 'Rees', 'McCandless', '511857024', 'rmccandless12@zimbio.com', 2),
(320, '53225556H', 'Frazer', 'Yarnton', '487661571', 'fyarnton13@msu.edu', 2),
(321, '41914680B', 'Sophie', 'Fishpond', '494294870', 'sfishpond14@people.com.cn', 3),
(322, '15649262N', 'Angel', 'Pargeter', '100628763', 'apargeter15@dagondesign.com', 5),
(323, '28146561T', 'Pacorro', 'Warlow', '932195808', 'pwarlow16@mysql.com', 4),
(324, '96352455R', 'Jayme', 'McConnulty', '367617401', 'jmcconnulty17@discuz.net', 3),
(325, '95067564H', 'Hugh', 'Paolinelli', '226449097', 'hpaolinelli18@bluehost.com', 3),
(326, '04208584J', 'Zara', 'Jude', '582552082', 'zjude19@squarespace.com', 2),
(327, '85636397Z', 'Davon', 'Buddington', '773699728', 'dbuddington1a@vinaora.com', 3),
(328, '49257097I', 'Lolly', 'Rocks', '049075964', 'lrocks1b@ibm.com', 2),
(329, '38860691W', 'Dee dee', 'Condon', '788469140', 'dcondon1c@freewebs.com', 5),
(330, '22995930U', 'Rosalinde', 'Betz', '244192533', 'rbetz1d@cbslocal.com', 3),
(331, '87441328J', 'Rycca', 'Whitesel', '067971343', 'rwhitesel1e@miibeian.gov.cn', 5),
(332, '68508992W', 'Roslyn', 'Bleythin', '551327851', 'rbleythin1f@shutterfly.com', 2),
(333, '10993767Q', 'Francesca', 'Benettolo', '507587491', 'fbenettolo1g@google.pl', 4),
(334, '68830067Y', 'Anton', 'Hastie', '109219091', 'ahastie1h@sohu.com', 4),
(335, '60717081G', 'Roseanne', 'Becarra', '921949825', 'rbecarra1i@multiply.com', 5),
(336, '95174162K', 'Eadmund', 'Spurdens', '714648082', 'espurdens1j@vkontakte.ru', 4),
(337, '49216336H', 'Sophronia', 'Crissil', '763106600', 'scrissil1k@unesco.org', 5),
(338, '71427145C', 'Avie', 'Brindle', '561324979', 'abrindle1l@google.nl', 5),
(339, '68145918V', 'Greg', 'Wadie', '780715040', 'gwadie1m@google.cn', 4),
(340, '72882707P', 'Ali', 'Langeley', '811740388', 'alangeley1n@lycos.com', 3),
(341, '09601204U', 'Twila', 'Riceards', '783856585', 'triceards1o@bluehost.com', 4),
(342, '57070134L', 'Othella', 'Pech', '731899658', 'opech1p@omniture.com', 5),
(343, '84729283F', 'Farrel', 'Goreisr', '202612494', 'fgoreisr1q@youtu.be', 3),
(344, '04208740E', 'Jessica', 'Freegard', '616535797', 'jfreegard1r@boston.com', 3),
(345, '73009929G', 'Charlene', 'Godleman', '552625997', 'cgodleman1s@virginia.edu', 4),
(346, '76284551O', 'Colas', 'Stockhill', '380442126', 'cstockhill1t@4shared.com', 3),
(347, '82867216P', 'Zorana', 'Bullick', '626835337', 'zbullick1u@xinhuanet.com', 4),
(348, '84393892Z', 'Tobey', 'Queenborough', '230447275', 'tqueenborough1v@discuz.net', 3),
(349, '54741280N', 'Josefa', 'Bains', '605202007', 'jbains1w@narod.ru', 2),
(350, '06849127V', 'Lyssa', 'Bartolozzi', '304435992', 'lbartolozzi1x@geocities.com', 4),
(351, '74433849M', 'Babb', 'Stiffell', '464210903', 'bstiffell1y@bloomberg.com', 4),
(352, '29377516Z', 'Glynn', 'Henden', '647302740', 'ghenden1z@rambler.ru', 3),
(353, '35697984L', 'Alic', 'Batte', '832287853', 'abatte20@1und1.de', 3),
(354, '04415172V', 'Anabel', 'McBlain', '585321876', 'amcblain21@seattletimes.com', 3),
(355, '11672678V', 'Marcelo', 'Cosgrave', '099260105', 'mcosgrave22@behance.net', 5),
(356, '67994314H', 'Brandais', 'Firebrace', '481121654', 'bfirebrace23@smh.com.au', 2),
(357, '91918826H', 'Demetre', 'Lashbrook', '803480944', 'dlashbrook24@cargocollective.com', 2),
(358, '32447587U', 'Yancy', 'Winfindine', '821885030', 'ywinfindine25@ifeng.com', 2),
(359, '54559960M', 'Alvinia', 'McKomb', '069023919', 'amckomb26@example.com', 4),
(360, '91382382E', 'Ker', 'Swan', '165031891', 'kswan27@imageshack.us', 5),
(361, '26250068J', 'Koressa', 'Elkin', '359414215', 'kelkin28@wired.com', 4),
(362, '29378471F', 'Tabitha', 'Roalfe', '702120299', 'troalfe29@bravesites.com', 2),
(363, '85864781A', 'Donavon', 'McCanny', '463346928', 'dmccanny2a@example.com', 4),
(364, '25786189K', 'Gearard', 'Kristof', '859490004', 'gkristof2b@multiply.com', 3),
(365, '79219150W', 'Johannes', 'Potteridge', '867385243', 'jpotteridge2c@histats.com', 3),
(366, '10935751V', 'Hillier', 'Fogden', '023911647', 'hfogden2d@wufoo.com', 2),
(367, '50707579Q', 'Keefer', 'Bedford', '862897266', 'kbedford2e@cbc.ca', 2),
(368, '82718775Q', 'Mortie', 'Lambart', '537850767', 'mlambart2f@wufoo.com', 4),
(369, '83855113B', 'Jan', 'Varns', '095333794', 'jvarns2g@infoseek.co.jp', 4),
(370, '12846270W', 'Angelina', 'Berston', '973508358', 'aberston2h@mashable.com', 4),
(371, '47243625E', 'Jackqueline', 'Ollier', '627413565', 'jollier2i@latimes.com', 3),
(372, '93578720Z', 'Raddie', 'Aronsohn', '795816176', 'raronsohn2j@blogger.com', 5),
(373, '43249292F', 'Norri', 'Palphreyman', '878298897', 'npalphreyman2k@nature.com', 5),
(374, '70545161C', 'Legra', 'Humbey', '648062143', 'lhumbey2l@bigcartel.com', 3),
(375, '96069709J', 'Kara', 'Lunam', '074879316', 'klunam2m@fastcompany.com', 2),
(376, '87348143A', 'Kurt', 'Brealey', '527518960', 'kbrealey2n@simplemachines.org', 5),
(377, '17072306L', 'Yevette', 'Stilldale', '313142748', 'ystilldale2o@sohu.com', 4),
(378, '50604190N', 'Gibbie', 'Thomasen', '821694170', 'gthomasen2p@deviantart.com', 4),
(379, '26049764Z', 'Geri', 'Anelay', '553561820', 'ganelay2q@canalblog.com', 4),
(380, '04893198X', 'Carmen', 'Abramchik', '152075027', 'cabramchik2r@biblegateway.com', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_classe`
--

CREATE TABLE `tbl_classe` (
  `id_classe` int(5) NOT NULL,
  `codi_classe` varchar(5) NOT NULL,
  `nom_classe` varchar(50) DEFAULT NULL,
  `tutor` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_classe`
--

INSERT INTO `tbl_classe` (`id_classe`, `codi_classe`, `nom_classe`, `tutor`) VALUES
(2, 'ASIX1', 'Administración de sistemas 1', NULL),
(3, 'ASIX2', 'Administración de sistemas 2', NULL),
(4, 'SMX1', 'Sistemas microinformáticos 1', NULL),
(5, 'EAS1', 'Educación deportiva 1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dept`
--

CREATE TABLE `tbl_dept` (
  `id_dept` int(5) NOT NULL,
  `codi_dept` varchar(5) NOT NULL,
  `nom_dept` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_dept`
--

INSERT INTO `tbl_dept` (`id_dept`, `codi_dept`, `nom_dept`) VALUES
(1, 'INF', 'Informática'),
(2, 'DEP', 'Deportes'),
(3, 'ENF', 'Enfermería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_professor`
--

CREATE TABLE `tbl_professor` (
  `id_professor` int(5) NOT NULL,
  `nom_prof` varchar(20) NOT NULL,
  `cognoms_prof` varchar(60) NOT NULL,
  `email_prof` varchar(50) DEFAULT NULL,
  `telf` varchar(9) DEFAULT NULL,
  `dept` int(5) NOT NULL,
  `contra` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_professor`
--

INSERT INTO `tbl_professor` (`id_professor`, `nom_prof`, `cognoms_prof`, `email_prof`, `telf`, `dept`, `contra`, `admin`) VALUES
(18, 'Gerard', 'Orobitg', 'geradorobitg@fje.edu', '676231222', 2, '401c53225073e49ad5cdeb11fc25a9ffb76257a8', 0),
(21, 'Sergio', 'Jiménez', 'sergiojimenez@fje.edu', '686782311', 1, '401c53225073e49ad5cdeb11fc25a9ffb76257a8', 0),
(22, 'Agnés', 'Plans', 'aplans@fje.edu', '686788899', 3, '401c53225073e49ad5cdeb11fc25a9ffb76257a8', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_alumne`
--
ALTER TABLE `tbl_alumne`
  ADD PRIMARY KEY (`id_alumne`),
  ADD KEY `alumne_classe_fk` (`classe`);

--
-- Indices de la tabla `tbl_classe`
--
ALTER TABLE `tbl_classe`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `tbl_classe_ibfk_1` (`tutor`);

--
-- Indices de la tabla `tbl_dept`
--
ALTER TABLE `tbl_dept`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indices de la tabla `tbl_professor`
--
ALTER TABLE `tbl_professor`
  ADD PRIMARY KEY (`id_professor`),
  ADD KEY `prof_dept_fk` (`dept`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_alumne`
--
ALTER TABLE `tbl_alumne`
  MODIFY `id_alumne` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=381;

--
-- AUTO_INCREMENT de la tabla `tbl_classe`
--
ALTER TABLE `tbl_classe`
  MODIFY `id_classe` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_dept`
--
ALTER TABLE `tbl_dept`
  MODIFY `id_dept` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_professor`
--
ALTER TABLE `tbl_professor`
  MODIFY `id_professor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_alumne`
--
ALTER TABLE `tbl_alumne`
  ADD CONSTRAINT `alumne_classe_fk` FOREIGN KEY (`classe`) REFERENCES `tbl_classe` (`id_classe`);

--
-- Filtros para la tabla `tbl_classe`
--
ALTER TABLE `tbl_classe`
  ADD CONSTRAINT `tbl_classe_ibfk_1` FOREIGN KEY (`tutor`) REFERENCES `tbl_professor` (`id_professor`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_professor`
--
ALTER TABLE `tbl_professor`
  ADD CONSTRAINT `prof_dept_fk` FOREIGN KEY (`dept`) REFERENCES `tbl_dept` (`id_dept`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
