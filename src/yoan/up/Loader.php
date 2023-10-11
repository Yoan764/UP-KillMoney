<?php
namespace yoan\up;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use yoan\up\Events\Killmoney;

class Loader extends PluginBase{

    use SingletonTrait;

    protected function onLoad(): void
    {
        self::setInstance($this);
    }
    protected function onEnable(): void
    {
        $this->getLogger()->info("Activé !");
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new Killmoney(), $this);

        if(!$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")){
            $this->getLogger()->alert("Plugin EconomyAPI introuvable !");
        }
    }
}