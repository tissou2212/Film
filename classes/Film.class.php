<?php

/**
 * Classe de l'entité Film
 *
 */
class Film
{
  private $film_id;
  private $film_titre;
  private $film_duree; 
  private $film_annee_sortie;
  private $film_resume;
  private $film_affiche;
  private $film_bande_annonce;
  private $film_statut;
  private $film_genre_id;

  private $erreurs = [];

  const ANNEE_PREMIER_FILM = 1895;
  const DUREE_MIN = 1;
  const DUREE_MAX = 600;     
  const STATUT_INVISIBLE = 0;
  const STATUT_VISIBLE   = 1;
  const STATUT_ARCHIVE   = 2;

  /**
   * Constructeur de la classe 
    * @param int $film_id
    * @param string $film_titre
    * @param int $film_duree
    * @param int $film_annee_sortie
    * @param string $film_resume
    * @param string $film_affiche
    * @param string $film_bande_annonce
    * @param int $film_statut
    * @param int $film_genre_id
    */ 
  
  public function __construct($film = []) 
  {
	  if (isset($film["film_id"])) $this->setFilm_id($film["film_id"]);
    if (isset($film["film_titre"])) $this->setFilm_titre($film["film_titre"]);
    if (isset($film["film_duree"])) $this->setFilm_duree($film["film_duree"]);
    if (isset($film["film_annee_sortie"])) $this->setFilm_annee_sortie($film["film_annee_sortie"]);
    if (isset($film["film_resume"])) $this->setFilm_resume($film["film_resume"]);
    if (isset($film["film_affiche"])) $this->setFilm_affiche($film["film_affiche"]);
    if (isset($film["film_bande_annonce"])) $this->setFilm_bande_annonce($film["film_bande_annonce"]);
    if (isset($film["film_statut"])) $this->setFilm_statut($film["film_statut"]);
    if (isset($film["film_genre_id"])) $this->setFilm_genre_id($film["film_genre_id"]);
	}

  /**
   * Destructeur de la classe 
   * @return string
   */
  /*
  public function __destruct() 
  {
    echo "Le film $this->film_titre n'existe plus!<br><br>";
  } */

  /**
   * Accesseur des propriétés de la propriété film_id
   * @return int
   */
  public function getFilm_id() 
  {
    return $this->film_id;
  }
  
  /**
   * Accesseur de la propriété film_titre 
   * @return string
   */
  public function getFilm_titre() 
  {
    return $this->film_titre;
  }

  /**
   * Accesseur de la propriété film_duree 
   * @return int
   */
  public function getFilm_duree() 
  {
    return $this->film_duree;
  }

  /**
   * Accesseur de la propriété film_annee_sortie 
   * @return int
   */

  public function getFilm_annee_sortie() 
  {
    return $this->film_annee_sortie;
  }

  /**
   * Accesseur de la propriété film_resume 
   * @return string
   */
  public function getFilm_resume() 
  {
    return $this->film_resume;
  }

  /**
   * Accesseur de la propriété film_affiche 
   * @return string
   */
  public function getFilm_affiche() 
  {
    return $this->film_affiche;
  }

  /**
   * Accesseur de la propriété film_bande_annonce 
   * @return string
   */
  public function getFilm_bande_annonce() 
  {
    return $this->film_bande_annonce;
  }

  /**
   * Accesseur de la propriété film_statut 
   * @return string
   */
  public function getFilm_statut() 
  {
    return $this->film_statut;
  }

  /**
   * Accesseur de la propriété film_genre_id 
   * @return string
   */
  public function getFilm_genre_id() 
  {
    return $this->film_genre_id;
  }

  /**
   * Accesseur de la propriété erreurs 
   * @return array
   */ 
  public function getErreurs() 
  {
    return $this->erreurs;
  }

  /**
   * Mutateur de la propriété film_id 
   * @param  int $film_id
   * @return $this
   */    //une valeur entière strictement positive
  public function setFilm_id($film_id = null) 
  {
    unset($this->erreurs['film_id']);
    $regexp = '/^[1-9]\d*$/';
    if (!preg_match($regexp, $film_id) || $film_id <= 0) 
    {
      $this->erreurs['film_id'] = "L'id doit être un nombre entier supérieur à 0";
    }
    $this->film_id = $film_id;
    return $this;
  } 
   
  /**
   * Mutateur de la propriété film_titre 
   * @param  string $film_titre
   * @return $this
   */   //au moins un caractère significatif(différent du caractère espace)
  public function setFilm_titre($film_titre) 
  {
    unset($this->erreurs['film_titre']);
    $film_titre = trim($film_titre);
    $regExp = '/^.+$/';
    if (!preg_match($regExp, $film_titre)) 
    {
      $this->erreurs['film_titre'] = 'Le titre doit avoir au moins un caractère significatif.';
    }
    $this->film_titre = mb_strtoupper($film_titre);
    return $this;
  }

  /**
   * Mutateur de la propriété film_duree 
   * @param  int $film_duree
   * @return $this
   */   //une valeur entière strictement positive entre 1 et 600(minutes)
  public function setFilm_duree($film_duree) 
  {
    unset($this->erreurs['film_duree']);
    if (!preg_match('/^\d+$/', $film_duree) || $film_duree < self::DUREE_MIN || $film_duree > self::DUREE_MAX) 
    {
      $this->erreurs['film_duree'] = "La durée doit être comprise entre ".self::DUREE_MIN." et ".self::DUREE_MAX.".";
    }
    $this->film_duree = $film_duree;
    return $this;
  }

