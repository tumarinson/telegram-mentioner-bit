<?php

namespace App\Services;

use App\Models\Group;
use App\Models\GroupMember;

final class GroupMemberService
{
    public static function addMembersToGroup($chatId, array $arguments): string
    {
        $groupName = $arguments[0];
        unset($arguments[0]);

        $group = Group::where('chat_id', $chatId)->where('name', $groupName)->first();

        if (!$group) {
            return "Group {$groupName} not found. Create it.";
        }

        foreach ($arguments as $username) {
            self::addMemberToGroup($group, $username);
        }

        return "Users successfully added to group {$groupName}";
    }

    public static function addMemberToGroup(Group $group, $userName)
    {
        GroupMember::firstOrCreate([
            'nickname' => $userName,
            'group_id' => $group->getKey(),
        ]);
    }

    public static function removeMembersFromGroup($chatId, $arguments): string
    {
        $groupName = $arguments[0];
        unset($arguments[0]);

        $group = Group::where('chat_id', $chatId)->where('name', $groupName)->first();

        if (!$group) {
            return "Group {$groupName} not found. Create it.";
        }

        foreach ($arguments as $username) {
            self::removeMemberFromGroup($group, $username);
        }

        return "Users successfully removed from group {$groupName}";
    }

    public static function removeMemberFromGroup(Group $group, $userName)
    {
        $group->members()->where('nickname', $userName)->delete();
    }
}
