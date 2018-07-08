<?php

namespace Kits;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase as Base;

class Main extends PluginBase {
	public function onEnable(){
		// [0] = chest, [1] = legs, [2] = weapon
		$this->default = array($this->getConfig()->get("DefaultChest"), $this->getConfig()->get("DefaultLegs"), $this->getConfig()->get("DefaultWeapon"));
		if(!(is_dir($this->getDataFolder()."Kits/"))){
			@mkdir($this->getDataFolder()."Kits/");
			$this->getLogger()->info(TextFormat::YELOW . "Made directory for kits...");
		}
		if(!(file_exists($this->getDataFolder()."Kits/"."Default.yml")){
			$file = new Config($this->getDataFolder()."Kits/"."Default.yml", Config::YAML);
			$file->set("Chest", $this->default[0]);
			$file->set("Legs", $this->default[1]);
			$file->set("Weapon", $this->default[2]);
			$file->save();
		}
		$this->saveDefaultConfig();
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED . "Kits disabled")
	}
	
	public function sendList($player){
		$player = $this->getServer()->getPlayerByName($player);
		$kits = array();
		foreach(scandir($this->getDataFolder()."Kits/") as $b){
			$file = new Config($this->getDataFolder()."Kits/".$b);
			if(in_array($file->get("Players"), $player->getName()){
				array_push($file->get("Name"));
			}
		}
		$player->sendMessage(TextFormat::GREEN . "Kits:");
		foreach($kits as $i){
			$player->sendMessage($i);
		}
	}
	
	public function makeKit($name){
		$file = new Config($this->getDataFolder()."Kits/".$name.".yml", Config::YAML);
		$file->set("Chest", $this->default[0]);
		$file->set("Legs", $this->default[1]);
		$file->set("Weapon", $this->default[2]);
		$file->set("Players", array());
		$file->save();
	}
			   
	public function delKit($name){
		unlink($this->getDataFolder()."Kits/".$name.".yml");
		$this->getLogger()->info(TextFormat::YELLOW."Kit ".$name." was deleted");
	}
			   
	public function addPlayer($player, $kit){
		if(!($kit == strtolower("--all"))){
			
		}
	}
	
	public function delPlayer($player, $kit){
		
	}
			   
	public function checkPlayer($player, $kit){
		
	}
			   
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if(strtolower($command->getName() == "kits")){
			if(!(isset($args[0])){
				$this->sendList($sender->getName());
			}elseif(strtolower($args[0] == "list")){
				$this->sendList($sender->getName());
			}
		}
	}		
}
