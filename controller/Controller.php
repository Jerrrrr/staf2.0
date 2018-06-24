<?php

class Controller {

	public $route;
	protected $viewVars = array();

	public function filter() {
		call_user_func(array($this, $this->route['action']));
	}

	public function render() {
		$this->setSessionMessages();
		$this->createViewVarWithContent();
		$this->renderInLayout();
		$this->unsetSessionMessages();
	}

	public function set($variableName, $value) {
		$this->viewVars[$variableName] = $value;
	}

	private function setSessionMessages() {
		if(!empty($_SESSION['info'])) $this->set('info', $_SESSION['info']);
		if(!empty($_SESSION['error'])) $this->set('error', $_SESSION['error']);
	}

	private function unsetSessionMessages() {
		if(!empty($_SESSION['info'])) unset($_SESSION['info']);
		if(!empty($_SESSION['error'])) unset($_SESSION['error']);
	}

	public function redirect($url) {
		header("Location: {$url}");
		exit();
	}

	private function createViewVarWithContent() {
		extract($this->viewVars, EXTR_OVERWRITE);
		ob_start();
		require WWW_ROOT . 'view' . DS . strtolower($this->route['controller']) . DS . $this->route['action'] . '.php';
		$content = ob_get_clean();
		$this->set('content', $content);
	}

	private function renderInLayout() {
		extract($this->viewVars, EXTR_OVERWRITE);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo $content;
		} else {
			include WWW_ROOT . 'view' . DS . 'layout.php';	
		}
	}


}