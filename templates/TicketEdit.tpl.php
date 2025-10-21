
<?php
var_dump("die"); die;
use Html\Form\Html5Autocomplete;

echo new Html5Autocomplete([
                    "id|name" => "customer",
                    "label" => "Customer",
                    "placeholder" => "Search",
                    "value" => !empty($Ticket->customerid) ? $Ticket->customerid : null,
                    "source" => $w->localUrl("/pos-ajax/ajaxSearch"),
                    "minItems" => 2,
]);




?>