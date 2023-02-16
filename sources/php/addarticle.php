<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$success = $artikelnummer = $produktbezeichnung = '';

if (isset($_POST['artikelnummer'])) {
    $artikelnummer = $_POST['artikelnummer'];
}
if (isset($_POST['produktbezeichnung'])) {
    $produktbezeichnung = $_POST['produktbezeichnung'];
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
            <form action="addarticle.php" method="post"
                style="max-width: 700px; background-color: #cccccc; padding: 20px; border-radius: 10px;">
                <div class="form-group">
                    <label for="input1" style="font-weight: 600">Artikelnummer</label>
                    <input type="text" class="form-control mt-1" maxlength="10" placeholder="Enter a unique number..."
                        id="input1" name="artikelnummer">
                </div>
                <div class="form-group mt-1">
                    <label for="input2" style="font-weight: 600">Produktbezeichnung</label>
                    <input type="text" class="form-control mt-1" maxlength="250"
                        placeholder="Enter a breathtaking description..." id="input2" name="produktbezeichnung">
                </div>
                <button type="submit" class="btn btn-secondary mt-2" name="submitButton">Submit</button>
            </form>
        </div>
    </div>

    <?php
    if (!($db->isEmpty($artikelnummer)) && !($db->isEmpty($produktbezeichnung))) {
        $artikel = $db->addArtikel($artikelnummer, $produktbezeichnung, $success);
        if ($success) { ?>
            <div class="container">
                <div class="row mt-2">
                    <table class="table table-bordered table-striped table-hover text-center bg-white table-responsive">
                        <tr>
                            <th class="bg-secondary text-white">ID</th>
                            <th class="bg-secondary text-white">Artikelnummer</th>
                            <th class="bg-secondary text-white">Produktbezeichnung</th>
                        </tr>
                        <tr>
                            <td class="bg-light">
                                <?php echo $artikel['ID']; ?>
                            </td>
                            <td class="bg-light">
                                <?php echo $artikel['ARTIKELNUMMER']; ?>
                            </td>
                            <td class="bg-light">
                                <?php echo $artikel['PRODUKTBEZEICHNUNG']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "Error can't insert article '{$artikelnummer} {$produktbezeichnung}'!";
        }
    }
    ?>
</body>

</html>