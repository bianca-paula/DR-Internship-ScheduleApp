<?php

$groups = array('231', '232', '233', '234', '235', '236', '237');

?>


<div class="col-lg-2 my-5 mx-2 pb-0 assigned-block">
    <div class="row form-container">
        <div class="col">
            <div class="row header">
                <div class="col d-flex justify-content-center align-items-center">
                    Assigned to
                </div>
            </div>
            <div class="row assigned-block-rows">
                <!-- Form -->
                <div class="col px-0 ">
                    <form class="assigned-block-form">

                        <?php
                        foreach ($groups as $group) {
                        ?>
                            <div class="row ">
                                <div class="col d-flex justify-content-end p-0 my-2">
                                    <input type="checkbox" id="<?php print($group) ?>">
                                </div>

                                <div class="col d-flex justify-content-start align-items-center">
                                    <label for="<?php print($group) ?>"><?php print($group) ?></label>
                                </div>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col px-0">
            <button class="w-100 py-2" type="submit">SAVE</button>
        </div>
    </div>
</div>