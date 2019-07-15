<?php

require_once 'Excel/excel_reader2.php';
require_once 'TextToImage.php';

$data = new Spreadsheet_Excel_Reader("c:/xampp/htdocs/lista/test.xls");

function eliminar_tildes($cadena){

    //Codificamos la cadena en formato utf8 en caso de que nos de errores
    $cadena = utf8_encode($cadena);

    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );

    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );

    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );

    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );

    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );

    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );

    return $cadena;
}

for ($fila=1; $fila<=11; $fila++) {
    
    for ($columna = 1; $columna<=6; $columna++) {
        
        switch ($columna) {
            
            /*case 1:
                $fileName = eliminar_tildes($data->val($fila,$columna));
                break;
            case 2:
                $invitado = eliminar_tildes($data->val($fila,$columna));
                break;
            case 3:
                $mesa = eliminar_tildes($data->val($fila,$columna));
                break;*/

            case 1:
                $fileName = eliminar_tildes($data->val($fila,$columna));
                break;
            case 2:
                $graduando = eliminar_tildes($data->val($fila,$columna));
                break;
            case 3:
                $invitado = eliminar_tildes($data->val($fila,$columna));
                break;
            case 4:
                $cedula = eliminar_tildes($data->val($fila,$columna));
                break;
            case 5:
                $mesa = eliminar_tildes($data->val($fila,$columna));
                break;
            case 6:
                $otro = eliminar_tildes($data->val($fila,$columna));
                break;
         }
        
	}
    
    //create img object
    $img = new TextToImage;

    if (empty($invitado)) {
        $invitado=$graduando;
    }
    
    //create image from text
    $text = 'Graduando: '.$graduando.'\n\nInvitado: '.$invitado.'\n\nCedula: '.$cedula.'\n\nMesa: '.$mesa.'\n\nOtro: '.$otro;
    //$text = 'Profesor: '.$invitado.'\n\nMesa: '.$mesa;
    $img->createImage($text);

    //save image as jpg format
    $img->saveAsJpg('0'.$fileName,'c:/xampp/htdocs/lista/images/');
    

}

echo "terminado";


?>