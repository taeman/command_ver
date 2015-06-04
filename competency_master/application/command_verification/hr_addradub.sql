/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : cmss_master

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2015-06-04 15:33:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hr_addradub
-- ----------------------------
DROP TABLE IF EXISTS `hr_addradub`;
CREATE TABLE `hr_addradub` (
  `runid` int(10) NOT NULL auto_increment,
  `level_id` varchar(16) default NULL,
  `radub` varchar(200) NOT NULL default '',
  `radub_real` varchar(20) default NULL,
  `active_status` int(2) default '0' COMMENT 'สถานะระดับที่ใช้จริง',
  `orderby` int(5) default NULL,
  `type_id` int(4) default NULL COMMENT 'รหัส',
  `active_now` int(1) default '0',
  `com_type_id` int(11) default NULL,
  `position_line_after` int(11) default NULL,
  PRIMARY KEY  (`runid`),
  KEY `index_1` (`runid`),
  KEY `index_level_id` (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=880 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of hr_addradub
-- ----------------------------
INSERT INTO `hr_addradub` VALUES ('311', '92254702', 'ท.2', '2', '3', '2', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('4', '92254703', 'ท.3', '3', '3', '3', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('5', '92254704', 'ท.4', '4', '3', '4', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('6', '92254705', 'ท.5', '5', '3', '5', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('7', '92254706', 'ท.6', '6', '3', '6', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('8', '92254707', 'ท.7', '7', '3', '7', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('9', '92254708', 'ท.8', '8', '3', '8', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('10', '92254709', 'ท.9', '9', '3', '9', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('11', '92254710', 'ท.10', '10', '3', '10', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('12', '92254711', 'ท.11', '11', '3', '11', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('31', '91254704', 'คศ.4', 'cs4', '2', '4', null, '1', '1', null);
INSERT INTO `hr_addradub` VALUES ('81', '91254701', 'คศ.1', 'cs1', '2', '1', null, '1', '1', null);
INSERT INTO `hr_addradub` VALUES ('121', '91254703', 'คศ.3', 'cs3', '2', '3', null, '1', '1', null);
INSERT INTO `hr_addradub` VALUES ('131', '91254702', 'คศ.2', 'cs2', '2', '2', null, '1', '1', null);
INSERT INTO `hr_addradub` VALUES ('191', '91250002', 'ตรี', '1', '0', '13', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('221', '91250003', 'โท', '2', '0', '14', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('281', '91254700', 'ครูผู้ช่วย', 'cs0', '2', '0', null, '1', '1', null);
INSERT INTO `hr_addradub` VALUES ('351', '92254701', 'ท.1', '1', '3', '1', null, '0', '2', null);
INSERT INTO `hr_addradub` VALUES ('431', '91250001', 'จัตวา', '1', '0', '15', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('531', '4252101', 'พ.1', '1', '0', '1', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('737', '92255107', 'ชำนาญการพิเศษ', null, '3', '18', '3', '1', '2', '1');
INSERT INTO `hr_addradub` VALUES ('738', '92255111', 'ชำนาญงาน', null, '3', '13', '4', '1', '2', '2');
INSERT INTO `hr_addradub` VALUES ('739', '92255106', 'ชำนาญการ', null, '3', '17', '3', '1', '2', '1');
INSERT INTO `hr_addradub` VALUES ('740', '92255112', 'อาวุโส', null, '3', '14', '4', '1', '2', '2');
INSERT INTO `hr_addradub` VALUES ('741', '92255105', 'ปฏิบัติการ', null, '3', '16', '3', '1', '2', '1');
INSERT INTO `hr_addradub` VALUES ('746', '4252103', 'ป.1', null, '0', '1', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('792', '91254705', 'คศ.5', 'cs5', '2', '5', null, '1', '1', null);
INSERT INTO `hr_addradub` VALUES ('796', '92255110', 'ปฏิบัติงาน', null, '3', '12', '4', '1', '2', '2');
INSERT INTO `hr_addradub` VALUES ('832', '4252102', 'พ.2', null, '0', '2', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('833', '4252134', 'ป.2', null, '0', '2', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('834', '91250004', 'เอก', null, '0', null, null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('835', '92255104', 'อำนวยการ(สูง)', null, '3', '22', '2', '1', null, null);
INSERT INTO `hr_addradub` VALUES ('836', '92255102', 'บริหาร(สูง)', null, '3', '24', '1', '1', null, null);
INSERT INTO `hr_addradub` VALUES ('837', '92255113', 'ทักษะพิเศษ', null, '3', '15', '4', '1', null, null);
INSERT INTO `hr_addradub` VALUES ('838', '92255109', 'ทรงคุณวุฒิ', null, '3', '20', '3', '1', null, '1');
INSERT INTO `hr_addradub` VALUES ('839', '92255103', 'อำนวยการ(ต้น)', null, '3', '21', '2', '1', null, null);
INSERT INTO `hr_addradub` VALUES ('840', '92255101', 'บริหาร(ต้น)', null, '3', '23', '1', '1', null, null);
INSERT INTO `hr_addradub` VALUES ('841', '92255108', 'เชี่ยวชาญ', null, '3', '19', '3', '1', null, '1');
INSERT INTO `hr_addradub` VALUES ('842', '4252104', 'ป.3', null, '0', '3', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('843', '4252105', 'ส.1', null, '0', '1', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('844', '4252106', 'ส.2', null, '0', '2', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('845', '4252107', 'ส.3', null, '0', '3', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('846', '4252108', 'ส.4', null, '0', '4', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('847', '4252109', 'ส.5', null, '0', '5', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('848', '4252110', 'ส.6', null, '0', '6', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('849', '4252111', 'ส.7', '', '0', '7', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('850', '4252112', 'ส.8', null, '0', '8', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('851', '4252113', 'ส.9', null, '0', null, null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('852', '4252114', 'น.1', null, '0', '1', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('853', '4252115', 'น.2', null, '0', '2', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('854', '4252116', 'น.3', null, '0', '3', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('855', '4252117', 'น.4', null, '0', '4', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('856', '4252118', 'น.5', null, '0', '5', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('857', '4252119', 'น.6', null, '0', '6', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('858', '4252120', 'น.7', null, '0', '7', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('859', '4252121', 'น.8', null, '0', '8', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('860', '4252122', 'น.9', null, '0', '9', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('861', '92254712', 'บ.11', null, '3', '12', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('862', '4252123', '1', '1', '2', '25', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('863', '4252124', '2', '2', '2', '26', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('864', '4252125', '3', '3', '2', '27', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('865', '4252126', '4', '4', '2', '28', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('866', '4252127', '5', '5', '2', '29', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('867', '4252128', '6', '6', '2', '30', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('868', '4252129', '7', '7', '2', '31', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('869', '4252130', '8', '8', '2', '32', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('870', '4252131', '9', '9', '2', '33', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('871', '4252132', '10', '10', '2', '34', null, '0', null, null);
INSERT INTO `hr_addradub` VALUES ('872', '4252133', '11', '11', '2', '35', null, '0', null, null);
