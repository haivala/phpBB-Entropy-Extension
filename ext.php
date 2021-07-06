<?php
/**
*
*  Entropy Extension.
*
*  @copyright (c) 2015 Harri Häivälä
*  @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace haivala\entropy;

class ext extends \phpbb\extension\base
{
    /**
    * Enable extension if phpBB minimum version requirement is met
    *
    * Requires phpBB 3.2
    *
    * @return bool
    * @aceess public
    */
    public function is_enableable()
    {
        $config = $this->container->get('config');
        return phpbb_version_compare($config['version'], '3.2', '>=');
    }
}
