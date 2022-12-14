<?php
/**
* WORK SMART
*/
?>
<?php

class tasksCommentsComponents extends sfComponents
{
  public function executeBreadcrump(sfWebRequest $request)
  {    
    $this->breadcrump = array();
        
    $this->breadcrump = array_reverse($this->breadcrump);
  }
  
  public function executeInfo(sfWebRequest $request)
  {
  
  }
  
  public function executeEmailBody()
  {    
    $this->comments_history = Doctrine_Core::getTable('TasksComments')
      ->createQuery()
      ->addWhere('tasks_id=?',$this->tasks->getId())      
      ->orderBy('created_at desc')
      ->limit((int)sfConfig::get('app_amount_previous_comments',2)+1)
      ->execute();  
  }
  
  public function executeGoto(sfWebRequest $request)
  {      
       $q = Doctrine_Core::getTable('Tasks')->createQuery('t')
              ->leftJoin('t.TasksPriority tp')
              ->leftJoin('t.TasksStatus ts')
              ->leftJoin('t.TasksLabels tl')
              ->leftJoin('t.TasksTypes tt')
              ->leftJoin('t.TasksGroups tg')
              ->leftJoin('t.ProjectsPhases pp')
              ->leftJoin('t.Versions v')
              ->leftJoin('t.Projects p')
              ->leftJoin('t.Users');
              
        $q->addWhere('projects_id=?',$request->getParameter('projects_id'));
        
        if(Users::hasAccess('view_own','tasks',$this->getUser(),$request->getParameter('projects_id')))
        {                 
          $q->addWhere("find_in_set('" . $this->getUser()->getAttribute('id') . "',t.assigned_to) or t.created_by='" . $this->getUser()->getAttribute('id') . "'");
        }
                                      
        $q = Tasks::addFiltersToQuery($q,$this->getUser()->getAttribute('tasks_filter' . ((int)$request->getParameter('projects_id')>0 ? $request->getParameter('projects_id') : '')));                  
        
        $q = app::addListingOrder($q,'tasks',$this->getUser(), (int)$request->getParameter('projects_id'));
        
        $this->menu = array();   
        $tasks_ids = array();                               
        foreach($q->fetchArray() as $tasks)
        {
                    
          if(strlen($sn=app::getArrayName($tasks,'TasksStatus'))>0){ $sn = $sn . ': ';}else{ $sn ='';}
          
          if($request->getParameter('tasks_id')==$tasks['id']) $tasks['name'] = '<b>' . $tasks['name'] . '</b>'; 
          
          $this->menu[] = array('title'=>$sn . $tasks['name'],'url'=>'tasksComments/index?projects_id=' . $request->getParameter('projects_id') . '&tasks_id=' . $tasks['id']);
          
          $tasks_ids[] = $tasks['id'];                               
        }  
       
    $current_key = array_search($request->getParameter('tasks_id'),$tasks_ids);
    $this->previous_tasks_id = false;
    $this->next_tasks_id = false;
    if(isset($tasks_ids[$current_key-1])) $this->previous_tasks_id = $tasks_ids[$current_key-1];
    if(isset($tasks_ids[$current_key+1])) $this->next_tasks_id = $tasks_ids[$current_key+1];
  
    
  }
  

}
