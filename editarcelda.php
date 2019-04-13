<?php
include("conn.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
 $update_field='';
 if(isset($input['nombre'])) {
 $update_field.= "nombre='".$input['nombre']."'";
 } else if(isset($input['telefono'])) {
 $update_field.= "telefono='".$input['telefono']."'";
 } 
 if($update_field && $input['id']) {
 $sql_query = "UPDATE usuario SET $update_field WHERE id='" . $input['id']."'";
 mysqli_query($conn, $sql_query) or die("database error:".mysqli_error($conn));
 }
}
?>