<?php

$course_table = array(
    array(
        'id' => 1,
        'course_name' => 'Inteligenta artificiala',
        'type' => 'Curs'
    ),
    array(
        'id' => 2,
        'course_name' => 'Medii de proiectare sis programare',
        'type' => 'Seminar'
    ),
    array(
        'id' => 3,
        'course_name' => 'Metodologii pentru procese software',
        'type' => 'Curs'
    )
);

?>

<div class="row course-table justify-content-center">
    <div class="col-md ">
        <div class="row header d-flex align-content-center justify-content-center">
            <div class="col-2 d-flex align-content-center justify-content-center ">ID</div>
            <div class="col-8 d-flex align-content-center justify-content-center">Course</div>
            <div class="col-2 d-flex align-content-center justify-content-center">Type</div>
        </div>


        <?php
        foreach ($course_table as $row => $value) {
        ?>
            <div class="row data-record">

                <div class="col-2 d-flex align-content-center justify-content-center id-col" data-course-id="<?php print($value['id']) ?>"> <?php print($value['id']) ?></div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-11 title" data-course-title="<?php print($value['course_name']) ?>"> <?php print($value['course_name']) ?> </div>
                        <div class="col-1 d-flex align-items-center justify-content-end see-more">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                            <div class="row choice-modal">
                                <div class="col">
                                    <!-- Delete button -->
                                    <div class="row">
                                        <button type="button" class="col mx-auto delete-button delete" data-bs-toggle="modal" data-bs-target="delete-modal">
                                            Delete Course
                                        </button>
                                    </div>

                                    <!-- See Scheduled button -->
                                    <div class="row">
                                        <form action="./schedule.php">
                                            <button type="submit" class="col mx-auto schedule-button">
                                                See Scheduled
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 course-type" data-course-type="<?php print($value['type']) ?>"> <?php print($value['type']) ?> </div>
            </div>
        <?php } ?>
    </div>
</div>