  /**
   * Mutateur de la propriété film_annee_sortie
   * @param  int $film_annee_sortie
   * @return $this
   */   //comprise entre une année mini (par exemple 1895)et l'année en cours
  public function setFilm_annee_sortie($film_annee_sortie) 
  {
    unset($this->erreurs['film_annee_sortie']);
    if (!preg_match('/^\d+$/', $film_annee_sortie) || $film_annee_sortie < self::ANNEE_PREMIER_FILM || $film_annee_sortie > date("Y")) 
    {
      $this->erreurs['film_annee_sortie'] = "L'année de soirtie doit être comprise entre ".self::ANNEE_PREMIER_FILM." et ". date("Y").".";
    }
    $this->film_annee_sortie = $film_annee_sortie;
    return $this;
  }

  /**
   * Mutateur de la propriété film_resume
   * @param  string $film_resume
   * @return $this
   */   //au moins 5 mots
  public function setFilm_resume($film_resume) 
  {
    unset($this->erreurs['film_resume']);
    $film_resume = trim($film_resume);
    $regExp = '/^\S+(\s+\S+){4,}$/';
    if (!preg_match($regExp, $film_resume)) 
    {
      $this->erreurs['film_resume'] = 'Le résumé du film doit avoir au moins 5 mots.';
    }
    $this->film_resume = $film_resume;
    return $this;
  }

  /**
   * Mutateur de la propriété film_affiche
   * @param  string $film_affiche
   * @return $this
   */   //une chaîne de caractères se terminant par le suffixe ".jpg"
  public function setFilm_affiche($film_affiche) 
  {
    unset($this->erreurs['film_affiche']);
    $film_affiche = trim($film_affiche);
    $regExp = '/^.+\.jpg$/';
    if (!preg_match($regExp, $film_affiche)) 
    {
      $this->erreurs['film_affiche'] = "L'affiche doit être au format .jpg";
    }
    $this->film_affiche = $film_affiche;
    return $this;
  }

  /**
   * Mutateur de la propriété film_bande_annonce
   * @param  string $film_bande_annonce
   * @return $this
   */   //une chaîne de caractères se terminant par le suffixe ".mp4"
  public function setFilm_bande_annonce($film_bande_annonce) 
  {
    unset($this->erreurs['film_bande_annonce']);
    $film_bande_annonce = trim($film_bande_annonce);
    $regExp = '/^.+\.mp4$/';
    if (!preg_match($regExp, $film_bande_annonce)) 
    {
      $this->erreurs['film_bande_annonce'] = "La bande d'annonce doit être au format .mp4";
    }
    $this->film_bande_annonce = $film_bande_annonce;
    return $this;
  }

  /**
   * Mutateur de la propriété film_statut
   * @param  int film_statut
   * @return $this
   */   //0 pour invisible, 1 pour visible  ou 2 pour archive
  public function setFilm_statut($film_statut) 
  {
    unset($this->erreurs['film_statut']);
    if ($film_statut != Film::STATUT_INVISIBLE && $film_statut != Film::STATUT_VISIBLE && $film_statut != Film::STATUT_ARCHIVE) 
    {
      $this->erreurs['film_statut'] = 'Le statut est erroné.';
    }
    $this->film_statut = $film_statut;
    return $this;
  }

  /**
   * Mutateur de la propriété film_genre_id
   * @param  int film_genre_id
   * @return $this
   */   //une valeur entière strictement positive.
    public function setFilm_genre_id($film_genre_id) 
    {
      unset($this->erreurs['film_genre_id']);
      if (!preg_match('/^[1-9]\d*$/', $film_genre_id) || $film_genre_id <= 0) 
      {
        $this->erreurs['film_genre_id'] = 'Le genre doit être une valeur entière strictement positive.';
      }
      $this->film_genre_id = $film_genre_id;
      return $this;
    }

  /**
   * Texte de mise en forme des propriétés de l'objet
   * @return string
   */    //Le film OSS 117 -BONS BAISERS D'AFRIQUE est sorti en 2021.<br> Il dure 116 minutes.<br> Statut: visible<br> Résumé:<br>1981.<br> Hubert Bonisseur de la Bath, alias OSS 117, est de retour. Etc.
  public function __toString() 
  {
    if (isset($this->film_titre) && isset($this->film_annee_sortie) && isset($this->film_duree) && isset($this->film_resume) && isset($this->film_statut)) 
    {
      if ($this->film_statut == Film::STATUT_INVISIBLE) 
        {
          $statut = 'invisible';
        } 
        else if ($this->film_statut == Film::STATUT_VISIBLE) 
        {
          $statut = 'visible';
        } 
        else if ($this->film_statut == Film::STATUT_ARCHIVE) 
        {
          $statut = 'archivé';
        }
        $mes = "Le film $this->film_titre est sorti en $this->film_annee_sortie.<br> Il dure $this->film_duree minutes.<br> Statut: $statut<br> Résumé:<br>$this->film_resume<br>";
      }
      else 
      {
        $mes = "Ce film n'a pas toutes ses propriétés.<br>";
      }
    return $mes;
  }
  
} 