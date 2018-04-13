/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : huonu

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 13/04/2018 20:33:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for huonu_admin
-- ----------------------------
DROP TABLE IF EXISTS `huonu_admin`;
CREATE TABLE `huonu_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员账号',
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员邮箱',
  `face` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员头像',
  `role` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员角色',
  `status` smallint(2) NOT NULL DEFAULT 10 COMMENT '状态 10 活跃 0 不活跃',
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_time` int(11) NOT NULL DEFAULT 0 COMMENT '上一次登录时间',
  `last_ip` char(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '上一次登录的IP',
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '地址信息',
  `created_at` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '管理员信息表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huonu_admin
-- ----------------------------
INSERT INTO `huonu_admin` VALUES (1, 'super', 'super@admin.com', '', 'administrator', 10, 'gKkLFMdB2pvIXOFNpF_Aeemvdf1j0YUM', '$2y$13$Nuf1mzDRoCMxrWI.rIjENu20QshJG41smdEeHFHxq0qdmS99YytHy', '5vLaPpUS-I-XxJaoGP-GZDk474WdnaK3_1469073015', 1501996501, '127.0.0.1', '湖南省,岳阳市,岳阳县', 1501996501, 1501996501);
INSERT INTO `huonu_admin` VALUES (2, 'admin', 'admin@admin.com', '', 'admin', 10, 'tArp_Kv4z1JlzBUZYCL33N24AZL-_77p', '$2y$13$RNrJ7GK1A5iZRxBpho6sbeCJKfNRxzy5axCeRjZLqvA5W6RuVYBRW', 'CgScbf1E96N3pqH01b0mVi_Z58j8QsRV_1501916190', 1523596953, '::1', '湖南省,岳阳市,岳阳县', 1501996501, 1523596953);
INSERT INTO `huonu_admin` VALUES (3, 'prtens', 'prtens@qq.com', '', '超级管理员', 0, 'NRz_iMgbwYW9As59mEMSdGHLguV-cxlh', '$2y$13$TV.w3JwwWH/l1yHCxtxZB.UGWCJozwut9Sbxor0oT1/KzjwIBsBIi', NULL, 0, '', '', 1523599853, 1523599853);
INSERT INTO `huonu_admin` VALUES (4, 'haizeiwang', 'haizeiwang@qq.com', '', '超级管理员', 0, 'iCTvJVlCbGMaEkcuRe9_7hF4ILn_CNot', '$2y$13$XcLWA.3arfJRnmWcAxLbjOlWZN/S4CRXlkzRfloIY4QO5UgHRmXMC', NULL, 0, '', '', 1523601719, 1523601719);
INSERT INTO `huonu_admin` VALUES (6, 'huxiao', 'huxiao@163.com', '', '超级管理员', 10, 'EYlcs53RDd-I9YlwdflPCk0w7NfGzOW8', '$2y$13$gjk3YIRikYkeWlgASzVzpufnyHwNI2W2z..nNGTa6b5T5boIXlhOa', NULL, 0, '', '', 1523614184, 1523614184);
INSERT INTO `huonu_admin` VALUES (7, '李四', 'lisi@qq.com', '', '超级管理员', 0, 'HVcY8evhtXmI1TiZGdqLONCyO7l9VRkS', '$2y$13$kvUDOFFuEvuMvywin2wIA.PQHovrfysIeJzDofE4wVvDjF8shhMpu', NULL, 0, '', '', 1523614366, 1523614366);
INSERT INTO `huonu_admin` VALUES (8, '王二码子', 'haizeiw@qq.com', '', '超级管理员', 10, 'gmngo9xAufcoeBQcpAyuS_T796ZkBqdq', '$2y$13$6ufwSFeWVktRJtujRkWEp.9EgGVUnCZpwRLuhSpX/J3W/ZC17raHu', NULL, 0, '', '', 1523614566, 1523614566);
INSERT INTO `huonu_admin` VALUES (9, '北方吹', '1017vdawergr34@qq.com', '', '超级管理员', 10, 'YPV-mCA6TBDE9P58CRDXw5M--KKfkchb', '$2y$13$ySfpH7lJKAZeSEzIA3X5N.4ZNK5HHMIt928lZChfryImEJ4JIWLCG', NULL, 0, '', '', 1523616552, 1523616552);
INSERT INTO `huonu_admin` VALUES (10, 'dfweagwe', '1017098134dvwegewgew@qq.com', '', '超级管理员', 10, 'VVFbkL1ncjuAQFqjD_8Ll1CTWxMMHmEp', '$2y$13$e0mt2beQtMOzJZJsLwwXneRyoqJr6IS/vyHZnQLKR3SHyQ2X9ngfW', NULL, 0, '', '', 1523616721, 1523616721);
INSERT INTO `huonu_admin` VALUES (11, 'sdwfweewfew', '101e709e8e134@qq.com', '', '超级管理员', 10, 'qeUw3tCHHBSyE_z2HeiAxLGVCiwsaMCK', '$2y$13$133NUgTSsGQItZ0RDfNMvu/v3g8DcOk1LX5iIeaK.Bq8LK.T2ThQO', NULL, 0, '', '', 1523619309, 1523619309);
INSERT INTO `huonu_admin` VALUES (12, 'sdwfweewfewsdf', '101efwefeew709e8e134@qq.com', '', '超级管理员', 10, 'MqZT_vhjac36_Aq1jJiTpjZlLuURxdcG', '$2y$13$Q3.WNXT3aeibZ0Eps2JE1OJ7xeqJmy5rtm8LRSt/u.vB4obOUAGmu', NULL, 0, '', '', 1523619337, 1523619337);

-- ----------------------------
-- Table structure for huonu_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `huonu_auth_assignment`;
CREATE TABLE `huonu_auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `auth_assignment_user_id_idx`(`user_id`) USING BTREE,
  CONSTRAINT `huonu_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `huonu_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '角色与用户对应关系表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huonu_auth_assignment
-- ----------------------------
INSERT INTO `huonu_auth_assignment` VALUES ('administrator', '1', 1523596866);
INSERT INTO `huonu_auth_assignment` VALUES ('administrator', '2', 1523596941);
INSERT INTO `huonu_auth_assignment` VALUES ('超级管理员', '1', 1523596849);
INSERT INTO `huonu_auth_assignment` VALUES ('超级管理员', '2', 1523596941);

-- ----------------------------
-- Table structure for huonu_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `huonu_auth_item`;
CREATE TABLE `huonu_auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL COMMENT 'type=1角色,type=2权限',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE,
  CONSTRAINT `huonu_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `huonu_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '角色|权限表,type=1角色,type=2权限' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huonu_auth_item
-- ----------------------------
INSERT INTO `huonu_auth_item` VALUES ('/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/base/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/default/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/default/db-explain', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/default/download-mail', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/default/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/default/toolbar', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/default/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/user/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/debug/user/set-identity', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/default/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/default/action', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/default/diff', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/default/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/default/preview', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/gii/default/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/site/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/site/captcha', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/site/error', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/site/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/site/login', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/site/logout', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/assignment/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/assignment/assign', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/assignment/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/assignment/revoke', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/assignment/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/default/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/default/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/assign', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/create', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/delete', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/remove', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/update', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/item/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/menu/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/menu/create', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/menu/delete', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/menu/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/menu/update', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/menu/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/assign', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/create', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/delete', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/remove', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/update', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/permission/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/assign', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/create', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/delete', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/remove', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/update', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/role/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/route/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/route/assign', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/route/create', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/route/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/route/refresh', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/route/remove', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/rule/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/rule/create', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/rule/delete', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/rule/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/rule/update', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/rule/view', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/user/*', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/user/index', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('/system/user/signup', 2, NULL, NULL, NULL, 1523596684, 1523596684);
INSERT INTO `huonu_auth_item` VALUES ('administrator', 2, '超级管理员(网站开发、运维等管理人员)', NULL, NULL, 1523596733, 1523596733);
INSERT INTO `huonu_auth_item` VALUES ('超级管理员', 1, '超级管理员(网站开发、运维等管理人员)', NULL, NULL, 1523596810, 1523596810);

-- ----------------------------
-- Table structure for huonu_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `huonu_auth_item_child`;
CREATE TABLE `huonu_auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `huonu_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `huonu_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `huonu_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `huonu_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '角色对应的权限,parent角色,child权限名' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huonu_auth_item_child
-- ----------------------------
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/base/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/default/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/default/db-explain');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/default/download-mail');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/default/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/default/toolbar');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/default/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/user/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/user/reset-identity');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/debug/user/set-identity');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/default/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/default/action');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/default/diff');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/default/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/default/preview');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/gii/default/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/site/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/site/captcha');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/site/error');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/site/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/site/login');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/site/logout');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/assignment/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/assignment/assign');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/assignment/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/assignment/revoke');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/assignment/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/default/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/default/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/assign');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/create');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/delete');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/remove');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/update');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/item/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/menu/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/menu/create');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/menu/delete');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/menu/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/menu/update');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/menu/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/assign');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/create');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/delete');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/remove');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/update');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/permission/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/assign');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/create');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/delete');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/remove');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/update');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/role/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/route/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/route/assign');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/route/create');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/route/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/route/refresh');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/route/remove');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/rule/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/rule/create');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/rule/delete');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/rule/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/rule/update');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/rule/view');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/user/*');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/user/index');
INSERT INTO `huonu_auth_item_child` VALUES ('administrator', '/system/user/signup');
INSERT INTO `huonu_auth_item_child` VALUES ('超级管理员', 'administrator');

-- ----------------------------
-- Table structure for huonu_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `huonu_auth_rule`;
CREATE TABLE `huonu_auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '规则,规则类名' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for huonu_log
-- ----------------------------
DROP TABLE IF EXISTS `huonu_log`;
CREATE TABLE `huonu_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '日志类型',
  `module` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块',
  `controller` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '方法',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `params` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '请求参数',
  `agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作用户浏览器代理商',
  `ip` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作用户IP',
  `created_at` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `created_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建用户',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台操作记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huonu_log
-- ----------------------------
INSERT INTO `huonu_log` VALUES (1, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfew\",\"email\":\"101e709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$7cOgM5drZeW/lnFn7Yh/mu3oZda0ffdUj544Zy1QGC5uwSztfYcyq\",\"auth_key\":\"R4U78Oi6bmkLJTQfugD9FcYhZLVDrZ87\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619112, 2);
INSERT INTO `huonu_log` VALUES (2, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfew\",\"email\":\"101e709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$133NUgTSsGQItZ0RDfNMvu/v3g8DcOk1LX5iIeaK.Bq8LK.T2ThQO\",\"auth_key\":\"qeUw3tCHHBSyE_z2HeiAxLGVCiwsaMCK\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619309, 2);
INSERT INTO `huonu_log` VALUES (3, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfew\",\"email\":\"101e709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$9gbxGo1DvHA2Kc/nemWrHeQj5pKS2uT0EprJMjiW.fsYKbCaQc7ke\",\"auth_key\":\"TMX9Xfj25OmI3WL4WfJUWmpsnxwQkYmc\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619320, 2);
INSERT INTO `huonu_log` VALUES (4, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfewsdf\",\"email\":\"101efwefeew709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$Q3.WNXT3aeibZ0Eps2JE1OJ7xeqJmy5rtm8LRSt/u.vB4obOUAGmu\",\"auth_key\":\"MqZT_vhjac36_Aq1jJiTpjZlLuURxdcG\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619337, 2);
INSERT INTO `huonu_log` VALUES (5, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfewsdf\",\"email\":\"101efwefeew709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$i2iGcePPJGl2voFi/g.1turywKNQKLBPvJulG2eFmZ3dJmMl3CvQ2\",\"auth_key\":\"CYn0V8RBFquqLSygajNkI-_Uo_lApBve\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619379, 2);
INSERT INTO `huonu_log` VALUES (6, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfewsdf\",\"email\":\"101efwefeew709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$GF6yATJwjra88afwDi6zD.m7btNwiggSvLcTqOQxb1qphPlNCOU3y\",\"auth_key\":\"ncBWWBW-nwiN6ZMMAIILaXZTuWVJHhNx\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619418, 2);
INSERT INTO `huonu_log` VALUES (7, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfewsdf\",\"email\":\"101efwefeew709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$IBbSYh7vlecr3yLMEvXrKOhpH6MopBQ56fAOqoBjXdCLSRqLKzs9C\",\"auth_key\":\"NIwALuc8LAK3eYhrhNe8DpYJlSnWhJTD\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619476, 2);
INSERT INTO `huonu_log` VALUES (8, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfewsdf\",\"email\":\"101efwefeew709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$NT7vOcvMkVEni7cm45FBbuvBEt7zDrZMMv3oW.xpv9UujZ8AviGTm\",\"auth_key\":\"Qz5BoVQ3PnZbjYlQJxzkOE7V8xRAH2D2\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619525, 2);
INSERT INTO `huonu_log` VALUES (9, 1, 'system', 'user', 'signup', '/system/user/signup.html', '{\"username\":\"sdwfweewfewsdf\",\"email\":\"101efwefeew709e8e134@qq.com\",\"role\":\"超级管理员\",\"password_hash\":\"$2y$13$8M0/vBvAmY/L9TjTIJkOYu16rZKUeUWkpXd96eXT0onfe3rmmisBe\",\"auth_key\":\"-iz9UPNSZHRcBqBCBcuIlPXBHctukHQo\"}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '::1', 1523619658, 2);

-- ----------------------------
-- Table structure for huonu_menu
-- ----------------------------
DROP TABLE IF EXISTS `huonu_menu`;
CREATE TABLE `huonu_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent`(`parent`) USING BTREE,
  CONSTRAINT `huonu_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `huonu_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '栏目' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huonu_menu
-- ----------------------------
INSERT INTO `huonu_menu` VALUES (1, '系统管理', NULL, '/system/default/index', 1, NULL);
INSERT INTO `huonu_menu` VALUES (2, '管理员列表', 1, '/system/user/index', 1, NULL);
INSERT INTO `huonu_menu` VALUES (3, '分配', 1, '/system/assignment/index', 2, NULL);
INSERT INTO `huonu_menu` VALUES (4, '角色列表', 1, '/system/role/index', 3, NULL);
INSERT INTO `huonu_menu` VALUES (5, '权限列表', 1, '/system/permission/index', 4, NULL);
INSERT INTO `huonu_menu` VALUES (6, '路由列表', 1, '/system/route/index', 5, NULL);
INSERT INTO `huonu_menu` VALUES (7, '规则列表', 1, '/system/rule/index', 6, NULL);
INSERT INTO `huonu_menu` VALUES (8, '菜单列表', 1, '/system/menu/index', 7, NULL);
INSERT INTO `huonu_menu` VALUES (9, '控制台', NULL, '/site/index', 2, NULL);

-- ----------------------------
-- Table structure for huonu_migration
-- ----------------------------
DROP TABLE IF EXISTS `huonu_migration`;
CREATE TABLE `huonu_migration`  (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huonu_migration
-- ----------------------------
INSERT INTO `huonu_migration` VALUES ('m000000_000000_base', 1523611724);
INSERT INTO `huonu_migration` VALUES ('m130524_201442_init', 1523611726);
INSERT INTO `huonu_migration` VALUES ('m170801_072726_create_admin', 1523611726);
INSERT INTO `huonu_migration` VALUES ('m180413_090505_admin_log', 1523611727);

-- ----------------------------
-- Table structure for huonu_user
-- ----------------------------
DROP TABLE IF EXISTS `huonu_user`;
CREATE TABLE `huonu_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huonu_user
-- ----------------------------
INSERT INTO `huonu_user` VALUES (5, 'prtens', 'FX2Hr_VlNzvptRDnrFYBgBVGY62zE4Gb', '$2y$13$iVk19JFjl3zIxCpOTcVIN.Ht8z8WX5jevFZWRA6gbKdoQECcBnXvC', NULL, '1017098134@qq.com', 10, 1523242003, 1523242003);

SET FOREIGN_KEY_CHECKS = 1;
