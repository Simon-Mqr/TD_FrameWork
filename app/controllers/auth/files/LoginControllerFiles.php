<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
  * Class LoginControllerFiles
  */
class LoginControllerFiles extends AuthFiles{
	public function getViewCreate(): string{
		return "LoginController/create.html";
	}

	public function getViewDisconnected(): string{
		return "LoginController/disconnected.html";
	}

	public function getViewIndex(): string{
		return "LoginController/index.html";
	}


}
