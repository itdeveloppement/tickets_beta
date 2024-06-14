<?php
/**
 * role : manipulation des date
 */

 namespace App\Utils;

use App\Modeles\Model;
use DateTime;

class Date extends Model {

    protected $date;

 /**
  * role : supression heure d'un datetime et formatage xx xx xxxx
  * @param : string $datetime : format : Y-m-d H:i:s
  *@return : string au format xx xx xxxx
  */
public function dateShort($date) {
// instentiation d'un objet datetime
$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
// formatage si l'objet a été créé
if ($dateTime === false) {
    echo "Erreur lors de la création de l'objet DateTime.";
} else {
    // Transformer la date au format 'dd mm yyyy'
    $shortDate = $dateTime->format('d m Y');
}
return $shortDate;
}

public function dateCurent () {
    $date = date('Y-m-d H:i:s');
    return $date;
}
}