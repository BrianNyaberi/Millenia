<?php
/**
* WORK SMART
*/
?>
<?php

/**
 * UserReports
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class UserReports extends BaseUserReports
{

  public static function addFiltersToQuery($q,$reports_id,$users_id=false)
  {
    if($r = Doctrine_Core::getTable('UserReports')->find($reports_id))
    {       
      
      if(strlen($r->getTasksStatusId())>0)
      {
        $q->whereIn('t.tasks_status_id',explode(',',$r->getTasksStatusId()));
      }
       
      if(strlen($r->getTasksTypeId())>0)
      {
        $q->whereIn('t.tasks_type_id',explode(',',$r->getTasksTypeId()));
      }
        
      if(strlen($r->getTasksLabelId())>0)
      {
        $q->whereIn('t.tasks_label_id',explode(',',$r->getTasksLabelId()));
      }
        
      
      if(strlen($r->getDueDateFrom())>0)
      {
        $q->addWhere('date_format(t.due_date,"%Y-%m-%d")>="' . $r->getDueDateFrom() . '"');
      }      
      if(strlen($r->getDueDateTo())>0)
      {
        $q->addWhere('date_format(t.due_date,"%Y-%m-%d")<="' . $r->getDueDateTo() . '"');
      }
                  
      if(strlen($r->getCreatedFrom())>0)
      {
        $q->addWhere('date_format(t.created_at,"%Y-%m-%d")>="' . $r->getCreatedFrom() . '"');
      }      
      if(strlen($r->getCreatedTo())>0)
      {
        $q->addWhere('date_format(t.created_at,"%Y-%m-%d")<="' . $r->getCreatedTo() . '"');
      }
      
      if(strlen($r->getClosedFrom())>0)
      {
        $q->addWhere('date_format(t.closed_date,"%Y-%m-%d")>="' . $r->getClosedFrom() . '"');
      }    
      if(strlen($r->getClosedTo())>0)
      {
        $q->addWhere('date_format(t.closed_date,"%Y-%m-%d")<="' . $r->getClosedTo() . '"');
      }
          
      if(strlen($r->getAssignedTo())>0)
      {        
        $filter_sql_array = array();
        foreach(explode(',',$r->getAssignedTo()) as $id)
        {
          $filter_sql_array[] = 'find_in_set(' . $id . ',t.assigned_to)';
        }
        
        $q->addWhere(implode(' or ',$filter_sql_array));
      } 
            
      if(strlen($r->getProjectsStatusId())>0)
      {
        $q->whereIn('p.projects_status_id',explode(',',$r->getProjectsStatusId()));
      }
       
      if(strlen($r->getProjectsTypeId())>0)
      {
        $q->whereIn('p.projects_types_id',explode(',',$r->getProjectsTypeId()));
      }
                      
      if(strlen($r->getProjectsId())>0)
      {
        $q->whereIn('p.id',explode(',',$r->getProjectsId()));
      }
      
      $q->orderBy('ts.group desc, ts.sort_order,LTRIM(ts.name), LTRIM(p.name), LTRIM(t.name)');
                                    
    }
                  
    return $q;  
  }
}
