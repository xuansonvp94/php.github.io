    <?php

    include "../Apps/bootstrap.php";

    $a = new Apps_Libs_DbConnection();
    $result = $a->buildQueryParams([
        "select"=>"*",
        "where"=>""
    ])->select();

    var_dump($result);
