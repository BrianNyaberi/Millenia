<?php
/**
* WORK SMART
*/
?>
<?php

/**
 * ticketsStatus actions.
 *
 * @package    sf_sandbox
 * @subpackage ticketsStatus
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketsStatusActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    app::setPageTitle('Ticktes Status',$this->getResponse());
    
    $this->tickets_statuss = Doctrine_Core::getTable('TicketsStatus')
      ->createQuery('a')
      ->orderBy('group desc, sort_order, name')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TicketsStatusForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TicketsStatusForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tickets_status = Doctrine_Core::getTable('TicketsStatus')->find(array($request->getParameter('id'))), sprintf('Object tickets_status does not exist (%s).', $request->getParameter('id')));
    $this->form = new TicketsStatusForm($tickets_status);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tickets_status = Doctrine_Core::getTable('TicketsStatus')->find(array($request->getParameter('id'))), sprintf('Object tickets_status does not exist (%s).', $request->getParameter('id')));
    $this->form = new TicketsStatusForm($tickets_status);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tickets_status = Doctrine_Core::getTable('TicketsStatus')->find(array($request->getParameter('id'))), sprintf('Object tickets_status does not exist (%s).', $request->getParameter('id')));
    $tickets_status->delete();

    $this->redirect('ticketsStatus/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tickets_status = $form->save();
      
      if($tickets_status->getDefaultValue()==1)
      {
        app::resetCfgDefaultValue($tickets_status->getId(),'TicketsStatus');
      }

      $this->redirect('ticketsStatus/index');
    }
  }
}
