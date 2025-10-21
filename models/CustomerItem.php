<?php
class CustomerItem extends DbObject {


public $firstname;
public $lastname;
public $fullname;
public $email;
public $phone;


public function getSelectOptionTitle()
{
    return $this->fullname;
}
public function getSelectOptionValue()
{
    return $this->id;
}


}
?>