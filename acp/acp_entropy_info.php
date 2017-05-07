<?php
/**
*
* @package acp
* @copyright (c) 2015 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace TheH\entropy\acp;

/**
* @package module_install
*/

class acp_entropy_info
{
	function module()
	{
		return array(
			'filename'	=> '\TheH\entropy\acp\acp_entropy_module',
			'title'		=> 'ACP_ENTROPY', // define in the lang/xx/acp/common.php language file
			'modes'		=> array(
				'main'		=> array(
					'title'		=> 'ACP_ENTROPY',
					'auth' 		=> 'ext_TheH/entropy && acl_a_user',
					'cat'		=> array('ACP_ENTROPY_GRP')
				),
			),
		);
	}
}
