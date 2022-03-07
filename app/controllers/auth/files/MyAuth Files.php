<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
  * Class MyAuth Files
  */
class MyAuth Files extends AuthFiles{
	public function getViewIndex(): string{
		return "MyAuth /index.html";
	}

	public function getViewInfo(): string{
		return "MyAuth /info.html";
	}

	public function getViewCreate(): string{
		return "MyAuth /create.html";
	}


}
