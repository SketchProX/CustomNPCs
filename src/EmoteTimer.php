<?php
declare(strict_types=1);

namespace XPocketMC\CustomNPCs;

use XPocketMC\CustomNPCs\Entity\CustomNPCs;
use pocketmine\network\mcpe\protocol\EmotePacket;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class EmoteTimer extends Task {

    public function onRun(int $currentTick)
    {
        foreach (Server::getInstance()->getLevels() as $level) {
            foreach ($level->getEntities() as $NPC) {
                if ($NPC instanceof CustomNPCs) {
                    foreach (NPC::get($NPC, 'Settings') as $setting) {
                        foreach (NPC::$emotes as $emote => $id) {
                            if ($setting === $emote) {
                                Server::getInstance()->broadcastPacket($NPC->getViewers(), EmotePacket::create($NPC->getId(), $id, 1 << 0));
                            }
                        }
                    }
                }
            }
        }
    }
}