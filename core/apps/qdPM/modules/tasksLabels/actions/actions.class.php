<?php
/**
* WORK SMART
*/
?>
<?php

/**
 * tasksLabels actions.
 *
 * @package    sf_sandbox
 * @subpackage tasksLabels
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tasksLabelsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tasks_labelss = Doctrine_Core::getTable('TasksLabels')
      ->createQuery('a')
      ->orderBy('sort_order, name')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TasksLabelsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TasksLabelsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tasks_labels = Doctrine_Core::getTable('TasksLabels')->find(array($request->getParameter('id'))), sprintf('Object tasks_labels does not exist (%s).', $request->getParameter('id')));
    $this->form = new TasksLabelsForm($tasks_labels);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tasks_labels = Doctrine_Core::getTable('TasksLabels')->find(array($request->getParameter('id'))), sprintf('Object tasks_labels does not exist (%s).', $request->getParameter('id')));
    $this->form = new TasksLabelsForm($tasks_labels);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tasks_labels = Doctrine_Core::getTable('TasksLabels')->find(array($request->getParameter('id'))), sprintf('Object tasks_labels does not exist (%s).', $request->getParameter('id')));
    $tasks_labels->delete();

    $this->redirect('tasksLabels/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {            
      $tasks_labels = $form->save();
      
      if($tasks_labels->getDefaultValue()==1)
      {
        app::resetCfgDefaultValue($tasks_labels->getId(),'TasksLabels');
      }

      $this->redirect('tasksLabels/index');
    }
  }
}
