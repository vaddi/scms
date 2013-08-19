<div class="content_item">
    
    <?php
    
    $table = "content";
    $content = array();
     
    // If content_id is set in URL, we use it, elses the default show the first Result
    if ( isset( $_GET['page']) && $_GET['page'] != null ) {
        $page = $_GET['page'];
        $mydb->query("SELECT * FROM " . $table . " WHERE " . $table . "_url = '" . $page . "' ;" );
    } else {
        $mydb->query("SELECT * FROM " . $table . " WHERE " . $table . "_url = 'start' ;" );
    }
    
    // Use Variables
    foreach($mydb->fetchRow() as $key => $item) { 
        if ($key == 'content_id') { $content_id = $item; }
        if ($key == 'content_name') { $content_name = $item; }
        if ($key == 'content_url') { $content_url = $item; }
        if ($key == 'content_type') { $content_type = $item; }
        if ($key == 'content_content') { $content_content = $item; }
        if ($key == 'content_created') { $content_created = date('D m.d.Y h:i:s \U\h\r', strtotime($item)); }
        if ($key == 'content_updated') { $content_updated = date('D m.d.Y h:i:s \U\h\r', strtotime($item)); }
        if ($key == 'content_use') { $content_use = date('D m.d.Y h:i:s \U\h\r', strtotime($item)); }
        if ($key == 'content_published') { $content_published = date('D m.d.Y h:i:s \U\h\r', strtotime($item)); }
        if ($key == 'content_parent') { $content_parent = $item; }
    }
    
    include('./inc/templates/'.$content_type.'.php');
    
    ?>
    
    
    
    
    
    
    
  </div><!-- close #content_item -->


