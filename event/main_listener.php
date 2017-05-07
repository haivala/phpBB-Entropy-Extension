<?php
/**
 *
 * @package phpBB Extension - Entropy
 * @copyright (c) 2017 TheH - http://entopy.fi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace TheH\entropy\event;
use phpbb\controller\helper;
use phpbb\request\request_interface;
use phpbb\user;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{

    /** @var config */
    protected $config;
    /** @var user */
    protected $user;
    /** @var template */
    protected $template;

    /**
     * Constructor
     * @param \phpbb\config  $config     Config object
     * @param \phpbb\user    $user       User object
     * @param \phpbb\template\template $template Template object
     *
     */
    public function __construct(\phpbb\config\config $config,\phpbb\user $user, \phpbb\template\template $template)
    {
        $this->config       = $config;
        $this->user         = $user;
        $this->template     = $template;
    }

    /**
     * @return array
     */
    static public function getSubscribedEvents()
    {
        return array(
            'core.submit_post_end'    => 'insert_posting',
            'core.page_header'        => 'add_vat_link',
        );
    }

    /**
     * Add a VAT link
     *
     * @param \phpbb\event\data $event The event object
     */
    public function add_vat_link($event)
    {
        $this->template->assign_vars(array(
            'SHOW_VAT' => $this->config['entropy_vat']
        ));
    }

    /**
     * @param Event $event
     */
    public function insert_posting($event)
    {
        if($event["mode"]!='edit' || $event['data']["post_edit_reason"]!=''){
            $botname = $this->config['entropy_botnick'];
            $botimg = $this->config['entropy_botimg'];
            $botchannel = $this->config['entropy_botchannel'];
            $board_url = generate_board_url() . '/';
            $reason ='';
            $mention ='';

            $user = $this->user->data['username'];
            $forum = '<'.$board_url.'viewforum.php?f='.$event["data"]["forum_id"].'|'.$event["data"]["forum_name"].'>';
            $post = '<'.$board_url.'viewtopic.php?f='.$event["data"]["forum_id"].'&t='.$event["data"]["topic_id"].'#p'.$event["data"]["post_id"].'|'.$event["data"]["topic_title"].'> by `'.$user.'`';
            $posttext = $event['data']['message'];
            $found = preg_match_all("/@\w+/", $posttext, $matches);
            if($found){
                $mention = ", mentioned:";
                foreach ($matches[0] as $match) {
                    $mention .= ' '.$match;
                }
                $mention.='.';
            }
            if ($event['data']["post_edit_reason"]){
                $reason .= ', because:'. $event['data']["post_edit_reason"];
            }
            if ($this->config['entropy_botchannel']){
                $channel = '"channel":"'.$this->config['entropy_botchannel'].'",';
            }
            $payload = '{"username":"'.$botname.'",'.$channel.'"icon_url":"'.$botimg.'",
                "text":"'.strtoupper($event["mode"]).': **Forum**: '.$forum.' **Post**: '.$post.''.$reason.''.$mention.'"}';
            $this->sendmessage($payload);
        }   
    }

    /**
     * @param Message $payload
     */
    public function sendmessage($payload){
        $xcURL = $this->config['entropy_webhook'];
        $curl = curl_init($xcURL);
        $cOptArr = array (
            CURLOPT_URL => $xcURL,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => 0,
            CURLOPT_POST => 1
        );
        $rc = curl_setopt_array ($curl, $cOptArr);
        $rc = curl_setopt ($curl, CURLOPT_POSTFIELDS, http_build_query (array ('payload' => $payload)));
        $rc = curl_exec ($curl);
        curl_close ($curl);
    }
}
