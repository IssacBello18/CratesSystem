<?php

namespace Crates\provider;

use Crates\Loader;
use Crates\Data\CratesManager;

use pocketmine\utils\{Config, TextFormat as TE};
use pocketmine\math\Vector3;

class YamlProvider {
	
	/**
	 * @return void
	 */
	public static function save() : void {
		if(count(Loader::$crates) === 0){
			Loader::getInstance()->getLogger()->debug("Nothing was saved the array is empty!");
			return;
		}
		$config = new Config(Loader::getInstance()->getDataFolder()."data.yml", Config::YAML);
		$config->setAll(Loader::$crates);
		$config->save();
		Loader::getInstance()->getLogger()->info("The configuration was saved correctly!");
	}
	
	/**
	 * @return void
	 */
	public static function init() : void {
		$config = new Config(Loader::getInstance()->getDataFolder()."data.yml", Config::YAML);
		if(empty($config)){
			Loader::getInstance()->getLogger()->debug("Cannot load configuration is empty!");
			return;
		}
		foreach($config->getAll() as $crateName => $values){
			CratesManager::addCrate($crateName, $values);
			Loader::getInstance()->getLogger()->info("The configuration was loaded correctly!");
		}
	}
}

?>