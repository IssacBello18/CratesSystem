<?php

namespace Crates;

use Crates\Data\CratesManager;

use pocketmine\utils\TextFormat as TE;
use pocketmine\command\{CommandSender, PluginCommand};
use pocketmine\{Player, Server};

class Command extends PluginCommand {
	
	/** @var Loader */
	protected $plugin;
	
	/**
	 * Command Consructor.
	 * @param Loader $plugin
	 */
	public function __construct(Loader $plugin){
		parent::__construct("crates", $plugin);
		$this->plugin = $plugin;
	}
	
	/**
	 * @param CommandSender $sender
	 * @param String $commandLabel
	 * @param Array $args
	 * @return void
	 */
	public function execute(CommandSender $sender, String $commandLabel, Array $args) : void {
		if(count($args) === 0){
			$sender->sendMessage(TE::RED."You don't have enough arguments!");
			return;
		}
		$permission = Loader::getDataConfig("permission") === null ? "use.command.crates" : Loader::getDataConfig("permission");
		if($sender->hasPermission($permission)){
			$sender->sendMessage(TE::RED."You do not have permission to use this command");
			return;
		}
		switch($args[0]){
			case "create":
			if(empty($args[1])){
				$sender->sendMessage(TE::RED."Use: /crates {$args[0]} <crateName>");
				return;
			}
			CratesManager::addCrate($args[1], ["items" => $sender->getInventory()->getContents(), "position" => [$sender->getPosition->getFloorX(), $sender->getPosition()->getFloorY(), $sender->getPosition()->getFloorZ(), $sender->getLevel()]]);
			$sender->sendMessage(TE::GREEN."Create the crate ".TE::GOLD."{$args[1]}".TE::GREEN." correctly!");
			break;
			case "delete":
			if(empty($args[1])){
				$sender->sendMessage(TE::RED."Use: /crates {$args[0]} <crateName>");
				return;
			}
			CratesManager::deleteCrate($args[1]);
			$sender->sendMessage(TE::GREEN."Delete the crate ".TE::GOLD."{$args[1]}".TE::GREEN." correctly!");
			break;
			case "spawn":
			break;
		}
	}
}

?>