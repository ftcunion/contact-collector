<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST["name"]) && !empty($_POST["number"])) {
    # append the received number to the file
    file_put_contents("numbers", $_POST['name'] . "\t" . $_POST['number'] . "\n", FILE_APPEND);
?>
    <!doctype html>
    <html lang="en">
    You did it!

    </html>
<?php
} else {
?>
    <!doctype html>
    <html lang="en" class="h-100 w-100">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Send Numbers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>

    <body class="h-100 w-100">
        <div class="d-flex h-100 w-100">
            <div class="d-flex flex-column justify-content-center mx-auto">
                <div class="rounded border shadow p-4">
                    <h1>Integer drop</h1>
                    <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input required type="text" id="name" name="name" class="form-control" placeholder="Matthew Thomas">
                            <label for="number" class="form-label">Number:</label>
                            <input required type="tel" id="number" name="number" class="form-control" maxlength="10" pattern="\d{10}" placeholder="2023334444">
                            <div class="form-text">Don't include country code</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send!</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>

<?php
}
?>