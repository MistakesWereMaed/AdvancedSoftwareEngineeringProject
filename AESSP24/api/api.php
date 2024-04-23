<?php
include("../utils/web_actions.php");

$url=$_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
$pathComponents = explode("/", trim($path, "/"));
$endPoint=$pathComponents[1];
switch($endPoint)
{
    case "add_equipment":
        include("./add_equipment.php");
        break;
	case "add_device":
        include("./add_device.php");
        break;
	case "add_manufacturer":
        include("./add_manufacturer.php");
        break;
	case "list_devices":
        include("list_devices.php");
        break;
	case "list_manufacturers":
        include("list_manufacturers.php");
        break;
	case "modify_equipment":
        include("./modify_equipment.php");
        break;
	case "modify_device":
        include("./modify_device.php");
        break;
	case "modify_manufacturer":
        include("./modify_manufacturer.php");
        break;
	case "query_device":
        include("./query_device.php");
        break;
	case "query_manufacturer":
        include("./query_manufacturer.php");
        break;
	case "query_serial":
        include("./query_serial.php");
        break;
	case "query_id":
        include("./query_id.php");
        break;
	case "search_devices":
        include("./search_devices.php");
        break;
    default:
		include("../utils/logger.php");
		log_call($endPoint, "Missing or invalid endpoint");
		post_data("ERROR", "Missing or invalid endpoint", "None");
        break;
}
die();
?>