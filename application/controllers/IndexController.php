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
    	$projects = $p->fetchAll();
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

    public function adminAction() {


    }

}

