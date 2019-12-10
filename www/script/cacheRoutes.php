<?php

    $listOfRoutes = yaml_parse_file("../routes.yml");
    

    $data = var_export($listOfRoutes, true);


    file_put_contents("../cache/routes.cache.php", "<?php ".$data);
