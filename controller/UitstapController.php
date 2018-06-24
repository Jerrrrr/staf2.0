<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'WeekDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'UitstapDAO.php';

class UitstapController extends Controller {


	private $userDAO;
	private $weekDAO;
    private $kinderenDAO;
    private $uitstapDAO;

	function __construct() {

		$this->userDAO = new UserDAO();
		$this->weekDAO = new WeekDAO();
        $this->kinderenDAO = new KinderenDAO();
        $this->uitstapDAO = new UitstapDAO();
	}


	public function index(){

	}

	public function detail(){

	}

	public function addChild(){

	}

	public function addEdit(){

	}


}
