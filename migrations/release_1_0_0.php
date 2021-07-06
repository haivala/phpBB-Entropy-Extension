<?php
/**
*
* Entropy extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 Harri Häivälä <http://www.entropy.fi>>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace haivala\entropy\migrations;

/**
* Primary migration
*/

class release_1_0_0 extends \phpbb\db\migration\migration
{
    public function update_data()
    {
        return array(
            array('config.add', array('entropy_version', '1.0.0')),
            // Add ACP extension category
            array('module.add', array(
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_CAT_ENTROPY',
            )),

            // Add ACP preferences module
            array('module.add', array(
                'acp',
                'ACP_CAT_ENTROPY',
                array(
                    'module_basename'   => '\haivala\entropy\acp\acp_entropy_module',
                    'modes' => array('main'),
                ),
            )),
        );
    }

    //lets create the needed table
    public function update_schema()
    {
        return array(
            'add_tables'    => array(
                $this->table_prefix . 'entropy'		=> array(
                    'COLUMNS'		=> array(
                        'id'            => array('UINT', null, 'auto_increment'),
                        'webhook'	    	=> array('VCHAR:50', 0),
                        'bot_name'	    	=> array('VCHAR:32', 0),
                        'bot_img'	    	=> array('VCHAR:50', 0),
                        'bot_channel'		=> array('VCHAR:32', 0),
                        'vat'	        	=> array('BOOL', 1)
                    ),
                    'PRIMARY_KEY'    => 'id',
                )
            ),
        );
    }

    public function revert_schema()
    {
        return array(
            'drop_tables'		=> array(
                $this->table_prefix . 'entropy'
            ),
        );
    }
}
