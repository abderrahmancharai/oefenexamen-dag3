<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="voornaam">voornaam</label>
        <input type="text" name="voornaam" id="voornaam" value="<?= $data["klanten"]->Voornaam; ?>">
        <label for="tussenvoegsel">tussenvoegsel</label>
        <input type="text" name="tussenvoegsel" id="tussenvoegsel" value="<?= $data['klant']->tussenvoegsel; ?>">
        <label for="achternaam">achternaam</label>
        <input type="text" name="achternaam" id="achternaam" value="<?= $data['klant']->achternaam; ?>">
        <label for="mobiel">mobiel</label>
        <input type="text" name="mobiel" id="mobiel" value="<?= $data['klant']->mobiel; ?>">
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="<?= $data['klant']->email; ?>">
        <label for="volwassen">volwassen</label>
        <input type="text" name="volwassen" id="volwassen" value="<?= $data['klant']->volwassen; ?>">
        <input type="submit" value="update">

    </form>
    
</body>
</html>