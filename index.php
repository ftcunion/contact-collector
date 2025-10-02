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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

        <style>
            body {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 80 80'%3e%3cpath fill='var(--bs-secondary)' fill-opacity='0.2' d='M14.9 7.53v1.6l-.96.8-.07 3.67-8.96.92s-.03-.46-.26-.46c-.2 0-.22.51-.22.51l-.68.07V15l.5.08C3.1 18.41 2.28 21 1.36 23.82H1s.43 2.67 3.72 2.65c3.15-.03 3.52-2.65 3.52-2.65h-.3l-2.82-8.61 8.68 1.37-.23 10.87c0 .89-1.75.77-3.2.83-.12.88-.42 2.82-.04 3.18h9.47c.37-.36.07-2.3-.05-3.18-1.45-.06-3.2.06-3.2-.83l-.23-10.87 8.54-1.35-2.8 8.59h-.3s.36 2.62 3.51 2.65c3.29.02 3.73-2.65 3.73-2.65h-.35c-.92-2.82-1.73-5.4-2.9-8.73l.64-.1-.01-.35-.81-.08c0-.04-.03-.5-.23-.5s-.25.41-.25.45l-8.83-.9-.07-3.67-.95-.8V7.52h-.35zm-10.55 9.4c.03 2.3.06 4.6.15 6.89H2l2.35-6.9zm21.3 0L28 23.81h-2.5c.1-2.29.12-4.6.14-6.9zm-20.6.5c.76 2.17 1.65 4.27 2.51 6.39h-2.7a160 160 0 0 0 .18-6.39zm19.92 0c.02 2.13.07 4.26.18 6.39h-2.7c.86-2.12 1.74-4.22 2.52-6.39zM55 18a2 2 0 0 0 0 4 2 2 0 0 0 0-4zm-.1 29.54v1.6l-.97.8-.07 3.67-8.95.92s-.04-.46-.26-.46c-.2 0-.22.51-.22.51l-.68.07-.01.35.51.08c-1.17 3.34-1.98 5.92-2.9 8.75H41s.44 2.67 3.72 2.64c3.15-.02 3.52-2.64 3.52-2.64h-.3l-2.81-8.61 8.68 1.37-.23 10.87c0 .89-1.76.77-3.2.83-.12.88-.42 2.82-.05 3.18h9.47c.38-.36.07-2.3-.04-3.18-1.45-.06-3.2.06-3.2-.83l-.23-10.87 8.53-1.35-2.8 8.59h-.3s.37 2.62 3.52 2.64c3.28.03 3.72-2.64 3.72-2.64h-.34c-.93-2.82-1.74-5.4-2.9-8.73l.63-.1v-.35l-.82-.08c0-.04-.03-.5-.22-.5-.21 0-.25.41-.25.45l-8.83-.9-.07-3.67-.96-.8v-1.62h-.35zm-10.55 9.4c.03 2.3.05 4.6.14 6.89h-2.48l2.34-6.9zm21.3 0L68 63.82h-2.48c.09-2.29.11-4.6.14-6.9zm-20.61.5c.77 2.17 1.65 4.27 2.52 6.39h-2.7c.1-2.13.16-4.26.18-6.4zm19.92 0c.02 2.13.08 4.26.18 6.39h-2.7c.87-2.12 1.75-4.22 2.52-6.4zM15 58a2 2 0 0 0 0 4 2 2 0 0 0 0-4z'/%3e%3c/svg%3e");
                background-size: 5.5rem
            }
        </style>
    </head>

    <body class="h-100 w-100 bg-light">
        <div class="d-flex h-100 w-100">
            <div class="d-flex flex-column justify-content-center mx-auto">
                <div class="rounded border bg-light shadow p-4">
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