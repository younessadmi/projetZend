<?php

namespace Article\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    protected $articleTable;
    
    //the ServiceManager can create an AlbumTable instance for us, we can add a method to the controller to retrieve it.
    public function getArticleTable()
    {
        if (!$this->articleTable) {
            $sm = $this->getServiceLocator();
            $this->articleTable = $sm->get('Article\Model\ArticleTable');
        }
        return $this->articleTable;
    }

    public function indexAction()
    {
    }

    public function ajax_comment_ratingAction()
    {
    }

    public function afficherAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        return new ViewModel([
            'article' => $this->getArticleTable()->getArticle($id),
        ]);
    }

    public function categorieAction()
    {
    }

    public function ajax_ratingAction()
    {
    }
}