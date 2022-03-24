<?php
namespace controllers;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\attributes\items\router\Get;
 use models\Product;
 use models\Section;
 use Ubiquity\orm\DAO;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;

/**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    public function initialize() {
        USession::start();
        if(USession::get('Prix') == null) {
            $this->view->setVar('prixP', 0);
        } else {
            $this->view->setVar('prixP', USession::get('Prix'));
        }
        if(USession::get('Total') == null) {
            $this->view->setVar('quantP', 0);
        } else {
            $this->view->setVar('quantP', USession::get('Total'));
        }
        parent::initialize();
    }

    #[Route('_default', name: 'store')]
	public function index() {
        $produits = DAO::getAll(Product::class);
        $nbProduits = count($produits);
        $sections = DAO::getAll(Section::class);
		$this->loadView('StoreController/index.html', ['nbproduits'=>$nbProduits, 'sections'=>$sections]);
	}

	#[Get(path: "store/section/{idSection}",name: "store.section")]
	public function getOneSection($idSection){
        $section = DAO::getById(Section::class, $idSection);
        $title = "Section";
        $sous_title = $section->getName();
        $produits = $section->getProducts();
        $this->loadView('StoreController/afficheProduits.html', ['title'=>$title, 'sous_title'=>$sous_title, 'produits'=>$produits]);
	}

	#[Get(path: "store/allProducts",name: "store.allProducts")]
	public function getAllProducts() {
        $produits = DAO::getAll(Product::class);
        $title = "Tout les Produits";
        $sous_title = count($produits)." références";
        $this->loadView('StoreController/afficheProduits.html',
            ['title'=>$title, 'sous_title'=>$sous_title, 'produits'=>$produits]);
    }



	#[Route(path: "store/addToCart/{idProduit}/{count}",name: "store.addToCart")]
	public function addToCart($idProduit,$count){
        USession::start();
        $product = DAO::getById(Product::class, $idProduit);
        if(USession::get($idProduit) != null) {
            $quantite = USession::get($idProduit) + $count;
        } else {
            $quantite = $count;
        }
        USession::set($idProduit, $quantite);

        if(USession::get('Total') != null) {
            $total = USession::get('Total') + $count;
        } else {
            $total = $count;
        }
        USession::set('Total', $total);

        if(USession::get('Prix') != null) {
            $prix = USession::get('Prix') + $product->getPrice();
        } else {
            $prix = $product->getPrice();
        }
        USession::set('Prix', $prix);
        UResponse::header('location', '/');
	}

}
