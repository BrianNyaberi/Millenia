<?php
/**
* WORK SMART
*/
?>
<?php

/**
 * UsersTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UsersTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UsersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Users');
    }
}
