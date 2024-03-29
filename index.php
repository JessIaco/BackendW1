<?php
require_once 'config.php';
require_once 'gestione.php';

$libri = getAllBooks($mysqli);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jes(sick)a Bookshelf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <h2 class="text-white mb-0">Jes(sick)a Bookshelf<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-heart" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.965 12.695a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2m-.8 3.108.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125M8 5.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
</svg></h2>
        </div>
    </nav>

    <button type="button" class="btn btn-primary mt-4 d-flex mx-auto" data-bs-toggle="modal"
        data-bs-target="#modaleAggiunta">
        Aggiungi un libro
    </button>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($libri as $key => $libro) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <?= $libro['titolo'] ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?= $libro['autore'] ?>
                            </h6>
                            <p class="card-text">Anno di pubblicazione:
                                <?= $libro['anno_pubblicazione'] ?>
                            </p>
                            <p class="card-text">Genere:
                                <?= $libro['genere'] ?>
                            </p>
                            <div class="d-flex justify-content-center">
                                <a role="button" class="btn mx-2 modificaBtn" data-bs-toggle="modal"
                                    data-bs-target="#modaleUpdate_<?= $libro['id'] ?>">Modifica</a>
                                <a role="button" class="btn eliminaBtn mx-2"
                                    href="gestione.php?action=remove&id=<?= $libro['id'] ?>">Rimuovi</a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modale per l'aggiornamento -->
                <div class="modal fade" id="modaleUpdate_<?= $libro['id'] ?>" tabindex="-1"
                    aria-labelledby="modaleUpdate<?= $libro['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Modifica i dati</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="gestione.php">
                                    <input type="hidden" name="id" value="<?= $libro['id'] ?>">
                                    <div class="mb-3">
                                        <label for="titoloLibroUp" class="form-label">Titolo</label>
                                        <input type="text" class="form-control" id="titoloLibroUp"
                                            aria-describedby="titoloLibroUp" name="titoloUp"
                                            value="<?= $libro['titolo'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="autoreLibroUp" class="form-label">Autore</label>
                                        <input type="text" class="form-control" id="autoreLibroUp" name="autoreUp"
                                            value="<?= $libro['autore'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="annoLibroUp" class="form-label">Anno di pubblicazione</label>
                                        <input type="number" step="1" min="1" max="2024" class="form-control"
                                            id="annoLibroUp" name="annoUp" value="<?= $libro['anno_pubblicazione'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="genereLibroUp" class="form-label">Genere</label>
                                        <input type="text" class="form-control" id="genereLibroUp" name="genereUp"
                                            value="<?= $libro['genere'] ?>">
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Chiudi</button>
                                        <button type="submit" class="btn btn-primary" name="action" value="update">Aggiorna
                                            libro</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer class="container-fluid">
        <div class="copyright">
            &copy; Miau
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>

<!-- Aggiunta libro -->
<div class="modal fade" id="modaleAggiunta" tabindex="-1" aria-labelledby="modaleAggiunta" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Dati del libro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="gestione.php">
                    <div class="mb-3">
                        <label for="titoloLibro" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="titoloLibro" aria-describedby="titoloLibro"
                            name="titolo" required>
                    </div>
                    <div class="mb-3">
                        <label for="autoreLibro" class="form-label">Autore</label>
                        <input type="text" class="form-control" id="autoreLibro" name="autore" required>
                    </div>
                    <div class="mb-3">
                        <label for="annoLibro" class="form-label">Anno di pubblicazione</label>
                        <input type="number" step="1" min="1" max="2024" class="form-control" id="annoLibro" name="anno"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="genereLibro" class="form-label">Genere</label>
                        <input type="text" class="form-control" id="genereLibro" name="genere" required>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary" name="action" value="add">Aggiungi il
                            libro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>