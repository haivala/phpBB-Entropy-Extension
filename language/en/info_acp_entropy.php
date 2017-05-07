<?php

/**
*
* Entropy [English]
*
* @package language
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ENTROPY_CONTROL'	=> 'Entropy',
	'ENTROPY_EXPLAIN'	=> 'From here you can change some entropy extension settings',
	'ENTROPY_WEBHOOK'	=> 'Incoming webkook url',
	'ENTROPY_WEBHOOK_EXPLAIN'	=> 'Url for the Mattermost/Slack incoming hook',
	'ENTROPY_BOTNICK'	=> 'Bot nick',
	'ENTROPY_BOTNICK_EXPLAIN'	=> 'The bot nick used in Mattermost/Slack',
    'ENTROPY_BOTIMGURL'	=> 'Url to bot img',
    'ENTROPY_BOTIMGURL_EXPLAIN' => 'The bot avatar image used in Mattermost/Slack',
    'ENTROPY_BOT_CHANNEL'	=> 'The bot channel',
    'ENTROPY_BOT_CHANNEL_EXPLAIN' => 'The bot channel in Mattermost/Slack',
    'SHOW_VAT' => 'Show View Active Topics link',
    'SHOW_VAT_EXPLAIN' => 'Adds View Active Topics link before main breadcrumb navigation',
    'ACP_CAT_ENTROPY'   => 'Entropy',
	'ACP_ENTROPY_GRP'	=> 'Settings',
	'ACP_ENTROPY'	=> 'Settings',
	'CONFIRM_MESSAGE'	=> 'Changes saved!<br><br><a href="%1$s">Back</а>',
));
