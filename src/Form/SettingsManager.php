<?php
declare(strict_types=1);
#=========================================#
# Plugin Custom NPC Made By XPocketMC #
#=========================================#
namespace XPocketMC\CustomNPCs\Form;

use XPocketMC\CustomNPCs\{Entity\CustomNPCs,
    Form\formapi\FormAPI,
    Form\Settings\Cooldown,
    Form\Settings\Rotation,
    Form\Settings\SizeAndEmotes
};
use XPocketMC\CustomNPCs\Form\Settings\NameTag;
use XPocketMC\CustomNPCs\Form\Settings\SkinAndCape;
use pocketmine\Player;

class SettingsManager
{
    public $players = ['Choose a player'];

    /**
     * @param Player $player
     * @param CustomNPCs $NPC
     */
    public function send(Player $player, CustomNPCs $NPC)
    {
        $form = (new FormAPI())->createSimpleForm(function (Player $player, $data = null) use ($NPC) {
            if (is_null($data)) {
                (new CustomizeMain())->send($player, $NPC);
                return;
            }

            switch ($data) {
                case 0:
                    (new NameTag())->send($player, $NPC);
                    break;
                case 1:
                    (new Rotation())->send($player, $NPC);
                    break;
                case 2:
                    (new Cooldown())->send($player, $NPC);
                    break;
                case 3:
                    (new SkinAndCape())->send($player, $NPC);
                    break;
                case 4:
                    (new SizeAndEmotes())->send($player, $NPC);
                    break;
                case 5:
                    (new CustomizeMain())->send($player, $NPC);
                    break;
            }
        });
        $form->setTitle("§3Settings Manager");
        $form->setContent("§3+ §6NPC ID §b: §a" . $NPC->getId());
        $form->addButton('§8NameTag');
        $form->addButton('§8Rotation');
        $form->addButton('§8Cooldown');
        $form->addButton('§8Skin & Cape');
        $form->addButton('§8Size & Emotes');
        $form->addButton('§4Back');
        $form->sendToPlayer($player);
    }
}