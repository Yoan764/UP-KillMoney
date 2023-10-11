<?php
namespace yoan\up\Events;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use yoan\up\Loader;

class Killmoney implements Listener{

    public function killmoney(PlayerDeathEvent $event){
        $config = Loader::getInstance()->getConfig();
        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent){
            $killer = $cause->getDamager();
            if($player instanceof Player and $killer instanceof Player){
                if($config->get("Reward-type") === "Fix"){
                    EconomyAPI::getInstance()->addMoney($killer, $config->get("Reward-fix-amount"));
                    $killer->sendPopup(str_replace("{amount}", $config->get("Reward-fix-amount"), $config->get("Reward-message")));
                }elseif($config->get("Reward-type") === "Random"){
                    $min = $config->get("Reward-random-min");
                    $max = $config->get("Reward-random-max");
                    $amount = random_int($min, $max);
                    EconomyAPI::getInstance()->addMoney($killer, $amount);
                    $killer->sendPopup(str_replace("{amount}", $amount, $config->get("Reward-message")));
                    }
                }
            }
        }
    }
