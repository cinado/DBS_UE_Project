<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$logistikzentrumid = $lagerhallennummer = $artikelidentifier = $menge = '';

if (isset($_GET['logistikzentrumid'])) {
    $logistikzentrumid = $_GET['logistikzentrumid'];
}
if (isset($_GET['lagerhallennummer'])) {
    $lagerhallennummer = $_GET['lagerhallennummer'];
}
if (isset($_GET['artikelidentifier'])) {
    $artikelidentifier = $_GET['artikelidentifier'];
}
if (isset($_GET['menge'])) {
    $menge = $_GET['menge'];
}

$wirdGelagertInTable = $db->selectWirdGelagertIn();
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
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row mt-2">
            <table class="table table-bordered table-striped table-hover text-center bg-white table-responsive">
                <tr>
                    <th class="bg-secondary text-white">LogistikzentrumID</th>
                    <th class="bg-secondary text-white">Hallennummer</th>
                    <th class="bg-secondary text-white">Artikelnummer</th>
                    <th class="bg-secondary text-white">Menge</th>
                </tr>
                <?php foreach ($wirdGelagertInTable as $w): ?>
                    <tr>
                        <td class="bg-light">
                            <?php echo '<a href="logistikzentrumentry.php?id=' . $w['ZENTRUMID'] . '">' . $w['ZENTRUMID'] . '</a>'; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo '<a href="lagerhallenentry.php?logistikzentrumid=' . $w['ZENTRUMID'] . '&&lagerhallennummer=' . $w['HALLENNUMMER'] . '">' . $w['HALLENNUMMER'] . '</a>'; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo '<a href="searcharticle.php?id=' . $w['ARTIKELIDENTIFIER'] . '">' . $w['ARTIKELIDENTIFIER'] . '</a>'; ?>
                        </td>
                        <td class="bg-light">
                            <?php echo $w['MENGE']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>

</html>