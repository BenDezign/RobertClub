<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 16:45
 */
/**
 * !!!! JE N'AI PAS MIS LE NOM DU SPORT DEVANT LES ATTRIBUE
 * DE LA CLASSE POUR QUE SA SERT COHERENT AVEC LA TABLE
 * */
class Inscription
{

    private $idInscription;
    private $idAdherents;
    private $idClubs;
    private $date_inscription;
    private $annee_licence;
    public static $_INSTANCE = null ;

    private function __construct($MuscuidInscription = 0 , $MuscuidAdherents = 0 , $MuscuidClubs = 0 , $Muscudate_inscription = 0  , $Muscuannee_licence = 0)
    {
        $this->idInscription = $MuscuidInscription ;
        $this->idAdherents = $MuscuidAdherents ;
        $this->idClubs = $MuscuidClubs ;
        $this->date_inscription = $Muscudate_inscription ;
        $this->annee_licence = $Muscuannee_licence ;
    }

    public function __set($Muscuname, $Muscuvalue)
    {
        $this->$Muscuname = $Muscuvalue ;
    }

    public function  __get($Muscuname)
    {
        return $this->$Muscuname ;
    }

    public  static function MuscugetInstance($MuscuidInscription = 0 , $MuscuidAdherents = 0 , $MuscuidClubs = 0 , $Muscudate_inscription = 0  , $Muscuannee_licence = 0) {
        if(is_null(self::$_INSTANCE))
            self::$_INSTANCE = new Inscription($MuscuidInscription , $MuscuidAdherents , $MuscuidClubs  , $Muscudate_inscription  , $Muscuannee_licence ) ;

        return self::$_INSTANCE ;
    }

    public static  function  MuscugetAll(){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents_inscrit; ");
        if( count($Muscures)  > 0 )
            return $Muscures ;
        else
            return array();
    }
    public  function  MuscugetById($MuscuidInscription){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents_inscrit WHERE idInscription = ".$MuscuidInscription."; ");
        if( count($Muscures)  > 0 )
            return $Muscures[0] ;
        else
            return array();
    }
    public  function  MuscugetByIdClub($MuscuidClubs){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents_inscrit WHERE idClubs = ".$MuscuidClubs."; ");
        if( count($Muscures)  > 0 )
            return $Muscures ;
        else
            return array();
    }
    public  function  MuscugetByIdAdherent($MuscuidAdherents){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents_inscrit WHERE idAdherents = ".$MuscuidAdherents."; ");
        if( count($Muscures)  > 0 )
            return $Muscures;
        else
            return array();
    }
    public function  MuscuCreate(){
        global $MuscuMaster;

        $Muscu_array_insert = array(
            'idAdherents' => $this->idAdherents ,
            'idClubs' => $this->idClubs,
            'idAdherents' => $this->idAdherents,
            'date_inscription' => $this->date_inscription,
            'annee_licence' => $this->annee_licence,
        ) ;
        $Muscures = $MuscuMaster->autoExecute('adherents_inscrit' , $Muscu_array_insert , 'INSERT');
        if( $Muscures )
            return $MuscuMaster->Insert_ID()  ;
        else
            return FALSE;
    }

    public  function  MuscuUpdate(){
        global $MuscuMaster;

        $Muscu_table_column = array(
            'idAdherents' ,
            'idClubs' ,
            'idAdherents' ,
            'date_inscription' ,
            'annee_licence',
        ) ;
        $Muscu_update_array = array();
        foreach ($Muscu_table_column as $Muscuitem)
        {
            if (!empty($this->$Muscuitem)){
                $Muscu_update_array[$Muscuitem] = $this->$Muscuitem ;
            }
        }

        $Muscures = $MuscuMaster->autoExecute('adherents_inscrit' , $Muscu_update_array , 'UPDATE' , ' idInscription = '.$this->idInscription);
        if( $Muscures )
            return TRUE  ;
        else
            return FALSE;
    }


    public  function  MuscuDelete(){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->Execute("DELETE FROM adherents_inscrit WHERE idInscription =  ".$this->idInscription);
        return $Muscures ;
    }
    public  function  MuscuDeleteByIdAdherent(){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->Execute("DELETE FROM adherents_inscrit WHERE idAdherents =  ".$this->idAdherents);
        return $Muscures ;
    }
    public  function  MuscuDeleteByIdClub(){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->Execute("DELETE FROM adherents_inscrit WHERE idClubs =  ".$this->idClubs);
        return $Muscures ;
    }
}
