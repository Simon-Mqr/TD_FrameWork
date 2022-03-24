<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
  * Class AuthController Files
  */
class AuthController Files extends AuthFiles{
	public function getViewCreate(): string{
		return "AuthController /create.html";
	}

	public function getViewDisconnected(): string{
		return "AuthController /disconnected.html";
	}

	public function getViewIndex(): string{
		return "AuthController /index.html";
	}


}
