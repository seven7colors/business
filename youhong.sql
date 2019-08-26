/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : youhong

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-08-26 18:24:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yh_admin`
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin`;
CREATE TABLE `yh_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_admin
-- ----------------------------
INSERT INTO `yh_admin` VALUES ('1', 'admin', 'admin');

-- ----------------------------
-- Table structure for `yh_carousel`
-- ----------------------------
DROP TABLE IF EXISTS `yh_carousel`;
CREATE TABLE `yh_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) DEFAULT NULL,
  `cate_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `many_thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_carousel
-- ----------------------------
INSERT INTO `yh_carousel` VALUES ('1', '1', '生鲜', '20190810\\4f575b1ed1287bcd45255adbe500477b.jpg,20190810\\10e8c10b5961395ff7a112a52f22cf72.jpg,20190810\\67c62a84b178497c15580cc9cdd0e9db.jpg');
INSERT INTO `yh_carousel` VALUES ('2', '18', '母婴玩具', '20190809\\f3f984216cd228195e225660b30a6d3c.jpg,20190809\\7822e64b4be1d1dc4dffe9e44ca203da.jpg');
INSERT INTO `yh_carousel` VALUES ('3', '0', '大屏幕', '20190810\\5cb7724e1238ea8f2649e6acd8272b4a.jpg,20190810\\049070d972299e045bb793305272422a.jpg');

-- ----------------------------
-- Table structure for `yh_cart`
-- ----------------------------
DROP TABLE IF EXISTS `yh_cart`;
CREATE TABLE `yh_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `g_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `g_price` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `g_thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `yh_category`
-- ----------------------------
DROP TABLE IF EXISTS `yh_category`;
CREATE TABLE `yh_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `cate_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `level` tinyint(1) DEFAULT '1' COMMENT '1:一级分类;2:二级分类;',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_category
-- ----------------------------
INSERT INTO `yh_category` VALUES ('1', '0', '生鲜', '1');
INSERT INTO `yh_category` VALUES ('16', '0', '食品饮料', '1');
INSERT INTO `yh_category` VALUES ('17', '0', '个人美妆', '1');
INSERT INTO `yh_category` VALUES ('18', '0', '母婴玩具', '1');
INSERT INTO `yh_category` VALUES ('19', '0', '家具生活', '1');
INSERT INTO `yh_category` VALUES ('20', '0', '数码家电', '1');
INSERT INTO `yh_category` VALUES ('21', '1', '水果', '2');
INSERT INTO `yh_category` VALUES ('26', '16', '可乐', '2');
INSERT INTO `yh_category` VALUES ('23', '20', '电脑', '2');
INSERT INTO `yh_category` VALUES ('25', '20', '手机', '2');
INSERT INTO `yh_category` VALUES ('27', '17', '香水', '2');
INSERT INTO `yh_category` VALUES ('31', '16', '雪碧', '2');
INSERT INTO `yh_category` VALUES ('29', '19', '沙发', '2');
INSERT INTO `yh_category` VALUES ('33', '18', '玩具', '2');
INSERT INTO `yh_category` VALUES ('34', '18', '婴儿用品', '2');

-- ----------------------------
-- Table structure for `yh_goods`
-- ----------------------------
DROP TABLE IF EXISTS `yh_goods`;
CREATE TABLE `yh_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `g_price` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `g_content` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `g_thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `many_thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cate_id` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_goods
-- ----------------------------
INSERT INTO `yh_goods` VALUES ('15', '美国柚', '12', '<p>	&nbsp;&nbsp; 光和热环境和环境<br/></p>', './uploads/156388710608ad21c6f9da6bdf51ae0b971f43d96d.png', '20190723\\7d6f473d9c37f58c94c4d5e5f38ddb21.jpg', '21', '56');
INSERT INTO `yh_goods` VALUES ('16', '挖掘机', '58', '<p>	&nbsp; &nbsp;	</p><p>	&nbsp;&nbsp; 分公司更国际化的hi就爱u<br/></p><p>	</p>', './uploads/1563944966c3daba8ba04565423e12eb8cb6237b46.png', '20190724\\d42c2a1d484cb419e3a07082b832be6e.jpg', '33', '56');
INSERT INTO `yh_goods` VALUES ('14', '奶粉', '1688', '<p>	&nbsp;&nbsp; 发育也如意湖 <br/></p>', './uploads/1563885109cfe8504bda37b575c70ee1a8276f3486.png', '20190723\\3e479c506041337baccbd5eb26cce8d1.jpg', '34', '190');
INSERT INTO `yh_goods` VALUES ('17', '苹果X', '6688', '<p>	&nbsp;&nbsp; 发放及覅按时覅uan<br/></p>', './uploads/15643906347b66b4fd401a271a1c7224027ce111bc.png', '20190729\\1b6da76f97232e956f120e26c7391057.jpg', '25', '189');
INSERT INTO `yh_goods` VALUES ('18', '宜家宝石蓝沙发', '1688', '<p>	&nbsp;&nbsp; 规范丧失公司工商局<br/></p>', './uploads/156439072254baf7f8288c87badf5f2dfb62baa1c3.png', '20190729\\66d394a4c3506d00717716a3cd3fadc1.jpg', '29', '58');
INSERT INTO `yh_goods` VALUES ('19', '迪欧法国茉莉香水', '559', '<p>	&nbsp;&nbsp; 让你欲罢不能<br/></p>', './uploads/1564390829c5ad7d5c8e1cd311a06a038f2510bfdc.png', '20190729\\690b3dfdb1060b9392ea0cf11b683106.jpg', '27', '123');
INSERT INTO `yh_goods` VALUES ('20', '十周年特别版可口可乐', '19', '<p>	&nbsp;&nbsp; 让你爽翻夏天<br/></p>', './uploads/1564391079f19fec2f129fbdba76493451275c883a.png', '20190729\\2280d3fde873146980482816a39a2b8e.jpg', '26', '288');

-- ----------------------------
-- Table structure for `yh_order`
-- ----------------------------
DROP TABLE IF EXISTS `yh_order`;
CREATE TABLE `yh_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `order_serial` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `order_time` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `sum_price` int(11) DEFAULT NULL,
  `sum_num` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0:已确认，未付款，未发货;1已确认，已付款，未发货:;2:已确认，已付款，已发货;',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_order
