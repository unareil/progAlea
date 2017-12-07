<?php
    class Individu 
    {
        private $_firstName;
        private $_lastName;
        private $_iteration;

        public function __construct($Lname,$Fname)
        {
            $this->_firstName = $Fname;
            $this->_lastName  = $Lname;
            $this->_iteration = 0;
        }

        public function infosIndividu() 
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

        public function genererClassJavascript()
        {
            echo 'function Indivdu(nom, prenom, nbiteration) 
            {
                this.nom = nom;
                this.prenom = prenom;
                this.nbiteration = nbiteration;

                this.augmenteNbiteration = function()
                {
                    this.nbiteration = this.nbiteration + 1;
                }
            }'.chr(13);
        } 

        public function genererObjetJavascript($num)
        {
            echo ' var personne'.$num.' = new Indivdu("'.$this->_lastName.'","'.$this->_firstName.'",'.$this->_iteration.');'.chr(13);
        }

        public function __destruct()
        {
        //    echo $this->_firstName .' '. $this->_lastName .' a ete detruit<br/>.';
        }
    }
?>