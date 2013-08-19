GRANT ALL ON cms.* TO 'dbuser01'@'localhost' IDENTIFIED BY '1nsecur3' WITH GRANT OPTION;

CREATE  TABLE `cms`.`session` (
  `session_id` INT NOT NULL AUTO_INCREMENT ,
  `session_sid` VARCHAR(45) NULL ,
  `session_uid` VARCHAR(45) NULL ,
  PRIMARY KEY (`session_id`) );

CREATE  TABLE `cms`.`role` (
  `role_id` INT NOT NULL AUTO_INCREMENT ,
  `role_name` VARCHAR(100) NULL ,
  PRIMARY KEY (`role_id`) );

CREATE  TABLE `cms`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(100) NULL ,
  `user_passwd` VARCHAR(100) NULL ,
  `user_forename` VARCHAR(100) NULL ,
  `user_surename` VARCHAR(100) NULL ,
  `user_email` VARCHAR(100) NULL ,
  `user_bdate` DATE NULL ,
  `user_valid` INT NULL ,
  `user_role` INT NULL ,
  PRIMARY KEY (`user_id`) );

CREATE  TABLE `cms`.`content` (
  `content_id` INT NOT NULL AUTO_INCREMENT ,
  `content_name` VARCHAR(100) NULL ,
  `content_url` VARCHAR(300) NULL ,
  `content_type` VARCHAR(100) NULL ,
  `content_content` VARCHAR(5000) NULL ,
  `content_created` DATETIME NULL ,
  `content_updated` DATETIME NULL ,
  `content_use` DATETIME NULL ,
  `content_published` DATETIME NULL ,
  `content_parent` INT NULL ,
  PRIMARY KEY (`content_id`) );

CREATE  TABLE `cms`.`visitor` (
  `visitor_id` INT NOT NULL AUTO_INCREMENT ,
  `visitor_ip` VARCHAR(15) NULL ,
  `visitor_banned` INT NULL ,
  `visitor_counter` INT NULL ,
  `visitor_rndtime` VARCHAR(15) NULL ,
  `visitor_lastsite` VARCHAR(300) NULL ,
  `visitor_lastdate` DATETIME NULL ,
  `visitor_browser` VARCHAR(300) NULL ,
  PRIMARY KEY (`visitor_id`) );
  







