<?php
namespace ThirdPartyAuthModule\Controller;

use ThirdPartyAuthModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Auth extends SharedController
{
    /**
     * Display that renders example of login with Third Party Authorise
     *
     * @param  Request $request
     * @return mixed
     */
    public function loginWithAction(Request $request)
    {
        // Get application config
        $config = $this->getConfig();

        // Get the third parties from config
        $thirdParties = $config['thirdparties'];

        $activeThirdParties = array();

        // Get the active third parties that are currently configured
        foreach ($thirdParties as $key => $val) {
            if (!empty($val['key']) && !empty($val['secret'])) {
                $activeThirdParties[] = $key;
            }
        }

        return $this->render('ThirdPartyAuthModule:auth:login.html.php');
    }

    /**
     * Authorise with ThirdParty
     *
     * @param  Request $request
     * @return mixed
     */
    public function authoriseAction(Request $request)
    {
        //@todo - Authorise with Third Party no matter what service you use
        
        /*
        $config = $this->getConfig();

        $service = $this->getService('oauth')->authorise(
            $config['fb'],
            $request->getSchemeAndHttpHost()
        );
        */
    }
}
