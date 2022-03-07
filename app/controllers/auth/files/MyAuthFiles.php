<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
  * Class MyAuthFiles
  */
class MyAuthFiles extends AuthFiles{
	public function getViewCreate(): string{
		return "MyAuth/create.html";
	}

	public function getViewIndex(): string{
		return "MyAuth/index.html";
	}

	public function getViewDisconnected(): string{
		return "MyAuth/disconnected.html";
	}


}
