<!DOCTYPE html>
<html lang="de">
<?php 

#include('./auth.php');
$conf = "../config.php";
include($conf);
include('../inc/functions/globals.php');
include('../inc/head.php');

//If the form is submitted
if(isset($_POST['submitted'])) {

    // require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Bitte geben Sie einen Namen ein!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
		//$name = str_replace($r1, $r2, $name);
		//$name = str_replace('[^\w\s[:punct:]]*', ' ', $name);

	}

    // need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Bitte geben Sie eine g&uuml;ltige email Adresse ein.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'Sie haben keine g&uuml;ltige email Adresse eingegeben.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}


    // require a password from user
	if(trim($_POST['password']) === '') {
		$passwordError =  'Bitte geben Sie ein Passwort ein!'; 
		$hasError = true;
	} else if (strlen(trim($_POST['password'])) < 3)
	{
	    $passwordError =  'Ihr Passwort sollte mindestens 3 Zeichen Lang sein!'; 
		$hasError = true;
	    
	} else {
		$password = trim($_POST['password']);
		$password = base64_encode( sha1($password . SITE_SALT, true) . SITE_SALT );
	}

    $date = $_POST['date'];
    
    if(!isset($hasError)) {
        
        // write databases
        $mydb = new connector(SQL_PATH,SQL_USER,SQL_PASSWD,SQL_NAME);
        
        $query = "CREATE DATABASE ". SQL_NAME ." CHARACTER SET utf8;";
        $mydb->query($query);
        
        $query = "GRANT ALL ON ". SQL_NAME .".* TO '". SQL_USER ."'@'". SQL_PATH ."' IDENTIFIED BY '". SQL_PASSWD ."' WITH GRANT OPTION;";
        $mydb->query($query);

        $query = "CREATE  TABLE `". SQL_NAME ."`.`session` ( `session_id` INT NOT NULL AUTO_INCREMENT , `session_sid` VARCHAR(45) NULL , `session_uid` VARCHAR(45) NULL ,  PRIMARY KEY (`session_id`) );";
        $mydb->query($query);
        
        $query = "CREATE  TABLE `". SQL_NAME ."`.`role` ( `role_id` INT NOT NULL AUTO_INCREMENT , `role_name` VARCHAR(100) NULL , PRIMARY KEY (`role_id`) );";
        $mydb->query($query);
        
        $query = "CREATE  TABLE `". SQL_NAME ."`.`user` ( `user_id` INT NOT NULL AUTO_INCREMENT , `user_name` VARCHAR(100) NULL , `user_passwd` VARCHAR(100) NULL , `user_forename` VARCHAR(100) NULL , `user_surename` VARCHAR(100) NULL , `user_email` VARCHAR(100) NULL , `user_bdate` DATE NULL , `user_valid` INT NULL , `user_role` INT NULL , PRIMARY KEY (`user_id`) );";
        $mydb->query($query);
        
        $query = "CREATE  TABLE `". SQL_NAME ."`.`content` ( `content_id` INT NOT NULL AUTO_INCREMENT , `content_name` VARCHAR(100) NULL , `content_url` VARCHAR(300) NULL , `content_type` VARCHAR(100) NULL , `content_content` VARCHAR(5000) NULL , `content_created` DATETIME NULL , `content_updated` DATETIME NULL , `content_use` DATETIME NULL , `content_published` DATETIME NULL , `content_parent` INT NULL , PRIMARY KEY (`content_id`) );";
        $mydb->query($query);
        
        $query = "CREATE  TABLE `". SQL_NAME ."`.`visitor` ( `visitor_id` INT NOT NULL AUTO_INCREMENT , `visitor_ip` VARCHAR(15) NULL , `visitor_banned` INT NULL , `visitor_counter` INT NULL , `visitor_rndtime` VARCHAR(15) NULL , `visitor_lastsite` VARCHAR(300) NULL , `visitor_lastdate` DATETIME NULL , `visitor_browser` VARCHAR(300) NULL , PRIMARY KEY (`visitor_id`) );";
        $mydb->query($query);
        
        // Realdatafill
        
        $query = "INSERT INTO `". SQL_NAME ."`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (0, '" . $name . "', '" . $password . "', '" . $forename . "', '" . $surename . "', '" . $email . "', '" . $bdate . "', 1, 0);";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`session` (`session_id`, `session_sid`, `session_uid`) VALUES ( 0, '1', '0' );";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES ( 0, '127.0.0.1', 0, 1, '0.523', 'https://DOMAIN.COM/index.php', '" . date('Y-m-d H:i:s') . "', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0' );";
        $mydb->query($query);
        
        
        // DEMO DATA FILL
        
        // USER
        $query = "INSERT INTO `". SQL_NAME ."`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (1, 'hwurst', '123456', 'Hans', 'Wurst', 'hwurst@domain.de', '1975-02-13', 1, 1);";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (2, 'mines', '123456', 'Maria', 'Ines', 'mines@domain.de', '1977-08-26', 1, 2);";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (3, 'nmeier', '123456', 'Nils', 'Meier', 'nmeier@domain.de', '1982-03-03', 1, 3);";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`user` (`user_id`, `user_name`, `user_passwd`, `user_forename`, `user_surename`, `user_email`, `user_bdate`, `user_valid`, `user_role`) VALUES (4, 'mschulz', '123456', 'Michael', 'Schulz', 'schulzmic@web.de', '1971-08-26', 1, 4);";
        $mydb->query($query);
        
        
        // Session
        $query = "INSERT INTO `". SQL_NAME ."`.`session` (`session_id`, `session_sid`, `session_uid`) VALUES (1, '1', '1');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`session` (`session_id`, `session_sid`, `session_uid`) VALUES (2, '1', '2');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`session` (`session_id`, `session_sid`, `session_uid`) VALUES (3, '1', '3');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`session` (`session_id`, `session_sid`, `session_uid`) VALUES (4, '1', '4');";
        $mydb->query($query);
        
        
        // Role
        $query = "INSERT INTO `". SQL_NAME ."`.`role` (`role_id`, `role_name`) VALUES (0, 'Administrator');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`role` (`role_id`, `role_name`) VALUES (1, 'Redakteur');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`role` (`role_id`, `role_name`) VALUES (2, 'Author');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`role` (`role_id`, `role_name`) VALUES (3, 'Worker');";
        $mydb->query($query);
        $query = "INSERT INTO `". SQL_NAME ."`.`role` (`role_id`, `role_name`) VALUES (4, 'Abonnent');";
        $mydb->query($query);
        
        
        // Content
        $query = "INSERT INTO `". SQL_NAME ."`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 1, 'Startpage', 'start', 'multi', 
    'Welcome to the About Us page, this ist the Content of the Aboutpage. 
    This is a little bit mor Content to see how Linebreaks ar falling. <br /><br />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
    
    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. <br /><br />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 2, 'Impressum', 'imprint', 'single', 
    'Welcome to the Imprint page, this ist the Content of the Imprintpage', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 3, 'Ueber Uns', 'about', 'special', 
    'Welcome to the About Us page, this ist the Content of the About Us page', '2013-08-17 10:24:59', '2013-08-17 20:55:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 4, 'Bilder', 'images', 'gallery', 
    'Welcome to the Image Gallery page, this ist the Content of the Image Gallery page', '2013-08-17 18:46:19', '2013-08-17 20:55:59', '2013-08-17 18:46:19', '2013-08-17 18:46:19', 0 );";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 5, 'Kontakt', 'contact', 'contact', 'Welcome to the Contact Us page, this ist the Content of the Contact Us page', '2013-08-17 20:13:35', '2013-08-17 20:55:59', '2013-08-17 10:24:59', '2013-08-17 10:24:59', 0 );";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`content` (`content_id`, `content_name`, `content_url`, `content_type`, `content_content`,  `content_created`,  `content_updated`, `content_use`, `content_published`, `content_parent`) VALUES ( 6, 'Urlaub', 'Holiday', 'holiday', 
    'Welcome to the Holiday page, this ist the Content of the Holiday page', '2013-08-17 19:02:51', '2013-08-17 20:55:59', '2013-08-17 18:46:19', '2013-08-17 18:46:19', 3 );";
        $mydb->query($query);
        
        
        // Visitors
        $query = "INSERT INTO `". SQL_NAME ."`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (1, '183.129.2.31', 0, 1, '0.182', 'https://spawn/vaddi/cms/admin/login.php', '2013-08-18 11:14:12', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (2, '153.39.36.183', 0, 1, '0.772', 'https://spawn/vaddi/cms/', '2013-08-18 11:27:31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');";
        $mydb->query($query);
        
        $query = "INSERT INTO `". SQL_NAME ."`.`visitor` (`visitor_id`, `visitor_ip`, `visitor_banned`, `visitor_counter`, `visitor_rndtime`, `visitor_lastsite`, `visitor_lastdate`, `visitor_browser`) VALUES (3, '223.210.212.245', 1, 20, '0.273', 'https://spawn/vaddi/cms/admin/login.php', '2013-08-18 11:31:48', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0');";
        $mydb->query($query);
        
        
        $setup = true;
        
    } // Error parser
    
} // Close Post

