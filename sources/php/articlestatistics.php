<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
    <?php
    if (!($db->isEmpty($id))) {
        $artikel = $db->getArtikelStatistics($id);
        if (!empty($artikel)) { ?>
            <div class="container">
                <div class="row mt-2">
                    <table class="table table-bordered table-striped table-hover text-center bg-white table-responsive">
                        <tr>
                            <th class="bg-secondary text-white">ID</th>
                            <th class="bg-secondary text-white">Gesamtmenge</th>
                            <th class="bg-secondary text-white">Anzahl der Logistikzentren, die diesen Artikel lagern</th>
                        </tr>
                            <tr>
                                <td class="bg-light">
                                    <?php echo $artikel['ID']; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $artikel['TOTALNUMBER']; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $artikel['LOGISTIKZENTRUMCOUNT']; ?>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "No article found with the given value '{$id}'!";
        }
    }
    ?>
</body>

</html>