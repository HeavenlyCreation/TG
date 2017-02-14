# Host: localhost  (Version: 5.5.53)
# Date: 2017-02-14 23:26:47
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "eorder"
#

DROP TABLE IF EXISTS `eorder`;
CREATE TABLE `eorder` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `OrderNum` varchar(20) NOT NULL COMMENT '订单号',
  `LoginID` varchar(11) NOT NULL COMMENT '登录ID，用户微信号',
  `Tel` varchar(15) NOT NULL COMMENT '用户电话',
  `AddressCD` varchar(30) NOT NULL COMMENT '订单安装地址',
  `AddressDif` varchar(100) NOT NULL COMMENT '订单安装地址自定义部分',
  `SumPrice` decimal(12,2) NOT NULL COMMENT '订单总价',
  `CommitTime` datetime DEFAULT NULL COMMENT '提交时间',
  `BookFitTime` datetime DEFAULT NULL COMMENT '预约安装时间',
  `OrderStatus` varchar(30) NOT NULL COMMENT '订单状态',
  `FinishTime` datetime DEFAULT NULL COMMENT '安装完成时间',
  `Remark` text COMMENT '备注',
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='订单基本信息';

#
# Data for table "eorder"
#

/*!40000 ALTER TABLE `eorder` DISABLE KEYS */;
INSERT INTO `eorder` VALUES (1,'TJ201607310008','1000','','','',100.00,'2016-08-03 22:33:00',NULL,'',NULL,NULL),(2,'TJ201607310005','1101','','','',10.00,NULL,NULL,'',NULL,NULL),(3,'TJ201607310001','1101','','120101','',11.00,NULL,NULL,'OrderStatus-4',NULL,NULL),(4,'TJ201607310002','1000','','130202','12',1.00,'2016-10-16 06:26:37','2016-10-16 06:26:37','OrderStatus-0','2016-10-16 06:26:37','34'),(5,'TJ201607310003','1102','','','',2.00,NULL,NULL,'',NULL,NULL),(6,'TJ201607310006','1102','67890904519','120101','滨江道',3.00,'2016-09-27 01:00:55','2016-09-26 00:00:55','OrderStatus-3','2016-09-26 00:00:55','快点！！！'),(7,'TJ201607310007','1000','','','',4.00,NULL,NULL,'',NULL,NULL),(8,'TJ201607310009','1102','','','',5.00,NULL,NULL,'',NULL,NULL),(9,'TJ201607310010','1103','','','',6.00,NULL,NULL,'',NULL,NULL),(10,'TJ201607310011','1000','','','',7.00,NULL,NULL,'',NULL,NULL),(11,'TJ201607310012','1103','','','',8.00,NULL,NULL,'',NULL,NULL),(12,'TJ201607310013','1103','','','',9.00,NULL,NULL,'',NULL,NULL),(13,'TJ201607310004','1101','','','',13.00,NULL,'2016-08-03 22:32:42','',NULL,NULL);
/*!40000 ALTER TABLE `eorder` ENABLE KEYS */;

#
# Structure for table "eorderproduct"
#

