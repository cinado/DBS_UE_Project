<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$id = $artikelnummer = $produktbezeichnung = '';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
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
            <form action="updatearticle.php" method="post"
                style="max-width: 700px; background-color: #cccccc; padding: 20px; border-radius: 10px;">
                <div class="form-group">
                    <label for="input1" style="font-weight: 600">ID</label>
                    <input type="text" class="form-control mt-1" placeholder="Article ID..." id="input1" name="id">
                </div>
                <div class="form-group">
                    <label for="input2" style="font-weight: 600">Artikelnummer</label>
                    <input type="text" class="form-control mt-1" maxlength="10" placeholder="Article number..."
                        id="input2" name="artikelnummer">
                </div>
                <div class="form-group mt-1">
                    <label for="input3" style="font-weight: 600">Produktbezeichnung</label>
                    <input type="text" class="form-control mt-1" maxlength="250" placeholder="Product designation..."
                        id="input3" name="produktbezeichnung">
                </div>
                <button type="submit" class="btn btn-secondary mt-2" name="submitButton">Update</button>
            </form>
        </div>
    </div>
    <?php
    if (!$db->isEmpty($id) && (!$db->isEmpty($artikelnummer) || !$db->isEmpty($produktbezeichnung))) {
        $artikel = $db->updateArtikel($id, $artikelnummer, $produktbezeichnung);
        if (!empty($artikel)) { ?>
            <div class="container">
                <div class="row mt-2">
                    <table class="table table-bordered table-striped table-hover text-center bg-white table-responsive">
                        <tr>
                            <th class="bg-secondary text-white">ID</th>
                            <th class="bg-secondary text-white">Artikelnummer</th>
                            <th class="bg-secondary text-white">Produktbezeichnung</th>
                        </tr>
                        <?php foreach ($artikel as $a): ?>
                            <tr>
                                <td class="bg-light">
                                    <?php echo $a['ID']; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $a['ARTIKELNUMMER']; ?>
                                </td>
                                <td class="bg-light">
                                    <?php echo $a['PRODUKTBEZEICHNUNG']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "No article found with the given id '{$id}'!";
        }
    }
    ?>
</body>

</html>