<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Check if the "id" or "email" field is empty
    if (empty($_POST["id"]) || empty($_POST["email"])) {
        die("Required fields not filled! Did you use the correct form?");
    }

    # Open file "contact.csv" in append mode and get a lock
    $file = fopen("../contact.csv", "a");
    if (flock($file, LOCK_EX)) {
        $file_size = fstat($file)['size'];

        # Write the header if the file is empty
        if ($file_size == 0) {
            fputcsv($file, ["Id", "Date", "Email", "Number"]);
        }

        # Add the contact information to the csv
        fputcsv($file, [$_POST["id"], date("Y-m-d H:i:s"), $_POST["email"], $_POST["number"] ?? ""]);

        # Release the lock and close the file
        flock($file, LOCK_UN);
        fclose($file);
    } else {
        die("Unable to submit the form. Please try again!");
    }
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
        <title>Contact information</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>

    <body class="h-100 w-100">
        <div class="d-flex h-100 w-100">
            <div class="d-flex flex-column justify-content-center mx-auto">
                <div class="rounded border shadow p-4">
                    <h1>Contact information</h1>
                    <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="mb-3">
                            <?php
                            # If the "id" field is provided in the URL, add it to the form, otherwise, request it in the form
                            if (isset($_GET["id"])) {
                            ?>
                                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                            <?php } else { ?>
                                <label for="id" class="form-label">Name:</label>
                                <input required type="text" id="id" name="id" class="form-control" placeholder="John Doe">
                            <?php } ?>
                            <label for="email" class="form-label">Non-FTC Email:</label>
                            <input required type="email" id="email" name="email" class="form-control" placeholder="johndoe21@gmail.com">
                            <label for="number" class="form-label">Non-FTC Number:</label>
                            <input type="tel" id="number" name="number" class="form-control" maxlength="10" pattern="\d{10}" placeholder="2023334444">
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