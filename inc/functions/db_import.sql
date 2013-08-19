
-- Create User
INSERT INTO `cms`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (0, 'admin', 'nimda', 'Maik', 'Vattersen', 'v@exigem.com', '1977-04-25', 1, 0); 
INSERT INTO `cms`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (1, 'hwurst', '123456', 'Hans', 'Wurst', 'hwurst@domain.de', '1975-02-13', 1, 1);
INSERT INTO `cms`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (2, 'mines', '123456', 'Maria', 'Ines', 'mines@domain.de', '1977-08-26', 1, 2);
INSERT INTO `cms`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (3, 'nmeier', '123456', 'Nils', 'Meier', 'nmeier@domain.de', '1982-03-03', 1, 3);
INSERT INTO `cms`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (4, 'mschulz', '123456', 'Michael', 'Schulz', 'schulzmic@web.de', '1971-08-26', 1, 4);

-- Create session
INSERT INTO `cms`.`session` (`session_id`, `session_sid`, `session_uid`) VALUES (0, '1', '1');

-- Create Role
INSERT INTO `cms`.`role` (`role_id`, `role_name`) VALUES (0, 'Administrator');
INSERT INTO `cms`.`role` (`role_id`, `role_name`) VALUES (1, 'Redakteur');
INSERT INTO `cms`.`role` (`role_id`, `role_name`) VALUES (2, 'Author');
INSERT INTO `cms`.`role` (`role_id`, `role_name`) VALUES (3, 'Worker');
INSERT INTO `cms`.`role` (`role_id`, `role_name`) VALUES (4, 'Abonnent');

-- Create Content
INSERT INTO `cms`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 1, 'Startpage', 'start', 'multi', 
    'Welcome to the About Us page, this ist the Content of the Aboutpage. 
    This is a little bit mor Content to see how Linebreaks ar falling. <br /><br />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
    
    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. <br /><br />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );
INSERT INTO `cms`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 2, 'Impressum', 'imprint', 'single', 
    'Welcome to the Imprint page, this ist the Content of the Imprintpage', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );
INSERT INTO `cms`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 3, 'Ueber Uns', 'about', 'special', 
    'Welcome to the About Us page, this ist the Content of the About Us page', '2013-08-17 10:24:59', '2013-08-17 20:55:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );
INSERT INTO `cms`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 4, 'Bilder', 'images', 'gallery', 
    'Welcome to the Image Gallery page, this ist the Content of the Image Gallery page', '2013-08-17 18:46:19', '2013-08-17 20:55:59', '2013-08-17 18:46:19', '2013-08-17 18:46:19', 0 );
INSERT INTO `cms`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 5, 'Kontakt', 'contact', 'contact', 'Welcome to the Contact Us page, this ist the Content of the Contact Us page', '2013-08-17 20:13:35', '2013-08-17 20:55:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );
INSERT INTO `cms`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 6, 'Urlaub', 'Holiday', 'holiday', 
    'Welcome to the Holiday page, this ist the Content of the Holiday page', '2013-08-17 19:02:51', '2013-08-17 20:55:59', '2013-08-17 18:46:19', '2013-08-17 18:46:19', 3 );
    
-- Create visitors
INSERT INTO `cms`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (1, '183.129.2.31', 0, 1, '0.182', 'https://spawn/vaddi/cms/admin/login.php', '2013-08-18 11:14:12', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');
    
INSERT INTO `cms`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (2, '153.39.36.183', 0, 1, '0.772', 'https://spawn/vaddi/cms/', '2013-08-18 11:27:31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');

INSERT INTO `cms`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (3, '223.210.212.245', 1, 20, '0.273', 'https://spawn/vaddi/cms/admin/login.php', '2013-08-18 11:31:48', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');

INSERT INTO `cms`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (4, '127.0.0.1', 0, 20, '0.273', 'https://spawn/vaddi/cms/admin/login.php', '2013-08-18 12:13:33', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');



