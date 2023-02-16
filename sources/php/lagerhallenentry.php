<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$logistikzentrumid = $lagerhallennummer = '';

if (isset($_GET['logistikzentrumid'])) {
    $logistikzentrumid = $_GET['logistikzentrumid'];
}
if (isset($_GET['lagerhallennummer'])) {
    $lagerhallennummer = $_GET['lagerhallennummer'];
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
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php
    if ((!$db->isEmpty($logistikzentrumid)) && (!$db->isEmpty($lagerhallennummer))) {
        $lagerhallen = $db->searchLagerhalle($logistikzentrumid, $lagerhallennummer);
        if (!empty($lagerhallen)) { ?>
            <div class="container">
                <div class="row mt-2">
                    <table class="table table-bordered table-striped table-hover text-center bg-white table-responsive">
                        <tr>
                            <th class="bg-secondary text-white">LogistikzentrumID</th>
                            <th class="bg-secondary text-white">Hallennummer</th>
                            <th class="bg-secondary text-white">Hallenhoehe</th>
                            <th class="bg-secondary text-white">Lagerflaeche</th>
                        </tr>
                        <?php foreach ($lagerhallen as $l): ?>
                            <tr>
                                <td class="bg-light">
                                    <?php echo '<a href="logistikzentrumentry.php?id=' . $l['LOGISTIKZENTRUMID'] . '">' . $l['LOGISTIKZENTRUMID'] . '</a>'; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $l['LAGERHALLENNUMMER']; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $l['LAGERHALLENHOEHE']; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $l['LAGERFLAECHE']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "No Lagerhalle found with the given values '{$logistikzentrumid} {$lagerhallennummer}'!";
        }
    }
    ?>
</body>

</html>