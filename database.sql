-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Generation Time: Aug 18, 2025 at 04:02 PM
-- Server version: 10.11.14-MariaDB-ubu2204
-- PHP Version: 8.2.29
--
-- Comments: FishGDPS database dump, without
-- the data

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
BEGIN;
SET time_zone = "+00:00";

--
-- Database: system32_fishgdps
--

-- --------------------------------------------------------

--
-- Table structure for table acccomments
--

CREATE TABLE acccomments (
	  userID INTEGER NOT NULL,
	  userName varchar(50) NOT NULL,
	  comment TEXT NOT NULL,
	  secret varchar(10) NOT NULL DEFAULT 'unused',
	  commentID INTEGER NOT NULL,
	  timestamp INTEGER NOT NULL,
	  likes INTEGER NOT NULL DEFAULT 0,
	  isSpam INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table accounts
--

CREATE TABLE accounts (
	  userName varchar(255) NOT NULL,
	  password varchar(255) NOT NULL,
	  gjp2 varchar(255) DEFAULT NULL,
	  email varchar(255) NOT NULL,
	  accountID INTEGER NOT NULL,
	  isAdmin INTEGER NOT NULL DEFAULT 0,
	  mS INTEGER NOT NULL DEFAULT 0,
	  frS INTEGER NOT NULL DEFAULT 0,
	  cS INTEGER NOT NULL DEFAULT 0,
	  youtubeurl varchar(255) NOT NULL DEFAULT '',
	  twitter varchar(255) NOT NULL DEFAULT '',
	  twitch varchar(255) NOT NULL DEFAULT '',
	  salt varchar(255) NOT NULL DEFAULT '',
	  registerDate INTEGER NOT NULL DEFAULT 0,
	  friendsCount INTEGER NOT NULL DEFAULT 0,
	  discordID BIGINT NOT NULL DEFAULT 0,
	  discordLinkReq BIGINT NOT NULL DEFAULT 0,
	  isActive BOOLEAN NOT NULL DEFAULT 0,
	  auth varchar(16) NOT NULL DEFAULT 'none',
	  mail varchar(255) NOT NULL DEFAULT '',
	  passCode varchar(255) NOT NULL DEFAULT '',
	  timezone varchar(255) NOT NULL DEFAULT ''
)  ;

-- --------------------------------------------------------

--
-- Table structure for table actions
--

CREATE TABLE actions (
	  ID INTEGER NOT NULL,
	  type INTEGER NOT NULL DEFAULT 0,
	  value varchar(255) NOT NULL DEFAULT '0',
	  timestamp INTEGER NOT NULL DEFAULT 0,
	  value2 varchar(255) NOT NULL DEFAULT '0',
	  value3 varchar(255) NOT NULL DEFAULT '',
	  value4 varchar(255) NOT NULL DEFAULT '',
	  value5 varchar(255) NOT NULL DEFAULT '',
	  value6 varchar(255) NOT NULL DEFAULT '',
	  account varchar(255) NOT NULL DEFAULT '',
	  IP varchar(255) NOT NULL DEFAULT ''
)  ;

-- --------------------------------------------------------

--
-- Table structure for table actions_downloads
--

CREATE TABLE actions_downloads (
	  id INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  ip BYTEA NOT NULL,
	  uploadDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)  ;

-- --------------------------------------------------------

--
-- Table structure for table actions_likes
--

CREATE TABLE actions_likes (
	  id INTEGER NOT NULL,
	  itemID INTEGER NOT NULL,
	  type INTEGER NOT NULL,
	  isLike INTEGER NOT NULL,
	  ip BYTEA NOT NULL,
	  uploadDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)  ;

-- --------------------------------------------------------

--
-- Table structure for table automod
--

CREATE TABLE automod (
	  ID INTEGER NOT NULL,
	  type INTEGER NOT NULL DEFAULT 0,
	  value1 varchar(255) NOT NULL DEFAULT '',
	  value2 varchar(255) NOT NULL DEFAULT '',
	  value3 varchar(255) NOT NULL DEFAULT '',
	  value4 varchar(255) NOT NULL DEFAULT '',
	  value5 varchar(255) NOT NULL DEFAULT '',
	  value6 varchar(255) NOT NULL DEFAULT '',
	  timestamp INTEGER NOT NULL DEFAULT 0,
	  resolved INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table bannedips
--

CREATE TABLE bannedips (
	  IP varchar(255) NOT NULL DEFAULT '127.0.0.1',
	  ID INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table bans
--

CREATE TABLE bans (
	  banID INTEGER NOT NULL,
	  modID varchar(255) NOT NULL DEFAULT '',
	  person varchar(50) NOT NULL DEFAULT '',
	  reason varchar(2048) NOT NULL DEFAULT '',
	  banType INTEGER NOT NULL DEFAULT 0,
	  personType INTEGER NOT NULL DEFAULT 0,
	  expires INTEGER NOT NULL DEFAULT 0,
	  isActive INTEGER NOT NULL DEFAULT 1,
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table blocks
--

CREATE TABLE blocks (
	  ID INTEGER NOT NULL,
	  person1 INTEGER NOT NULL,
	  person2 INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table clanrequests
--

CREATE TABLE clanrequests (
	  ID INTEGER NOT NULL,
	  accountID INTEGER NOT NULL DEFAULT 0,
	  clanID INTEGER NOT NULL DEFAULT 0,
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table clans
--

CREATE TABLE clans (
	  ID INTEGER NOT NULL,
	  clan varchar(255) NOT NULL DEFAULT '',
	  tag varchar(15) NOT NULL DEFAULT '',
	  desc varchar(2048) NOT NULL DEFAULT '',
	  clanOwner INTEGER NOT NULL DEFAULT 0,
	  color varchar(6) NOT NULL DEFAULT 'FFFFFF',
	  isClosed INTEGER NOT NULL DEFAULT 0,
	  creationDate INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table comments
--

CREATE TABLE comments (
	  userID INTEGER NOT NULL,
	  userName varchar(50) NOT NULL,
	  comment TEXT NOT NULL,
	  secret varchar(10) NOT NULL DEFAULT 'none',
	  levelID INTEGER NOT NULL,
	  commentID INTEGER NOT NULL,
	  timestamp INTEGER NOT NULL,
	  likes INTEGER NOT NULL DEFAULT 0,
	  percent INTEGER NOT NULL DEFAULT 0,
	  isSpam BOOLEAN NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table cpshares
--

CREATE TABLE cpshares (
	  shareID INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  userID INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table dailyfeatures
--

CREATE TABLE dailyfeatures (
	  feaID INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  timestamp INTEGER NOT NULL,
	  type INTEGER NOT NULL DEFAULT 0,
	  webhookSent INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table data
--

CREATE TABLE data (
	  info BOOLEAN NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table demonlist
--

CREATE TABLE demonlist (
	  levelID INTEGER NOT NULL,
	  authorID INTEGER NOT NULL,
	  pseudoPoints INTEGER NOT NULL,
	  giveablePoints INTEGER NOT NULL,
	  youtube varchar(255)  COLLATE utf8mb4_general_ci NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table dlsubmits
--

CREATE TABLE dlsubmits (
	  ID INTEGER NOT NULL,
	  accountID INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  atts INTEGER NOT NULL,
	  ytlink varchar(255)  COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
	  auth varchar(255)  COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
	  approve INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table events
--

CREATE TABLE events (
	  feaID INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  timestamp INTEGER NOT NULL,
	  duration INTEGER NOT NULL,
	  rewards varchar(2048) NOT NULL DEFAULT '',
	  webhookSent INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table favsongs
--

CREATE TABLE favsongs (
	  ID INTEGER NOT NULL,
	  songID INTEGER NOT NULL DEFAULT 0,
	  accountID INTEGER NOT NULL DEFAULT 0,
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table friendreqs
--

CREATE TABLE friendreqs (
	  accountID INTEGER NOT NULL,
	  toAccountID INTEGER NOT NULL,
	  comment varchar(1000) NOT NULL,
	  uploadDate INTEGER NOT NULL,
	  ID INTEGER NOT NULL,
	  isNew BOOLEAN NOT NULL DEFAULT 1
)  ;

-- --------------------------------------------------------

--
-- Table structure for table friendships
--

CREATE TABLE friendships (
	  ID INTEGER NOT NULL,
	  person1 INTEGER NOT NULL,
	  person2 INTEGER NOT NULL,
	  isNew1 INTEGER NOT NULL,
	  isNew2 INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table gauntlets
--

CREATE TABLE gauntlets (
	  ID INTEGER NOT NULL,
	  level1 INTEGER NOT NULL,
	  level2 INTEGER NOT NULL,
	  level3 INTEGER NOT NULL,
	  level4 INTEGER NOT NULL,
	  level5 INTEGER NOT NULL,
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table levels
--

CREATE TABLE levels (
	  gameVersion INTEGER NOT NULL,
	  binaryVersion INTEGER NOT NULL DEFAULT 0,
	  userName TEXT NOT NULL,
	  levelID INTEGER NOT NULL,
	  levelName varchar(255) NOT NULL,
	  levelDesc TEXT NOT NULL,
	  levelVersion INTEGER NOT NULL,
	  levelLength INTEGER NOT NULL DEFAULT 0,
	  audioTrack INTEGER NOT NULL,
	  auto INTEGER NOT NULL,
	  password INTEGER NOT NULL,
	  original INTEGER NOT NULL,
	  twoPlayer INTEGER NOT NULL DEFAULT 0,
	  songID INTEGER NOT NULL DEFAULT 0,
	  songIDs varchar(2048) DEFAULT '',
	  objects INTEGER NOT NULL DEFAULT 0,
	  coins INTEGER NOT NULL DEFAULT 0,
	  requestedStars INTEGER NOT NULL DEFAULT 0,
	  extraString TEXT NOT NULL,
	  levelString TEXT DEFAULT NULL,
	  levelInfo TEXT NOT NULL,
	  secret TEXT NOT NULL,
	  starDifficulty INTEGER NOT NULL DEFAULT 0 COMMENT '0=N/A 10=EASY 20=NORMAL 30=HARD 40=HARDER 50=INSANE 50=AUTO 50=DEMON',
	  downloads INTEGER NOT NULL DEFAULT 0,
	  likes INTEGER NOT NULL DEFAULT 0,
	  starDemon INTEGER NOT NULL DEFAULT 0,
	  starAuto INTEGER NOT NULL DEFAULT 0,
	  starStars INTEGER NOT NULL DEFAULT 0,
	  uploadDate BIGINT NOT NULL,
	  updateDate BIGINT NOT NULL,
	  rateDate BIGINT NOT NULL DEFAULT 0,
	  starCoins INTEGER NOT NULL DEFAULT 0,
	  starFeatured INTEGER NOT NULL DEFAULT 0,
	  starHall INTEGER NOT NULL DEFAULT 0,
	  starEpic INTEGER NOT NULL DEFAULT 0,
	  starDemonDiff INTEGER NOT NULL DEFAULT 0,
	  userID INTEGER NOT NULL,
	  extID varchar(255) NOT NULL,
	  unlisted INTEGER NOT NULL,
	  hostname varchar(255) NOT NULL,
	  isDeleted INTEGER NOT NULL DEFAULT 0,
	  isMagic INTEGER NOT NULL DEFAULT 0 COMMENT 'if a level is in the magic tab or not',
	  unlisted2 INTEGER NOT NULL DEFAULT 0,
	  wt INTEGER NOT NULL DEFAULT 0,
	  wt2 INTEGER NOT NULL DEFAULT 0,
	  ts INTEGER NOT NULL DEFAULT 0,
	  settingsString TEXT NOT NULL DEFAULT '',
	  isWeekly INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table levelscores
--

CREATE TABLE levelscores (
	  scoreID INTEGER NOT NULL,
	  accountID INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  percent INTEGER NOT NULL,
	  uploadDate INTEGER NOT NULL,
	  attempts INTEGER NOT NULL DEFAULT 0,
	  coins INTEGER NOT NULL DEFAULT 0,
	  clicks INTEGER NOT NULL DEFAULT 0,
	  time INTEGER NOT NULL DEFAULT 0,
	  progresses text NOT NULL,
	  dailyID INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table links
--

CREATE TABLE links (
	  ID INTEGER NOT NULL,
	  accountID INTEGER NOT NULL,
	  targetAccountID INTEGER NOT NULL,
	  server varchar(255) NOT NULL,
	  timestamp INTEGER NOT NULL,
	  userID INTEGER NOT NULL,
	  targetUserID INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table lists
--

CREATE TABLE lists (
	  listID INTEGER NOT NULL,
	  listName varchar(2048)  COLLATE utf8mb3_general_ci NOT NULL,
	  listDesc varchar(2048)  COLLATE utf8mb3_general_ci NOT NULL,
	  listVersion INTEGER NOT NULL DEFAULT 1,
	  accountID INTEGER NOT NULL,
	  downloads INTEGER NOT NULL DEFAULT 0,
	  starDifficulty INTEGER NOT NULL,
	  likes INTEGER NOT NULL DEFAULT 0,
	  starFeatured INTEGER NOT NULL DEFAULT 0,
	  starStars INTEGER NOT NULL DEFAULT 0,
	  listlevels varchar(2048)  COLLATE utf8mb3_general_ci NOT NULL,
	  countForReward INTEGER NOT NULL DEFAULT 0,
	  uploadDate INTEGER NOT NULL DEFAULT 0,
	  updateDate INTEGER NOT NULL DEFAULT 0,
	  original INTEGER NOT NULL DEFAULT 0,
	  unlisted INTEGER NOT NULL DEFAULT 0,
	  commentLocked INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table mappacks
--

CREATE TABLE mappacks (
	  ID INTEGER NOT NULL,
	  name varchar(100) NOT NULL,
	  levels varchar(512) NOT NULL COMMENT 'entered as "ID of level 1, ID of level 2, ID of level 3" for example "13,14,15" (without the "s)',
	  stars INTEGER NOT NULL,
	  coins INTEGER NOT NULL,
	  difficulty INTEGER NOT NULL,
	  rgbcolors varchar(11) NOT NULL COMMENT 'entered as R,G,B',
	  colors2 varchar(11) NOT NULL DEFAULT 'none',
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table messages
--

CREATE TABLE messages (
	  userID INTEGER NOT NULL,
	  userName varchar(50) NOT NULL,
	  body TEXT NOT NULL,
	  subject TEXT NOT NULL,
	  accID INTEGER NOT NULL,
	  messageID INTEGER NOT NULL,
	  toAccountID INTEGER NOT NULL,
	  timestamp INTEGER NOT NULL,
	  secret varchar(25) NOT NULL DEFAULT 'unused',
	  isNew INTEGER NOT NULL DEFAULT 0,
	  readTime INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table modactions
--

CREATE TABLE modactions (
	  ID INTEGER NOT NULL,
	  type INTEGER NOT NULL DEFAULT 0,
	  value varchar(255)  COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
	  timestamp INTEGER NOT NULL DEFAULT 0,
	  value2 varchar(255)  COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
	  user INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table modipperms
--

CREATE TABLE modipperms (
	  categoryID INTEGER NOT NULL,
	  actionFreeCopy INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table modips
--

CREATE TABLE modips (
	  ID INTEGER NOT NULL,
	  IP varchar(69) NOT NULL,
	  isMod INTEGER NOT NULL,
	  accountID INTEGER NOT NULL,
	  modipCategory INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table platscores
--

CREATE TABLE platscores (
	  ID INTEGER NOT NULL,
	  accountID INTEGER NOT NULL DEFAULT 0,
	  levelID INTEGER NOT NULL DEFAULT 0,
	  time INTEGER NOT NULL DEFAULT 0,
	  points INTEGER NOT NULL DEFAULT 0,
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table quests
--

CREATE TABLE quests (
	  ID INTEGER NOT NULL,
	  type INTEGER NOT NULL,
	  amount INTEGER NOT NULL,
	  reward INTEGER NOT NULL,
	  name varchar(255) NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table replies
--

CREATE TABLE replies (
	  replyID INTEGER NOT NULL,
	  commentID INTEGER NOT NULL,
	  accountID INTEGER NOT NULL,
	  body varchar(255) NOT NULL,
	  timestamp INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table reports
--

CREATE TABLE reports (
	  ID INTEGER NOT NULL,
	  levelID INTEGER NOT NULL,
	  hostname varchar(255) NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table roleassign
--

CREATE TABLE roleassign (
	  assignID BIGINT NOT NULL,
	  roleID BIGINT NOT NULL,
	  accountID BIGINT NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table roles
--

CREATE TABLE roles (
	  roleID BIGINT NOT NULL,
	  priority INTEGER NOT NULL DEFAULT 0,
	  roleName varchar(255)  COLLATE utf8mb3_general_ci NOT NULL,
	  commandRate INTEGER NOT NULL DEFAULT 0,
	  commandFeature INTEGER NOT NULL DEFAULT 0,
	  commandEpic INTEGER NOT NULL DEFAULT 0,
	  commandUnepic INTEGER NOT NULL DEFAULT 0,
	  commandVerifycoins INTEGER NOT NULL DEFAULT 0,
	  commandDaily INTEGER NOT NULL DEFAULT 0,
	  commandWeekly INTEGER NOT NULL DEFAULT 0,
	  commandEvent INTEGER NOT NULL DEFAULT 0,
	  commandDelete INTEGER NOT NULL DEFAULT 0,
	  commandSetacc INTEGER NOT NULL DEFAULT 0,
	  commandRenameOwn INTEGER NOT NULL DEFAULT 1,
	  commandRenameAll INTEGER NOT NULL DEFAULT 0,
	  commandPassOwn INTEGER NOT NULL DEFAULT 1,
	  commandPassAll INTEGER NOT NULL DEFAULT 0,
	  commandDescriptionOwn INTEGER NOT NULL DEFAULT 1,
	  commandDescriptionAll INTEGER NOT NULL DEFAULT 0,
	  commandPublicOwn INTEGER NOT NULL DEFAULT 1,
	  commandPublicAll INTEGER NOT NULL DEFAULT 0,
	  commandUnlistOwn INTEGER NOT NULL DEFAULT 1,
	  commandUnlistAll INTEGER NOT NULL DEFAULT 0,
	  commandSharecpOwn INTEGER NOT NULL DEFAULT 1,
	  commandSharecpAll INTEGER NOT NULL DEFAULT 0,
	  commandSongOwn INTEGER NOT NULL DEFAULT 1,
	  commandSongAll INTEGER NOT NULL DEFAULT 0,
	  commandLockCommentsOwn INTEGER NOT NULL DEFAULT 1,
	  commandLockCommentsAll INTEGER NOT NULL DEFAULT 0,
	  commandLockUpdating INTEGER NOT NULL DEFAULT 0,
	  actionRateDemon INTEGER NOT NULL DEFAULT 0,
	  actionRateStars INTEGER NOT NULL DEFAULT 0,
	  actionRateDifficulty INTEGER NOT NULL DEFAULT 0,
	  actionRequestMod INTEGER NOT NULL DEFAULT 0,
	  actionSuggestRating INTEGER NOT NULL DEFAULT 0,
	  actionDeleteComment INTEGER NOT NULL DEFAULT 0,
	  toolLeaderboardsban INTEGER NOT NULL DEFAULT 0,
	  dashboardGauntletCreate INTEGER NOT NULL DEFAULT 0,
	  toolQuestsCreate INTEGER NOT NULL DEFAULT 0,
	  toolModactions INTEGER NOT NULL DEFAULT 0,
	  toolSuggestlist INTEGER NOT NULL DEFAULT 0,
	  dashboardModTools INTEGER NOT NULL DEFAULT 0,
	  dashboardLevelPackCreate INTEGER NOT NULL DEFAULT 0,
	  dashboardAddMod INTEGER NOT NULL DEFAULT 0,
	  dashboardManageSongs INTEGER NOT NULL DEFAULT 0,
	  dashboardForceChangePassNick INTEGER NOT NULL DEFAULT 0,
	  dashboardDeleteLeaderboards INTEGER NOT NULL DEFAULT 0,
	  dashboardManageLevels INTEGER NOT NULL DEFAULT 0,
	  dashboardManageAutomod INTEGER NOT NULL DEFAULT 0,
	  dashboardVaultCodesManage INTEGER NOT NULL DEFAULT 0,
	  demonlistAdd INTEGER NOT NULL DEFAULT 0,
	  demonlistApprove INTEGER NOT NULL DEFAULT 0,
	  modipCategory INTEGER NOT NULL DEFAULT 0,
	  isDefault INTEGER NOT NULL DEFAULT 0,
	  commentColor varchar(11)  COLLATE utf8mb3_general_ci NOT NULL DEFAULT '000,000,000',
	  modBadgeLevel INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table sfxs
--

CREATE TABLE sfxs (
	  ID INTEGER NOT NULL,
	  name varchar(100) NOT NULL,
	  authorName varchar(100) NOT NULL,
	  download varchar(255) DEFAULT '',
	  milliseconds INTEGER NOT NULL DEFAULT 0,
	  size varchar(100) NOT NULL,
	  isDisabled INTEGER NOT NULL DEFAULT 0,
	  levelsCount INTEGER NOT NULL DEFAULT 0,
	  reuploadID INTEGER NOT NULL DEFAULT 0,
	  reuploadTime INTEGER NOT NULL DEFAULT 0,
	  token varchar(255) NOT NULL DEFAULT ''
)  ;

-- --------------------------------------------------------

--
-- Table structure for table songs
--

CREATE TABLE songs (
	  ID INTEGER NOT NULL,
	  name varchar(100) NOT NULL,
	  authorID INTEGER NOT NULL,
	  authorName varchar(100) NOT NULL,
	  size varchar(100) NOT NULL,
	  duration INTEGER NOT NULL DEFAULT 0,
	  download varchar(1337) NOT NULL,
	  hash varchar(256) NOT NULL DEFAULT '',
	  isDisabled INTEGER NOT NULL DEFAULT 0,
	  levelsCount INTEGER NOT NULL DEFAULT 0,
	  reuploadTime INTEGER NOT NULL DEFAULT 0,
	  reuploadID INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table suggest
--

CREATE TABLE suggest (
	  ID INTEGER NOT NULL,
	  suggestBy INTEGER NOT NULL DEFAULT 0,
	  suggestLevelId INTEGER NOT NULL DEFAULT 0,
	  suggestDifficulty INTEGER NOT NULL DEFAULT 0 COMMENT '0 - NA 10 - Easy 20 - Normal 30 - Hard 40 - Harder 50 - Insane/Demon/Auto',
	  suggestStars INTEGER NOT NULL DEFAULT 0,
	  suggestFeatured INTEGER NOT NULL DEFAULT 0,
	  suggestAuto INTEGER NOT NULL DEFAULT 0,
	  suggestDemon INTEGER NOT NULL DEFAULT 0,
	  timestamp INTEGER NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
	  isRegistered INTEGER NOT NULL,
	  userID INTEGER NOT NULL,
	  extID varchar(100) NOT NULL,
	  userName varchar(69) NOT NULL DEFAULT 'undefined',
	  role INTEGER NOT NULL DEFAULT 0 COMMENT '0=MEMBER, 1=MOD, 2=ADMIN, 3=OWNER',
	  clan INTEGER NOT NULL DEFAULT 0,
	  joinedAt INTEGER NOT NULL DEFAULT 0,
	  dlPoints INTEGER NOT NULL DEFAULT 0,
	  stars INTEGER NOT NULL DEFAULT 0,
	  demons INTEGER NOT NULL DEFAULT 0,
	  icon INTEGER NOT NULL DEFAULT 0,
	  color1 INTEGER NOT NULL DEFAULT 0,
	  color2 INTEGER NOT NULL DEFAULT 3,
	  color3 INTEGER NOT NULL DEFAULT 0,
	  iconType INTEGER NOT NULL DEFAULT 0,
	  coins INTEGER NOT NULL DEFAULT 0,
	  userCoins INTEGER NOT NULL DEFAULT 0,
	  special INTEGER NOT NULL DEFAULT 0,
	  gameVersion INTEGER NOT NULL DEFAULT 0,
	  secret varchar(69) NOT NULL DEFAULT 'none',
	  accIcon INTEGER NOT NULL DEFAULT 0,
	  accShip INTEGER NOT NULL DEFAULT 0,
	  accBall INTEGER NOT NULL DEFAULT 0,
	  accBird INTEGER NOT NULL DEFAULT 0,
	  accDart INTEGER NOT NULL DEFAULT 0,
	  accRobot INTEGER DEFAULT 0,
	  accGlow INTEGER NOT NULL DEFAULT 0,
	  accSwing INTEGER NOT NULL DEFAULT 0,
	  accJetpack INTEGER NOT NULL DEFAULT 0,
	  dinfo varchar(100) DEFAULT '',
	  sinfo varchar(100) DEFAULT '',
	  pinfo varchar(100) DEFAULT '',
	  creatorPoints double NOT NULL DEFAULT 0,
	  extraCreatorPoints INTEGER NOT NULL DEFAULT 0,
	  IP varchar(69) NOT NULL DEFAULT '127.0.0.1',
	  lastPlayed INTEGER NOT NULL DEFAULT 0,
	  diamonds INTEGER NOT NULL DEFAULT 0,
	  moons INTEGER NOT NULL DEFAULT 0,
	  orbs INTEGER NOT NULL DEFAULT 0,
	  completedLvls INTEGER NOT NULL DEFAULT 0,
	  accSpider INTEGER NOT NULL DEFAULT 0,
	  accExplosion INTEGER NOT NULL DEFAULT 0,
	  chest1time INTEGER NOT NULL DEFAULT 0,
	  chest2time INTEGER NOT NULL DEFAULT 0,
	  chest1count INTEGER NOT NULL DEFAULT 0,
	  chest2count INTEGER NOT NULL DEFAULT 0,
	  isBanned INTEGER NOT NULL DEFAULT 0,
	  isCreatorBanned INTEGER NOT NULL DEFAULT 0,
	  isLeaderboardBanned INTEGER NOT NULL DEFAULT 0
)  ;

-- --------------------------------------------------------

--
-- Table structure for table vaultcodes
--

CREATE TABLE vaultcodes (
	  rewardID INTEGER NOT NULL,
	  code varchar(255) NOT NULL DEFAULT '',
	  rewards varchar(2048) NOT NULL DEFAULT '',
	  duration INTEGER NOT NULL DEFAULT 0,
	  uses INTEGER NOT NULL DEFAULT -1,
	  timestamp INTEGER NOT NULL DEFAULT 0
)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table acccomments
--
ALTER TABLE acccomments
  ADD PRIMARY KEY (commentID),

--
-- Indexes for table accounts
--
ALTER TABLE accounts
  ADD PRIMARY KEY (accountID),

--
-- Indexes for table actions
--
ALTER TABLE actions
  ADD PRIMARY KEY (ID),

--
-- Indexes for table actions_downloads
--
ALTER TABLE actions_downloads
  ADD PRIMARY KEY (id),

--
-- Indexes for table actions_likes
--
ALTER TABLE actions_likes
  ADD PRIMARY KEY (id),

--
-- Indexes for table automod
--
ALTER TABLE automod
  ADD PRIMARY KEY (ID);

--
-- Indexes for table bannedips
--
ALTER TABLE bannedips
  ADD PRIMARY KEY (ID);

--
-- Indexes for table bans
--
ALTER TABLE bans
  ADD PRIMARY KEY (banID);

--
-- Indexes for table blocks
--
ALTER TABLE blocks
  ADD PRIMARY KEY (ID),

--
-- Indexes for table clanrequests
--
ALTER TABLE clanrequests
  ADD PRIMARY KEY (ID);

--
-- Indexes for table clans
--
ALTER TABLE clans
  ADD PRIMARY KEY (ID);

--
-- Indexes for table comments
--
ALTER TABLE comments
  ADD PRIMARY KEY (commentID),

--
-- Indexes for table cpshares
--
ALTER TABLE cpshares
  ADD PRIMARY KEY (shareID),

--
-- Indexes for table dailyfeatures
--
ALTER TABLE dailyfeatures
  ADD PRIMARY KEY (feaID),

--
-- Indexes for table demonlist
--
ALTER TABLE demonlist
  ADD PRIMARY KEY (levelID);

--
-- Indexes for table dlsubmits
--
ALTER TABLE dlsubmits
  ADD PRIMARY KEY (ID);

--
-- Indexes for table events
--
ALTER TABLE events
  ADD PRIMARY KEY (feaID);

--
-- Indexes for table favsongs
--
ALTER TABLE favsongs
  ADD PRIMARY KEY (ID);

--
-- Indexes for table friendreqs
--
ALTER TABLE friendreqs
  ADD PRIMARY KEY (ID),

--
-- Indexes for table friendships
--
ALTER TABLE friendships
  ADD PRIMARY KEY (ID),

--
-- Indexes for table gauntlets
--
ALTER TABLE gauntlets
  ADD PRIMARY KEY (ID),

--
-- Indexes for table levels
--
ALTER TABLE levels
  ADD PRIMARY KEY (levelID),

--
-- Indexes for table levelscores
--
ALTER TABLE levelscores
  ADD PRIMARY KEY (scoreID),

--
-- Indexes for table links
--
ALTER TABLE links
  ADD PRIMARY KEY (ID),

--
-- Indexes for table lists
--
ALTER TABLE lists
  ADD PRIMARY KEY (listID);

--
-- Indexes for table mappacks
--
ALTER TABLE mappacks
  ADD PRIMARY KEY (ID);

--
-- Indexes for table messages
--
ALTER TABLE messages
  ADD PRIMARY KEY (messageID),

--
-- Indexes for table modactions
--
ALTER TABLE modactions
  ADD PRIMARY KEY (ID);

--
-- Indexes for table modipperms
--
ALTER TABLE modipperms
  ADD PRIMARY KEY (categoryID);

--
-- Indexes for table modips
--
ALTER TABLE modips
  ADD PRIMARY KEY (ID),

--
-- Indexes for table platscores
--
ALTER TABLE platscores
  ADD PRIMARY KEY (ID);

--
-- Indexes for table quests
--
ALTER TABLE quests
  ADD PRIMARY KEY (ID);

--
-- Indexes for table replies
--
ALTER TABLE replies
  ADD PRIMARY KEY (replyID);

--
-- Indexes for table reports
--
ALTER TABLE reports
  ADD PRIMARY KEY (ID),

--
-- Indexes for table roleassign
--
ALTER TABLE roleassign
  ADD PRIMARY KEY (assignID),

--
-- Indexes for table roles
--
ALTER TABLE roles
  ADD PRIMARY KEY (roleID),

--
-- Indexes for table sfxs
--
ALTER TABLE sfxs
  ADD PRIMARY KEY (ID),

--
-- Indexes for table songs
--
ALTER TABLE songs
  ADD PRIMARY KEY (ID),

--
-- Indexes for table suggest
--
ALTER TABLE suggest
  ADD PRIMARY KEY (ID),

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (userID),

--
-- Indexes for table vaultcodes
--
ALTER TABLE vaultcodes
  ADD PRIMARY KEY (rewardID);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table acccomments
--
ALTER TABLE acccomments
  MODIFY commentID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table accounts
--
ALTER TABLE accounts
  MODIFY accountID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table actions
--
ALTER TABLE actions
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table actions_downloads
--
ALTER TABLE actions_downloads
  MODIFY id SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table actions_likes
--
ALTER TABLE actions_likes
  MODIFY id SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table automod
--
ALTER TABLE automod
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table bannedips
--
ALTER TABLE bannedips
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table bans
--
ALTER TABLE bans
  MODIFY banID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table blocks
--
ALTER TABLE blocks
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table clanrequests
--
ALTER TABLE clanrequests
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table clans
--
ALTER TABLE clans
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table comments
--
ALTER TABLE comments
  MODIFY commentID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table cpshares
--
ALTER TABLE cpshares
  MODIFY shareID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table dailyfeatures
--
ALTER TABLE dailyfeatures
  MODIFY feaID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table dlsubmits
--
ALTER TABLE dlsubmits
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table events
--
ALTER TABLE events
  MODIFY feaID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table favsongs
--
ALTER TABLE favsongs
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table friendreqs
--
ALTER TABLE friendreqs
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table friendships
--
ALTER TABLE friendships
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table gauntlets
--
ALTER TABLE gauntlets
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table levels
--
ALTER TABLE levels
  MODIFY levelID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table levelscores
--
ALTER TABLE levelscores
  MODIFY scoreID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table links
--
ALTER TABLE links
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table lists
--
ALTER TABLE lists
  MODIFY listID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table mappacks
--
ALTER TABLE mappacks
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table messages
--
ALTER TABLE messages
  MODIFY messageID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table modactions
--
ALTER TABLE modactions
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table modipperms
--
ALTER TABLE modipperms
  MODIFY categoryID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table modips
--
ALTER TABLE modips
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table platscores
--
ALTER TABLE platscores
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table quests
--
ALTER TABLE quests
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table replies
--
ALTER TABLE replies
  MODIFY replyID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table reports
--
ALTER TABLE reports
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table roleassign
--
ALTER TABLE roleassign
  MODIFY assignID BIGINT NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table roles
--
ALTER TABLE roles
  MODIFY roleID BIGINT NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table sfxs
--
ALTER TABLE sfxs
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table songs
--
ALTER TABLE songs
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table suggest
--
ALTER TABLE suggest
  MODIFY ID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY userID SERIAL PRIMARY KEY;

--
-- AUTO_INCREMENT for table vaultcodes
--
ALTER TABLE vaultcodes
  MODIFY rewardID SERIAL PRIMARY KEY;
COMMIT;


CREATE INDEX ON vaultcodes (userID);
CREATE INDEX ON vaultcodes (timestamp);
CREATE UNIQUE INDEX ON vaultcodes (userName);
CREATE INDEX ON vaultcodes (isAdmin);
CREATE INDEX ON vaultcodes (frS);
CREATE INDEX ON vaultcodes (discordID);
CREATE INDEX ON vaultcodes (discordLinkReq);
CREATE INDEX ON vaultcodes (friendsCount);
CREATE INDEX ON vaultcodes (isActive);
CREATE INDEX ON vaultcodes (type);
CREATE INDEX ON vaultcodes (value);
CREATE INDEX ON vaultcodes (value2);
CREATE INDEX ON vaultcodes (timestamp);
CREATE INDEX ON vaultcodes (levelID,ip,uploadDate);
CREATE INDEX ON vaultcodes (itemID,type,isLike,ip,uploadDate);
CREATE UNIQUE INDEX ON vaultcodes (ID);
CREATE INDEX ON vaultcodes (person1);
CREATE INDEX ON vaultcodes (person2);
CREATE INDEX ON vaultcodes (levelID);
CREATE INDEX ON vaultcodes (userID);
CREATE INDEX ON vaultcodes (likes);
CREATE INDEX ON vaultcodes (levelID);
CREATE INDEX ON vaultcodes (type);
CREATE INDEX ON vaultcodes (timestamp);
CREATE INDEX ON vaultcodes (toAccountID);
CREATE INDEX ON vaultcodes (accountID);
CREATE INDEX ON vaultcodes (uploadDate);
CREATE INDEX ON vaultcodes (person1);
CREATE INDEX ON vaultcodes (person2);
CREATE INDEX ON vaultcodes (isNew1);
CREATE INDEX ON vaultcodes (isNew2);
CREATE INDEX ON vaultcodes (level5);
CREATE INDEX ON vaultcodes (levelID);
CREATE INDEX ON vaultcodes (levelName);
CREATE INDEX ON vaultcodes (starDifficulty);
CREATE INDEX ON vaultcodes (starFeatured);
CREATE INDEX ON vaultcodes (starEpic);
CREATE INDEX ON vaultcodes (starDemonDiff);
CREATE INDEX ON vaultcodes (userID);
CREATE INDEX ON vaultcodes (likes);
CREATE INDEX ON vaultcodes (downloads);
CREATE INDEX ON vaultcodes (starStars);
CREATE INDEX ON vaultcodes (songID);
CREATE INDEX ON vaultcodes (audioTrack);
CREATE INDEX ON vaultcodes (levelLength);
CREATE INDEX ON vaultcodes (twoPlayer);
CREATE INDEX ON vaultcodes (starDemon);
CREATE INDEX ON vaultcodes (starAuto);
CREATE INDEX ON vaultcodes (extID);
CREATE INDEX ON vaultcodes (uploadDate);
CREATE INDEX ON vaultcodes (updateDate);
CREATE INDEX ON vaultcodes (starCoins);
CREATE INDEX ON vaultcodes (coins);
CREATE INDEX ON vaultcodes (password);
CREATE INDEX ON vaultcodes (original);
CREATE INDEX ON vaultcodes (unlisted);
CREATE INDEX ON vaultcodes (gameVersion);
CREATE INDEX ON vaultcodes (rateDate);
CREATE INDEX ON vaultcodes (objects);
CREATE INDEX ON vaultcodes (unlisted2);
CREATE INDEX ON vaultcodes (levelID);
CREATE INDEX ON vaultcodes (accountID);
CREATE INDEX ON vaultcodes (targetUserID);
CREATE INDEX ON vaultcodes (targetAccountID);
CREATE INDEX ON vaultcodes (server);
CREATE INDEX ON vaultcodes (toAccountID);
CREATE INDEX ON vaultcodes (accID);
CREATE INDEX ON vaultcodes (accountID);
CREATE INDEX ON vaultcodes (IP);
CREATE INDEX ON vaultcodes (levelID);
CREATE INDEX ON vaultcodes (hostname);
CREATE INDEX ON vaultcodes (roleID);
CREATE INDEX ON vaultcodes (accountID);
CREATE INDEX ON vaultcodes (priority);
CREATE INDEX ON vaultcodes (toolModactions);
CREATE INDEX ON vaultcodes (name);
CREATE INDEX ON vaultcodes (authorName);
CREATE INDEX ON vaultcodes (name);
CREATE INDEX ON vaultcodes (authorName);
CREATE INDEX ON vaultcodes (timestamp);
CREATE INDEX ON vaultcodes (userID);
CREATE INDEX ON vaultcodes (userName);
CREATE INDEX ON vaultcodes (stars);
CREATE INDEX ON vaultcodes (demons);
CREATE INDEX ON vaultcodes (coins);
CREATE INDEX ON vaultcodes (userCoins);
CREATE INDEX ON vaultcodes (gameVersion);
CREATE INDEX ON vaultcodes (creatorPoints);
CREATE INDEX ON vaultcodes (diamonds);
CREATE INDEX ON vaultcodes (orbs);
CREATE INDEX ON vaultcodes (completedLvls);
CREATE INDEX ON vaultcodes (isBanned);
CREATE INDEX ON vaultcodes (isCreatorBanned);
CREATE INDEX ON vaultcodes (extID);
CREATE INDEX ON vaultcodes (IP);
CREATE INDEX ON vaultcodes (isRegistered);