?>

<body onload="ladezeit()">

<div id="wrap">

<?php include('../inc/header_admin.php'); ?>

<div id="content_area">

<div id="sidebar">
<?php include('../inc/nav_admin.php'); ?>
</div>

  <div class="content_item">
    
    
    
    <?php if(isset($setup) && $setup == true) { ?>
	  <meta http-equiv="refresh" content="<?= WAIT ?>; url=index.php" />  
          <h3>Setup Bericht</h3>
          
          <p class="valid fade-in">Installation erfolgreich abgeschlossen.</p>
          <br />
          <p class="info" style="margin-bottom:50px;">
            <?php  
              foreach ($setupArr as $key => $item)
              {
                  if ($key == count($cfield))
                  {
                      echo "<br />";
                      
                  } 
                  echo $key + 1 . " - " . $setupArr[$key] . "<br />\n";
              }
          
            ?>
            <br /><br />
            <span>Installation erfolgreich abgeschlossen.</span>
          </p>
          
        <?php } else { ?>
        
	  <div class="desc">
	    <p class="desc"> </p>
	  </div>
				
	  <div id="install-form">
	    <?php $date = date("Y-m-d H:i:s"); ?>
	    <span class="right"><?= $date ?></span>
        <h3>Installationsassistent</h3>
        
	  
	    <?php if(isset($hasError)) { ?>
          <p class="invalid fade-in">Bitte geben Sie Ihre Daten in die vorgesehenen Felder ein und klicken anschlie&szlig;end auf Absenden. <br />Es ist notwendig eine gültige E-Mail Adresse f&uuml;r Systemnachrichten anzugeben.</p> <br /><br />
        <?php } ?>

	
        <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post">
        
        <!-- Versteckte Infos -->
        <input type="hidden" name="date" id="date" value="<?= $date ?>" />
          
          <div class="formblock">
		    <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField <?php if($nameError != '') { echo inputError; } ?>" 
		    placeholder="Name:"
		    onfocus="if(this.value=='Name:')this.value=''" 
            onblur="if(this.value=='') this.value=this.defaultValue;" />
		    <?php if($nameError != '') { ?>
		    <span class="error"><?php echo $nameError;?></span> 
		    <?php } ?>
	      </div>
          
          <div class="formblock">
		    <input type="email" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" class="txt requiredField email <?php if($emailError != '') { echo 'inputError'; } ?>" 
		    placeholder="Email:" 
		    onfocus="if(this.value=='Email:')this.value=''" 
            onblur="if(this.value=='') this.value=this.defaultValue;" />
		    <?php if($emailError != '') { ?>
		      <span class="error"><?php echo $emailError;?></span>
		    <?php } ?>
	      </div>
	      
	      <div class="formblock">
		    <input type="text" name="password" id="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>" class="txt requiredField password <?php if($passwordError != '') { echo 'inputError'; } ?>"
		    placeholder="Passwort" 
            onfocus="if(this.value=='Passwort')this.value=''" 
            onblur="if(this.value=='') this.value=this.defaultValue;" />
		    <?php if($passwordError != '') { ?>
		      <span class="error"><?php echo $passwordError;?></span>
		    <?php } ?>
	      </div>
	      
	      <br />
        
          <div class="formblock">
            <input type="button" value="Zur&uuml;ck" onclick="window.history.back()" />
	        <button name="submit" type="submit" class="subbutton">Absenden</button>
	        <input type="hidden" name="submitted" id="submitted" value="true" />
	      </div>
	      
        </form>
        
      <?php } ?>
    
    
    
    
    </div> 
    
  </div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
