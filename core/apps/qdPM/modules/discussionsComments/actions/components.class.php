<?php
/**
* WORK SMART
*/
?>
<?php

class discussionsCommentsComponents extends sfComponents
{
  public function executeInfo(sfWebRequest $request)
  {
  
  }
  
  public function executeEmailBody()
  {    
    $this->comments_history = Doctrine_Core::getTable('DiscussionsComments')
      ->createQuery()
      ->addWhere('discussions_id=?',$this->discussions->getId())      
      ->orderBy('created_at desc')
      ->limit((int)sfConfig::get('app_amount_previous_comments',2)+1)
      ->execute();  
  }
  
  public function executeGoto(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Discussions')->createQuery('d')          
          ->leftJoin('d.DiscussionsStatus ds')                                       
          ->leftJoin('d.Projects p')
          ->leftJoin('d.Users');
          
 
    $q->addWhere('projects_id=?',$request->getParameter('projects_id'));
    
    if(Users::hasAccess('view_own','discussions',$this->getUser(),$request->getParameter('projects_id')))
    {                 
      $q->addWhere("find_in_set('" . $this->getUser()->getAttribute('id') . "',d.assigned_to) or d.users_id='" . $this->getUser()->getAttribute('id') . "'");
    }
 
    $q = Discussions::addFiltersToQuery($q,$this->getUser()->getAttribute('discussions_filter' . ((int)$request->getParameter('projects_id')>0 ? $request->getParameter('projects_id') : '')));
    $q = app::addListingOrder($q,'discussions',$this->getUser(), (int)$request->getParameter('projects_id'));            

    $this->menu = array();   
    $ids = array();                                   
    foreach($q->fetchArray() as $v)
    {
      if(strlen($sn=app::getArrayName($v,'DiscussionsStatus'))>0){ $sn = $sn . ': ';}else{ $sn ='';}
      
      if($request->getParameter('discussions_id')==$v['id']) $v['name'] = '<b>' . $v['name'] . '</b>'; 
          
      $this->menu[] = array('title'=>$sn . $v['name'],'url'=>'discussionsComments/index?projects_id=' . $request->getParameter('projects_id') . '&discussions_id=' . $v['id']);
      
      $ids[] = $v['id'];
    }
    
    $current_key = array_search($request->getParameter('discussions_id'),$ids);
    $this->previous_item_id = false;
    $this->next_item_id = false;
    if(isset($ids[$current_key-1])) $this->previous_item_id = $ids[$current_key-1];
    if(isset($ids[$current_key+1])) $this->next_item_id = $ids[$current_key+1];
  }
}
