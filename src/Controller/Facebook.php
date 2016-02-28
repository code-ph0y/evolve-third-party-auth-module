<?php
namespace ThirdPartyAuthModule\Controller;

use ThirdPartyAuthModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Facebook extends SharedController
{
    public function dashboardAction(Request $request)
    {
        return $this->render('ThirdPartyAuthModule:index:dashboard.html.php');
    }
}
