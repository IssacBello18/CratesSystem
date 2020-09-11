<?php

namespace Crates;

use Crates\provider\YamlProvider;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TE;

use RuntimeException;

class Loader extends PluginBase {
	
	/** @var Interface */
	protected static $instance = null;
	
	/** @var array */
	public static $crates = [];
	
	/**
	 * @return void
	 */
	public function onLoad() : void {
		self::$instance = $this;
	}
	
	/**
	 * @return void
	 */
	public function onEnable() : void {
		YamlProvider::init();
	}
	
	/**
	 * @return void
	 */
	public function onDisable() : void {
		YamlProvider::save();
	}
	
	/**
	 * @return Config|null
	 */
	public static function getDataConfig($configuration) : ?Config {
		return self::getInstance()->getConfig()->get($configuration);
	}
	
	/**
	 * @return Config|null
	 */
	public static function getConfiguration($configuration) : ?Config {
		return new Config(self::getInstance()->getDataFolder()."{$configuration}".".yml", Config::YAML);
	}
	
	/**
	 * Returns values ​​of the main class
	 * @return Loader[]
	 */
	public static function getInstance() : Loader {
		if(self::$instance === null){
			throw new RuntimeException("Loader > Could not create instance of variable!");
		}
		return self::$instance;
	}
}

?>