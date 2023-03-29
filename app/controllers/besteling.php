<?php

class besteling extends Controller
{
  // Properties, field
  private $bestelingModel;

  // Dit is de constructor
  public function __construct()
  {
    $this->bestelingModel = $this->model('bestelingModel'); // Model initialisatie
  }
  // Index-methode om de bestellingen weer te geven
  public function index()
  { // Bestellingen ophalen via model
    $besteling = $this->bestelingModel->getbestellingen();
    $rows = '';
    // De volgende code maakt een tabelrij voor elke bestelling en toont de details van de bestelling in de juiste kolommen. en ver
    //zorgt er ook voor dat je kan update en delete
    foreach ($besteling as $value) {
      $packageperreservationId = $value->packageperreservationId;
      $ReservationId = $value->ReservationId;
      $rows .= "<tr>
                  <td>$value->personid</td>
                  <td>$value->firstname</td>
                  <td>$value->infix</td>
                  <td>$value->lastname</td>
                  <td>$value->Mobile</td>
                  <td>$value->name</td>
                    <td>$value->Date</td>
                    <td><a href='" . URLROOT . "/besteling/delete/$packageperreservationId'>delete</a></td>
                    <td><a href='" . URLROOT . "/besteling/beschikbarebesteling/" . $ReservationId . "/" . $packageperreservationId . "'>update</a></td>;
                </tr>";
    }  // De bestellingen en andere data doorgeven aan de view
    $data = [
      'title' => 'besteling',
      'amountOfbesteling' => sizeof($besteling),
      'rows' => $rows
    ];
    $this->view('besteling/index', $data);
  }

  public function beschikbarebesteling($ReservationId, $packageperreservationId)
  { // Haalt alle beschikbare bestellingen op vanuit de database via de getallbeschibarebestelingen methode van de bestelingModel class.
    $beschibarebesteling = $this->bestelingModel->getallbeschibarebestelingen($ReservationId);

    $rows = '';
    foreach ($beschibarebesteling as $value) {
      $packageoptionsId = $value->packageoptionsId;

      $rows .= "<tr>
                  <td>$value->name</td>
                  <td>$value->price</td>
                  <td>$value->Omschrijving</td>
                  <td><a href='" . URLROOT . "/besteling/update/" . $packageoptionsId . "/" . $packageperreservationId . "'>update</a></td>    ;
                </tr>";
    }
    $data = [
      'title' => 'besteling',
      'rows' => $rows,

    ];
    $this->view('besteling/beschikbarebesteling', $data);
  }

  public function update($packageoptionsId, $packageperreservationId)
  {
    $besteling = $this->bestelingModel->update($packageoptionsId, $packageperreservationId);
    header("Refresh: 3; URL=" . URLROOT . "/besteling/index");
    echo "besteling is geupdate";
    $this->view('besteling/update');
  }

  public function delete($packageperreservationId)
  {
    $bestelingdelete = $this->bestelingModel->delete($packageperreservationId);
    if ($bestelingdelete == 0) {
      header("Refresh: 4; URL=" . URLROOT . "/besteling/index");
      echo "er is iets fout gegaan<br>";
      echo "    je word doorgestuurd naar de homepagina";
    } else {
      header("Refresh: 4; URL=" . URLROOT . "/besteling/index");
      echo "besteling is verwijderd";
    }
    // De bestellingen en andere data doorgeven aan de view
    $this->view('besteling/delete');
  }

  public function geenbesteling()
  {
    $besteling = $this->bestelingModel->geenbesteling();

    if ($besteling == null) {
      header("Refresh: 4; URL=" . URLROOT . "/besteling/index");
      echo "er zijn geen bestelingen meer";
      echo "je word doorgestuurd naar de homepagina";
    } else {
      $rows = '';
      foreach ($besteling as $value) {
        $rows .= "<tr>
               
                  <td>$value->firstname</td>
                  <td>$value->infix</td>
                  <td>$value->lastname</td>
               
                  <td>$value->Mobile</td>
                  <td>$value->name</td>
                  <td><a href='" . URLROOT . "/besteling/allPackageOptions/$value->Reservationid'>besteling toevoegen</a></td>;
                </tr>";
        $data = [
          'title' => 'besteling',
          'rows' => $rows,
        ];
      }

      $this->view('besteling/geenbesteling', $data);
    }
  }

  public function allPackageOptions($Reservationid)
  {
    $besteling = $this->bestelingModel->allPackageOptions($Reservationid);
    $geenbesteling = $this->bestelingModel->geenbesteling();
    $rows = '';
    foreach ($besteling as $value) {
      $packageoptionsId = $value->packageoptionsId;
      $rows .= "<tr>
                  <td>$value->name</td>
                  <td>$value->price</td>
                  <td>$value->omschrijving</td>
                  <td><a href='" . URLROOT . "/besteling/nieuwbesteling/" . $Reservationid . "/" . $packageoptionsId . "'>voeg toe</a></td>  
                  ;
                </tr>";
      $data = [
        'title' => 'besteling',
        'rows' => $rows,
      ];
    }
    $this->view('besteling/allPackageOptions', $data);
  }

  public function nieuwbesteling($Reservationid, $packageoptionsId)
  {
    $nieuwbestelings = $this->bestelingModel->nieuwbesteling($packageoptionsId, $Reservationid);
    if ($nieuwbestelings == 0) {
      header("Refresh: 4; URL=" . URLROOT . "/besteling/index");
      echo "er is iets fout gegaan";
      echo "je word doorgestuurd naar de homepagina";
    } else {
      header("Refresh: 4; URL=" . URLROOT . "/besteling/index");
      echo "besteling is toegevoegd";
    }
    $this->view('besteling/nieuwbesteling');
  }
}
