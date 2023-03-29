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




        $this->view('klanten/klantenoverzicht', $data); // Bestellingen ophalen via model
    }

    public function klantenoverzichtupdate()
    {
        $klanten = $this->klantenModel->getklant();
        $rows = '';

        foreach ($klanten as $value) {
            $persoonId  = $value->persoonId;
            $rows .= "<tr>
                        <td>$value->Voornaam</td>
                        <td>$value->Tussenvoegsel</td>
                        <td>$value->Achternaam</td>
                        <td>$value->mobiel</td>
                        <td>$value->Email</td>
                        <td>$value->IsVolwassen</td>
                        <td><a href='" . URLROOT . "/klanten/update/$persoonId'>update</i></a></td>
                       
                      </tr>";
        }

        $data = [
            'title' => 'klanten in dienst',
            'amountOfklanten' => sizeof($klanten),
            'rows' => $rows
        ];




        $this->view('klanten/klantenoverzichtupdate', $data); 
    }




    public function update($persoonId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->klantenModel->update($_POST);
            echo "update succesvol";
            header("Refresh: 1; URL=" . URLROOT . "/klanten/klantenoverzichtupdate");
        } else {
            $klant = $this->klantenModel->getklantbyid($persoonId);
           
            $data = [
                'title' => '<h1>Update contactgegevens</h1>',
                'klant' => $klant[0]
            ];
            $this->view("klanten/update", $data);
        }




        



    }
}

?>