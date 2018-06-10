<?php
namespace App\Model;

use App\Model\BaseModel;

class LoginModel extends BaseModel
{
    public function isPost()
    {
        return isPostVarSet('doLogin') === true && getPostVar('doLogin') === '1';
    }

    public function isValidData()
    {
        return (isPostVarSet('username') === true
            || isPostVarSet('password') === true);
    }

    public function onPost()
    {
        if ($this->isValidData() === false) {
            $this->sendStatus('error', 'badData');
            return false;
        }

        $username = getPostVar('username');
        $password = getPostVar('password');
        $userId = $this->_db->loginClient(
            $username,
            $password
        );

        if ($userId == null) {
            $this->sendStatus('error', 'badClient');
            return false;
        }
        
        setSession($userId);
        $this->sendStatus('ok');
        return true;
    }
}
