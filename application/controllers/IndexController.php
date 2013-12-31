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

        $this->view->original = $p->getOriginalQuery(null, false);
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

    /**
     *
     * runs the query and optionally saves it
     */
    public function runQueryAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $Query = new Models_I_Query();
        if($this->getRequest()->getParam('I_id')) {
            $Query->loadOne($this->getRequest()->getParam('I_id'));
        }
        $response = array();
        $return = array();
        $return['error'] = false;
        if($this->getRequest()->getParam('save')) {
            $Query->setTitle($this->getRequest()->getParam('I_title'));
            $Query->setQuery($this->getRequest()->getParam('I_query'));
            $Query->setNotes($this->getRequest()->getParam('I_notes'));
            $id = $Query->save();
            $Query->loadOne($id);//in case it was an insert - the dupe logic is negigible
            $return['saved'] = true;
        }
        try {
            $response = $Query->runQuery($this->getRequest()->getParam('I_query'), $this->getRequest()->getParam('save'));
        } catch(Exception $e) {
            $return['error'] = true;
            $return['error_message'] = $e->getMessage();
        }
        unset($response['results']);
        $return = array_merge($return, $response);
        echo json_encode($return);
    }

    /**
     * forks a query
     */
    public function forkQueryAction() {
        $Query = new Models_I_Query();
        $Query->loadOne($this->getRequest()->getParam('id'));
        $Query->fork();
        $this->_redirect('/index/project/id/'.$Query->getProjectId());
    }

    /**
     * deletes a query
     */
    public function deleteQueryAction() {
        $Query = new Models_I_Query();
        $id = (int)$this->getRequest()->getParam('id');
        $Query->loadOne($id);
        $Query->delete("id = $id AND is_original = 0");
        $this->_redirect('/index/project/id/'.$Query->getProjectId());
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

