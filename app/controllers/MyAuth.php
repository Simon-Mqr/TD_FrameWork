<?php
namespace controllers;
use models\Organization;
use models\User;
use Ubiquity\orm\DAO;
use Ubiquity\utils\flash\FlashMessage;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use controllers\auth\files\MyAuthFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\attributes\items\router\Route;

#[Route(path: "/login",inherited: true,automated: true)]
class MyAuth extends \Ubiquity\controllers\auth\AuthController{

    protected function onConnect($connected)
    {
        $urlParts = $this->getOriginalURL();
        USession::set($this->_getUserSessionKey(), $connected);
        if (isset($urlParts)) {
            $this->_forward(implode("/", $urlParts));
        } else {
            UResponse::header('Location', '/');
        }
    }

    protected function _connect()
    {
        if (URequest::isPost()) {
            $email = URequest::post($this->_getLoginInputName());
            $password = URequest::post($this->_getPasswordInputName());
            $user = DAO::getOne(User::class, 'email= ?', false, [$email]);
            if ($user != null) {
                if(URequest::password_verify('password', $user->getPassword())) {
                    USession::set('idOrga', $user->getOrganization());
                    return $user;
                }
            } else {
                return null;
            }
        }
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
     */
    public function _isValidUser($action = null): bool
    {
        return USession::exists($this->_getUserSessionKey());
    }

    public function _getBaseRoute(): string
    {
        return '/login';
    }

    protected function hasAccountCreation(): bool
    {
        return true;
    }

    protected function _newAccountCreationRule(string $accountName): ?bool
    {
        return array_search($accountName, ['admin', 'root']) === false;
    }

    protected function _create(string $login, string $password): ?bool
    {
        if (!DAO::exists(User::class, 'email= ?', [$login])) {
            $user = new User();
            $user->setEmail($login);
            $user->setFirstname(URequest::post('prenom'));
            $user->setLastname(URequest::post('nom'));
            $user->setPassword(\password_hash($password, PASSWORD_DEFAULT));
            $user->setOrganization(DAO::getOne(Organization::class, 'id= ?', false, [1]));
            DAO::insert($user);
            return true;
        } else {
            return false;
        }
    }

    public function _displayInfoAsString(): bool
    {
        return true;
    }

    protected function noAccessMessage(FlashMessage $fMessage)
    {
        $fMessage->setTitle('Accès interdit !');
        $fMessage->setContent('Vous n\'êtes pas autorisé à accéder à cette page(/).');
    }

    protected function terminateMessage(FlashMessage $fMessage)
    {
        $fMessage->setTitle('Fermeture');
        $fMessage->setContent('Vous avez été correctement déconnecté de l\'application.');
    }

    protected function badLoginMessage(FlashMessage $fMessage)
    {
        $fMessage->setTitle('Problème de connexion !');
        $fMessage->setContent('Identifiants invalide.');
    }

    protected function getFiles(): AuthFiles{
		return new MyAuthFiles();
	}

}


