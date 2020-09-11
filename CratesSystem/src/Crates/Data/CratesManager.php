<?php

namespace Crates\Data;

use Crates\Loader;

use pocketmine\utils\{Config, TextFormat as TE};
use pocketmine\math\Vector3;

use RuntimeException;

class CratesManager {
	
	/**
	 * @return Array|null
	 */
	public static function getCrates() : ?Array {
		return Loader::$crates;
	}
	
	/**
	 * @param String $crateName
	 * @return void
	 */
	public static function getCrate(String $crateName) : void {
		$crate = null;
		if(isset(Loader::$crates[$crateName])){
			$crate = Loader::$crates[$crateName];
		}
		return $crate;
	}
	
	/**
	 * @param String $crateName
	 * @param Vector3 $position
	 * @param Array $items
	 * @return void
	 */
	public static function addCrate(String $crateName, Array $config) : void {
		Loader::$crates[$crateName] = new Crate($crateName, $config);
	}
	
	/**
	 * @param String $cratesName
	 * @return void
	 */
	public static function deleteCrate(String $crateName) : void {
		if(!isset(Loader::$crates[$crateName])){
			throw new RuntimeException("There is no {$crateName}");
		}
		unset(Loader::$crates[$crateName]);
		$config = new Config(Loader::getInstance()->getDataFolder()."data.yml", Config::YAML);
		$config->remove($crateName);
		$config->save();
	}
}

?>