<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$id = $name = $straße = $hausnummer = $ort= $plz = '';

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
    $strasse = $_GET['ort'];
}
if (isset($_GET['plz'])) {
    $strasse = $_GET['plz'];
}

$logistikzentren = $db->selectLogistikzentrum();
?>

<!doctype html>
<html lang="en">

<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 200,
            'opsz' 48
    }
</style>

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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-2" style="max-width: 500px; border-radius: 20px; background-color: #705B73;">
        <div class="d-flex justify-content-around">
            <a href="addlogistikzentrum.php" class="mt-1"><span class="material-symbols-outlined text-white">add</span></a>
            <a href="searchlogistikzentrum.php" class="mt-1"><span class="material-symbols-outlined text-white">search</span></a>
            <a href="updatelogistikzentrum.php" class="mt-1"><span class="material-symbols-outlined text-white">edit</span></a>
            <a href="deletelogistikzentrum.php" class="mt-1"><span class="material-symbols-outlined text-white">delete</span></a>
        </div>
    </div>
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
                <?php foreach ($logistikzentren as $l): ?>
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

</body>

</html>