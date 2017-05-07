<?php
/**
*
* @package Entropy
* @copyright (c) 2017 TheH
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/

namespace TheH\entropy\acp;

/**
* @package acp
*/

class acp_entropy_module
{
	function main($id, $mode)
	{
		global $db, $config, $template, $request, $table_prefix, $phpbb_root_path;
		global $language, $phpbb_container;

		$language = $phpbb_container->get('language');
		//Define extension path (we will need it)
		$ext_path =  $phpbb_root_path . 'ext/TheH/entropy/';

		$this->tpl_name = 'acp_entropy';
		$this->page_title = 'ACP_ENTROPY';

		if ($request->is_set_post('submit'))
		{
            $entropy = $request->variable('entropy', array('' => ''));
			foreach ($entropy as $id => $var)
			{
                $config->set($id, $var);
            }
			trigger_error($language->lang('CONFIRM_MESSAGE', $this->u_action));
		}

		$template->assign_vars(array(
            'ENTROPY_WEBHOOK'	=> $config['entropy_webhook'],
			'ENTROPY_BOTNICK'	=> $config['entropy_botnick'],
			'ENTROPY_BOTIMG'	=> $config['entropy_botimg'],
			'ENTROPY_BOTCHANNEL'	=> $config['entropy_botchannel'],
			'SHOW_VAT'	=> $config['entropy_vat'],
		));
	}
}
