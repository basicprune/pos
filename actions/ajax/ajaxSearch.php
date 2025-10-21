<?php

function ajaxSearch_GET(Web $w)
{
    $w->setLayout(null);
    $term = Request::string("term");

    $customers = PosService::getInstance($w)->getObjects("CustomerItem", ["fullname LIKE ?" => "%{$term}%", "is_deleted" => 0, "is_active" => 1], false, 'title ASC');
    $return_data = [];
    if (!empty($customers)) {
        $customers = array_filter($customers, function ($customer) use ($w) {
            return $customer->canView(AuthService::getInstance($w)->user());
        });

        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $return_data[] = ["label" => $customer->getSelectOptionTitle(), "value" => $customer->getSelectOptionValue()];
            }
        }
    }

    echo json_encode($return_data);
}
