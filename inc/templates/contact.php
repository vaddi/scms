<?php 


error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP
 
session_start();
$sessionstringnew = null;
$sessionstringadd = null;
if (!isset($_COOKIE[session_name()])) {
    $sessionstringnew = '?' . session_name() . "=" . session_id();
    $sessionstringadd = '&amp;' . session_name() . "=" . session_id();
}
$valid = sha1(trim(strip_tags(strtoupper($_POST['code']))));
$revalid = $_SESSION['P91Captcha_code'];

$r1 = array("Ä","ä","Ü","ü","Ö","ö","ß","@","€","\$","’");
$r2 = array("Ae","ae","Ue","ue","Oe","oe","ss","[at]","Euro","Dollar","'"); // Simple by vaddi

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// captcha 
	if (empty($_POST['code'])) {
		$captchaError = 'Sie haben kein Captcha eingegeben.';
		$hasError = true;
	} else if (sha1(trim(strip_tags(strtoupper($_POST['code'])))) != $_SESSION['P91Captcha_code']) {
		$captchaError = 'Das Captcha ist falsch, bitte nochmal!';
		$hasError = true;
	}

	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Bitte geben Sie einen Namen ein!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
		$name = str_replace($r1, $r2, $name);
		$name = str_replace('[^\w\s[:punct:]]*', ' ', $name);

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
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'Bitte geben Sie eine Nachrich an uns ein!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
			//$comments = stripslashes(trim(strip_tags($_POST['comments'])));
			$comments = str_replace($r1, $r2, $comments);
			$comments = str_replace('[^\w\s[:punct:]]*', ' ', $comments);
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
			$ip = $_SERVER['REMOTE_ADDR'];
			$host = gethostbyaddr($ip);
			$timestamp = time ();
			$datum = date ("d.m.Y", $timestamp);
			$uhrzeit = date ("H:i:s", $timestamp);
		$emailTo = html_entity_decode(MAIL,null,'UTF-8');
		$subject = 'Webformular Nachricht von '.$name;
		$sendCopy = trim($_POST['sendCopy']);

// Emailbody Start
		$body = '

