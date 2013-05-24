<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { height: 100% }
</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng(43.0730517, -89.4012302);
    var myOptions = {
      zoom: 8,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    <?php /*
    $o = "\n";
    foreach(Page::get_core_data('simple_map_data') as $ix => $marker)
    {
        $o .= "\n".'var m_'.$ix.'_marker = new google.maps.LatLng('.$marker['lat'].','.$marker['lng'].');';

        $o .= "\n".'var marker = new google.maps.Marker({';
        $o .= "\n".'position: m_'.$ix.'_marker, ';
        $o .= "\n".'map: map,';
        $o .= "\n".'title:"'.$marker['name'].'"';
        $o .= "\n".' });';
    }

    echo $o."\n";
    */
    ?>

  }
</script>



<script type="text/javascript" src="http://c948972.r72.cf0.rackcdn.com/jquery.simplemodal.1.4.1.min.js"></script>
<script type='text/javascript' src='http://c948972.r72.cf0.rackcdn.com/contact.js'></script>


<!-- Page styles -->
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen' />

<!-- Contact Form CSS files -->
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

