<?php 

declare(strict_types=1);

namespace GameMode;

use pocketmine\plugin\PluginBase as P;
use pocketmine\event\Listener as L;
use pocketmine\utils\TextFormat as TF; 

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\item\Item;
use pocketmine\inventory\Inventory;

class Main extends P implements L {
	
	public function onEnable() : void{
		$this->getLogger()->notice(base64_decode("VGhlIFBsdWdpbiBDcmVhdGUgQnkgTGFpdGhZb3V0dWJlciBDb3B5cmlnaHQgMjAxOSBMYWl0aFlU"));
		$this->getLogger()->info(" Aktiviert ");
		$this->getLogger()->info(" GameModeUI Aktiviert ");
	}
	
	public function onDisable() {
		$this->getLogger()->info(" GameModdUI Deaktiviert ");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch($cmd->getName()){
			case "gm":
				if($sender instanceof Player){
					$this->OpenUI($sender);
				}
			break;
		}
		return true;
	}
	
	public function GM0($player){
		$player->setGamemode(0);
		$player->sendMessage(TF::GREEN . "§b§lSystem §r§7» §aDu bist nun im GameMode 0");
	}
	
	public function GM1($player){
		$player->setGamemode(1);
		$player->sendMessage(TF::GREEN . "§b§lSystem §r§7» §aDu bist nun im GameMode 1");
	}
	public function GM2($player){
		$player->setGamemode(2);
		$player->sendMessage(TF::GREEN . "§b§lSystem §r§7» Du bist nun im GameMode 2");
	}
	
	public function GM3($player){
		$player->setGamemode(3);
		$player->sendMessage(TF::GREEN . "§b§lSystem §r§7» §aDu bist nun im GameMode 3");
	}
	
	public function OpenUI($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
		$result = $data;
		if($result === null){
			return true;
			}
			 switch($result){
				case 0:
					$this->GM0($player);
				break;
				
				case 1:
					$this->GM1($player);
				break;
				
				case 2:
					$this->GM2($player);
				break;
				
				case 3:
					$this->GM3($player);
				break;
				}
		});
		$form->setTitle("§a§lGameMode");
		$form->setContent("§6Wähle dein gewünschten GameMode aus:");
		$form->addButton("§cÜberleben\n GameMode 0");
		$form->addButton("§9Kreativ\n GameMode 1");
    $form->addButton("§eAbenteuer\n GameMode 2");
		$form->addButton("§aZuschauer\n GameMode 3");
		$form->sendToPlayer($player);
		return $form;
	 }
}