<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-15">
  </head>
  <body bgcolor="#ffffff" text="#000000">
    <!-- Facebook sharing information tags -->
    <div class="moz-signature">
      <title>Webformular Nachricht</title>
      <style type="text/css">
			/* Client-specific Styles */
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
			body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

			/* Reset Styles */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* Template Styles */

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: COMMON PAGE ELEMENTS /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Page
			* @section background color
			* @tip Set the background color for your email. You may want to choose one that matches your company&rsquo;s branding.
			* @theme page
			*/
			body, #backgroundTable{
				/*@editable*/ background-color:#FAFAFA;
			}

			/**
			* @tab Page
			* @section email border
			* @tip Set the border for your email.
			*/
			#templateContainer{
				/*@editable*/ border: 1px solid #DDDDDD;
			}

			/**
			* @tab Page
			* @section heading 1
			* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
			* @style heading 1
			*/
			h1, .h1{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:34px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 2
			* @tip Set the styling for all second-level headings in your emails.
			* @style heading 2
			*/
			h2, .h2{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:30px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 3
			* @tip Set the styling for all third-level headings in your emails.
			* @style heading 3
			*/
			h3, .h3{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:26px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 4
			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
			* @style heading 4
			*/
			h4, .h4{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:22px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: PREHEADER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Header
			* @section preheader style
			* @tip Set the background color for your email&rsquo;s preheader area.
			* @theme page
			*/
			#templatePreheader{
				/*@editable*/ background-color:#FAFAFA;
			}

			/**
			* @tab Header
			* @section preheader text
			* @tip Set the styling for your email&rsquo;s preheader text. Choose a size and color that is easy to read.
			*/
			.preheaderContent div{
				/*@editable*/ color:#505050;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:10px;
				/*@editable*/ line-height:100%;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Header
			* @section preheader link
			* @tip Set the styling for your email&rsquo;s preheader links. Choose a color that helps them stand out from your text.
			*/
			.preheaderContent div a:link, .preheaderContent div a:visited, /* Yahoo! Mail Override */ .preheaderContent div a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: HEADER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Header
			* @section header style
			* @tip Set the background color and border for your email&rsquo;s header area.
			* @theme header
			*/
			#templateHeader{
				/*@editable*/ background-color:#FFFFFF;
				/*@editable*/ border-bottom:0;
			}

			/**
			* @tab Header
			* @section header text
			* @tip Set the styling for your email&rsquo;s header text. Choose a size and color that is easy to read.
			*/
			.headerContent{
				/*@editable*/ color:#202020;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:34px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				/*@editable*/ padding:0;
				/*@editable*/ text-align:center;
				/*@editable*/ vertical-align:middle;
			}

			/**
			* @tab Header
			* @section header link
			* @tip Set the styling for your email&rsquo;s header links. Choose a color that helps them stand out from your text.
			*/
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:600px !important;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: MAIN BODY /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Body
			* @section body style
			* @tip Set the background color for your email&rsquo;s body area.
			*/
			#templateContainer, .bodyContent{
				/*@editable*/ background-color:#FFFFFF;
			}

			/**
			* @tab Body
			* @section body text
			* @tip Set the styling for your email&rsquo;s main content text. Choose a size and color that is easy to read.
			* @theme main
			*/
			.bodyContent div{
				/*@editable*/ color:#505050;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:14px;
				/*@editable*/ line-height:150%;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Body
			* @section body link
			* @tip Set the styling for your email&rsquo;s main content links. Choose a color that helps them stand out from your text.
			*/
			.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			.bodyContent img{
				display:inline;
				height:auto;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: FOOTER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Footer
			* @section footer style
			* @tip Set the background color and top border for your email&rsquo;s footer area.
			* @theme footer
			*/
			#templateFooter{
				/*@editable*/ background-color:#FFFFFF;
				/*@editable*/ border-top:0;
			}

			/**
			* @tab Footer
			* @section footer text
			* @tip Set the styling for your email&rsquo;s footer text. Choose a size and color that is easy to read.
			* @theme footer
			*/
			.footerContent div{
				/*@editable*/ color:#707070;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:12px;
				/*@editable*/ line-height:125%;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Footer
			* @section footer link
			* @tip Set the styling for your email&rsquo;s footer links. Choose a color that helps them stand out from your text.
			*/
			.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			.footerContent img{
				display:inline;
			}

			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email&rsquo;s footer social bar.
			* @theme footer
			*/
			#social{
				/*@editable*/ background-color:#FAFAFA;
				/*@editable*/ border:0;
			}

			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email&rsquo;s footer social bar.
			*/
			#social div{
				/*@editable*/ text-align:center;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email&rsquo;s footer utility bar.
			* @theme footer
			*/
			#utility{
				/*@editable*/ background-color:#FFFFFF;
				/*@editable*/ border:0;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email&rsquo;s footer utility bar.
			*/
			#utility div{
				/*@editable*/ text-align:center;
			}

			#monkeyRewards img{
				max-width:190px;
			}
		</style>
      <center>
        <table id="backgroundTable" height="100%" border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td align="center" valign="top">
                <!-- // Begin Template Preheader \\ -->
                <table id="templatePreheader" border="0" cellpadding="10" cellspacing="0" width="600">
                  <tbody>
                    <tr>
                      <td class="preheaderContent" valign="top">
                        <!-- // Begin Module: Standard Preheader \ -->
                        <table border="0" cellpadding="10" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td valign="top">
                                <div mc:edit="std_preheader_content">
                                  Eine neue Nachricht von: '.$name.'
                                </div>
                              </td>
                              <!-- *|IFNOT:ARCHIVE_PAGE|* --> <td valign="top" width="200">
                                <div mc:edit="std_preheader_links">
                                  <a href="'. BASE .'" target="_blank">'. BASE .'</a>.
				</div>
                              </td>
                              <!-- *|END:IF|* --> </tr>
                          </tbody>
                        </table>
                        <!-- // End Module: Standard Preheader \ --> </td>
                    </tr>
                  </tbody>
                </table>
                <!-- // End Template Preheader \\ -->
                <table id="templateContainer" border="0" cellpadding="0" cellspacing="0" width="600">
                  <tbody>
                    <tr>
                      <td align="center" valign="top">
                        <!-- // Begin Template Header \\ -->
                        <table id="templateHeader" border="0" cellpadding="0" cellspacing="0" width="600">
                          <tbody>
                            <tr>
                              <td class="headerContent">
                                <!-- // Begin Module: Standard Header Image \\ -->
                                <a href="'. BASE .'">
				  <img
                                    alt="Firmenlogo"

                                    src="'. BASE .'inc/img/mail_header.png"

                                    style="max-width: 600px;"
                                    id="headerImage campaign-icon"
                                    mc:label="header_image"
                                    mc:edit="header_image"
                                    mc:allowdesigner="" mc:allowtext=""
                                    height="150" border="0" width="600">
				</a>
                                <!-- // End Module: Standard Header Image \\ -->
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <!-- // End Template Header \\ --> </td>
                    </tr>
                    <tr>
                      <td align="center" valign="top">
                        <!-- // Begin Template Body \\ -->
                        <table id="templateBody" border="0" cellpadding="0" cellspacing="0" width="600">
                          <tbody>
                            <tr>
                              <td class="bodyContent" valign="top">
                                <!-- // Begin Module: Standard Content \\ -->
                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td valign="top">
                                        <div mc:edit="std_content00">
					  <img
                                            style="max-width: 256px;"
                                            float="right" alt="Bild"
f                                            src="'. BASE .'inc/img/brille.png"
                                            mc:label="postcard_image"
                                            mc:edit="postcard_image"
                                            mc:allowtext=""
                                            height="128" hspace="32"
                                            align="right" vspace="32"
                                            width="128">
                                          <h2 class="h2">Nachricht von '. $name .'</h2>
                                          <div align="justify"> 

						'. $comments .'

                                          </div>
                                          <br>
                                          <br>
                                          Mit freundlichem Gru&szlig;<br>
					  '. $name .'<br>
                                        </div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" valign="top">
                        <table id="templateFooter" border="0" cellpadding="10" cellspacing="0" width="600">
                          <tbody>
                            <tr>
                              <td class="footerContent" valign="top">
                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td colspan="2" id="social" valign="middle">
                                        <div mc:edit="std_social">
					  <center>
					  <a target="_blank" href="'. TWITTER .'">auf Twitter folgen</a> | 
					  <a target="_blank" href="'. FACEBOOK .'">wir auf Facebook</a> | 
					  <a href="mailto:'.$email.'">Antwort an '.$name.'</a>
					  </center>
					</div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td valign="top" width="350">
                                        <div mc:edit="std_footer"><em>Copyright &copy; 2011 '. COMPANY_NAME .', Alle Rechte vorbehalten.</em><br><br>
                                          <strong>Telefon</strong>: &nbsp;&nbsp;'. COMPANY_PHONE .'<br>
                                          <strong>Fax: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>'. COMPANY_FAX .'<br>
                                          <strong>Mail: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><a class="moz-txt-link-abbreviated" href="mailto:'.MAIL.'">'.MAIL.'</a><br>
                                          <strong>Internet:</strong> <a class="moz-txt-link-freetext" href="http://www.exigem.com/">http://www.exigem.com/</a>
                                          <br>
                                        </div>
                                      </td>
                                      <td id="monkeyRewards" valign="top" width="190">
                                        <div mc:edit="monkeyrewards">
					  <em>Wir lieben gutes Webdesign</em>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" id="utility"
                                        valign="middle">
                                        <div mc:edit="std_utility">
					  Versendet am '. $datum .' um '. $uhrzeit .' <br>von '. $ip .' ('. $host .').
					</div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                <!-- // End Module: Standard Footer \\ -->
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <!-- // End Template Footer \\ --> 
		      </td>
                    </tr>
                  </tbody>
                </table>
                <br>
              </td>
            </tr>
          </tbody>
        </table>
      </center>
    </div>
  </body>
</html>

';

// Emailbody End

	// Add Recipient and set default Mailencoding to 8bit HTML 

		$headers = "From: $name <$email>\n";
		$headers .= "Content-Type: text/html\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n";

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}

