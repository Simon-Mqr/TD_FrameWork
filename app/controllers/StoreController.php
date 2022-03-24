<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
 use models\Product;
 use models\Section;
 use Ubiquity\orm\DAO;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    #[Route('_default', name: 'store')]
	public function index() {
        $produits = DAO::getAll(Product::class);
        $nbProduits = count($produits);
        $sections = DAO::getAll(Section::class);
		$this->loadView('StoreController/index.html', ['nbproduits'=>$nbProduits, 'sections'=>$sections]);
	}

	#[Get(path: "store/section/{idSection}",name: "store.section")]
	public function getOneSection($idSection){
        $sections = DAO::getById(Section::class, $idSection);
        $this->loadView('StoreController/getOneSection.html', ['sections'=>$sections]);
	}

	#[Get(path: "store/allProducts",name: "store.getAllProducts")]
	public function getAllProducts(){
        $produits = DAO::getAll(Product::class);
        $this->loadView('StoreController/getAllProducts.html', ['produits'=>$produits]);
	}

}
