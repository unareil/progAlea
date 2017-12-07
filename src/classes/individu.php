<?php
    class Individu 
    {
        private $_firstName;
        private $_lastName;
        private $_iteration;
        private $_nbSelection;
        private $_coche;

        public function __construct($un,$deux,$trois=0,$quatre=0,$cinq=true)
        {
            $this->_firstName = $un;
            $this->_lastName  = $deux;
            $this->_iteration = $trois;
            $this->_nbSelection = $quatre;
            $this->_coche = $cinq;
        }

        public function infosIndividu() 
        {
            return $this->_lastName." ".$this->_firstName;
        }

        public function infosCandidat() 
        {
            return $this->_lastName." ".$this->_firstName;
        }

        public function setNom($Lname)
        {
            $this->_lastName = $Lname;
        }

        public function getNom()
        {
            return $this->_lastName;
        }

        public function setPrenom($Fname)
        {
            $this->_firstName = $Fname;
        }
        
        public function getPrenom()
        {
            return $this->_firstName;
        }
        
        public function getIteration()
        {
            return $this->_iteration;
        }
        
        public function setIteration($num)
        {
            $this->_iteration = $num;
        }

        public function incrementeIteration()
        {
            $this->_iteration++;
        }

        public function getNbSelection()
        {
            return $this->_nbSelection;
        }

        public function setNbSelection($num)
        {
            $this->_nbSelection = $num;
        }

        public function getCoche()
        {
            return $this->_coche;
        }

        public function setCoche($bool)
        {
            $this->_coche = $bool;
        }

        public function genererClassJavascript()
        {
            echo 'function Indivdu(nom, prenom, nbiteration, nombreSelection, cocheTF) 
            {
                this.nom = nom;
                this.prenom = prenom;
                this.nbiteration = nbiteration;
                this.nombreSelection = nombreSelection;
                this.cocheTF = cocheTF;

                this.setNbiteration = function(nb)
                {
                    this.nbiteration = nb;
                }
                this.setNombreSelection = function(nb)
                {
                    this.nombreSelection = nb;
                }
                this.setCocheTF = function(booleen)
                {
                    this.cocheTF = booleen;
                }
            }'.chr(13);

            // déclare le tableau des objets
            //echo 'var tabIndivdu = [];'.chr(13);
        }

        public function genererObjetJavascript($num)
        {
            echo ' var personne'.$num.' = new Indivdu("'.$this->_lastName.'","'.$this->_firstName.'",'.$this->_iteration.','.$this->_nbSelection.','.$this->_coche.');'.chr(13);

            // Ajoute l'objet au tableau d'objet
            //echo 'tabIndivdu.push(personne'.$num.')'.chr(13);
        }

        public function __destruct()
        {
        //    echo $this->_firstName .' '. $this->_lastName .' a ete detruit<br/>.';
        }
    }
?>