?>

<script type="text/javascript">
function P91Captcha(sid){
	var pas = new Image();
	var heuri = new Date();
	pas.src="./inc/functions/captcha_form.php?x="+heuri.getTime()+sid;
	document.getElementById("P91Captcha").src=pas.src;
}
</script>

<article>
    
    <h3><?= $content_name ?></h3>
    
    <!-- @begin contact -->
    <div id="contact" class="section">
      <div class="container content">
		
	<?php if(isset($emailSent) && $emailSent == true) { ?>
	  <meta http-equiv="refresh" content="4; url=./index.php" /> 
          <p class="valid fade-in">Ihre Nachricht wurde zugestellt.</p>
          <?php session_destroy(); ?>
        <?php } else { ?>
	  <div class="desc">
	    <?= $content_content ?>
	  </div>
				
	  <div id="contact-form">
	    <?php if(isset($hasError) || isset($captchaError) ) { ?>
<!--      <p class="alert">Error submitting the form</p> -->
        <?php } ?>
	    
	    <!-- index.php?page=contact -->
	    <form id="contact-us" action="<?= $_SERVER['PHP_SELF']; ?>?page=contact" method="post">

	      <div class="formblock">
		<label class="screen-reader-text">Name</label>
		<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField <?php if($nameError != '') { echo inputError; } ?>" placeholder="Name:" />
		<?php if($nameError != '') { ?>
		  <span class="error"><?php echo $nameError;?></span> 
		<?php } ?>
	      </div>
                        
	      <div class="formblock">
		<label class="screen-reader-text">Email</label>
		<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email <?php if($emailError != '') { echo 'inputError'; } ?>" placeholder="Email:" />
		<?php if($emailError != '') { ?>
		  <span class="error"><?php echo $emailError;?></span>
		<?php } ?>
	      </div>
                        
	      <div class="formblock">
		<label class="screen-reader-text">Nachricht</label>
		<textarea name="comments" id="commentsText" class="txtarea requiredField <?php if($commentError != '') { echo 'inputError'; } ?>" placeholder="Nachricht:"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
		<?php if($commentError != '') { ?>
		  <span class="error"><?php echo $commentError;?></span> 
		<?php } ?>
	      </div>
                        
	      <div class="formblock">
		<label class="screen-reader-text">Captcha</label>							
		<img src="./inc/functions/captcha_form.php<?=$sessionstringnew;?>" alt="Captcha" id="P91Captcha" />
		<br /><a href="javascript:P91Captcha('<?=$sessionstringadd;?>');">Neuer Code?</a>
		<br /><br />
		<input type="text" name="code" id="code" class="text requiredField code <?php if($captchaError != '') { echo 'inputError'; } ?>" maxlength="50" placeholder="Captcha-Code" />
		<?php if($captchaError != '') { ?>
		  <span class="error"><?php echo $captchaError;?></span> 
		<?php } ?>
	      </div>

	      <div class="formblock">
	      <button name="submit" type="submit" class="subbutton">Absenden</button>
	      <input type="hidden" name="submitted" id="submitted" value="true" />
	      </div>

	    </form>			
	  </div>
				
	  <?php } ?>
	</div>
    </div><!-- End #contact -->
	
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$('form#contact-us').submit(function() {
			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">Sie haben '+labelText+' vergessen anzugeben.</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! Die von Ihnen eingegebene '+labelText+' ist fehlerhaft.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				} else {
					var codeReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if (sha1(trim(strip_tags(strtoupper($_POST['code'])))) != $_SESSION['P91Captcha_code']) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! Das von Ihnen eingegebene '+labelText+' ist fehlerhaft.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contact-us').slideUp("fast", function() {				   
						$(this).before('<p class="tick"><strong>Danke!</strong> Ihre Nachricht an uns wurde zugestellt.</p>');
					captcha_});
				});
			}

			return false;	
		});
	});
	//-->!]]>
</script>

</article>
