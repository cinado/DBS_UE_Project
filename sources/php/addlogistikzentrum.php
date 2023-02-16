<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$success = $name = $ort = $plz = $strasse = $hausnummer = '';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['ort'])) {
    $ort = $_POST['ort'];
}
if (isset($_POST['plz'])) {
    $plz = $_POST['plz'];
}
if (isset($_POST['strasse'])) {
    $strasse = $_POST['strasse'];
}
if (isset($_POST['hausnummer'])) {
    $hausnummer = $_POST['hausnummer'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row mt-2 justify-content-center">
            <form action="addlogistikzentrum.php" method="post"
                style="max-width: 700px; background-color: #cccccc; padding: 20px; border-radius: 10px;">
                <div class="form-group">
                    <label for="input1" style="font-weight: 600">Name</label>
                    <input type="text" class="form-control mt-1" maxlength="50"
                        placeholder="Enter the name of the logistikzentrum..." id="input1" name="name">
                </div>
                <div class="form-group mt-1">
                    <label for="input2" style="font-weight: 600">Ort</label>
                    <input type="text" class="form-control mt-1" maxlength="50"
                        placeholder="Enter the name of the place..." id="input2" name="ort">
                </div>
                <div class="form-group mt-1">
                    <label for="input2" style="font-weight: 600">Postleitzahl</label>
                    <input type="text" class="form-control mt-1" maxlength="5"
                        placeholder="Enter the postal code of the place..." id="input2" name="plz">
                </div>
                <div class="form-group mt-1">
                    <label for="input2" style="font-weight: 600">Strasse</label>
                    <input type="text" class="form-control mt-1" maxlength="100"
                        placeholder="Enter the name of the street..." id="input2" name="strasse">
                </div>
                <div class="form-group mt-1">
                    <label for="input2" style="font-weight: 600">Hausnummer</label>
                    <input type="text" class="form-control mt-1" maxlength="3" placeholder="Enter an arbitrary number."
                        id="input2" name="hausnummer">
                </div>
                <button type="submit" class="btn btn-secondary mt-2" name="submitButton">Submit</button>
            </form>
        </div>
    </div>
    <?php
    if (!($db->isEmpty($ort)) && !($db->isEmpty($plz)) && !($db->isEmpty($name)) && !($db->isEmpty($hausnummer)) && !($db->isEmpty($strasse))) {
        $logistikzentrum = $db->addLogistikzentrum($name, $ort, $plz, $strasse, $hausnummer, $success);
        if ($success) { ?>
            <div class="container">
                <div class="row mt-2">
                    <table class="table table-bordered table-striped table-hover text-center bg-white table-responsive">
                        <tr>
                            <th class="bg-secondary text-white">ID</th>
                            <th class="bg-secondary text-white">Name</th>
                            <th class="bg-secondary text-white">Ort</th>
                            <th class="bg-secondary text-white">Postleitzahl</th>
                            <th class="bg-secondary text-white">Straße</th>
                            <th class="bg-secondary text-white">Hausnummer</th>
                        </tr>
                        <tr>
                        <td class="bg-light">
                            <?php echo $logistikzentrum['ID']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $logistikzentrum['NAME']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $logistikzentrum['ORT']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $logistikzentrum['PLZ']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $logistikzentrum['STRASSE']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $logistikzentrum['HAUSNUMMER']; ?>
                        </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "Error can't insert Logistikzentrum '{$name} {$ort} {$plz} {$strasse} {$hausnummer}'!";
        }
    }
    ?>
</body>

</html>