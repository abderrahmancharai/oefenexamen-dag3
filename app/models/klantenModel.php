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


  public function getklantbyid($persoonId)
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










  public function update($post)
  {

   
    $sql = "UPDATE typepersoon 

              
    inner join  persoon on
    TypePersoonId = typepersoon.Id
    
    inner join contact on
    contact.PersoonId = persoon.Id
    SET persoon.Voornaam = :Voornaam 
     ,persoon.Tussenvoegsel = :Tussenvoegsel	
     ,persoon.achternaam = :Achternaam
     ,persoon.IsVolwassen =:IsVolwassen
     ,contact.Email= :Email
     ,contact.Mobiel=:Mobiel
    WHERE persoon.Id = :persoonId;";
$this->db->query($sql);
$this->db->bind(':persoonId', $post["persoonId"], PDO::PARAM_INT);
$this->db->bind(':Voornaam', $post["Voornaam"], PDO::PARAM_STR);
$this->db->bind(':Tussenvoegsel', $post["Tussenvoegsel"], PDO::PARAM_STR);
$this->db->bind(':Achternaam', $post["Achternaam"], PDO::PARAM_STR);
$this->db->bind(':IsVolwassen', $post["IsVolwassen"], PDO::PARAM_INT);
$this->db->bind(':Email', $post["Email"], PDO::PARAM_STR);
$this->db->bind(':Mobiel', $post["Mobiel"], PDO::PARAM_INT);    
    $result = $this->db->resultSet();
    return $result;
  }

  


}