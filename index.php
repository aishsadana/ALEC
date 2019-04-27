 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "query";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
// username and password sent from form 
$query = $_POST['query'];
$email = $_POST['email']; 
$sql="Insert into queries values('".$query."','".$email."','".date("Y-m-d")."',0,0)";
mysqli_query($conn,$sql);

}
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>ALEC</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
   <meta charset="utf-8"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    var ws = new WebSocket("ws://localhost:8080");
    // Close socket when window closes
    $(window).on('beforeunload', function(){
       ws.close();
    });
    ws.onerror = function(event) {
        location.reload();
    }
    ws.onmessage = function(event)  { 
        var message_received = event.data;
        chat_add_message(message_received, false);
    };
    // Add a message to the chat history
    function chat_add_message(message, isUser) {
        var class_suffix = isUser ? '_user' : '_server';
        var html = '\
        <div class="chat_line">\
            <div class="chat_bubble'+class_suffix+'">\
              \
                '+message+'\
            </div>\
        </div>\
        ';
        chat_add_html(html);
    }
    // Add HTML to the chat history
    function chat_add_html(html) {
        $("#msg-page").append(html);
        chat_scrolldown();
    }
    // Scrolls the chat history to the bottom
    function chat_scrolldown() {
        $("#msg-page").animate({ scrollTop: $("#msg-page")[0].scrollHeight }, 500);
    }
    // If press ENTER, talk to chat and send message to server
    $(function() {
       $('#chat_input').on('keypress', function(event) {
          if (event.which === 13 && $(this).val() != ""){
             var message = $(this).val();
             $(this).val("");
             chat_add_message(message, true);
             ws.send(message);
          }
       });
    });
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  ws.close();
  location.reload();
}
function submitquery(){
	var html = '\
        <div style="width:95%;border-radius:10px 10px 10px 0px;" class="chat_line">\
            <div style="width:95%;" class="chat_bubble_server">\
              <form name="f1" method="POST" action="" target="frame" onsubmit="displaymsg()">\
				Enter your query <br><textarea name="query" autocomplete="off" style="width:200px;height:30px;" required></textarea><br>\
				Enter your mail id <br><input type="email" name="email" style="width:200px;" autocomplete="off" required /><br><br>\
				<input type="submit" value="Submit" style=" background-color:#234b9b;border:none;color:white;padding:5px 10px;text-align:center;text-decoration:none;display:inline-block;font-size:10px;margin-bottom:2px;"/>\
			  </form>\
            </div>\
        </div>\
        ';
    chat_add_html(html);
}
function displaymsg(){
	var html = '\
        <div class="chat_line">\
            <div class="chat_bubble_server">\
				Your query has been submitted\
            </div>\
        </div>\
        ';
    chat_add_html(html);
}

</script>
<style type="text/css">
iframe{
	display:none;
}
body {
    background-image: url("background.jpg");
	font-family: Helvetica;
}
#chat_container {
    overflow: hidden;
    border-radius: 15px;
    border: 1px solid black;
    margin: 40px 80px 0px 80px;
}
#chat_log {
    background-color: #F3F76F;
    padding: 10px;
    border-bottom: 1px solid black;
    overflow-y: scroll;
    height: 300px;
    font-size: 26px;
}
#chat_input_container {
    padding-bottom: 2px;
	padding-left:2px;
	padding-right:10px;
}
#chat_input {
    padding-bottom:0px;
    font-size: 18px;
    width: 100%;
	border: none;
	border-radius: 20px;
}
.chat_line {
    overflow: hidden;
    width: 100%;
    margin: 2px 0 12px 0;
}
.chat_server, .chat_bubble_server {
    background: #007bff none repeat scroll 0 0;
    color: #fff;
    border-radius:10px 10px 10px 0px;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 50%;
}
.chat_bubble_server {
    left: auto;
    right: 10px;
    border-width: 13px 18px 0 0;
    border-color: #234b9b transparent transparent transparent;
}
.chat_bubble, .chat_bubble_user {
    background: #007bff none repeat scroll 1px 1px;
    color: #fff;
    border-radius: 10px 10px 0px 10px;
    font-size: 14px;
    margin: 3px;
    padding: 5px 10px 5px 12px;
    width: 50%;
}
.chat_bubble_user {
    float: right;
    margin-left: 0px;
    margin-right: 20px;
    background-color: #234b9b;
    color: #FFF;
}


.container
{
  width: 300px;
  margin-left: 75%;
  margin-top: 3%;
  font-family: sans-serif;
  letter-spacing: 0.5px;
  position:fixed;
  background-color:powderblue;
  display: none;
  z-index: 9;
  right: 28px;
  bottom: 23px;
  /*opacity: 0.7 ;*/
}
.open-button {
  background-color:blue;
  color: white;
  padding: 16px 20px;
  text-align: center;
  border: none;
  cursor: pointer;
  opacity: 0.7;
  position: fixed;
  bottom: 10px;
  right: 10px;
  border-radius: 60%;
}
.btn-cancel {
  background-color: #ff0000;
  color: white;
  padding: 16px 20px;
  text-align: center;
  border: none;
  cursor: pointer;
  
  position: fixed;
  bottom: 10px;
  right: 10px;
  border-radius: 60%;
}
.msg-header
{
 border: none;
 max-height: 45px;
 width: 99%;
 height: 10%;
 border-bottom: 3px solid rgb(20, 20, 20);
 display: inline-block;
 background-color:blue;
}
.msg-header-img 
{
    border-radius: 20%;
    width: 1px;
    height: 1px;
    margin-left: 20px;
    margin-top: 2px;
    float: left;
    border-image: 0px;
}

