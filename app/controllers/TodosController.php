<?php
namespace controllers;
use Ajax\php\ubiquity\JsUtils;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  * @property JsUtils $jquery
  */
class TodosController extends \controllers\ControllerBase{
    use WithAuthTrait;
    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    public function initialize() {
        $this->loadView("main/vHeader.html");
        $this->loadView("main/vMenu.html");
    }

    public function finalize() {
        $this->loadView("main/vFooter.html");
    }

    private function displayList(array $list) {
        $this->loadView('TodosController/displayList.html', compact('list'));
    }

	#[Post(path: "todos/add",name: "todos.add")]
	public function addElement() {
		$list = uSession::get(self::LIST_SESSION_KEY, []);
        $newElement = URequest::post('elm');
        $list[] = $newElement;
        USession::set(self::LIST_SESSION_KEY, $list);
        $this->displayList($list);
	}

	#[Get(path: "todo/delete/{index}",name: "todos.delete")]
	public function deleteElement($index) {
		$list=USession::get('active-list', []);
        unset($list[$index]);
        USession::set('list', array_values($list));
        $this->displayList($list);
	}

	#[Post(path: "todos/edit/{index}",name: "todos.edit")]
	public function editElement($index) {
		
	}

	#[Get(path: "todos/loadList/{uniqid}",name: "todos.loadList")]
	public function loadList($uniqid) {
		
	}

	#[Post(path: "todos/loadList",name: "todos.loadListPost")]
	public function loadListFromFrom() {
		
	}

	#[Get(path: "todos/new",name: "todos.new")]
	public function newlist($force=false) {
		if($force) {
            true;
        }
	}

	#[Get(path: "todos/save",name: "todos.save")]
	public function saveList() {
		
	}

    #[Route(path: "_default",name: "home")]
    public function index() {
        $this->loadView("TodosController/index.html");
        if(USession::exists(self::ACTIVE_LIST_SESSION_KEY)){
            $list=USession::get('list',[]);
            $this->displayList($list);
        } else {
            $this->newlist();
        }
    }

    protected function getAuthController(): AuthController {
        return new MyAuth($this);
    }
}
