<?php

class IndexController extends DDM_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$p = new Models_I_Project();
        $archived = (int)$this->getRequest()->getParam('archived');
        $this->view->archived = $archived;
    	$projects = $p->fetchAll('archived = '.$archived, 'id DESC');
    	$this->view->projects = $projects;
    }

    public function projectAction()
    {
    	$projectId = $this->getRequest()->getParam('id');
    	$p = new Models_I_Project();
    	$q = new Models_I_Query();

    	$queries = $q->loadByProjectId($projectId);
    	$this->view->queries = $queries;

    	$project = $p->loadOne($projectId);
    	$this->view->project = $project;
    }

    public function editProjectAction() {
        $this->_helper->layout()->disableLayout();
        $form = new Forms_I_Project();
        $processed = $form->process($this->getRequest());
        if($processed && $this->getRequest()->isXmlHttpRequest()) {
            echo $processed;
            exit;
        }
        $this->view->form = $form;
    }

    public function archiveProjectAction() {
        $Project = new Models_I_Project();
        $Project->loadOne($this->getRequest()->getParam('id'));
        $Project->setArchived($this->getRequest()->getParam('archive'));
        $Project->save();
        $this->_redirect('/');
    }

    public function adminAction() {


    }

}

