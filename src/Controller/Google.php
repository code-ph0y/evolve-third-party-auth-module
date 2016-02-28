<?php
namespace ThirdPartyAuthModule\Controller;

use ThirdPartyAuthModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Google extends SharedController
{
    public function indexAction(Request $request)
    {
        return $this->render('ThirdPartyAuthModule:index:index.html.php');
    }
}
