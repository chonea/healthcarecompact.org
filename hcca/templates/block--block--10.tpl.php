<div id="block-block-10">
	<h1>Healthcare Reform : By The Map</h1>
	<?php
	
	session_start();
	
	// Debug output
	function debugger($value) {
		if (is_array($value) === true)	{
			return '<pre>Array:<br />' . print_r($value, true) . '</pre>';
		} elseif (is_object($value) === true) {
			return '<pre>Object:<br />' . print_r($value, true) . '</pre>';
		} elseif (is_string($value) === true) {
			return '</pre>String:<br />' . $value . '</pre>';
		} else {
			return 'Variable type not detected.';
		}
	}            
	$query = db_select('node', 'n');
	$query->leftJoin('field_data_field_state_color_code_active', 'c', 'n.nid = c.entity_id');  //LEFT JOIN node with active color_code
	$query->fields('n', array('nid', 'title','type'))                                   //SELECT the fields from node
				->fields('c',array('entity_id', 'field_state_color_code_active_value'));             //SELECT the fields from active color_code
	$query->condition('n.type', 'statepage');                                           //Return only nodes where node.type = "statepage"
	$results = $query->execute();
	
	$n = 0;
	while ($row = $results->fetchAssoc()) {
			$activeStateData[$n] = $row;
			$n++;
	}
	// Rebuild the array to something easier to maintain
	$stateColor= array();
	foreach ($activeStateData as $stateKey => $state) {
			if ($state['field_state_color_code_active_value'] != '') {
					$stateColor['active'][trim($state['title'])] = $state['field_state_color_code_active_value'];
			} else {
					$stateColor['active'][trim($state['title'])] = '#999999';            
			}
	}  
	$query = db_select('node', 'n');
	$query->leftJoin('field_data_field_state_color_code', 'c', 'n.nid = c.entity_id');  //LEFT JOIN node with static color_code
	$query->fields('n', array('nid', 'title','type'))                                   //SELECT the fields from node
				->fields('c',array('entity_id', 'field_state_color_code_value'));             //SELECT the fields from static color_code
	$query->condition('n.type', 'statepage');                                        //Return only nodes where node.type = "statepage"
	$results = $query->execute();
	$n = 0;
	while ($row = $results->fetchAssoc()) {
		$staticStateData[$n] = $row;
		$n++;
	}
	// Add static colors to the array
	foreach ($staticStateData as $stateKey => $state) {
		if (isset($state['field_state_color_code_value']) === true) {
			$stateColor['static'][trim($state['title'])] = $state['field_state_color_code_value'];
		} else {
			$stateColor['static'][trim($state['title'])] = '#7798BA';            
		}
	}
	if (isset($_GET['debug']) === true) {
		//echo debugger($stateColor);
	}
	?>
	
	
	<!-- start HTML5 Map -->
    <link href="<?=path_to_theme(); ?>/scripts/us_locator/html5/map.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=path_to_theme(); ?>/scripts/us_locator/html5/raphael-min.js"></script>
    <!-- <script type="text/javascript" src="<?=path_to_theme(); ?>/scripts/us_locator/html5/settings.js"></script> -->
    <script type="text/javascript">
        var 
        mapWidth        = 600;
        mapHeight       = 465;

        shadowWidth     = 2;
        shadowOpacity       = 0.3;
        shadowColor     = "black";
        shadowX         = 1;
        shadowY         = 2;

        iPhoneLink      = true,

        isNewWindow     = false,

        borderColor     = "#ffffff",
        borderColorOver     = "#ffffff",

        nameColor       = "#ffffff",
        nameFontSize        = "12px",
        nameFontWeight      = "bold",

        overDelay       = 400,


        map_data = {
        st1: {
            id: 1,
           name: "Alabama",
            shortname: "AL",
            link: "javascript:loadSessionState('AL', '/alabama'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Alabama']; ?>", 
            color_map_over: "<?=$stateColor['active']['Alabama']; ?>"
        },
        st2: {
            id: 2,
           name: "Alaska",
            shortname: "AK",
            link: "javascript:loadSessionState('AK', '/alaska'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Alaska']; ?>", 
            color_map_over: "<?=$stateColor['active']['Alaska']; ?>"
        },
        st3: {
            id: 3,
           name: "Arizona",
            shortname: "AZ",
            link: "javascript:loadSessionState('AZ', '/arizona'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Arizona']; ?>", 
            color_map_over: "<?=$stateColor['active']['Arizona']; ?>"
        },
        st4:{
            id: 4,
           name: "Arkansas",
            shortname: "AR",
            link: "javascript:loadSessionState('AR', '/arkansas'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Arkansas']; ?>", 
            color_map_over: "<?=$stateColor['active']['Arkansas']; ?>"
        },
        st5:{
            id: 5,
           name: "California",
            shortname: "CA",
            link: "javascript:loadSessionState('CA', '/california'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['California']; ?>", 
            color_map_over: "<?=$stateColor['active']['California']; ?>"
        },
        st6:{
            id: 6,
           name: "Colorado",
            shortname: "CO",
            link: "javascript:loadSessionState('CO', '/colorado'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Colorado']; ?>", 
            color_map_over: "<?=$stateColor['active']['Colorado']; ?>"
        },
        st7:{
            id: 7,
           name: "Connecticut",
            shortname: "CT",
            link: "javascript:loadSessionState('CT', '/connecticut'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Connecticut']; ?>", 
            color_map_over: "<?=$stateColor['active']['Connecticut']; ?>"
        },
        st8:{
            id: 8,
           name: "Delaware",
            shortname: "DE",
            link: "javascript:loadSessionState('DE', '/delaware'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Delaware']; ?>", 
            color_map_over: "<?=$stateColor['active']['Delaware']; ?>"
        },
        st9:{
            id: 9,
           name: "District of Columbia",
            shortname: "DC",
            link: "javascript:loadSessionState('DC', '/district-of-columbia'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['District of Columbia']; ?>", 
            color_map_over: "<?=$stateColor['active']['District of Columbia']; ?>"
        },
        st10:{
            id: 10,
           name: "Florida",
            shortname: "FL",
            link: "javascript:loadSessionState('FL', '/florida'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Florida']; ?>", 
            color_map_over: "<?=$stateColor['active']['Florida']; ?>"
        },
        st11:{
            id: 11,
           name: "Georgia",
            shortname: "GA",
            link: "javascript:loadSessionState('GA', '/georgia'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Georgia']; ?>", 
            color_map_over: "<?=$stateColor['active']['Georgia']; ?>"
        },
        st12:{
            id: 12,
           name: "Hawaii",
            shortname: "HI",
            link: "javascript:loadSessionState('HI', '/hawaii'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Hawaii']; ?>", 
            color_map_over: "<?=$stateColor['active']['Hawaii']; ?>"
        },
        st13:{
            id: 13,
           name: "Idaho",
            shortname: "ID",
            link: "javascript:loadSessionState('ID', '/idaho'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Idaho']; ?>", 
            color_map_over: "<?=$stateColor['active']['Idaho']; ?>"
        },
        st14:{
            id: 14,
           name: "Illinois",
            shortname: "IL",
            link: "javascript:loadSessionState('IL', '/illinois'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Illinois']; ?>", 
            color_map_over: "<?=$stateColor['active']['Illinois']; ?>"
        },
        st15:{
            id: 15,
           name: "Indiana",
            shortname: "IN",
            link: "javascript:loadSessionState('IN', '/indiana'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Indiana']; ?>", 
            color_map_over: "<?=$stateColor['active']['Indiana']; ?>"
        },
        st16:{
            id: 16,
           name: "Iowa",
            shortname: "IA",
            link: "javascript:loadSessionState('IA', '/iowa'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Iowa']; ?>", 
            color_map_over: "<?=$stateColor['active']['Iowa']; ?>"
        },
        st17:{
            id: 17,
           name: "Kansas",
            shortname: "KS",
            link: "javascript:loadSessionState('KS', '/kansas'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Kansas']; ?>", 
            color_map_over: "<?=$stateColor['active']['Kansas']; ?>"
        },
        st18:{
            id: 18,
           name: "Kentucky",
            shortname: "KY",
            link: "javascript:loadSessionState('KY', '/kentucky'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Kentucky']; ?>", 
            color_map_over: "<?=$stateColor['active']['Kentucky']; ?>"
        },
        st19:{
            id: 19,
           name: "Louisiana",
            shortname: "LA",
            link: "javascript:loadSessionState('LA', '/louisiana'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Louisiana']; ?>", 
            color_map_over: "<?=$stateColor['active']['Louisiana']; ?>"
        },
        st20:{
            id: 20,
           name: "Maine",
            shortname: "ME",
            link: "javascript:loadSessionState('ME', '/maine'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Maine']; ?>", 
            color_map_over: "<?=$stateColor['active']['Maine']; ?>"
        },
        st21:{
            id: 21,
           name: "Maryland",
            shortname: "MD",
            link: "javascript:loadSessionState('MD', '/maryland'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Maryland']; ?>", 
            color_map_over: "<?=$stateColor['active']['Maryland']; ?>"
        },
        st22:{
            id: 22,
           name: "Massachusetts",
            shortname: "MA",
            link: "javascript:loadSessionState('MA', '/massachusetts'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Massachusetts']; ?>", 
            color_map_over: "<?=$stateColor['active']['Massachusetts']; ?>"
        },
        st23:{
            id: 23,
           name: "Michigan",
            shortname: "MI",
            link: "javascript:loadSessionState('MI', '/michigan'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Michigan']; ?>", 
            color_map_over: "<?=$stateColor['active']['Michigan']; ?>"
        },
        st24:{
            id: 24,
           name: "Minnesota",
            shortname: "MN",
            link: "javascript:loadSessionState('MN', '/minnesota'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Minnesota']; ?>", 
            color_map_over: "<?=$stateColor['active']['Minnesota']; ?>"
        },
        st25:{
            id: 25,
           name: "Mississippi",
            shortname: "MS",
            link: "javascript:loadSessionState('MS', '/mississippi'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Mississippi']; ?>", 
            color_map_over: "<?=$stateColor['active']['Mississippi']; ?>"
        },
        st26:{
            id: 26,
           name: "Missouri",
            shortname: "MO",
            link: "javascript:loadSessionState('MO', '/missouri'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Missouri']; ?>", 
            color_map_over: "<?=$stateColor['active']['Missouri']; ?>"
        },
        st27:{
            id: 27,
           name: "Montana",
            shortname: "MT",
            link: "javascript:loadSessionState('MT', '/montana'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Montana']; ?>", 
            color_map_over: "<?=$stateColor['active']['Montana']; ?>"
        },
        st28:{
            id: 28,
           name: "Nebraska",
            shortname: "NE",
            link: "javascript:loadSessionState('NE', '/nebraska'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Nebraska']; ?>", 
            color_map_over: "<?=$stateColor['active']['Nebraska']; ?>"
        },
        st29:{
            id: 29,
           name: "Nevada",
            shortname: "NV",
            link: "javascript:loadSessionState('NV', '/nevada'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Nevada']; ?>", 
            color_map_over: "<?=$stateColor['active']['Nevada']; ?>"
        },
        st30:{
            id: 30,
           name: "New Hampshire",
            shortname: "NH",
            link: "javascript:loadSessionState('NH', '/new-hampshire'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['New Hampshire']; ?>", 
            color_map_over: "<?=$stateColor['active']['New Hampshire']; ?>"
        },
        st31:{
            id: 31,
           name: "New Jersey",
            shortname: "NJ",
            link: "javascript:loadSessionState('NJ', '/new-jersey'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['New Jersey']; ?>", 
            color_map_over: "<?=$stateColor['active']['New Jersey']; ?>"
        },
        st32:{
            id: 32,
           name: "New Mexico",
            shortname: "NM",
            link: "javascript:loadSessionState('NM', '/new-mexico'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['New Mexico']; ?>", 
            color_map_over: "<?=$stateColor['active']['New Mexico']; ?>"
        },
        st33:{
            id: 33,
           name: "New York",
            shortname: "NY",
            link: "javascript:loadSessionState('NY', '/new-york'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['New York']; ?>", 
            color_map_over: "<?=$stateColor['active']['New York']; ?>"
        },
        st34:{
            id: 34,
           name: "North Carolina",
            shortname: "NC",
            link: "javascript:loadSessionState('NC', '/north-carolina'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['North Carolina']; ?>", 
            color_map_over: "<?=$stateColor['active']['North Carolina']; ?>"
        },
        st35:{
            id: 35,
           name: "North Dakota",
            shortname: "ND",
            link: "javascript:loadSessionState('ND', '/north-dakota'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['North Dakota']; ?>", 
            color_map_over: "<?=$stateColor['active']['North Dakota']; ?>"
        },
        st36:{
            id: 36,
           name: "Ohio",
            shortname: "OH",
            link: "javascript:loadSessionState('OH', '/ohio'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Ohio']; ?>", 
            color_map_over: "<?=$stateColor['active']['Ohio']; ?>"
        },
        st37:{
            id: 37,
           name: "Oklahoma",
            shortname: "OK",
            link: "javascript:loadSessionState('OK', '/oklahoma'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Oklahoma']; ?>", 
            color_map_over: "<?=$stateColor['active']['Oklahoma']; ?>"
        },
        st38:{
            id: 38,
           name: "Oregon",
            shortname: "OR",
            link: "javascript:loadSessionState('OR', '/oregon'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Oregon']; ?>", 
            color_map_over: "<?=$stateColor['active']['Oregon']; ?>"
        },
        st39:{
            id: 39,
           name: "Pennsylvania",
            shortname: "PA",
            link: "javascript:loadSessionState('PA', '/pennsylvania'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Pennsylvania']; ?>", 
            color_map_over: "<?=$stateColor['active']['Pennsylvania']; ?>"
        },
        st40:{
            id: 40,
           name: "Rhode Island",
            shortname: "RI",
            link: "javascript:loadSessionState('RI', '/rhode-island'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Rhode Island']; ?>", 
            color_map_over: "<?=$stateColor['active']['Rhode Island']; ?>"
        },
        st41:{
            id: 41,
           name: "South Carolina",
            shortname: "SC",
            link: "javascript:loadSessionState('SC', '/south-carolina'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['South Carolina']; ?>", 
            color_map_over: "<?=$stateColor['active']['South Carolina']; ?>"
        },
        st42:{
            id: 42,
           name: "South Dakota",
            shortname: "SD",
            link: "javascript:loadSessionState('SD', '/south-dakota'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['South Dakota']; ?>", 
            color_map_over: "<?=$stateColor['active']['South Dakota']; ?>"
        },
        st43:{
            id: 43,
           name: "Tennessee",
            shortname: "TN",
            link: "javascript:loadSessionState('TN', '/tennessee'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Tennessee']; ?>", 
            color_map_over: "<?=$stateColor['active']['Tennessee']; ?>"
        },
        st44:{
            id: 44,
           name: "Texas",
            shortname: "TX",
            link: "javascript:loadSessionState('TX', '/texas'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Texas']; ?>", 
            color_map_over: "<?=$stateColor['active']['Texas']; ?>"
        },
        st45:{
            id: 45,
           name: "Utah",
            shortname: "UT",
            link: "javascript:loadSessionState('UT', '/utah'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Utah']; ?>", 
            color_map_over: "<?=$stateColor['active']['Utah']; ?>"
        },
        st46:{
            id: 46,
           name: "Vermont",
            shortname: "VT",
            link: "javascript:loadSessionState('VT', '/vermont'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Vermont']; ?>", 
            color_map_over: "<?=$stateColor['active']['Vermont']; ?>"
        },
        st47:{
            id: 47,
           name: "Virginia",
            shortname: "VA",
            link: "javascript:loadSessionState('VA', '/virginia'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Virginia']; ?>", 
            color_map_over: "<?=$stateColor['active']['Virginia']; ?>"
        },
        st48:{
            id: 48,
           name: "Washington",
            shortname: "WA",
            link: "javascript:loadSessionState('WA', '/washington'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Washington']; ?>", 
            color_map_over: "<?=$stateColor['active']['Washington']; ?>"
        },
        st49:{
            id: 49,
           name: "West Virginia",
            shortname: "WV",
            link: "javascript:loadSessionState('WV', '/west-virginia'); ",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['West Virginia']; ?>", 
            color_map_over: "<?=$stateColor['active']['West Virginia']; ?>"
        },
        st50:{
            id: 50,
           name: "Wisconsin",
            shortname: "WI",
            link: "javascript:loadSessionState('WI', '/wisconsin');",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Wisconsin']; ?>", 
            color_map_over: "<?=$stateColor['active']['Wisconsin']; ?>"
        },
        st51:{
            id: 51,
           name: "Wyoming",
            shortname: "WY" ,
            link: "javascript:loadSessionState('WY', '/wyoming');",
            comment: "",
            image: "",
            color_map: "<?=$stateColor['static']['Wyoming']; ?>", 
            color_map_over: "<?=$stateColor['active']['Wyoming']; ?>"
        }
    };

    function loadSessionState(stateVal, destination) {
        jQuery.ajax({
            type: "POST",
            url: '/setSessionState',
            data: {state: stateVal},
	    success: function() {
		window.location = destination;
	    }
        });
    }
    </script>
    <script type="text/javascript" src="<?=path_to_theme(); ?>/scripts/us_locator/html5/map.js"></script>
    <div id="svg_map"></div>
	<!-- end HTML5 Map -->
</div>