<table class="w-100" data-toggle="table" id="schedule-table">
    <thead>
        <tr class="table-head">
            <th data-width="80"></th>
            <?php
            const WEEKDAYS = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
            foreach (WEEKDAYS as $day) {
            ?>
                <th data-width="150"><?php print($day) ?></th>
            <?php
            }
            ?>
        </tr>
    </thead>
    <tbody class="table-data">
        <?php
        for ($hour = 8; $hour <= 19; $hour++) {
        ?>
            <tr>
                <th><?php print $hour; ?>-<?php print($hour + 1) ?></th>
                <?php

                foreach (WEEKDAYS as $day) {
                ?>
                    <td data-toggle="modal" data-target="#courseModal">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-4 justify-content-end">AI</div>
                                <div class="col-4 justify-content-center">
                                    <form action="#" method="post">
                                        <button type="button" class="col mx-auto delete-button" data-bs-toggle="modal" data-bs-target="delete-modal">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                <?php } ?>
            </tr>
        <?php
        } ?>
    </tbody>
</table>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
<script src="https://kit.fontawesome.com/aca3ebed9c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script> -->