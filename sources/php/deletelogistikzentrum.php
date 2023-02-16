<?php
require_once('DatabaseHelper.php');
$db = new DatabaseHelper();
$id = '';
$success = 0;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row mt-2 justify-content-center">
            <form action="deletelogistikzentrum.php" method="post"
                style="max-width: 700px; background-color: #cccccc; padding: 20px; border-radius: 10px;">
                <div class="form-group">
                    <label for="input1" style="font-weight: 600">ID</label>
                    <input type="text" class="form-control mt-1" placeholder="Logistikzentrum ID..." id="input1" name="id">
                </div>
                <button type="submit" class="btn btn-secondary mt-2" name="submitButton">Delete</button>
            </form>
        </div>
    </div>
    <?php
    if (!$db->isEmpty($id)) {
        $success = $db->deleteLogistikzentrum($id);
        if ($success) { ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Logistikzentrum deleted!</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            The Logistikzentrum with the id <?php echo $id; ?> has been successfully deleted!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('#myModal').modal('show');
                });
            </script>
            <?php
        } else {
            echo "No Logistikzentrum found with the given id '{$id}'!";
        }
    }
    ?>
</body>

</html>