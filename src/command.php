<?php



class command
{
    private $CLIENT_ID = '23cabbbdc6cd418abb4b39c32c41195d';
    private $CLIENT_SECRET = "53bc75238f0c4d08a118e51fe9203300";
    private $oauthUrl = "https://oauth.yandex.ru";
    private $baseUrl = "https://api.music.yandex.net";
    private $token;
    private $requestYandexAPI;

    public function __construct($token = "")
    {
        if ($token != "") {
            $this->token = $token;
            $this->requestYandexAPI = new RequestYandexAPI($token);
            $this->updateAccountStatus();
        } else {
            $this->requestYandexAPI = new RequestYandexAPI();
        }
    }

    public function search($text,
                           $noCorrect = false,
                           $type = 'all',
                           $page = 0,
                           $playlistInBest = true
    )
    {
        $url = $this->baseUrl . "/search"
            . "?text=$text"
            . "&nocorrect=$noCorrect"
            . "&type=$type"
            . "&page=$page"
            . "&playlist-in-best=$playlistInBest";

        $response = json_decode($this->get($url))->result;

        return $response;
    }

    private function get($url)
    {
        return $this->requestYandexAPI->get($url);
    }

    private function updateAccountStatus()
    {
        $this->account = $this->accountStatus()->account;
        $this->requestYandexAPI->updateUser($this->account->login);
    }

    public function accountStatus()
    {
        $url = $this->baseUrl . "/account/status";

        $response = json_decode($this->get($url))->result;

        return $response;
    }
}