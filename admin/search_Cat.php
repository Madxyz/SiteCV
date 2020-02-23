<?php

  $key=$_GET['key'];
  $array = array();
  $con=mysqli_connect("109.234.164.74","zaah7051_jds_Defaut","2WI87U3ITszQ","zaah7051_jds","3306");
  $query=mysqli_query($con, "SELECT * FROM categorie WHERE nom_categorie LIKE '%{$key}%'");
  while($row=mysqli_fetch_assoc($query))
  {
    $array[] = $row['nom_categorie'];
  }
  echo json_encode($array);
  mysqli_close($con);
?>
