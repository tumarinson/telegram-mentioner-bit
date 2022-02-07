<?php

namespace App\Services;

use App\Models\Group;

final class GroupService
{
    // todo changeGroupName

    public static function createGroup($chatId, $arguments): string // todo restore()
    {
        $groupName = $arguments[0];

        $group = Group::where('chat_id', $chatId)->where('name', $groupName)->first();

        if ($group) {
            return "Group {$groupName} is already exist";
        }

        Group::create(['chat_id' => $chatId, 'name' => $groupName]);

        return "Group {$groupName} was created";
    }

    public static function deleteGroup($chatId, $arguments): string
    {
        $groupName = $arguments[0];

        $group = Group::where('chat_id', $chatId)->where('name', $groupName)->first();

        if (!$group) {
            return "Group {$groupName} not found";
        }

        $group->delete();

        return "Group {$groupName} was removed";

        // todo event() remove all members
    }
}
