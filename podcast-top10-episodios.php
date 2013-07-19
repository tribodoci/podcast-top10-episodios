<?php

mysql_connect("localhost","","");
mysql_select_db("relsonin_wrdp1");

$sql  = "";
$sql .= "SELECT   wp_posts.id                               , ";
$sql .= "         wp_posts.post_title, ";
$sql .= "         SUM(wp_podpress_statcounts.total) AS total, ";
$sql .= "         wp_posts.post_name ";
$sql .= "FROM     wp_podpress_statcounts ";
$sql .= "         INNER JOIN wp_posts ";
$sql .= "         ON       wp_posts.id = wp_podpress_statcounts.postID ";
$sql .= "GROUP BY wp_posts.id        , ";
$sql .= "         wp_posts.post_title, ";
$sql .= "         wp_posts.post_name ";
$sql .= "ORDER BY total DESC LIMIT 10 ";

$query = mysql_query($sql);
echo "<html><head><meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\" />";
echo "</head><body style=\"font-family: arial, helvetica, sans; color: #FFFFFF;text-decoration: none; font-size: small;\"><ol>";  
while ($res = mysql_fetch_array($query)){
	
	$link  = "/?p=".$res["id"];
	
	echo "<li style=\"margin-left: -25px;margin-bottom: 10px; border-bottom: solid lightgray 1px;\"><a target=\"_blank\" style=\"text-decoration: none; color: #FFFFFF;\" href=\"". $link . "\">" . htmlspecialchars(substr($res["post_title"],33)) ." (" . str_pad($res["total"], 4, "0", STR_PAD_LEFT) . ") " . "</a></li>";
}
echo "<ol></body></html>";	
?>
