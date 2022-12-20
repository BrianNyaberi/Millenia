<?php
/**
* WORK SMART
*/
?>
<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Departments', 'doctrine');

/**
 * BaseDepartments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $sort_order
 * @property integer $active
 * @property integer $users_id
 * @property Users $Users
 * @property Doctrine_Collection $Tickets
 * 
 * @method integer             getId()         Returns the current record's "id" value
 * @method string              getName()       Returns the current record's "name" value
 * @method integer             getSortOrder()  Returns the current record's "sort_order" value
 * @method integer             getActive()     Returns the current record's "active" value
 * @method integer             getUsersId()    Returns the current record's "users_id" value
 * @method Users               getUsers()      Returns the current record's "Users" value
 * @method Doctrine_Collection getTickets()    Returns the current record's "Tickets" collection
 * @method Departments         setId()         Sets the current record's "id" value
 * @method Departments         setName()       Sets the current record's "name" value
 * @method Departments         setSortOrder()  Sets the current record's "sort_order" value
 * @method Departments         setActive()     Sets the current record's "active" value
 * @method Departments         setUsersId()    Sets the current record's "users_id" value
 * @method Departments         setUsers()      Sets the current record's "Users" value
 * @method Departments         setTickets()    Sets the current record's "Tickets" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDepartments extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('departments');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 64, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 64,
             ));
        $this->hasColumn('sort_order', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('active', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('users_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users', array(
             'local' => 'users_id',
             'foreign' => 'id'));

        $this->hasMany('Tickets', array(
             'local' => 'id',
             'foreign' => 'departments_id'));
    }
}
