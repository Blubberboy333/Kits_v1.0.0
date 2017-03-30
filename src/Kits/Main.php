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
		if(!(is_dir($this->getDataFolder()."Kits/"))){
			@mkdir($this->getDataFolder()."Kits/");
			$this->getLogger()->info(TextFormat::YELOW . "Made directory for kits...");
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
		
	}
			   
	public function delKit($name){
		
	}
			   
	public function addPlayer($player, $kit){
		
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
