<?php namespace GrahamCampbell\BootstrapCMS\Commands;

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use Symfony\Component\Console\Input\InputArgument;

class QueueIron extends AppCommand {

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'queue:iron';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Setups up IronMQ subscriptions';

    /**
     * Run the commend.
     *
     * @return void
     */
    public function fire() {
        $this->ironQueue($this->input->getArgument('url'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
            array('url', InputArgument::VALUE_REQUIRED, 'The base url of your site without a slash')
        );
    }
}
