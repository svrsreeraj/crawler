<?php

include 'curl.php';
include 'simple_html_dom.php';

class Scorer
{

    private $curl;
    private $dom;
    private $content;
    private $messageSubject = "Hey";
    private $messageContent = "Hey Nice to see you here :)";

    const LOGIN_URL        = "";
    const SEARCH_URL       = "";
    const SEARCH_PAGE_URL  = "";
    const SEARCH_NEXT_URL  = "";
    const USERNAME         = "";
    const PASSWORD         = "";
    const POST_MAX_COUNT   = 90;

    public function __construct ()
    {
        $this->curl = new Curl();
    }

    public function postAll ()
    {
        $this->curl         = new Curl();
        $this->makeMeLoggedIn();
        $fData              = "";
		$this->postMessage($profile);
        
    }

    private function postMessage ($uid)
    {
        $profileId = end(explode("-", $uid));
        $postUrl   = self::SEND_MESSAGE_URL . $profileId;
        sleep(2);
        $content   = $this->post($postUrl, $this->getPostMessageData($profileId));
        echo "$uid Message posted !!! \n";
        return $content;
    }

    private function makeMeLoggedIn ()
    {
        $this->post(self::LOGIN_URL, $this->getLoginData());
        sleep(1);
    }


    private function get ($url)
    {
        $this->content = $this->curl->get($url);
        $this->treatPage($this->content);
        return $this->content;
    }

    private function post ($url, $data)
    {
        $this->content = $this->curl->postRequest($url, $data);
        $this->treatPage($this->content);
        return $this->content;
    }

    private function treatPage ($content)
    {
        return true;
    }

    private function getLoginData ()
    {
        return array(
            'txtusername' => self::USERNAME,
            'txtpassword' => self::PASSWORD
        );
    }

    private function getPostMessageData ($profileId)
    {
        return array(
            'frm'          => "",
            'chknotify'    => '0',
            'chkinclude'   => "0",
            'txtsubject'   => $this->messageSubject,
            'txtrecipient' => $profileId,
            'txtmessage'   => $this->messageContent,
            'btnsend'      => 'Send'
        );
    }

   

}

?>
