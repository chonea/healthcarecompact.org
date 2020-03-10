Important notice!

This HTML5 map is designed to work on the website only and
doesn't include capabilities for testing its work on a local computer. 
In order to evaluate the work of the map on your website, please upload all map's files
to any directory of your website using an FTP connection or a remote file
browser.

Here is the code to put into the HTML source of a web page:

<!-- start HTML5 Map -->
    <link href="map.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="raphael-min.js"></script>
    <script type="text/javascript" src="settings.js"></script>
    <script type="text/javascript" src="map.js"></script>
    <div id="svg_map"></div>
<!-- end HTML5 Map -->


In case you have uploaded files into a subfolder on your server and you want to
show the map on your home page, you need to specify the full path to map's files
in the code:

<!-- start HTML5 Map -->
    <link href="/directory/map.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/directory/raphael-min.js"></script>
    <script type="text/javascript" src="/directory/settings.js"></script>
    <script type="text/javascript" src="/directory/map.js"></script>
    <div id="svg_map"></div>
<!-- end HTML5 Map -->

