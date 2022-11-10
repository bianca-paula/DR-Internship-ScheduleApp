<?php

include_once "../helpers/GroupHelper.php";
include_once "../utils/DbConfiguration.php";


$db_config = new DbConfiguration();
GroupHelper::setUpUserTable($db_config);

echo "DONE, GO HOME!";

?>