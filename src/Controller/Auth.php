<?php
namespace ThirdPartyAuthModule\Controller;

use ThirdPartyAuthModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Auth extends SharedController
{
    public function loginAction(Request $request)
    {
        return $this->render('ThirdPartyAuthModule:auth:login.html.php');
    }
}
