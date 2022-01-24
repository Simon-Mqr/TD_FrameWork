<?php
namespace controllers;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
 /**
  * Controller TodosController
  */
class TodosController extends \controllers\ControllerBase{
    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    #[Route(path: "_default",name: "home")]
	public function index(){
		
	}

	#[Post(path: "todos/add",name: "todos.add")]
	public function addElement(){
		
	}


	#[Get(path: "todo/delete/{index}",name: "todos.delete")]
	public function deleteElement($index){
		
	}


	#[Post(path: "todos/edit/{index}",name: "todos.edit")]
	public function editElement($index){
		
	}


	#[Get(path: "todos/loadList/{uniqid}",name: "todos.loadList")]
	public function loadList($uniqid){
		
	}


	#[Post(path: "todos/loadList",name: "todos.loadListPost")]
	public function loadListFromFrom(){
		
	}


	#[Get(path: "todos/new",name: "todos.new")]
	public function newlist($force=false){
		
	}

	#[Get(path: "todos/save",name: "todos.save")]
	public function saveList(){
		
	}

}
