<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-07
 * Time: 15:10
 */
/**
 * !!!! JE N'AI PAS MIS LE NOM DU SPORT DEVANT LES ATTRIBUE
 * DE LA CLASSE POUR QUE SA SERT COHERENT AVEC LA TABLE
 * */
class Adherents
{
    private $idAdherents;
    private $prenomAdherents;
    private $nomAdherents;
    private $dateBornAdherents;
    private $genreAdherents;
    public static $_INSTANCE = null;


    private function __construct($MuscuUnId = 0, $MuscuUnNom = '', $MuscuUnPrenom = '', $MuscuUneDate = 0, $MuscuUnGenre = '')
    {
        $this->idAdherents = $MuscuUnId;
        $this->prenomAdherents = $MuscuUnNom;
        $this->nomAdherents = $MuscuUnPrenom;
        $this->dateBornAdherents = $MuscuUneDate;
        $this->genreAdherents = $MuscuUnGenre;
    }

    public function __set($Muscuname, $Muscuvalue)
    {
        $this->$Muscuname = $Muscuvalue;
    }

    public function __get($Muscuname)
    {
        return $this->$Muscuname;
    }

    public static function MuscugetInstance($MuscuUnId = 0, $MuscuUnNom = '', $MuscuUnPrenom = '', $MuscuUneDate = 0, $MuscuUnGenre = '')
    {
        if (is_null(self::$_INSTANCE))
            self::$_INSTANCE = new Adherents($MuscuUnId, $MuscuUnNom, $MuscuUnPrenom, $MuscuUneDate, $MuscuUnGenre);

        return self::$_INSTANCE;
    }

    public static function MuscugetAll()
    {
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents; ");
        if (count($Muscures) > 0)
            return $Muscures;
        else
            return array();
    }

    public static function MuscugetAJourWithDetail($Muscufilter = 0)
    {
        global $MuscuMaster;
        if($Muscufilter > 0 ) {
            $Muscufilter = " AND adherents_inscrit.idClubs = " . $Muscufilter;
        }else{
            $Muscufilter = "  " ;
        }
        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents 
                                                LEFT JOIN adherents_inscrit 
                                                ON  adherents.idAdherents = adherents_inscrit.idAdherents 
                                                LEFT JOIN clubs ON clubs.idClubs = adherents_inscrit.idClubs
                                                WHERE adherents_inscrit.annee_licence = '" . date('Y') . "'
                                                " . $Muscufilter ."
                                                GROUP BY adherents_inscrit.idAdherents ; ");
        if (count($Muscures) > 0)
            return $Muscures;
        else
            return array();
    }

