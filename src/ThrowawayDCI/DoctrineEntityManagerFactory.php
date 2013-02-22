<?php

/**
 * @package ThrowawayDCI
 */

namespace ThrowawayDCI;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Simple doctrine entity manager builder.
 * 
 * It reads the db configuration file, maps the folder where the annotated entities are stored
 * and sets up a new entity manager
 * 
 * @author Kpacha <kpacha666@gmail.com>
 */
class DoctrineEntityManagerFactory
{

    public static function create()
    {
        $dbRawConfig = file_get_contents(CONFIG_PATH . '/db.json');
        if(!$dbRawConfig){
            //TODO: throw an exception
            //but by now, should we die here?
            return null;
        }
        $dbParameters = json_decode($dbRawConfig, true);
        if(!$dbRawConfig){
            //TODO: throw an exception
            //but by now, should we die here?
            return null;
        }
        $paths = array(APP_PATH . '/Data');
        $environment = (DEBUG_MODE) ? "development" : "production";

        $config = Setup::createAnnotationMetadataConfiguration($paths, DEBUG_MODE);
        return EntityManager::create($dbParameters[$environment], $config);
    }

}
