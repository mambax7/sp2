#
# Structure table for `soapbox8_sbcolumns` 8
#

CREATE TABLE `soapbox8_sbcolumns` (
  `columnID`    TINYINT(4)   NOT NULL  AUTO_INCREMENT,
  `author`      INT(8)       NOT NULL,
  `name`        VARCHAR(255) NOT NULL,
  `description` TEXT         NOT NULL,
  `total`       INT(11)      NOT NULL  DEFAULT 0,
  `weight`      INT(11)      NOT NULL  DEFAULT 1,
  `colimage`    VARCHAR(255) NOT NULL  DEFAULT 'blank.png',
  `created`     INT(11)      NOT NULL  DEFAULT 1033141070,
  PRIMARY KEY (`columnID`)
)
  ENGINE = MyISAM;

#
# Structure table for `soapbox8_sbarticles` 22
#

CREATE TABLE `soapbox8_sbarticles` (
  `articleID`   INT(8)          NOT NULL  AUTO_INCREMENT,
  `columnID`    TINYINT(4)      NOT NULL  DEFAULT 0,
  `headline`    VARCHAR(255)    NOT NULL  DEFAULT '0',
  `lead`        TEXT            NOT NULL,
  `bodytext`    TEXT            NOT NULL,
  `teaser`      TEXT            NOT NULL,
  `uid`         INT(6)          NULL      DEFAULT 1,
  `submit`      INT(1)          NOT NULL  DEFAULT 0,
  `datesub`     INT(11)         NOT NULL  DEFAULT 1033141070,
  `counter`     INT(8) UNSIGNED NOT NULL  DEFAULT 0,
  `weight`      INT(11)         NOT NULL  DEFAULT 1,
  `html`        TINYINT(1)      NOT NULL  DEFAULT 0,
  `smiley`      TINYINT(1)      NOT NULL  DEFAULT 0,
  `xcodes`      TINYINT(1)      NOT NULL  DEFAULT 0,
  `breaks`      TINYINT(1)      NOT NULL  DEFAULT 1,
  `block`       INT(11)         NOT NULL  DEFAULT 0,
  `artimage`    VARCHAR(255)    NOT NULL,
  `votes`       INT(11)         NOT NULL  DEFAULT 0,
  `rating`      DOUBLE(6, 4)    NOT NULL  DEFAULT '0.0000',
  `commentable` INT(11)         NOT NULL  DEFAULT 0,
  `offline`     INT(11)         NOT NULL  DEFAULT 0,
  `notifypub`   INT(11)         NOT NULL  DEFAULT 0,
  PRIMARY KEY (`articleID`)
)
  ENGINE = MyISAM;

#
# Structure table for `soapbox8_sbvotedata` 6
#

CREATE TABLE `soapbox8_sbvotedata` (
  `ratingid`        INT(11) UNSIGNED    NOT NULL  AUTO_INCREMENT,
  `lid`             INT(11) UNSIGNED    NOT NULL  DEFAULT 0,
  `ratinguser`      INT(11)             NOT NULL  DEFAULT 0,
  `rating`          TINYINT(3) UNSIGNED NOT NULL  DEFAULT 0,
  `ratinghostname`  VARCHAR(60)         NOT NULL,
  `ratingtimestamp` INT(10)             NOT NULL  DEFAULT 0,
  PRIMARY KEY (`ratingid`)
)
  ENGINE = MyISAM;

#
# Structure table for `soapbox8_test` 14
#

CREATE TABLE `soapbox8_test` (
  `id`             INT(8)       NOT NULL  AUTO_INCREMENT,
  `text`           VARCHAR(55)  NOT NULL,
  `textarea`       TEXT         NOT NULL,
  `dhtml`          TEXT         NOT NULL,
  `checkbox`       INT          NOT NULL,
  `radioyn`        INT          NOT NULL,
  `selectbox`      INT          NOT NULL,
  `selectuser`     INT          NOT NULL,
  `colorpicker`    VARCHAR(50)  NOT NULL,
  `uploadimage`    VARCHAR(100) NOT NULL,
  `uploadfile`     VARCHAR(100) NOT NULL,
  `textdataselect` VARCHAR(55)  NOT NULL,
  `datetimeselect` INT          NOT NULL,
  `articleslink`   INT          NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;