.name
{
 width: 100%;
 float: center;
 margin-top: 10px;
 
}
.name h2
{
 font-size: 30px;
 margin : auto;
 text-align: center;
 font-style: sans-serif;
 
 color: rgb(20, 20, 20);
}
.header-icons
{
    width: 120px;
    float: right;
    margin-top: 12px;
    margin-right: 10px;
}
.header-icons .fa
{
    color: #fff;
    cursor: pointer;
    margin: 10px;
}
.chat-page
{
    /*padding: 0 0 50px 0;*/
    width: 99%;
    border: none;
    background-color: #b3e0ff;
}
.chats
{
    padding: 30px 5px 0 15px;
}
#msg-page
{
    height: 400px;
    overflow-y: auto;
}
.msg-inbox
{
  border: none;
  overflow: hidden;
  padding-bottom: 20px;
}
.received-chats-img
{
    display: inline-block;
    width: 20px;
    float: left;
}
.received-msg
{
    
    background: #007bff none repeat scroll 0 0;
        color: #fff;
        border-radius: 10px 10px 0px 10px;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 50%;
}
.received-msg-inbox
{
  width: 40%;
}
.received-msg-inbox .p
{
    background: #efefef non repeat scroll 0 0;
    border-radius: 10px 10px 0px 10px;
    color: #0c0c0c;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width:10
}
.outgoing-chats
{
     overflow: hedden;
      margin: 26px 20px;
}
.outgoing-chats-msg
{
        background: #007bff none repeat scroll 1px 1px;
        color: #fff;
        border-radius: 10px;
        font-size: 14px;
        margin: 3px;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
}
.outgoing-chats-msg
{
    float: right;
    width: 60%;
   
}
.outgoing-chats-img
{
    display: inline-block;
    width: 20px;
    float: right;
}
.msg-bottom
{
 position: relative;
 height: 10%;
 background-color: #007bff;
}
.input-group
{
    float: right;
    margin-top: 13px;
    margin-right: 20px;
    outline: none;
    border-radius: 20px;
    width: 61%;
    background-color: #fff;
}
.form-control
{
    
    border: none;
    border-radius: 20px;
    margin-left: 30%;
}
.input-group-text
{
    background: transparent;
    border: rgb(20, 20, 20);
}
.input-group .fa
{
     color: #f0f6f7;
     float: right;
}
.bottom-icons
{
    float: left;
    margin-top: 17px;
    width: 30px;
    margin-left: 22px;
}
.bottom-icons .fa
{
    color: #fff;
    padding: 5px;
}
.form-control:focus
{
    border-color: none;
    box-shadow: none;
    border-radius: 20px;
}
.chat_input:focus
{
    border-color: none;
    box-shadow: none;
    border-radius: 20px;
}
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #0000e6; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #000099; 
}

/* to remove outline on focus */
*:focus {
    outline: none;
}

*{
	margin: 0;
	padding: 0;
	font-family: Century Gothic;
}

header{
	background-image: linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)), url(blue.jpg);
	height: 100vh;
	background-size: cover;
	background-position: center;
}

ul{
	float: right;
	list-style-type: none; 
	margin-top: 25px;
}

ul li{
	display: inline-block;
}

ul li a{
	text-decoration: none;
	color: #fff;
	padding: 5px 20px;
	border: 1px solid transparent;
	transition: 0.6s ease;
}

ul li a:hover{
	background-color: white;
	color: #000;
}

ul li.active a{
	background-color: white;
	color: #000;
}

.logo img{
	float: left;
	width: 250px;
	height: auto;
}

.main{
	max-width: 1300px;
	margin: auto;
}

.title{
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
}

.title h1{
	color: #fff;
	font-size: 70px;
}

</style>
</head>
<body>
<header>
		<div class="main">
			<div class="logo">
				<img src="logonew.png">
			</div>
			<ul>
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Events</a></li>
				<li><a href="#">Gallery</a></li>
				<li><a href="#">Contacts</a></li>
			</ul>
		</div>

		<div class="title">
			<h1>CSED Website</h1>
		</div>
	</header>

<button class="open-button" onclick="openForm()">CHAT</button>
<div class="container" id="myForm" style="background-color:rgb(47, 183, 201);">
    <div class="msg-header">
        <div class="msg-header-img">
            
           <!-- <image src="image\logo.jpg" style="width:40px;height:40px;"></image> -->
        </div>
            <div class="name">
            <h2>ALEC</h2>
        </div>
        <div class="header-icons">
            <!--<i class="fa fa-commenting-o"></i>-->
        </div>
    </div>

    <div class="chat-page">
     <div class="msg-inbox">
       <div class="chats">
         <div id="msg-page">
		 <div class="chat_line">
            <div class="chat_bubble_server">
              Hi! ALEC here
            </div>
        </div>
		<div class="chat_line">
            <div class="chat_bubble_server">
              You can ask me any question related to CSED
            </div>
        </div>
		<div class="chat_line">
            <div class="chat_bubble_server">
              or you can submit your query using the 'Any Query' button below
            </div>
        </div>
         </div>
		 <div id="chat_input_container">
			<div><input id="chat_input" autocomplete="off" /></div>
		 </div>
		 <button onclick="submitquery()" style=" background-color:#234b9b;border:none;color:white;padding:5px 10px;text-align:center;text-decoration:none;display:inline-block;font-size:10px;margin-bottom:2px;">
		 Any Query</button>
       </div>
     </div>
         
 </div>
 <button type="button" class="btn-cancel" onclick="closeForm()">Close</button>
</div>
<iframe name="frame">
</iframe>

</body>
</html>