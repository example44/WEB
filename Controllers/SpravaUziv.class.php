<?php


class SpravaUziv implements IController
{
    private $userMan;
    private $tplData;

    public function __construct()
    {
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS . "/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => "",
            "alert" => ""
        );
    }

    public function show()
    {
        if ($this->userMan->isUserLogged()) {
            $this->tplData['uzivatel']['username'] = $this->userMan->getLoggedUserData()['username'];
            $this->tplData['uzivatel']['role'] = $this->userMan->getLoggedUserData()['id_ROLE'];
        } else {
            $this->tplData['uzivatel']['role'] = 0;
        }
        if (isset($_POST['action']) && $_POST['action'] == 'odhlaseni') {
            $this->userMan->userLogout();
            $GLOBALS['alert'] = "OK: Uživatel byl odhlášen.";
            header("Location: index.php?page=uvodni");
        }

        $this->tplData['vse_role'] = $this->userMan->getAllRole();
        $this->tplData['users'] = $this->userMan->getAllusers();
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                $this->userMan->deleteUser($_POST['user_del']);
                $GLOBALS['alert'] = "OK: Uživatel byl smazan.";
                header("Location: index.php?page=spravaUziv");
            } elseif ($_POST['action'] == 'save') {
                $this->userMan->zmenRole($_POST['user_up'], $_POST['nova_role']);
                $GLOBALS['alert'] = "OK: Role byla změněna.";
                header("Location: index.php?page=spravaUziv");
            } elseif ($_POST['action'] == 'blok') {
                if ($_POST['status'] == 1) {
                    $this->userMan->zmenaStat($_POST['id_user'], 0);
                    header("Location: index.php?page=spravaUziv");
                } else {
                    $this->userMan->zmenaStat($_POST['id_user'], 1);
                    header("Location: index.php?page=spravaUziv");
                }
            }
         }
        return $this->tplData;
    }
}