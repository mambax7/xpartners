# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `xoops_partners`
#

CREATE TABLE xpartners (
  id          INT(10)      NOT NULL AUTO_INCREMENT,
  weight      INT(10)      NOT NULL DEFAULT '0',
  hits        INT(10)      NOT NULL DEFAULT '0',
  url         VARCHAR(150) NOT NULL DEFAULT '',
  image       VARCHAR(150) NOT NULL DEFAULT '',
  title       VARCHAR(50)  NOT NULL DEFAULT '',
  description VARCHAR(255)          DEFAULT NULL,
  status      TINYINT(1)   NOT NULL DEFAULT '1',
  approve     TINYINT(1)   NOT NULL DEFAULT '1',
  PRIMARY KEY (id),
  KEY status(status)
)
  ENGINE = MyISAM;

CREATE TABLE `xpartners_category` (
  `cat_id`          INT(10)      NOT NULL,
  `cat_title`       VARCHAR(50)  NOT NULL,
  `cat_description` VARCHAR(255) NOT NULL,
  `cat_weight`      INT(10)      NOT NULL,
  `dohtml`          TINYINT(1)   NOT NULL DEFAULT '1',
  `doxcode`         TINYINT(1)   NOT NULL DEFAULT '1',
  `dosmiley`        TINYINT(1)   NOT NULL DEFAULT '1',
  `doimage`         TINYINT(1)   NOT NULL DEFAULT '1',
  `dobr`            TINYINT(1)   NOT NULL DEFAULT '0'
)
  ENGINE = MyISAM;
