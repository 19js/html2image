<?php
$html=file_get_contents('./index.html');
$js=file_get_contents('assets/html2canvas.js');
$str="<script >".$js."</script>";
$k="";
$str .=";

<script>
    html2canvas(document.body).then(function(canvas) {
       var k=canvas.toDataURL();
        console.log(k)
    });
  </script>
";
echo  $html.$str;


