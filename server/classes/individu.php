<?php
  class Individu {
    private $_firstName;
    private $_lastName;

    public function __construct($Lname,$Fname){
      $this->_firstName = $Fname;
      $this->_lastName = $Lname;
    }
    public function infosIndividu(){
      return "Pr&eacute;nom : ". $this->_firstName ." Nom : ". $this->_lastName;
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

	public function __destruct()
{
//	echo $this->_firstName .' '. $this->_lastName .' a ete detruit<br/>.';
}
  }
?>
