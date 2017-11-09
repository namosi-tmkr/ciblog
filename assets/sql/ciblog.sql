-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 05:32 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `created_at`) VALUES
(0, 1, 'a. (none)', '2017-11-02 08:44:40'),
(4, 1, 'Business', '2017-10-31 08:14:58'),
(5, 1, 'Technology', '2017-10-31 08:15:06'),
(6, 1, 'Social', '2017-10-31 08:15:22'),
(7, 2, 'Food', '2017-10-31 08:15:55'),
(8, 10, 'games', '2017-11-01 10:30:23'),
(9, 2, 'beauty', '2017-11-02 08:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `body`, `created_at`) VALUES
(11, 18, 'Namosi Tamrakar', 'namosi.tamrakar@gmail.com', '<p>great info. thanks</p>\r\n', '2017-11-01 10:20:35'),
(12, 18, 'jack sparrow', 'jack@caribbean.com', '<p>aye thanks</p>\r\n', '2017-11-01 10:21:06'),
(13, 23, 'Gagan Pradhan', 'gagan@gmail.com', '<p>aeee esto po</p>\r\n', '2017-11-01 10:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'normal user', ''),
(2, 'admin', '{\r\n\"admin\" : 1\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `user_id`, `title`, `slug`, `body`, `post_image`, `created_at`) VALUES
(18, 7, 10, 'sushi', 'sushi', '<p><strong>Sushi</strong> (??, ??, ?) is the <a href=\"https://en.wikipedia.org/wiki/Japanese_cuisine\">Japanese</a> preparation and serving of specially prepared vinegared rice (?? <em>sushi-meshi</em>) combined with varied ingredients (?? <em>neta</em>) such as chiefly seafood (often uncooked), vegetables, and occasionally <a href=\"https://en.wikipedia.org/wiki/Tropical_fruit\">tropical fruits</a>. Styles of sushi and its presentation vary widely, but the key ingredient is sushi rice, also referred to as <em>shari</em> (???), or <em>sumeshi</em> (??).</p>\r\n\r\n<p>Sushi can be prepared with either <a href=\"https://en.wikipedia.org/wiki/Brown_rice\">brown</a> or <a href=\"https://en.wikipedia.org/wiki/White_rice\">white rice</a>. It is often prepared with raw seafood, but some varieties of sushi use cooked ingredients, and many other are <a href=\"https://en.wikipedia.org/wiki/Vegetarian\">vegetarian</a>. Sushi is often served with <a href=\"https://en.wikipedia.org/wiki/Gari_%28ginger%29\">pickled ginger</a>, <a href=\"https://en.wikipedia.org/wiki/Wasabi\">wasabi</a>, and <a href=\"https://en.wikipedia.org/wiki/Soy_sauce\">soy sauce</a>. <a href=\"https://en.wikipedia.org/wiki/Daikon\">Daikon</a> radish is popular as a garnish.</p>\r\n\r\n<p>Sushi is often confused with <a href=\"https://en.wikipedia.org/wiki/Sashimi\">sashimi</a>, a related Japanese dish consisting of thinly sliced raw fish or occasionally meat, and an optional serving of rice.</p>\r\n', '20171101040505_sushiqweqwe.jpg', '2017-11-01 10:20:05'),
(19, 8, 10, 'Dota 2: The most-played game on Steam.', 'Dota-2-The-most-played-game-on-Steam', '<p>Every day, millions of players worldwide enter battle as one of over a hundred Dota heroes. And no matter if it&#39;s their 10th hour of play or 1,000th, there&#39;s always something new to discover. With regular updates that ensure a constant evolution of gameplay, features, and heroes, Dota 2 has truly taken on a life of its own.</p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h3>&nbsp;</h3>\r\n', '20171101041821_dota2rocks.jpg', '2017-11-01 10:33:21'),
(20, 7, 2, 'Mo:Mo - Food of Nepal', 'MoMo-Food-of-Nepal', '<p>Momo is a type of steamed dumpling with some form of filling. Momo has become a traditional delicacy in Nepal, Tibet and among Nepalese/Tibetan communities in <a href=\"https://en.wikipedia.org/wiki/Bhutan\">Bhutan</a>, as well as Nepali people of <a href=\"https://en.wikipedia.org/wiki/Sikkim\">Sikkim</a> state and <a href=\"https://en.wikipedia.org/wiki/Darjeeling_district\">Darjeeling district</a> of India. It is one of the most popular fast foods in Nepal. Momos have also spread to other countries like <a href=\"https://en.wikipedia.org/wiki/United_States\">United States</a> (some parts), UK and India. MoMo used to be particularly part of cultural and traditional cuisine among the <a href=\"https://en.wikipedia.org/wiki/Newar\">Newar</a> community specially among Tuladhar and their related clans. Till mid 90s or some years after the Jana Andolan, MoMo was a popular cuisine only among <a href=\"https://en.wikipedia.org/wiki/Newars\">Newars</a> and <a href=\"https://en.wikipedia.org/wiki/Kathmandu\">Kathmanduites</a>. Mo:mo used to be home-cooked cuisine, only among <a href=\"https://en.wikipedia.org/wiki/Newar\">Newar communities</a> before mid 90s. At that time, only buffalo mince meat was used, which restricted expansion among <a href=\"https://en.wikipedia.org/wiki/Bahun\">Nepali Brahmin</a> and <a href=\"https://en.wikipedia.org/wiki/Chhetri\">Chhetri</a> population</p>\r\n', '20171101042007_momosaedqweqwezxd.jpg', '2017-11-01 10:35:07'),
(21, 9, 2, 'beauty tips', 'beauty-tips', '<p><strong>Beauty</strong> is a characteristic of an animal, <a href=\"https://en.wikipedia.org/wiki/Idea\">idea</a>, <a href=\"https://en.wikipedia.org/wiki/Object_%28philosophy%29\">object</a>, person or <a href=\"https://en.wikipedia.org/wiki/Location_%28geography%29\">place</a> that provides a <a href=\"https://en.wikipedia.org/wiki/Perception\">perceptual</a> experience of <a href=\"https://en.wikipedia.org/wiki/Pleasure\">pleasure</a> or <a href=\"https://en.wikipedia.org/wiki/Contentment\">satisfaction</a>. Beauty is studied as part of <a href=\"https://en.wikipedia.org/wiki/Aesthetics\">aesthetics</a>, <a href=\"https://en.wikipedia.org/wiki/Culture\">culture</a>, <a href=\"https://en.wikipedia.org/wiki/Social_psychology\">social psychology</a>, <a href=\"https://en.wikipedia.org/wiki/Philosophy\">philosophy</a> and <a href=\"https://en.wikipedia.org/wiki/Sociology\">sociology</a>. An &quot;ideal beauty&quot; is an entity which is admired, or possesses features widely attributed to beauty in a particular culture, for perfection.</p>\r\n\r\n<p><a href=\"https://en.wikipedia.org/wiki/Unattractiveness\">Ugliness</a> is considered to be the opposite of beauty.</p>\r\n\r\n<p>The experience of &quot;beauty&quot; often involves an interpretation of some entity as being in balance and <a href=\"https://en.wikipedia.org/wiki/Harmony\">harmony</a> with <a href=\"https://en.wikipedia.org/wiki/Nature\">nature</a>, which may lead to feelings of <a href=\"https://en.wikipedia.org/wiki/Sexual_attraction\">attraction</a> and <a href=\"https://en.wikipedia.org/wiki/Emotional_well-being\">emotional well-being</a>. Because this can be a <a href=\"https://en.wikipedia.org/wiki/Subjectivity\">subjective</a> experience, it is often said that &quot;beauty is in the eye of the beholder.</p>\r\n', '20171101042150_beautytipsdas.jpg', '2017-11-01 10:36:50'),
(22, 5, 1, 'Php info', 'Php-info', '<p><strong>PHP</strong> is a <a href=\"https://en.wikipedia.org/wiki/Server-side_scripting\">server-side scripting</a> language designed primarily for <a href=\"https://en.wikipedia.org/wiki/Web_development\">web development</a> but also used as a <a href=\"https://en.wikipedia.org/wiki/General-purpose_programming_language\">general-purpose programming language</a>. Originally created by <a href=\"https://en.wikipedia.org/wiki/Rasmus_Lerdorf\">Rasmus Lerdorf</a> in 1994,<a href=\"https://en.wikipedia.org/wiki/PHP#cite_note-History_of_PHP-4\">[4]</a> the PHP <a href=\"https://en.wikipedia.org/wiki/Reference_implementation\">reference implementation</a> is now produced by The PHP Development Team.<a href=\"https://en.wikipedia.org/wiki/PHP#cite_note-about_PHP-5\">[5]</a> PHP originally stood for <em>Personal Home Page</em>,<a href=\"https://en.wikipedia.org/wiki/PHP#cite_note-History_of_PHP-4\">[4]</a> but it now stands for the <a href=\"https://en.wikipedia.org/wiki/Recursive_acronym\">recursive acronym</a> <em>PHP: Hypertext Preprocessor</em>.<a href=\"https://en.wikipedia.org/wiki/PHP#cite_note-6\">[6]</a></p>\r\n\r\n<p>PHP code may be embedded into <a href=\"https://en.wikipedia.org/wiki/HTML\">HTML</a> or HTML5 <a href=\"https://en.wikipedia.org/wiki/Markup_language\">markup</a>, or it can be used in combination with various <a href=\"https://en.wikipedia.org/wiki/Web_template_system\">web template systems</a>, <a href=\"https://en.wikipedia.org/wiki/Web_content_management_system\">web content management systems</a> and <a href=\"https://en.wikipedia.org/wiki/Web_framework\">web frameworks</a>. PHP code is usually processed by a PHP <a href=\"https://en.wikipedia.org/wiki/Interpreter_%28computing%29\">interpreter</a> implemented as a <a href=\"https://en.wikipedia.org/wiki/Plugin_%28computing%29\">module</a> in the web server or as a <a href=\"https://en.wikipedia.org/wiki/Common_Gateway_Interface\">Common Gateway Interface</a> (CGI) <a href=\"https://en.wikipedia.org/wiki/Executable\">executable</a>. The <a href=\"https://en.wikipedia.org/wiki/Web_server\">web server</a> software combines the results of the interpreted and executed PHP code, which may be any type of data, including images, with the generated <a href=\"https://en.wikipedia.org/wiki/Web_page\">web page</a>. PHP code may also be executed with a <a href=\"https://en.wikipedia.org/wiki/Command-line_interface\">command-line interface</a> (CLI) and can be used to implement <a href=\"https://en.wikipedia.org/wiki/Computer_software\">standalone</a> <a href=\"https://en.wikipedia.org/wiki/Graphical_user_interface\">graphical applications</a>.<a href=\"https://en.wikipedia.org/wiki/PHP#cite_note-7\">[7]</a></p>\r\n\r\n<p>The standard PHP interpreter, powered by the <a href=\"https://en.wikipedia.org/wiki/Zend_Engine\">Zend Engine</a>, is <a href=\"https://en.wikipedia.org/wiki/Free_software\">free software</a> released under the <a href=\"https://en.wikipedia.org/wiki/PHP_License\">PHP License</a>. PHP has been widely ported and can be deployed on most web servers on almost every <a href=\"https://en.wikipedia.org/wiki/Operating_system\">operating system</a> and <a href=\"https://en.wikipedia.org/wiki/Computing_platform\">platform</a>, free of charge.<a href=\"https://en.wikipedia.org/wiki/PHP#cite_note-foundations-8\">[8]</a></p>\r\n\r\n<p>The PHP language evolved without a written <a href=\"https://en.wikipedia.org/wiki/Formal_specification\">formal specification</a> or standard until 2014, leaving the canonical PHP interpreter as a <em><a href=\"https://en.wikipedia.org/wiki/De_facto\">de facto</a></em> standard. Since 2014 work has gone on to create a formal PHP specification</p>\r\n', '20171101042647_the-php-practitioner.jpg', '2017-11-01 10:40:03'),
(23, 6, 11, 'Nepali society', 'Nepali-society', '<p>A society is a web of human relationships. It is about the people, their culture and lifestyles, daily patterns, their relationship with each others, etc. Nepali society is a little different than other societies for some of its specific features.</p>\r\n\r\n<p>The specific features of Nepali society are:</p>\r\n\r\n<p><strong>Historically inegalitarian</strong></p>\r\n\r\n<p>Nepali society never was equal and was always stratified in terms of caste, caste and gender. The people of higher caste and class enjoyed more facilities than those of the lower.</p>\r\n\r\n<p><strong>Cultural harmony</strong></p>\r\n\r\n<p>Although there are many cultural and ethnic groups in Nepal, they always lived in peace and harmony with each other. There always was tolerance among the various cultures and no dispute occurred that could affect the cultural solidarity of the country.</p>\r\n\r\n<p><strong>Vertically and horizontally stratified</strong></p>\r\n\r\n<p>Nepali society is vertically and horizontally stratified, vertically in terms of caste, class and gender and horizontally in terms of religion and culture.</p>\r\n\r\n<p><strong>Synthesized form</strong></p>\r\n\r\n<p>Nepali society has mixed culture. Although there reside various different cultures, the cultural practices are often mixed up and one cultural group can be seen practicing the traditions of other.</p>\r\n\r\n<p><strong>Electicism</strong></p>\r\n\r\n<p>People are free to select their own cultural practices and no one is forced to follow a particular format.</p>\r\n\r\n<p><strong>Widespread diversity</strong></p>\r\n\r\n<p>Nepal is diverse in terms of culture, language, religion and ethnicity. There are number of cultural and ethnic groups speaking diverse language, wearing different dresses and following different religion.</p>\r\n\r\n<p><strong>Unity in diversity</strong></p>\r\n\r\n<p>Although Nepal is multi-cultural, multi-ethnic, multi-lingual, multi-religious nation, there is tolerance among them. The diverse groups are united under the same identity of being a Nepali.</p>\r\n\r\n<p><strong>Flexibility</strong></p>\r\n\r\n<p>Nepali society is flexible and the systems and cultural practices are blended according to the comfort of the human beings. The traditional practices could be modified for one&rsquo;s comfort.</p>\r\n\r\n<p><strong>Transition phase</strong></p>\r\n\r\n<p>Nepal is in transition phase in terms of its political condition. &nbsp;It has recently gained the system of a <em>Ganatantric Loktantra</em> from the Monarchial and Democratic system.</p>\r\n', '20171101042833_nepali.jpg', '2017-11-01 10:43:33'),
(24, 8, 11, 'badminton-basic', 'badminton-basic', '<p><strong>Badminton</strong> is a racquet sport played using <a href=\"https://en.wikipedia.org/wiki/Racket_%28sports_equipment%29\">racquets</a> to hit a <a href=\"https://en.wikipedia.org/wiki/Shuttlecock\">shuttlecock</a> across a <a href=\"https://en.wikipedia.org/wiki/Net_%28device%29\">net</a>. Although it may be played with larger teams, the most common forms of the game are &quot;singles&quot; (with one player per side) and &quot;doubles&quot; (with two players per side). Badminton is often played as a casual outdoor activity in a yard or on a beach; formal games are played on a rectangular indoor court. Points are scored by striking the shuttlecock with the racquet and landing it within the opposing side&#39;s half of the court.</p>\r\n\r\n<p>Each side may only strike the shuttlecock once before it passes over the net. Play ends once the shuttlecock has struck the floor or if a fault has been called by the umpire, service judge, or (in their absence) the opposing side.<a href=\"https://en.wikipedia.org/wiki/Badminton#cite_note-FOOTNOTEBoga2008-1\">[1]</a></p>\r\n\r\n<p>The shuttlecock is a feathered or (in informal matches) plastic projectile which flies differently from the balls used in many other sports. In particular, the feathers create much higher <a href=\"https://en.wikipedia.org/wiki/Drag_%28physics%29\">drag</a>, causing the shuttlecock to decelerate more rapidly. Shuttlecocks also have a high top speed compared to the balls in other racquet sports. The flight of the shuttlecock gives the sport its distinctive nature.</p>\r\n', 'noimage.jpg', '2017-11-01 10:44:20'),
(25, 8, 1, 'Dota 2-Alchemist', 'Dota-2-Alchemist', '<p><strong>Razzil Darkbrew</strong>, the <strong>Alchemist</strong>, is a <a href=\"https://dota2.gamepedia.com/Melee\">melee</a> <a href=\"https://dota2.gamepedia.com/Strength\">strength</a> <a href=\"https://dota2.gamepedia.com/Hero\">hero</a> whose alchemical prowess makes him a strange but versatile fighter. He is an unusual <a href=\"https://dota2.gamepedia.com/Carry\">carry</a> based upon transmuting killed creeps into large amounts of bonus gold, with both an early game and late game presence due to the enormous health regeneration from his ultimate and the first strike nature of his other spells. His low but balanced attributes and the sure promise of gold for <a href=\"https://dota2.gamepedia.com/Items\">items</a> means he can be one of the most disparately built heroes in the game.</p>\r\n\r\n<p><a href=\"https://dota2.gamepedia.com/Alchemist#Unstable_Concoction\">Unstable Concoction</a> is his main contribution early on, dealing good damage and a lengthy stun. <a href=\"https://dota2.gamepedia.com/Alchemist#Acid_Spray\">Acid Spray</a> allows him to rapidly clear waves of <a href=\"https://dota2.gamepedia.com/Creeps\">creeps</a> for his <a href=\"https://dota2.gamepedia.com/Alchemist#Greevil.27s_Greed\">Greevil&#39;s Greed</a> to contribute massive amounts of extra income. A well-equipped Alchemist can then use <a href=\"https://dota2.gamepedia.com/Alchemist#Chemical_Rage\">Chemical Rage</a> to its fullest effect, as the incredible regeneration and base attack time reduction make it one of the best steroid abilities in the game</p>\r\n', '20171101043129_Alchemist_icon.png', '2017-11-01 10:46:29'),
(26, 7, 1, 'chowmein', 'chowmein', '<p>The word means &#39;fried noodles&#39;, <em>chow</em> meaning &#39;fried&#39; and <em>mein</em> meaning &#39;noodles&#39;. The pronunciation <em>chow mein</em> is an English corruption of the <a href=\"https://en.wikipedia.org/wiki/Taishan_dialect\">Taishanese</a> pronunciation <em>ch?u-m&egrave;ing</em>. The lightly pronounced <a href=\"https://en.wikipedia.org/wiki/Taishanese\">Taishanese</a> [?], resembling the end of a Portuguese <a href=\"https://en.wikipedia.org/wiki/Nasal_vowel\">nasal vowel</a>, was taken to be /n/ by English speakers.[<em><a href=\"https://en.wikipedia.org/wiki/Wikipedia:Citation_needed\">citation needed</a></em>] The Taishan dialect was spoken by migrants to North America from <a href=\"https://en.wikipedia.org/wiki/Taishan\">Taishan</a>.</p>\r\n', '20171101043220_chowmiensadwqe.jpg', '2017-11-01 10:47:20'),
(27, 7, 1, 'burger', 'burger', '<p>A <strong>hamburger</strong>, <strong>beefburger</strong> or <strong>burger</strong> is a <a href=\"https://en.wikipedia.org/wiki/Sandwich\">sandwich</a> consisting of one or more cooked <a href=\"https://en.wikipedia.org/wiki/Patty\">patties</a> of <a href=\"https://en.wikipedia.org/wiki/Ground_meat\">ground meat</a>, usually <a href=\"https://en.wikipedia.org/wiki/Ground_beef\">beef</a>, placed inside a sliced <a href=\"https://en.wikipedia.org/wiki/Bread_roll\">bread roll</a> or <a href=\"https://en.wikipedia.org/wiki/Bun\">bun</a>. The patty may be <a href=\"https://en.wikipedia.org/wiki/Pan_frying\">pan fried</a>, <a href=\"https://en.wikipedia.org/wiki/Barbecuing\">barbecued</a>, or <a href=\"https://en.wikipedia.org/wiki/Flame_broiler\">flame broiled</a>. Hamburgers are often served with <a href=\"https://en.wikipedia.org/wiki/Cheese\">cheese</a>, <a href=\"https://en.wikipedia.org/wiki/Lettuce\">lettuce</a>, <a href=\"https://en.wikipedia.org/wiki/Tomato\">tomato</a>, <a href=\"https://en.wikipedia.org/wiki/Bacon\">bacon</a>, <a href=\"https://en.wikipedia.org/wiki/Onion\">onion</a>, <a href=\"https://en.wikipedia.org/wiki/Pickled_cucumber\">pickles</a>, or <a href=\"https://en.wikipedia.org/wiki/Chili_pepper\">chiles</a>; <a href=\"https://en.wikipedia.org/wiki/Condiment\">condiments</a> such as <a href=\"https://en.wikipedia.org/wiki/Mustard_%28condiment%29\">mustard</a>, <a href=\"https://en.wikipedia.org/wiki/Mayonnaise\">mayonnaise</a>, <a href=\"https://en.wikipedia.org/wiki/Ketchup\">ketchup</a>, <a href=\"https://en.wikipedia.org/wiki/Relish\">relish</a>, or &quot;<a href=\"https://en.wikipedia.org/wiki/Special_sauce\">special sauce</a>&quot;; and are frequently placed on <a href=\"https://en.wikipedia.org/wiki/Bun\">sesame seed buns</a>. A hamburger topped with cheese is called a <a href=\"https://en.wikipedia.org/wiki/Cheeseburger\">cheeseburger</a>.</p>\r\n\r\n<p>The term &quot;burger&quot; can also be applied to the <a href=\"https://en.wikipedia.org/wiki/Patty\">meat patty</a> on its own, especially in the UK where the term &quot;patty&quot; is rarely used, or the term can even refer simply to <a href=\"https://en.wikipedia.org/wiki/Ground_beef\">ground beef</a>. The term may be prefixed with the type of meat or meat substitute used, as in &quot;<a href=\"https://en.wikipedia.org/wiki/Turkey_meat\">turkey burger</a>&quot;, &quot;<a href=\"https://en.wikipedia.org/wiki/Bison\">bison</a> burger&quot;, or &quot;<a href=\"https://en.wikipedia.org/wiki/Veggie_burger\">veggie burger</a>&quot;.</p>\r\n', '20171101043312_burger.jpg', '2017-11-01 10:48:13'),
(32, 0, 2, 'test post', 'test-post', '<p>this is a test post with no category and no image</p>\r\n', 'noimage.jpg', '2017-11-02 08:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `groups` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `zipcode`, `email`, `username`, `password`, `register_date`, `groups`) VALUES
(1, 'Namosi Tamrakar', '12345', 'namoshi.tamrakar1@gmail.com', 'namosi', '$2y$10$8x4wkHWtjuKrT9cjLNHSh.bCeOoa.UEKq9gcujck409m98xmV2CYu', '2017-11-01 09:30:11', 2),
(2, 'Sumina Shrestha', '12314', 'sumina@gmail.com', 'sumina', '$2y$10$VQPD.n8Z3cXP2XMFU/1s0Ol0BSp1Ywuze3cz/Lo5le2iqBO60Ip1O', '2017-10-31 05:14:35', 1),
(10, 'Gagan Pradhan', '12345', 'gagan.pradhan@hotmail.com', 'gagan', '$2y$10$J6j31yFe6bAcLFq8XjdynexBzfzHm3RULSjd5EoGuegcJjQvl.Q9q', '2017-11-01 10:16:39', 1),
(11, 'Manoj Regmi', '12314', 'manoj@gmail.com', 'manoj', '$2y$10$MMKkJeu6Nqat2hal6hlWgeT.83wGQgPGU0CLv7Yo.RC6xXy3PoFV2', '2017-11-01 10:17:02', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userid` (`user_id`),
  ADD KEY `FK_categoryid` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_groups` (`groups`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_groups` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