DROP TABLE IF EXISTS `eorderproduct`;
CREATE TABLE `eorderproduct` (
  `OrderProductID` int(11) NOT NULL COMMENT '订单产品ID',
  `OrderID` int(11) NOT NULL COMMENT '订单ID',
  `ProductID` int(11) NOT NULL COMMENT '产品ID',
  `Quantity` int(11) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`OrderProductID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单中选择的安装产品';

#
# Data for table "eorderproduct"
#

/*!40000 ALTER TABLE `eorderproduct` DISABLE KEYS */;
INSERT INTO `eorderproduct` VALUES (1,2,3,2),(2,1,2,1),(3,1,1,2),(4,0,4,1),(5,0,5,2),(6,0,6,1);
/*!40000 ALTER TABLE `eorderproduct` ENABLE KEYS */;

#
# Structure for table "etakeorder"
#

DROP TABLE IF EXISTS `etakeorder`;
CREATE TABLE `etakeorder` (
  `TakeOrderID` int(11) NOT NULL COMMENT '接单记录ID',
  `OrderID` int(11) DEFAULT NULL COMMENT '订单ID',
  `WorkerID` int(11) DEFAULT NULL COMMENT '工人ID',
  `IfTake` bit(1) DEFAULT NULL COMMENT '是否接单：0.弃单，1.接单',
  `TakeTime` datetime DEFAULT NULL COMMENT '接单时间',
  `AbandonCode` varchar(30) DEFAULT NULL COMMENT '弃单原因：对应 码表 中AbandonType的码表Key',
  `AbandonRemark` text COMMENT '弃单原因备注',
  PRIMARY KEY (`TakeOrderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='接单记录';

#
# Data for table "etakeorder"
#

/*!40000 ALTER TABLE `etakeorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `etakeorder` ENABLE KEYS */;

#
# Structure for table "maddress"
#

DROP TABLE IF EXISTS `maddress`;
CREATE TABLE `maddress` (
  `AddressCD` char(6) NOT NULL COMMENT '城市数据CD',
  `AddressName` varchar(20) NOT NULL COMMENT '地区名称',
  `RegionLevel` int(11) DEFAULT NULL COMMENT '行政等级：1.省，2.市，3.区',
  `AreaCode` char(4) DEFAULT NULL COMMENT '长途区号',
  `PostCode` char(6) DEFAULT NULL COMMENT '邮政编码',
  PRIMARY KEY (`AddressCD`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='地址表';

#
# Data for table "maddress"
#

/*!40000 ALTER TABLE `maddress` DISABLE KEYS */;
INSERT INTO `maddress` VALUES ('110000','北京市',1,NULL,NULL),('110100','北京市',2,NULL,NULL),('110101','东城区',3,NULL,NULL),('110102','西城区',3,NULL,NULL),('120000','天津市',1,NULL,NULL),('120100','天津市',2,NULL,NULL),('120101','和平区',3,NULL,NULL),('120102','河东区',3,NULL,NULL),('130000','河北省',1,NULL,NULL),('130100','石家庄市',2,NULL,NULL),('130102','长安区',3,NULL,NULL),('130103','桥东区',3,NULL,NULL),('130200','唐山市',2,NULL,NULL),('130202','路南区',3,NULL,NULL);
/*!40000 ALTER TABLE `maddress` ENABLE KEYS */;

#
# Structure for table "mcode"
#

DROP TABLE IF EXISTS `mcode`;
CREATE TABLE `mcode` (
  `CodeCD` varchar(30) NOT NULL COMMENT 'CodeTable键',
  `CodeValue` tinyint(4) NOT NULL COMMENT 'CodeTable值',
  `CodeDesc` varchar(50) NOT NULL COMMENT '描述',
  `CodeType` varchar(30) NOT NULL COMMENT '类型',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `Sort` tinyint(4) NOT NULL COMMENT '同类型记录间的排序',
  PRIMARY KEY (`CodeCD`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='码表';

#
# Data for table "mcode"
#

/*!40000 ALTER TABLE `mcode` DISABLE KEYS */;
INSERT INTO `mcode` VALUES ('at_Cheap',2,'价格低','AbandonType','弃单原因',2),('at_Far',3,'距离远','AbandonType','弃单原因',3),('at_Mistaken',4,'订单信息有误','AbandonType','弃单原因',4),('at_Other',0,'其他原因','AbandonType','弃单原因',0),('at_UnableInstall',5,'特殊产品无法安装','AbandonType','弃单原因',5),('at_UserCanceled',1,'消费者取消服务','AbandonType','弃单原因',1),('os_AgainReserve',4,'再预约','OrderStatus','订单状态',4),('os_Cancel',0,'已取消','OrderStatus','订单状态-用户主动取消订单',0),('os_Feedback',7,'已反馈','OrderStatus','订单状态',7),('os_Installed',5,'已安装','OrderStatus','订单状态',5),('os_NotTake',1,'待接单','OrderStatus','订单状态',1),('os_WaitFeedback',6,'待反馈','OrderStatus','订单状态',6),('os_WaitInstall',3,'待安装','OrderStatus','订单状态',3),('os_WaitReserve',2,'待预约','OrderStatus','订单状态',2),('ut_Admin',0,'管理员','UserType','账户类型',0),('ut_Customer',2,'顾客','UserType','账户类型',2),('ut_Worker',1,'工人','UserType','账户类型',1),('ws_Rest',2,'休息中','WorkStatus',NULL,2),('ws_Work',1,'工作中','WorkStatus',NULL,1);
/*!40000 ALTER TABLE `mcode` ENABLE KEYS */;

#
# Structure for table "mcustomer"
#

DROP TABLE IF EXISTS `mcustomer`;
CREATE TABLE `mcustomer` (
  `CustomerID` int(11) NOT NULL COMMENT '顾客ID',
  `UserID` int(11) NOT NULL COMMENT '用户ID',
  `AddressCD1` char(6) NOT NULL COMMENT '地址1',
  `AddressDif1` varchar(50) NOT NULL COMMENT '地址1自定义部分',
  `AddressCD2` char(6) DEFAULT NULL COMMENT '地址2',
  `AddressDif2` varchar(50) DEFAULT NULL COMMENT '地址2自定义部分',
  `InsTime` datetime DEFAULT NULL COMMENT '新建时间',
  `UpdTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='顾客信息表';

#
# Data for table "mcustomer"
#

/*!40000 ALTER TABLE `mcustomer` DISABLE KEYS */;
INSERT INTO `mcustomer` VALUES (0,1003,'','',NULL,NULL,NULL,NULL),(1,1001,'','',NULL,NULL,NULL,NULL),(2,1004,'','',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mcustomer` ENABLE KEYS */;

#
# Structure for table "mlogin"
#

DROP TABLE IF EXISTS `mlogin`;
CREATE TABLE `mlogin` (
  `LoginID` int(11) NOT NULL AUTO_INCREMENT COMMENT '登录记录ID',
  `UserName` varchar(50) NOT NULL COMMENT '登陆账号，管理员是邮箱，工人、用户是微信号',
  `Password` varchar(255) DEFAULT NULL COMMENT '登陆密码，管理员、工人登录需要输入密码',
  `UserTypeCD` varchar(30) DEFAULT NULL COMMENT '账户类型：取自 MCode 表 UserType 的记录',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我',
  PRIMARY KEY (`LoginID`)
) ENGINE=MyISAM AUTO_INCREMENT=1113 DEFAULT CHARSET=utf8;

#
# Data for table "mlogin"
#

/*!40000 ALTER TABLE `mlogin` DISABLE KEYS */;
INSERT INTO `mlogin` VALUES (1000,'admin','$2y$10$G9kpmzq6eHvQsGG0iDE6yOpOsSf9bA3sjytUSrCLcJ6853BA/Xnf.','ut_Admin','JBiOGKbmjMkirKHxXGqkmHdnM6xg75VNjebBlRfDkbD5pcDurWWabtozC7q7'),(1101,'12345678901','$2y$10$G9kpmzq6eHvQsGG0iDE6yOpOsSf9bA3sjytUSrCLcJ6853BA/Xnf.','ut_Worker',NULL),(1102,'23456789012','$2y$10$G9kpmzq6eHvQsGG0iDE6yOpOsSf9bA3sjytUSrCLcJ6853BA/Xnf.','ut_Worker',NULL),(1103,'34567890123','$2y$10$G9kpmzq6eHvQsGG0iDE6yOpOsSf9bA3sjytUSrCLcJ6853BA/Xnf.','ut_Worker',NULL),(1108,'test1','$2y$10$7o2pqLGL7NJuj.jCPiVSQ.dBnd7phTC7gOI4Xq81WpJDrf8vlxWfK','ut_Worker',NULL),(1109,'1111','$2y$10$yBgU7H0acZhDA74pJ8XPlun/5X19b2vsAoTsYFtCg/8HRwI7vogfy','ut_Worker',NULL),(1110,'ffffffff','$2y$10$iJomF4XZar/5o8PjqXxIeu3HKL.lFmuzxB9FW7Ty7sIHwZytd9OM6','ut_Worker',NULL),(1111,'33333333333','$2y$10$6DaITtvZUzchgD/L7adag.8I9IuRC2MF9QOjOG44W8hlMziLhGl3C','ut_Worker',NULL),(1112,'dd','$2y$10$3MMpRGot87g5qSA.cgjZCeilH9ZJfB6akiRf3eY2IPvhDX2nqjr6G','ut_Worker',NULL);
/*!40000 ALTER TABLE `mlogin` ENABLE KEYS */;

#
# Structure for table "mproduct"
#

DROP TABLE IF EXISTS `mproduct`;
CREATE TABLE `mproduct` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT COMMENT '产品ID',
  `ProductCategoryID` int(11) NOT NULL COMMENT '产品类别-MProductCatetory(MPCID)',
  `ProductName` varchar(20) NOT NULL COMMENT '产品名称',
  `UnitKey` varchar(30) DEFAULT NULL COMMENT '产品单位',
  `Price` decimal(6,2) DEFAULT NULL COMMENT '产品单价',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `CreatedTime` datetime DEFAULT NULL COMMENT '创建时间',
  `Status` int(11) DEFAULT '0' COMMENT '状态 0：正常，-1：删除或下架',
  PRIMARY KEY (`ProductID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='产品表';

#
# Data for table "mproduct"
#

/*!40000 ALTER TABLE `mproduct` DISABLE KEYS */;
INSERT INTO `mproduct` VALUES (9,2,'水晶灯（3头以内）',NULL,24.00,'','2017-02-08 15:51:43',0),(10,2,'',NULL,0.00,'','2017-02-14 13:50:25',0);
/*!40000 ALTER TABLE `mproduct` ENABLE KEYS */;

#
# Structure for table "mproductcategory"
#

DROP TABLE IF EXISTS `mproductcategory`;
CREATE TABLE `mproductcategory` (
  `ProductCategoryID` int(11) NOT NULL AUTO_INCREMENT COMMENT '产品种类ID',
  `ParentID` int(11) DEFAULT NULL COMMENT '上级产品种类ID',
  `CategoryName` varchar(20) NOT NULL COMMENT '产品种类名称',
  `CreatedTime` datetime DEFAULT NULL COMMENT '创建时间',
  `Status` int(11) DEFAULT '0',
  PRIMARY KEY (`ProductCategoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='产品种类表';

#
# Data for table "mproductcategory"
#

/*!40000 ALTER TABLE `mproductcategory` DISABLE KEYS */;
INSERT INTO `mproductcategory` VALUES (1,NULL,'浴具','0000-00-00 00:00:00',0),(2,NULL,'灯具','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `mproductcategory` ENABLE KEYS */;

#
# Structure for table "munit"
#

DROP TABLE IF EXISTS `munit`;
CREATE TABLE `munit` (
  `UnitKey` varchar(30) NOT NULL COMMENT '单位键',
  `UnitValue` varchar(30) NOT NULL COMMENT '单位名称',
  `UnitType` varchar(30) DEFAULT NULL COMMENT '单位种类',
  `Sort` tinyint(4) DEFAULT NULL COMMENT '相同种类记录排序',
  PRIMARY KEY (`UnitKey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品单位表';

#
# Data for table "munit"
#

/*!40000 ALTER TABLE `munit` DISABLE KEYS */;
/*!40000 ALTER TABLE `munit` ENABLE KEYS */;

#
# Structure for table "muser"
#

DROP TABLE IF EXISTS `muser`;
CREATE TABLE `muser` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `LoginID` varchar(20) DEFAULT NULL COMMENT '登录ID，管理员是邮箱，工人是微信号',
  `JobID` varchar(12) NOT NULL COMMENT '工号',
  `Name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `Nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `IdentityNum` char(18) DEFAULT NULL COMMENT '身份证',
  `JobNumber` varchar(50) DEFAULT NULL,
  `Sex` bit(1) DEFAULT NULL COMMENT '性别',
  `Age` tinyint(4) DEFAULT NULL COMMENT '年龄',
  `WxCD` varchar(30) DEFAULT NULL COMMENT '微信账号',
  `Tel` varchar(15) DEFAULT NULL COMMENT '电话',
  `Tel2` varchar(15) DEFAULT NULL COMMENT '电话2',
  `AddressCD` varchar(6) DEFAULT NULL COMMENT '住址CD',
  `AddressDif` varchar(50) DEFAULT NULL COMMENT '住址自定义部分',
  `BusArea` char(6) DEFAULT NULL COMMENT '业务区域，地址6位码',
  `BusType1` int(11) DEFAULT NULL COMMENT '业务种类1',
  `BusType2` int(11) DEFAULT NULL COMMENT '业务种类2',
  `BusType3` int(11) DEFAULT NULL COMMENT '业务种类3',
  `Readme` varchar(255) DEFAULT NULL COMMENT '自述(自己给自己打广告语)',
  `WorkTime` datetime DEFAULT NULL COMMENT '自定义工作时间',
  `InsTime` datetime DEFAULT NULL COMMENT '加入时间',
  `UpdTime` datetime DEFAULT NULL COMMENT '更新时间',
  `WorkStatus` varchar(30) NOT NULL DEFAULT '0',
  `Status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

#
# Data for table "muser"
#

/*!40000 ALTER TABLE `muser` DISABLE KEYS */;
INSERT INTO `muser` VALUES (1000,'1000','','admin','user0nn',NULL,NULL,b'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',0),(1001,'1104','','work4','user1nn',NULL,NULL,b'1',NULL,NULL,'123','345',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',0),(1002,'1101','','work1','user2nn','363636363636363636','A001',b'1',NULL,'wx123456','55555555555','666666666','130202','fdsfadsafdsaf f dsafdsaf sa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',0),(1003,'1102','','work2','wk2nn',NULL,'111',b'1',NULL,NULL,NULL,NULL,'110101',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',0),(1004,'1103','','work3','wk3nn',NULL,'222',b'1',NULL,NULL,NULL,NULL,'110101',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',0),(1008,'1108','','test',NULL,'test1','test1',b'1',NULL,'321','123123','21321',NULL,'3213123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',-1),(1009,'1109','','test',NULL,'3232','33',b'1',NULL,'323','23','32',NULL,'3232',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',-1),(1010,'1110','','ffffffff',NULL,'3123213','213213',b'1',NULL,'321312','21312','321321',NULL,'321312312',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',-1),(1011,'1112','','3333333',NULL,'333333333333','33333333333333',b'1',NULL,'33333333333333','333333333333','3333333333333',NULL,'33333333',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ws_Work',-1);
/*!40000 ALTER TABLE `muser` ENABLE KEYS */;
