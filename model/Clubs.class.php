<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-07
 * Time: 14:47
 */
/**
 * !!!! JE N'AI PAS MIS LE NOM DU SPORT DEVANT LES ATTRIBUE
 * DE LA CLASSE POUR QUE SA SERT COHERENT AVEC LA TABLE
 * */
class Clubs
{

    private $idClubs;
    private $nomClubs;
    private $codePostalClubs;
    private $villeClubs;
    public static $_INSTANCE = null ;

    private function __construct($MuscuUnId = 0 , $MuscuUnNom = '' , $MuscuUnCode = 0 , $MuscuUneVille = 0)
    {
        $this->idClubs = $MuscuUnId ;
        $this->nomClubs = $MuscuUnNom ;
        $this->codePostalClubs = $MuscuUnCode ;
        $this->villeClubs = $MuscuUneVille ;
    }

    public function __set($Muscuname, $Muscuvalue)
    {
        $this->$Muscuname = $Muscuvalue ;
    }

    public function  __get($Muscuname)
    {
        return $this->$Muscuname ;
    }

    public  static function MuscugetInstance($MuscuUnId = 0 , $MuscuUnNom = '' , $MuscuUnCode = 0 , $MuscuUneVille = 0) {
        if(is_null(self::$_INSTANCE))
             self::$_INSTANCE = new Clubs($MuscuUnId, $MuscuUnNom , $MuscuUnCode , $MuscuUneVille) ;

            return self::$_INSTANCE ;
    }

    public static  function  MuscugetAll(){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM clubs; ");
        if( count($Muscures)  > 0 )
            return $Muscures ;
        else
            return array();
    }
    public  function  MuscugetById($MuscuidClubs){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM clubs WHERE idClubs = ".$MuscuidClubs."; ");
        if( count($Muscures)  > 0 )
            return $Muscures[0] ;
        else
            return array();
    }

    public function  MuscuCreate(){
        global $MuscuMaster;

        $Muscu_array_insert = array(
            'nomClubs' => $this->nomClubs ,
            'codePostalClubs' => $this->codePostalClubs,
            'villeClubs' => $this->villeClubs,
            ) ;
        $Muscures = $MuscuMaster->autoExecute('clubs' , $Muscu_array_insert , 'INSERT');
        if( $Muscures )
            return $MuscuMaster->Insert_ID()  ;
        else
            return FALSE;
    }

    public  function  MuscuUpdate(){
        global $MuscuMaster;

        $Muscu_table_column = array(
            'nomClubs'  ,
            'codePostalClubs' ,
            'villeClubs' ,
        ) ;
        $Muscu_update_array = array();
        foreach ($Muscu_table_column as $Muscuitem)
        {
            if (!empty($this->$Muscuitem)){
                $Muscu_update_array[$Muscuitem] = $this->$Muscuitem ;
            }
        }

        $Muscures = $MuscuMaster->autoExecute('clubs' , $Muscu_update_array , 'UPDATE' , ' idClubs = '.$this->idClubs);
        if( $Muscures )
            return TRUE  ;
        else
            return FALSE;
    }


    public  function  MuscuDelete(){
        global $MuscuMaster;

        $Muscures = $MuscuMaster->Execute("DELETE FROM clubs WHERE idClubs =  ".$this->idClubs);
            return $Muscures ;
    }
}