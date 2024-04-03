<?php
//exec("php ../bin/create_address.php 1 1", $output, $status);
//exec("php ../bin/create_campus.php", $output, $status);
//exec("php ../bin/create_company.php 1 2 3 4 5", $output, $status);
//exec("php ../bin/create_editwishlist.php 20 7 3", $output, $status);
//exec("php ../bin/create_need.php 1 2", $output, $status); @todo /!\ error ID_offers
//exec("php ../bin/create_offers.php 1 2 3 4 5/6/7 8 1 1", $output, $status);
//exec("php ../bin/create_postulate.php 12 24 30 40", $output, $status);
//exec("php ../bin/create_skills.php 19", $output, $status);
exec("php ../bin/create_user.php John Doe 3 2 jhon@etudiant.com CESI2024 1 1", $output, $status);
//exec("php ../bin/create_opinion.php 1 opinion sender 3", $output, $status);



out($output);


function out($output)
{
    print_r($output);
    if ($output[count($output) - 2] === "error") {
        echo "error detected => have to add error popup";
    } elseif (count($output) != 1) {
        for ($i = 0; $i < count($output) / 2 - 1; $i++) {
            $values = array();
            array_push($values, $output[$i]);
            echo $output[$i] . "\n";
        }
        if (count($output) == 2) {
            echo $output[0];
        }
    }
}
