<?php
namespace ThirdPartyAuthModule\Controller;

use ThirdPartyAuthModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Facebook extends SharedController
{
    public function authenticateAction(Request $request)
    {
        // Get configuration
        $config = $this->getConfig();

        $fb = $this->getService('fb.auth')->authenticate(
            $config['fb'],
            $request->getSchemeAndHttpHost()
        );

        return $this->render('ThirdPartyAuthModule:index:dashboard.html.php');
    }
}
