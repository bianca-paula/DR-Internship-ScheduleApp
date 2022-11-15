<?php
if (isset($_POST['submit-delete-course'])) {
    echo "Deleted course id is: " . $_POST['id'];
}

if (isset($_POST['submit-add-course'])) {
    echo "course-name=" . $_POST['course-name'] . "</br>" .
        "course-type=" . $_POST['course-type'];
}


if (isset($_POST['submit-assigned'])) {
    echo "Assigned group:" . "</br>";
    foreach ($_POST as $key => $value) {
        if ($key != 'submit-assigned') {
            echo "-" . $key . "</br>";
        }
    }
}
