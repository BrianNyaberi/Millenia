<?php
/**
* WORK SMART
*/
?>
<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TicketsComments', 'doctrine');

/**
 * BaseTicketsComments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property timestamp $created_at
 * @property integer $tickets_id
 * @property integer $users_id
 * @property integer $tickets_status_id
 * @property Tickets $Tickets
 * @property Users $Users
 * @property TicketsStatus $TicketsStatus
 * 
 * @method integer         getId()                Returns the current record's "id" value
 * @method string          getDescription()       Returns the current record's "description" value
 * @method timestamp       getCreatedAt()         Returns the current record's "created_at" value
 * @method integer         getTicketsId()         Returns the current record's "tickets_id" value
 * @method integer         getUsersId()           Returns the current record's "users_id" value
 * @method integer         getTicketsStatusId()   Returns the current record's "tickets_status_id" value
 * @method Tickets         getTickets()           Returns the current record's "Tickets" value
 * @method Users           getUsers()             Returns the current record's "Users" value
 * @method TicketsStatus   getTicketsStatus()     Returns the current record's "TicketsStatus" value
 * @method TicketsComments setId()                Sets the current record's "id" value
 * @method TicketsComments setDescription()       Sets the current record's "description" value
 * @method TicketsComments setCreatedAt()         Sets the current record's "created_at" value
 * @method TicketsComments setTicketsId()         Sets the current record's "tickets_id" value
 * @method TicketsComments setUsersId()           Sets the current record's "users_id" value
 * @method TicketsComments setTicketsStatusId()   Sets the current record's "tickets_status_id" value
 * @method TicketsComments setTickets()           Sets the current record's "Tickets" value
 * @method TicketsComments setUsers()             Sets the current record's "Users" value
 * @method TicketsComments setTicketsStatus()     Sets the current record's "TicketsStatus" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTicketsComments extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tickets_comments');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('tickets_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('users_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tickets_status_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Tickets', array(
             'local' => 'tickets_id',
             'foreign' => 'id'));

        $this->hasOne('Users', array(
             'local' => 'users_id',
             'foreign' => 'id'));

        $this->hasOne('TicketsStatus', array(
             'local' => 'tickets_status_id',
             'foreign' => 'id'));
    }
}
