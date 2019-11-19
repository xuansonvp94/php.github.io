<?php

include "../Apps/bootstrap.php";

$a = new Apps_Libs_DbConnection();
$a ->buildQueryParams([
    "select"=>"*",
    "where"=>""
])->select();
