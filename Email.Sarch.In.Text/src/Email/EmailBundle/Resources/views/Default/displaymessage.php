<?php
$file = $_GET['filename'];
?>
<script>
var client = new XMLHttpRequest();
client.open('GET', '/uploads/<?=$file?>');
client.onreadystatechange = function() {
  document.getElementById("#textbox").value = client.responseText;
}
client.send();

?>