<?php
include_once("resultat-attendu.php");

?>
<table style="width: 100%;">
  <tr>
    <th style="width: 50%;">
    	<fieldset style="padding: 5px;">
    		<legend style="margin-left: 100px;">MONOLINE</legend>
    		<div style="padding: 2px; text-align: center;">
    			<a href="?f=POTS-monoline">POTS</a> &nbsp;|&nbsp; <a href="?f=T0-monoline">T0</a> &nbsp;|&nbsp; <a href="?f=T2-monoline">T2</a>
    		</div>
    	</fieldset>
    </th>
    <th><a href="resultat-attendu-html.php">TOUT AFFICHER</a></th>
    <th style="width: 50%;">
    	<fieldset style="padding: 5px;">
    		<legend style="margin-left: 100px;">MULTILINE</legend>
    		<div style="padding: 2px; text-align: center;">
    			<a href="?f=POTS-multiline">POTS</a> &nbsp;|&nbsp; <a href="?f=T0-multiline">T0</a> &nbsp;|&nbsp; <a href="?f=T2-multiline">T2</a>
    		</div>
    	</fieldset>
    </th>
  </tr>
</table>
<?php

if(count($finalResultText) > 0){
	?>
<table border="1" style="width: 100%;">
   <tr>
       <th>TYPE</th>
       <th>NDG</th>
       <th style="min-width: 220px;">NDS</th>
       <th>CAT</th>
       <th>ND</th>
       <th>NE</th>
       <th>TY</th>
       <th>MAR</th>
       <th>NAR</th>
       <th>TYPE=3</th>
       <th>TYPE=4</th>
       <th>ACH</th>
   </tr>
   <?php 
   foreach ($finalResultText as $key => $value){
   	$TYPE_VALUE = $value["TYPE_VALUE"];
   	$NDG_VALUE = $value["NDG_VALUE"];
   	$NDS_VALUE = $value["NDS_VALUE"];
   	$CAT_VALUE = $value["CAT_VALUE"];
   	$ND_VALUE = $value["ND_VALUE"];
   	$NE_VALUE = $value["NE_VALUE"];
   	$TY_VALUE = $value["TY_VALUE"];
   	$MAR_VALUE = $value["MAR_VALUE"];
   	$NAR_VALUE = $value["NAR_VALUE"];
   	$TYPE_3_VALUE = $value["TYPE_3_VALUE"];
   	$TYPE_4_VALUE = $value["TYPE_4_VALUE"];
   	$ACH_VALUE = $value["ACH_VALUE"];
   	?>
   <tr>
       <td valign="top" title="TYPE"><input readonly="readonly" type="text" value="<?php echo $TYPE_VALUE; ?>" /></td>
       <td valign="top" title="NDG"><input readonly="readonly" type="text" value="<?php echo $NDG_VALUE; ?>" /></td>
       <td valign="top" title="NDS"><textarea style="min-width: 100%; min-height: 90px;" readonly="readonly"><?php echo (!is_array($NDS_VALUE) ? $NDS_VALUE : implode("\n", $NDS_VALUE)); ?></textarea></td>
       <td valign="top" title="CAT"><input readonly="readonly" type="text" value="<?php echo $CAT_VALUE; ?>" /></td>
       <td valign="top" title="ND">
       <?php 
       if(is_array($ND_VALUE)){
       		foreach ($ND_VALUE as $k => $val){
       			//echo ($k >= 1 ? "<hr>" : "");
       			?><input readonly="readonly" type="text" value="<?php echo $val; ?>" /><?php
       		}
       }
       else{
       	?><input readonly="readonly" type="text" value="<?php echo $ND_VALUE; ?>" /><?php
       }
       ?>
       </td>
       <td valign="top" title="NE">
       <?php 
       if(is_array($NE_VALUE)){
       		foreach ($NE_VALUE as $k => $val){
       			//echo ($k >= 1 ? "<hr>" : "");
       			?><input readonly="readonly" type="text" value="<?php echo $val; ?>" /><?php
       		}
       }
       else{
       	?><input readonly="readonly" type="text" value="<?php echo $NE_VALUE; ?>" /><?php
       }
       ?>
       </td>
       <td valign="top" title="TY">
       <?php 
       if(is_array($TY_VALUE)){
       		foreach ($TY_VALUE as $k => $val){
       			//echo ($k >= 1 ? "<hr>" : "");
       			?><input readonly="readonly" type="text" value="<?php echo $val; ?>" /><?php
       		}
       }
       else{
       	?><input readonly="readonly" type="text" value="<?php echo $TY_VALUE; ?>" /><?php
       }
       ?>
       </td>
       <td valign="top" title="MAR">
       <?php 
       if(is_array($MAR_VALUE)){
       		foreach ($MAR_VALUE as $k => $val){
       			//echo ($k >= 1 ? "<hr>" : "");
       			?><input readonly="readonly" type="text" value="<?php echo $val; ?>" /><?php
       		}
       }
       else{
       	?><input readonly="readonly" type="text" value="<?php echo $MAR_VALUE; ?>" /><?php
       }
       ?>
       </td>
       <td valign="top" title="NAR">
       <?php 
       if(is_array($NAR_VALUE)){
       		foreach ($NAR_VALUE as $k => $val){
       			//echo ($k >= 1 ? "<hr>" : "");
       			?><input readonly="readonly" type="text" value="<?php echo $val; ?>" /><?php
       		}
       }
       else{
       	?><input readonly="readonly" type="text" value="<?php echo $NAR_VALUE; ?>" /><?php
       }
       ?>
       </td>
       <td valign="top" title="TYPE=3"><input readonly="readonly" type="text" value="<?php echo $TYPE_3_VALUE; ?>" /></td>
       <td valign="top" title="TYPE=4"><input readonly="readonly" type="text" value="<?php echo $TYPE_4_VALUE; ?>" /></td>
       <td valign="top" title="ACH"><input readonly="readonly" type="text" value="<?php echo $ACH_VALUE; ?>" /></td>
   </tr>
   	<?php
   	//MAX = 50;
   	if($key == 1000) break;
   }
   ?>
</table>
	<?php
}
else{
	echo "<h3>Aucun resultat trouvé.</h3>";
}
?>