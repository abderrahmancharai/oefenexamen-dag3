<?php

class klanten extends Controller
{
    // Properties, field
    private $klantenModel;

    // Dit is de constructor
    public function __construct()
    {
        $this->klantenModel = $this->model('klantenModel'); // Model initialisatie
    }
    // Index-methode om de bestellingen weer te geven
    public function index()
    {
        $this->view('klanten/index'); // Bestellingen ophalen via model
    }


    public function klantenoverzicht()
    {

        $klanten = $this->klantenModel->getklant();
        $rows = '';


        foreach ($klanten as $value) {
            $rows .= "<tr>
                        <td>$value->Voornaam</td>
                        <td>$value->Tussenvoegsel</td>
                        <td>$value->Achternaam</td>
                        <td>$value->mobiel</td>
                        <td>$value->Email</td>
                        <td>$value->IsVolwassen</td>
                       
                      </tr>";
        }

        $data = [
            'title' => 'klanten in dienst',
            'amountOfklanten' => sizeof($klanten),
            'rows' => $rows
        ];




        $this->view('klanten/klantenoverzicht',$data); // Bestellingen ophalen via model
    }

    public function klantenoverzichtupdate()
    {

      
        $klanten = $this->klantenModel->getklant();
        $rows = '';

        foreach ($klanten as $value) {
            $persoonId  =$value->persoonId;
            $rows .= "<tr>
                        <td>$value->Voornaam</td>
                        <td>$value->Tussenvoegsel</td>
                        <td>$value->Achternaam</td>
                        <td>$value->mobiel</td>
                        <td>$value->Email</td>
                        <td>$value->IsVolwassen</td>
                        <td><a href='" . URLROOT . "/klanten/klantenupdateform/$persoonId'>update</i></a></td>
                       
                      </tr>";
        }

        $data = [
            'title' => 'klanten in dienst',
            'amountOfklanten' => sizeof($klanten),
            'rows' => $rows
        ];




        $this->view('klanten/klantenoverzichtupdate',$data); // Bestellingen ophalen via model
    }


    public function klantenupdateform($persoonId = 0)
    {
        var_dump($persoonId);

        $klanten = $this->klantenModel->updateklantform($persoonId);

        var_dump($klanten);

        
        $data = [
            'title' => 'klanten in dienst',
            'klanten' => $klanten,
           
        ];
       




        $this->view('klanten/klantenupdateform',$data ); // Bestellingen ophalen via model
    }
}