    public static function MuscugetNonAJourWithDetail($Muscufilter = 0 )
    {
        global $MuscuMaster;
        if($Muscufilter > 0 ) {
            $Muscufilter = " AND adherents_inscrit.idClubs = " . $Muscufilter;
        }else{
            $Muscufilter = "  " ;
        }
        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents LEFT JOIN adherents_inscrit 
                                                ON  adherents.idAdherents = adherents_inscrit.idAdherents 
                                                LEFT JOIN clubs ON clubs.idClubs = adherents_inscrit.idClubs
                                                WHERE adherents_inscrit.annee_licence != '" . date('Y') . "'
                                                " . $Muscufilter ."
                                                GROUP BY adherents_inscrit.idAdherents ;");
        if (count($Muscures) > 0)
            return $Muscures;
        else
            return array();
    }
    public static function MuscugetAllWithDetail($Muscufilter = 0 )
    {
        global $MuscuMaster;
        if($Muscufilter > 0 ) {
            $Muscufilter = " AND adherents_inscrit.idClubs = " . $Muscufilter;
        }else{
            $Muscufilter = "  " ;
        }
        $Muscures = $MuscuMaster->ExecuteS("SELECT adherents.* , clubs.* FROM adherents LEFT JOIN adherents_inscrit 
                                                ON  adherents.idAdherents = adherents_inscrit.idAdherents 
                                                LEFT JOIN clubs ON clubs.idClubs = adherents_inscrit.idClubs
                                                WHERE 1
                                                " . $Muscufilter ."
                                                 GROUP BY adherents_inscrit.idAdherents ;");
        if (count($Muscures) > 0)
            return $Muscures;
        else
            return array();
    }


    public function MuscugetById($MuscuidAdherents)
    {
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents WHERE idAdherents = " . $MuscuidAdherents . "; ");
        if (count($Muscures) > 0)
            return $Muscures[0];
        else
            return array();
    }

    public function MuscuCreate()
    {
        global $MuscuMaster;

        $Muscu_array_insert = array(
            'nomAdherents' => $this->nomAdherents,
            'prenomAdherents' => $this->prenomAdherents,
            'dateBornAdherents' => $this->dateBornAdherents,
            'genreAdherents' => $this->genreAdherents,
        );
        $Muscures = $MuscuMaster->autoExecute('adherents', $Muscu_array_insert, 'INSERT');
        if ($Muscures)
            return $MuscuMaster->Insert_ID();
        else
            return FALSE;
    }

    public function MuscuUpdate()
    {
        global $MuscuMaster;

        $Muscu_table_column = array(
            'nomAdherents',
            'prenomAdherents',
            'dateBornAdherents',
            'genreAdherents',
        );
        $Muscu_update_array = array();
        foreach ($Muscu_table_column as $Muscuitem) {
            if (!empty($this->$Muscuitem)) {
                $Muscu_update_array[$Muscuitem] = $this->$Muscuitem;
            }
        }

        $Muscures = $MuscuMaster->autoExecute('adherents', $Muscu_update_array, 'UPDATE', ' idAdherents = ' . $this->idAdherents);
        if ($Muscures)
            return TRUE;
        else
            return FALSE;
    }


    public function MuscuDelete()
    {
        global $MuscuMaster;

        $Muscures = $MuscuMaster->Execute("DELETE FROM adherents WHERE idAdherents =  " . $this->idAdherents);
        return $Muscures;
    }

    public function MuscugetListClubsByIdAdherent($MuscuidAdherents)
    {
        global $MuscuMaster;

        $Muscures = $MuscuMaster->ExecuteS("SELECT * FROM adherents_inscrit LEFT JOIN clubs  
                                                ON adherents_inscrit.idClubs = clubs.idClubs
                                                WHERE idAdherents = " . $MuscuidAdherents . "; ");
        if (count($Muscures) > 0)
            return $Muscures;
        else
            return array();
    }

    public static function MuscugetStat()
    {
        global $MuscuMaster;

        $Muscutotal = $MuscuMaster->ExecuteS("SELECT COUNT(*) as total  FROM adherents ");
        $Muscuhomme = $MuscuMaster->ExecuteS("SELECT COUNT(*) as total  FROM adherents WHERE genreAdherents = 'H'");
        return array('total' => $Muscutotal[0]['total'], 'homme' => $Muscuhomme[0]['total']);
    }

    public static function MuscugetStatByIdClub($MuscuidClubs)
    {
        global $MuscuMaster;

        $Muscutotal = $MuscuMaster->ExecuteS("SELECT COUNT(*) as total 
                                        FROM adherents LEFT JOIN adherents_inscrit 
                                        ON adherents.idAdherents = adherents_inscrit.idAdherents 
                                        WHERE adherents_inscrit.idClubs = " . $MuscuidClubs);
        $Muscuhomme = $MuscuMaster->ExecuteS("SELECT COUNT(*) as total 
                                        FROM adherents LEFT JOIN adherents_inscrit 
                                        ON adherents.idAdherents = adherents_inscrit.idAdherents  
                                        WHERE adherents.genreAdherents = 'H' AND adherents_inscrit.idClubs = " . $MuscuidClubs);
        return array('total' => $Muscutotal[0]['total'], 'homme' => $Muscuhomme[0]['total']);
    }

    public static function MuscugetAge($MuscudateBorn)
    {
        return $Muscuage = (time() - strtotime($MuscudateBorn)) / 3600 / 24 / 365;
    }


}