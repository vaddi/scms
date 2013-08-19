<?php 

// Seitendaten
define ("BASE", "http://exigem.com/scms/");                                            		// Basisurl (Bitte mit '/' am Ende)
define ("MAIL", "info&#64;exigem&#46;com");                                             	// Ihre Mailadresse

define ("SITE_NAME", "Simple CMS");                                                         	// Der Name der Seite
define ("SITE_TITLE", "Wir lieben gutes Webdesign");                                        	// Untertitel oder Slogan
define ("SITE_DESCRIPTION", "Wir lieben gutes Webdesign");                                  	// Kurzbeschreibung 
define ("SITE_KEYWORDS", "simple CMS,exigem media, webdesign braunschweig, webdesign 38102, exigem");  // Suchwoerter 
define ("SITE_PUBLISHER", "eXigem Media");                                                  	// Veroefentlicher 

// Datenbank 
define ("SQL_PATH", "");				// Der verwendete Benutzername
define ("SQL_USER", "");				// Der verwendete Benutzername
define ("SQL_PASSWD", "");			    	// Das verwendete Passwort
define ("SQL_NAME", "");			        // Name der Haupttabelle (Datenbankname)

// SICHERHEIT
define ("SITE_SALT", "bd56d8d5e24fc1d61560e84070e1cf247aee6376");   // Der verwendete Passwort-Salt
define ("SITE_BAN", "9");                                           // Anzahl der Loginfehlversuche bevor gebannt wird

// HEADER
define ("HEADER_LOGIN", "1");				// Loginbutton im Header
define ("HEADER_IMPRINT", "0");				// Impressum im Header
define ("HEADER_FEED_RSS", "0");			// Feeds im Header
define ("HEADER_USER", "1");			    	// Benutzerkonto im Header
define ("HEADER_ADMIN", "1");				// Admin im Header
define ("HEADER_REGISTER", "0");			// register im Header

// Social
define ("TWITTER", "http://twitter.com/#%21/exigem"); 					// Twitterurl
define ("FACEBOOK", "http://www.facebook.com/pages/Exigem-Media-GbR/133882766677923"); 	// Facebookurl

// Wird im Mailfooter verwendet
define ("COMPANY_NAME", "eXigem Media");		// Name
define ("COMPANY_PHONE", "0531 428 77 630");		// Rufnummer
define ("COMPANY_FAX", "0531 428 77 639");		// Faxnummer

// Optionales
define ("SITE_INTRO", "0");				// 1 = Bei erstem Seitenaufruf Intro anzeigen     DEPRECATED
define ("SITE_COPY", "1");				// 1 = Anzeigen des Copyrights
define ("SITE_LOADTIME", "1");				// 1 = Anzeige der Seitenladezeit im Footer 
define ("SITE_COUNTER", "2");				// 1 = Anzeige des durchschnitlichen Aufrufe 
                                                        // 2 = Anzeige des Seitenzäaehlers und der Besucher  
define ("SITE_VALIDATOR_HTML", "1");			// 1 = Anzeige des w3c HTML Validators im Footer 
define ("SITE_VALIDATOR_CSS", "1");			// 1 = Anzeige des w3c CSS Validators im Footer 
define ("PIWIK_ID", "0"); 	            		// 1 = Verwenden einer Piwik-ID

define ("SITE_DEFAULT", "Home"); 			// Standartseite die geladen wird
define ("SITE_IMPRINT", "Impressum");			// Impressum 

define ("DEBUG", "0"); 					// 0: Kein Output 
                       					// 1: Wenig Output  
                       					// 2: Alle Fehler anzeigen

define ("VERSION","0.3.1");				// Versionshinweis

?>
