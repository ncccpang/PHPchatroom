<?php
if (!isset($_COOKIE["name"])) {
    header("Location: error.html");
    return;
}

// get the name from cookie
$name = $_COOKIE["name"];


// get the message content
$message = $_POST["message"];
/**
//get the color content
$color = $_POST["color"];
**/
//echo $color;
if (trim($message) == "") $message = "__EMPTY__";

require_once('xmlHandler.php');

// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.html");
    exit;
}

$xmlh->openFile();

// Get the 'messages' element as the current element
$messages_element = $xmlh->getElement("messages");

// Create a 'message' element for each message
$message_element = $xmlh->addElement($messages_element, "message");


// Add the name
$xmlh->setAttribute($message_element, "name", $_COOKIE["name"]);
$xmlh->setAttribute($message_element, "color", $_POST["color"]);

//$xmlh->addAttribute($message_element, "color" $color);

// Add the content of the message
$xmlh->addText($message_element, $message);

$xmlh->saveFile();

// create the following DOM tree structure for a message
// and add it to the chatroom XML file
//
// <message name="...">...</message>
//

/* Add your code here */

header("Location: client.php");

?>
