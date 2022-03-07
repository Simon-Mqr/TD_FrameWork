<?php
namespace controllers;
 use models\Organization;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Post;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\orm\repositories\Repository;
 use Ubiquity\orm\repositories\ViewRepository;
 use Ubiquity\utils\http\URequest;

 /**
  * Controller OrgaController
  */
 #[Route('orga')]
class OrgaController extends \controllers\ControllerBase{
    public ViewRepository $repo;

     public function initialize() {
         parent::initialize();
         $this->repo??=new ViewRepository($this,Organization::class);
     }

    #[Get(name: 'orga.index')]
	public function index(){
        $this->repo->all();
		$this->loadView("OrgaController/index.html");
	}

     #[Route(path: "/getOne/{idOrga}",name: "orga.getOne")]
     public function getOne($idOrga){
         $this->repo->byId($idOrga, ['users', 'groupes']);
         $this->loadView('OrgaController/getOne.html');
     }

     #[Get(path: "add",name: "orga.frmAdd")]
     public function frmAdd(){
         $this->loadView('OrgaController/frmAdd.html');
     }

     #[Post(path: "add",name: "orga.add")]
     public function add(){
         $orga = new Organization();
         URequest::setValuesToObject($orga);
         $nom = $orga->getName();
         if($orga->getName() != "") {
             if (DAO::insert($orga)) {
                 $msg = [
                     "title" => "Ajout Fait",
                     "txt" => $nom." a bien été ajouté" ,
                     "icon" => "smile outline",
                     "color" => "green"
                 ];
                 $this->loadView('OrgaController/msg.html', compact('msg'));
                 $this->index();
             }
         } else {
             $msg = [
                 "title" => "Erreur de Ajout",
                 "txt" => "Une erreur lors de l'ajout s'est produit" ,
                 "icon" => "meh outline",
                 "color" => "red"
             ];
             $this->loadView('OrgaController/msg.html', compact('msg'));
             $this->frmAdd();
         }
     }

     #[Get(path: "/del/{idOrga}",name: "orga.del")]
     public function del($idOrga){
         $orga=DAO::getById(Organization::class,$idOrga);
         $nom = $orga->getName();
         if(DAO::remove($orga)){
             $msg = [
                 "title" => "Suppression Faite",
                 "txt" => $nom." a bien été supprimé" ,
                 "icon" => "smile outline",
                 "color" => "green"
             ];
             $this->loadView('OrgaController/msg.html', compact('msg'));
             $this->index();
         } else {
             $msg = [
                 "title" => "Erreur de Suppression",
                 "txt" => "Une erreur lors de la suppression s'est produite" ,
                 "icon" => "meh outline",
                 "color" => "red"
             ];
             $this->loadView('OrgaController/msg.html', compact('msg'));
             $this->index();
         }
     }

}
