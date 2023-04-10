<?php
require_once __DIR__ . '/vendor/autoload.php'; // Chargement de mPDF
use \Mpdf\Mpdf;


 class CV{

    private $nom;
    private $prenom;
    private $email;
    private $tel;
    private $adresse;
    private $educations = array();
    private $projets = array();
    private $competences = array();
    private $certifications = array();

    public function __construct($nom,$prenom,$email,$tel,$adresse,$educations,$projets,$competences,$certifications)
    {
        $this->nom = $nom;
    $this->prenom = $prenom;
    $this->email = $email;
    $this->tel = $tel;
    $this->adresse = $adresse;
    $this->educations = $educations;
    $this->projets = $projets;
    $this->competences = $competences; 
    $this->certifications = $certifications; 
    }

    public function generer_pdf() {
        
        // Création d'une nouvelle instance de mPDF
        $mpdf = new Mpdf();
    
        // Génération du code HTML correspondant au CV
        $html = "
          <html>
            <head>
              <style>
                /* Ajouter ici le style CSS pour le CV */
                </style>
                </head>
                <body>
                  <h1>{$this->prenom} {$this->nom}</h1>
                  <p>Email : {$this->email}</p>
                  <p>Téléphone : {$this->tel}</p>
                  <p>Adresse : {$this->adresse}</p>
                  <h2>Formation :</h2>
                  <ul>";
            foreach ($this->formation as $f) {
              $html .= "<li>$f</li>";
            }
            $html .= "</ul>
                  <h2>Expériences :</h2>
                  <ul>";
            foreach ($this->experiences as $e) {
              $html .= "<li>
                          <h3>{$e['poste']} chez {$e['entreprise']} ({$e['date']})</h3>
                          <p>{$e['description']}</p>
                        </li>";
            }
            $html .= "</ul>
                  <h2>Compétences :</h2>
                  <ul>";
            foreach ($this->competences as $c) {
              $html .= "<li>$c</li>";
            }
            $html .= "</ul>
                </body>
              </html>
            ";
        
            // Conversion du code HTML en PDF avec mPDF
            $mpdf->WriteHTML($html);
        
            // Envoi du PDF au navigateur pour le téléchargement
            $mpdf->Output('cv.pdf', 'D');
          }
        
        
    public function afficher(){

      echo  "  <h1>{$this->prenom} {$this->nom}</h1> \n";
        echo " <h3>{$this->email} </h3> \n";
        echo "<h3>{$this->tel}</h3>\n";
        echo "<h3>{$this->adresse}</h3>\n";
        echo "<h1>Educations : </h1>\n";
    foreach ($this->educations as $education) {
        echo " <h3> - {$education['titre']} </h3>\n";
        echo "  {$education['description']}\n";

    }
    echo " <h1>Projets: </h1>\n";
    foreach ($this->projets as $projet) {
        echo "  <h3> -{$projet['titre']} </h3>\n";
        echo "  {$projet['description']}\n";
    }

    echo " <h1>Competences Techniques : </h1>\n";
    foreach ($this->competences as $competence) {
        
        echo "  <h3> -{$competence['titre']} </h3>\n";
        echo "  {$competence['description']}\n";
    }

    echo " <h1>Certifications : </h1>\n";
    foreach ($this->certifications as $certification) {
        echo " <h3> - {$certification['titre']} </h3>\n";
        echo "  {$certification['description']}\n";
    }

    }
    
    
 }

 // Instanciation de la classe CV
$cv1 = new CV(
    "Gopal",
    "Das",
    "sognigbegopal@gmail.com",
    "66510304",
    "AGONGBOMEY AKPAKPA, 877",
array( 
        array( "titre"=>"Licence en Architecture de Logiciel",
             "description" => "Depuis septembre 2020 ESGIS-BENIN Cotonou "
        ) ,
        array( "titre"=>"Baccalauréat Série D",
    "description" => "De septembre 2010 à juillet 2017 Cours de Soutien Scolaire Cotonou"
       )
), 
array(
    array(
        "titre" => "Logiciel de gestion de magasin",
        "description" => "Développement  avec PHP et MySQL"
    ),
    array(
        "titre" => "site web",
        "description" => "Développement javascript et MySQL"
    ),
),
array( 
      array( "titre"=>"Langages",
         "description" => " Python , JavaScript , PHP(POO) ,JAVA , HTML5,CSS3 "
       ) ,
      array( "titre"=>"Librairies & Frameworks",
      "description" => "React js,Boostrap"
      ),
     array( "titre"=>"Outils et Plateforme",
     "description" => "GIT,Linux"
      )
),

array(
            array(
                "titre" => "JavaScrpit Algorithme and Data Structure",
                "description" => "Janvier 2023 freecodecamp.org"
            )
)
);

// Affichage du CV
$cv1->afficher();
?>