<?php
class klantenModel
{
    // Properties, fields
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getklant()
  {
    $sql = "select 
	            typepersoon.Id as  typepersoonId
                ,persoon.Id    as  persoonId 
                ,contact.Id    as  contactId 
                ,persoon.Voornaam
                ,persoon.Tussenvoegsel
                ,persoon.Achternaam
                ,persoon.IsVolwassen
                ,contact.mobiel
                ,contact.Email
                from typepersoon
    
                inner join  persoon on
                TypePersoonId = typepersoon.Id
    
                 inner join contact on
                contact.PersoonId = persoon.Id";
    $this->db->query($sql);
    $result = $this->db->resultSet();
    return $result;
  }


  public function getklantupdate()
  {
    $sql = "select 
	            typepersoon.Id as  typepersoonId
                ,persoon.Id    as  persoonId 
                ,contact.Id    as  contactId 
                ,persoon.Voornaam
                ,persoon.Tussenvoegsel
                ,persoon.Achternaam
                ,persoon.IsVolwassen
                ,contact.mobiel
                ,contact.Email
                from typepersoon
    
                inner join  persoon on
                TypePersoonId = typepersoon.Id
    
                 inner join contact on
                contact.PersoonId = persoon.Id";
    $this->db->query($sql);
    $result = $this->db->resultSet();
    return $result;
  }


  public function updateklantform($persoonId)
  {
    $sql = "select 
	typepersoon.Id as  typepersoonId
    ,persoon.Id    as  persoonId 
    ,contact.Id    as  contactId 
        ,persoon.Voornaam
    ,persoon.Tussenvoegsel
    ,persoon.Achternaam
    ,persoon.IsVolwassen
    ,contact.mobiel
    ,contact.Email
    from typepersoon
    
    inner join  persoon on
    TypePersoonId = typepersoon.Id
    
    inner join contact on
    contact.PersoonId = persoon.Id where persoonId = :persoonid";
    $this->db->query($sql);
    $this->db->bind(':persoonid', $persoonId, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }










  public function update()
  {
    $sql = "UPDATE typepersoon 

              
    inner join  persoon on
    TypePersoonId = typepersoon.Id
    
    inner join contact on
    contact.PersoonId = persoon.Id
    SET persoon.Voornaam = 'kip' 
     ,persoon.Tussenvoegsel = 'de' 	
     ,persoon.achternaam = 'jan' 
     ,persoon.IsVolwassen ='1'
     ,contact.Email= 'kip@hotmail.com' 
     ,contact.Mobiel=0687484869
    WHERE persoon.Id = 2;";
    $this->db->query($sql);
    $result = $this->db->resultSet();
    return $result;
  }

  


}