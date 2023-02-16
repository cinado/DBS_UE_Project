<style>
    .custom-font {
        font-family: 'Roboto', sans-serif;
    }

    .nav-item:hover .nav-link {
        font-weight: bold;
    }

    html,
    body {
        margin: 0;
        min-height: 100vh;
    }

    body {
        background-color: #DEE1E6;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Logo"
            style="height: 60px; margin-left: 15%;"></a>
    <button class="navbar-toggler mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-around nav-fill d-flex" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active mx-3">
                <a class="nav-link nav-primary text-light font-weight-bold custom-font" href="index.php">Home</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link nav-primary text-light font-weight-bold custom-font" href="article.php">Artikel</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link nav-primary text-light font-weight-bold custom-font"
                    href="wirdgelagertin.php">Wird-Gelagert-In-Tabelle</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link nav-primary text-light font-weight-bold custom-font" href="lagerhalle.php">Lagerhalle</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link nav-primary text-light font-weight-bold custom-font"
                    href="logistikzentrum.php">Logisitikzentrum</a>
            </li>
        </ul>
    </div>
</nav>