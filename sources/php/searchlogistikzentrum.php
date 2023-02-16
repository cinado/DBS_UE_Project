<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$id = $name = $strasse = $hausnummer = $ort= $plz = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_GET['strasse'])) {
    $strasse = $_GET['strasse'];
}
if (isset($_GET['hausnummer'])) {
    $hausnummer = $_GET['hausnummer'];
}
if (isset($_GET['ort'])) {
    $ort = $_GET['ort'];
}
if (isset($_GET['plz'])) {
    $plz = $_GET['plz'];
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
            <form action="searchlogistikzentrum.php" method="get"
                style="max-width: 700px; background-color: #cccccc; padding: 20px; border-radius: 10px;">
                <div class="form-group">
                    <label for="input1" style="font-weight: 600">ID</label>
                    <input type="text" class="form-control mt-1" maxlength="50"
                        placeholder="Enter the id of the logistikzentrum..." id="input1" name="id">
                </div>
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
                <button type="submit" class="btn btn-secondary mt-2" name="submitButton">Search</button>
            </form>
        </div>
    </div>
    <?php
    if (!($db->isEmpty($id)) || !($db->isEmpty($ort)) || !($db->isEmpty($plz)) || !($db->isEmpty($name)) || !($db->isEmpty($hausnummer)) || !($db->isEmpty($strasse))) {
        $logistikzentrum = $db->searchLogistikzentrumNew($id, $name, $ort, $plz, $strasse, $hausnummer);
        if (!empty($logistikzentrum)) { ?>
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
                <?php foreach ($logistikzentrum as $l): ?>
                    <tr>
                        <td class="bg-light">
                            <?php echo $l['ID']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $l['NAME']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $l['ORT']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $l['PLZ']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $l['STRASSE']; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $l['HAUSNUMMER']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
                </div>
            </div>
            <?php
        } else {
            echo "No Logistikzentrum found with the given values '{$id} {$name} {$ort} {$plz} {$strasse} {$hausnummer}'!";
        }
    }
    ?>
</body>

</html>