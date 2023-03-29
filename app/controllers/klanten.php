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




        $this->view('klanten/klantenoverzichtupdate', $data); // Bestellingen ophalen via model
    }




    public function update($persoonId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->klantenModel->update($_POST);
        } else {
            $klant = $this->klantenModel->getklantbyid($persoonId);
            var_dump($klant);

            // var_dump($row);
            // exit();

            $data = ['title' => '<h1>Update contactgegevens</h1>',
                      'klant' => $klant[0]
                    ];
            $this->view("klanten/update", $data);
        }
    }
}

    // public function klantenupdateform($persoonId)
    // {


    //     $klant = $this->klantenModel->getklantbyid($persoonId);

    //     $data = [
    //         'title' => 'klanten in dienst',
    //         'klant' => $klant[0]
    //     ];

    //     $this->view('klanten/klantenupdateform', $data); // Bestellingen ophalen via model
    // }

//     //public function update($persoonId = null)
//     {
//         if ($_SERVER["REQUEST_METHOD"] == "POST") 
//         {
//             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//             $this->klantenModel->update($_POST,$persoonId);
//             echo "update succesvol";
         
//         } else {
//             echo "update niet gelukt";
//         }

//       var_dump($_POST);

//         $data = [
//             'title' => 'klanten in dienst',
           
//         ];

//         $this->view('klanten/update', $data); // Bestellingen ophalen via model
//     }
// }
