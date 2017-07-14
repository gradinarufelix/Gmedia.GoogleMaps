<?php

namespace Gmedia\GoogleMaps\ViewHelpers;

use Neos\Flow\Utility\Algorithms;

class MapViewHelper extends \Neos\Fluid\Core\ViewHelper\AbstractViewHelper {
	
	/**
     * @var boolean
     */
    protected $escapeOutput = false;
	
	/**
	 * @var array
	 */
	protected $settings;
	  
	/**
	 * Inject settings
	 *
	 * @param array $settings
	 * @return void
	 */
	public function injectSettings(array $settings) {
	    $this->settings = $settings;
	}
	
    /**
     * Render the title and apply some magic
     *
     * @param string $containerClass container class
     * @param string $title title of the site header
     * @param string $lead lead text of the site header
     * @param string $leadClass class of the lead text
     * @param string $buttons html of the content section
     * @return string rendered html
     * @throws \Neos\Fluid\Core\ViewHelper\Exception
     */
    public function render($lat = 0, $long = 0, $zoom = 8, $height = "500px") {
	    	// Create Object ID
			$uuid = Algorithms::generateUUID();
			$apiKey = $this->settings["apiKeys"]["google"];
			
            $output = "<div class='gc-map'><div id='map-".$uuid."'></div>";
            
		    $output .= '<script>
		    var map;
		    function initMap() {
			    map = new google.maps.Map(document.getElementById("map-'.$uuid.'"), {
				  center: {lat: '.$lat.', lng: '.$long.'},
				  zoom: '.$zoom.'
				});
				
				var marker = new google.maps.Marker({
		          map: map,
		          position: {lat: '.$lat.', lng: '.$long.'}
		        });
			}
		    </script>
		    <style>#map-'.$uuid.' { height: '.$height.'; position: relative; }</style>';
		    //$output .= '<script async defer
		    //  src="https://maps.googleapis.com/maps/api/js?key='.$apiKey.'&callback=initMap">
		    //</script>';
		    
				
			$output .= '</div>';
			
			return $output;
    }
}	
	
?>