<?php
/**
* WORK SMART
*/
?>
<?php

/**
 * ticketsReports actions.
 *
 * @package    sf_sandbox
 * @subpackage ticketsReports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketsReportsActions extends sfActions
{
  public function checkAccess($reports,$check_view = false)
  {
    if($reports->getUsersId()!=$this->getUser()->getAttribute('id'))
    {
      $this->redirect('accessForbidden/index');
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->tickets_reportss = Doctrine_Core::getTable('TicketsReports')
      ->createQuery()
      ->addWhere('users_id=?',$this->getUser()->getAttribute('id'))      
      ->orderBy('sort_order, name')
      ->execute();
      
    app::setPageTitle('Tickets Reports',$this->getResponse());
  }
  
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless($this->tickets_reports = Doctrine_Core::getTable('TicketsReports')->find(array($request->getParameter('id'))), sprintf('Object tickets_reports does not exist (%s).', $request->getParameter('id')));
    
    $this->checkAccess($this->tickets_reports, true);
    
    app::setPageTitle($this->tickets_reports->getName(),$this->getResponse());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TicketsReportsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TicketsReportsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tickets_reports = Doctrine_Core::getTable('TicketsReports')->find(array($request->getParameter('id'))), sprintf('Object tickets_reports does not exist (%s).', $request->getParameter('id')));
    $this->checkAccess($tickets_reports);
    $this->form = new TicketsReportsForm($tickets_reports);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tickets_reports = Doctrine_Core::getTable('TicketsReports')->find(array($request->getParameter('id'))), sprintf('Object tickets_reports does not exist (%s).', $request->getParameter('id')));
    $this->checkAccess($tickets_reports);
    $this->form = new TicketsReportsForm($tickets_reports);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tickets_reports = Doctrine_Core::getTable('TicketsReports')->find(array($request->getParameter('id'))), sprintf('Object tickets_reports does not exist (%s).', $request->getParameter('id')));
    $this->checkAccess($tickets_reports);
    $tickets_reports->delete();

    switch($request->getParameter('redirect_to'))
    {
      default: $this->redirect('ticketsReports/index');
        break;
    }
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $form->setFieldValue('departments_id',$form['departments_id']->getValue());
      
      $form->setFieldValue('tickets_types_id',$form['tickets_types_id']->getValue());            
      $form->setFieldValue('tickets_status_id',$form['tickets_status_id']->getValue());            
            
      $form->setFieldValue('projects_type_id',$form['projects_type_id']->getValue());            
      $form->setFieldValue('projects_status_id',$form['projects_status_id']->getValue());                              
      $form->setFieldValue('projects_id',$form['projects_id']->getValue());
                             
      $form->protectFieldsValue();
      
      $tickets_reports = $form->save();

      switch($request->getParameter('redirect_to'))
      {      
        case 'view': $this->redirect('ticketsReports/view?id=' . $tickets_reports->getId());
          break;
        default: $this->redirect('ticketsReports/index');
          break;
      }   
    }
  }
}
