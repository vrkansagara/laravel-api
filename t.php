<?php

class ApiEndpoints {


    public function getEndpoint()
    {
        $configJson = 'config.json';

        return $api_endpoint . $version; //"https://api.vrkansagara.in/api/v1/"
    }


    public function loginController()
    {
        $this->getEndpoint() . $constant['LOGIN']

    }
}
