<!doctype html>
<html lang="en">

<style>
    footer {
        background-color: #202124;
    }

    #flyingImages img {
        object-fit: contain;
        display: none;
        width: 15%;
        height: 15%;
    }

    #flyingImages {
        overflow: hidden;
        position: absolute;
        top: 110px;
        bottom: 100px;
        left: 0;
        right: 0;
        width: 100%;
        height: 60%;
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="js/flyingObjects.js" defer></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="mb-3 fw-semibold lh-1">Datenbanksysteme</h1>
                <p class="lead mb-4">
                    University of Vienna 2022/2023
                </p>
            </div>
        </div>
    </div>

    <div id="flyingImages">
        <img src="img/amogusred.png" alt="amogusred">
        <img src="img/amogusblack.png" alt="amogusblack">
        <img src="img/amoguswhite.png" alt="amoguswhite">
        <img src="img/amoguspurple.png" alt="amoguspurple">
    </div>

    <footer class="text-white p-1 fixed-bottom">
        <div class="footer-copyright text-center py-3">
            <p>© Copyright DBS 2022/2023</p>
            <p>Special thanks to&nbsp;<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">VentingOnFridays.org</a></p>
        </div>
    </footer>



</body>

</html>