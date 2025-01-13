<?php
if (isset($_POST['btn_upload'])) {
    include "../connection.php";

    $file = $_FILES['file_upload']['name'];
    $file_tmp = $_FILES['file_upload']['tmp_name'];
    $description = mysqli_real_escape_string($con, $_POST['file_description']);
    $upload_dir = "uploads/";

    if (!empty($file)) {
        $file_path = $upload_dir . $file;
        $counter = 1;

        // Check if the file already exists and append a suffix if necessary
        while (file_exists($file_path)) {
            $file_info = pathinfo($file);
            $file_path = $upload_dir . $file_info['filename'] . "_{$counter}." . $file_info['extension'];
            $counter++;
        }

        // Move the file with a unique name
        if (move_uploaded_file($file_tmp, $file_path)) {
            $query = mysqli_query($con, 
                "INSERT INTO tblfiles (filename, description, upload_date) 
                VALUES ('" . basename($file_path) . "', '$description', NOW())"
            );

            // Log the action
            if (isset($_SESSION['role'])) {
                $action = 'Uploaded File: ' . basename($file_path);
                mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('" . $_SESSION['role'] . "', NOW(), '$action')");
            }

            $_SESSION[$query ? 'added' : 'error'] = $query ? 1 : "Database insertion failed.";
        } else {
            $_SESSION['error'] = "File upload failed.";
        }
    } else {
        $_SESSION['error'] = "No file selected.";
    }

    header("location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['btn_edit'])) {
    include "../connection.php";

    $file_id = $_POST['file_id'];
    $new_name = mysqli_real_escape_string($con, $_POST['file_name']);
    $description = mysqli_real_escape_string($con, $_POST['file_description']);

    // Fetch the current file name
    $file_query = mysqli_query($con, "SELECT filename FROM tblfiles WHERE id='$file_id'");
    $old_name = mysqli_fetch_assoc($file_query)['filename'];

    // Define paths
    $upload_dir = "uploads/";
    $old_path = $upload_dir . $old_name;
    $new_path = $upload_dir . $new_name;

    // Rename file on the server if the name has changed
    if ($old_name !== $new_name) {
        if (file_exists($old_path)) {
            rename($old_path, $new_path);
        }
    }

    // Update the database
    $query = mysqli_query($con, "UPDATE tblfiles SET filename='$new_name', description='$description' WHERE id='$file_id'");

    // Log the action
    if (isset($_SESSION['role'])) {
        $action = 'Edited File: ' . $old_name . ' to ' . $new_name;
        mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('" . $_SESSION['role'] . "', NOW(), '$action')");
    }

    $_SESSION[$query ? 'edited' : 'error'] = $query ? 1 : "Edit failed.";
    header("location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['btn_delete'])) {
    if (isset($_POST['chk_delete'])) {
        foreach ($_POST['chk_delete'] as $file_id) {
            $file_query = mysqli_query($con, "SELECT filename FROM tblfiles WHERE id='$file_id'");
            $file = mysqli_fetch_assoc($file_query)['filename'];

            // Delete the file from the server
            unlink("uploads/" . $file);

            // Delete the file record from the database
            mysqli_query($con, "DELETE FROM tblfiles WHERE id='$file_id'");

            // Log the action
            if (isset($_SESSION['role'])) {
                $action = 'Deleted File: ' . $file;
                mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('" . $_SESSION['role'] . "', NOW(), '$action')");
            }
        }
        $_SESSION['delete'] = 1;
    }
    header("location: " . $_SERVER['REQUEST_URI']);
}
?>
