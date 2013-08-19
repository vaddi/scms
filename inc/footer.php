<?php
  echo "\n",'<footer>',"\n";
  echo "·:::· ";

  if(SITE_COPY == '1')
    echo " &copy;" . date('Y') . " <a href=\"", BASE ,"\">", SITE_NAME ,"</a> ·:::· ";

  if(SITE_LOADTIME == '1') 
    echo " Seiten-Ladezeit: <span id=\"Ladezeit\"><b class=\"warn\">no js</b></span> Sek. <input type='hidden' id='loadtime' value='-.---' /> ·:::· ";

  if(SITE_VALIDATOR_HTML == '1') echo '
    <!-- html-validator -->
    <a href="http://validator.w3.org/check?uri=referer" target="_blank" class="img_link">
      <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" title="Valid XHTML 1.0 Transitional" height="16" />
    </a> ·:::· ';

  if(SITE_VALIDATOR_CSS == '1') echo '
    <!-- css-validator -->
    <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="img_link">
      <img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS ist valide!" title="Valid CSS 3.0" />
    </a> ·:::· ';
  
  if(SITE_COUNTER > '0') {
    $mydb->query("SELECT SUM(visitor_counter) FROM " . SQL_NAME . ".visitor;");
    $userArr = $mydb->fetchArr();
    $pagehits = $userArr[0];
    
    $mydb->query("SELECT COUNT(visitor_counter) FROM " . SQL_NAME . ".visitor;");
    $userArr = $mydb->fetchArr();
    $visitors = $userArr[0];
    
    if (SITE_COUNTER >= '2') {
        // Big
        echo ' ' . $pagehits . ' Hits / ' . $visitors . ' Besucher ·:::· ';
    } else {
        // Small
        $visits = round($pagehits / $visitors);
        echo ' ' . $visits . ' Hits ·:::· ';
    }
  }

  echo '
    <div id="hoster">
      <a href="http://www.exigem.com/" title="hosted by exigem"></a>
    </div>';
  echo "\n",'</footer>',"\n";
?>

<?php if(defined('PIWIK_ID') && !'' == PIWIK_ID && !'0' == PIWIK_ID){ ?>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://exigem.com/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "<?= PIWIK_ID; ?>"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
<?php } ?>

