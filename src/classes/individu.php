<?php
    class Individu 
    {
        private $_firstName;
        private $_lastName;
        private $_iteration;
        private $_nbSelection;

        public function __construct($Lname,$Fname)
        {
            $this->_firstName = $Fname;
            $this->_lastName  = $Lname;
            $this->_iteration = 0;
            $this->_nbSelection = 0;
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
            $this->_iteration = $this->_iteration + 1;
        }

        public function getNbSelection()
        {
            return $this->_nbSelection;
        }

        public function setNbSelection($num)
        {
            $this->_nbSelection = $num;
        }

        public function genererClassJavascript()
        {
            echo 'function Indivdu(nom, prenom, nbiteration, nombreSelection) 
            {
                this.nom = nom;
                this.prenom = prenom;
                this.nbiteration = nbiteration;
                this.nombreSelection = nombreSelection;

                this.augmenteNbiteration = function()
                {
                    this.nbiteration = this.nbiteration + 1;
                }
                this.augmenteNombreSelection = function()
                {
                    this.nombreSelection = this.nombreSelection + 1;
                }
            }'.chr(13);
        } 

        public function genererObjetJavascript($num)
        {
            echo ' var personne'.$num.' = new Indivdu("'.$this->_lastName.'","'.$this->_firstName.'",'.$this->_iteration.','.$this->_nbSelection.');'.chr(13);
        }



        public function __destruct()
        {
        //    echo $this->_firstName .' '. $this->_lastName .' a ete detruit<br/>.';
        }
    }
?>