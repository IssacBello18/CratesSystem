<?php

namespace Crates\Data;

use Crates\Loader;

use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\utils\TextFormat as TE;
use pocketmine\item\{Item, ItemIds};

class Crates {
	
	/** @var Loader */
	protected $plugin;
	
	/** @var String */
	protected $crateName = "";
	
	 /** @var Vector3 */
	protected $position = null;
	
	/** @var array */
	protected $items = [];
	
	/**
	 * @param String $crateName
	 * @param Vector3 $position
	 * @param Array $items
	 */
	public function __construct(String $crateName, Array $config){
		$this->crateName = $crateName;
		$this->position = $config["position"];
		$this->items = $config["items"];
	}
	
	/**
	 * @return String|null
	 */
	public function getName() : ?String {
		return $this->crateName;
	}
	
	/**
	 * @return Vector3|null
	 */
	public function getPosition() : ?Vector3 {
		return new Vector3($this->position[0], $this->position[1], $this->position[2], $this->position[3]);
	}
	
	/**
	 * @return Array|null
	 */
	public function getItems() : ?Array {
		return $this->items;
	}
}

?>