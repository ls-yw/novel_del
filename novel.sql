/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : novel

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2019-11-04 16:10:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL DEFAULT '' COMMENT '用户名',
  `password_hash` varchar(60) NOT NULL DEFAULT '' COMMENT '密码',
  `auth_key` varchar(200) NOT NULL DEFAULT '',
  `truename` varchar(6) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `last_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin11', '', '', '', '1970-01-01 08:00:00', '1', '1970-01-01 08:00:00', '1970-01-01 08:00:00');
INSERT INTO `admin` VALUES ('2', 'admin', '$2y$13$MkF214g3dOM31buDGPh3T.9YgTufmbB6TmESH7PLjyCDrEA/PBQtS', '3ubMvH-KTMU7vuxMuiirYJ24UnApvVVN', 'ye', '2019-10-31 16:27:58', '0', '2019-10-31 16:20:49', '2019-10-31 16:20:49');

-- ----------------------------
-- Table structure for admin_logs
-- ----------------------------
DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `add_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_logs
-- ----------------------------
INSERT INTO `admin_logs` VALUES ('admin', 'admin', '10.0.2.2', '2019-10-31 15:30:40');
INSERT INTO `admin_logs` VALUES ('admin', '', '10.0.2.2', '2019-10-31 15:32:16');
INSERT INTO `admin_logs` VALUES ('admin', 'admin', '10.0.2.2', '2019-10-31 15:32:21');
INSERT INTO `admin_logs` VALUES ('admin', 'admin', '10.0.2.2', '2019-10-31 15:32:43');
INSERT INTO `admin_logs` VALUES ('admin', '123456', '10.0.2.2', '2019-10-31 15:37:11');
INSERT INTO `admin_logs` VALUES ('admin', '', '10.0.2.2', '2019-10-31 15:40:00');
INSERT INTO `admin_logs` VALUES ('admin', '123456', '10.0.2.2', '2019-10-31 16:21:10');
INSERT INTO `admin_logs` VALUES ('admin', '123456', '10.0.2.2', '2019-10-31 16:23:18');
INSERT INTO `admin_logs` VALUES ('admin', '123456', '10.0.2.2', '2019-10-31 16:25:11');
INSERT INTO `admin_logs` VALUES ('admin', '', '10.0.2.2', '2019-10-31 16:27:58');

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被采集方IP',
  `domain_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('1', '7169', '1', '惊悚乐园', '', '', '1970-01-01 08:00:00');

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `value` varchar(200) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of configs
-- ----------------------------
INSERT INTO `configs` VALUES ('1', 'hostname', '竹刻书', 'common');
INSERT INTO `configs` VALUES ('2', 'host', 'novel.woodlsy.com', 'common');
INSERT INTO `configs` VALUES ('3', 'keywords', '竹刻书', 'common');
INSERT INTO `configs` VALUES ('4', 'description', '竹刻书', 'common');

-- ----------------------------
-- Table structure for domain
-- ----------------------------
DROP TABLE IF EXISTS `domain`;
CREATE TABLE `domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) NOT NULL DEFAULT '' COMMENT '站点域名',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '站点名称',
  `book_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '小说规则',
  `author_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '作者规则',
  `chapter_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '章节规则',
  `content_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '内容规则',
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否采集',
  `bookname_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '小说名称规则',
  `descript_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '简介规则',
  `paging_regular` varchar(255) NOT NULL DEFAULT '' COMMENT '上下章规则',
  `book_mark_id` varchar(100) NOT NULL DEFAULT '' COMMENT '小说URL子序号运算方式',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 08:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of domain
-- ----------------------------
INSERT INTO `domain` VALUES ('1', 'https://www.hkslg.net', '顺隆书院', '<{markid}>/<{bookid}>/index.html', '<em>作者：(.*)</em></h1>', '/$/$/$.html', '</SCRIPT></TD></TR></TABLE><P>****</P></DIV></TD>', '1', '<h1 class=\"f20h\">****<em>作者', '<!--内容简介-->****<!--内容简介结束-->', '<DIV ID=\"thumb\">****<SCRIPT TYPE=\"text/javascript\" SRC=\"/gaogao/zhangjie/page-bottom2.js\"></SCRIPT>', '<{bookid}>%%1000', '2019-10-31 16:48:51', '2019-10-31 17:04:39');

-- ----------------------------
-- Table structure for keywords
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `is_hot` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keywords
-- ----------------------------
INSERT INTO `keywords` VALUES ('a', '4', '1');
INSERT INTO `keywords` VALUES ('惊悚乐园', '1', '0');