-- ----------------------------
INSERT INTO `yh_order` VALUES ('4', '2', '201907311914123032', '1564571652', '2120', '37', '0');

-- ----------------------------
-- Table structure for `yh_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `yh_order_goods`;
CREATE TABLE `yh_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(25) DEFAULT NULL,
  `g_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `g_price` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `g_thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_order_goods
-- ----------------------------
INSERT INTO `yh_order_goods` VALUES ('5', '4', '宜家宝石蓝沙发', '1688', '1', '18', './uploads/156439072254baf7f8288c87badf5f2dfb62baa1c3.png');
INSERT INTO `yh_order_goods` VALUES ('6', '4', '美国柚', '12', '36', '15', './uploads/156388710608ad21c6f9da6bdf51ae0b971f43d96d.png');

-- ----------------------------
-- Table structure for `yh_reciver`
-- ----------------------------
DROP TABLE IF EXISTS `yh_reciver`;
CREATE TABLE `yh_reciver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `countryside` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `recivername` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `reciveremail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `reciverphone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `recivertelphone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `build` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `recivertime` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0:不是默认;1:默认',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_reciver
-- ----------------------------
INSERT INTO `yh_reciver` VALUES ('16', '5', '四川', '宜宾', '成华区', '中国', '法师法说', '发发', '刚发', '发发', '发个爱国', '格式', '发  嘎嘎', '发发 ', '0');
INSERT INTO `yh_reciver` VALUES ('20', '2', '重庆', '宜宾', '锦江区', '中国', '林慧怡', '564987@qq.com', '广州天鹅湖', '521532', '15920250640', '020-564515', '广东技术师范大学', '7.23', '1');

-- ----------------------------
-- Table structure for `yh_user`
-- ----------------------------
DROP TABLE IF EXISTS `yh_user`;
CREATE TABLE `yh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yh_user
-- ----------------------------
INSERT INTO `yh_user` VALUES ('2', 'ukk', '123456', '156546', '155', './uploads/1563712947536a76f94cf7535158f66cfbd4b113b6.png');
INSERT INTO `yh_user` VALUES ('5', 'ukk45', '456546', '156546', '155', null);
INSERT INTO `yh_user` VALUES ('7', 'lichuxian', '123456', '1813055215@qq.com', '17875661579', '20190721\\a9145d41096bf699b21ab55b4b07cfed.jpg');
INSERT INTO `yh_user` VALUES ('8', '林慧怡', '', '32612300@qq.com', '17915531254', './uploads/1563696799bd853b475d59821e100d3d24303d7747.png');
