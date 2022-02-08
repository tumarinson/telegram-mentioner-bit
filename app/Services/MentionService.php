<?php

namespace App\Services;

use App\Models\GroupMember;

class MentionService
{
    const ALL_TAG_KEYS = [
        '@all', 'all',
        '@everyone', 'everyone',
    ];

    public static function mention($chatId, array $groupsList): string
    {
        if (self::needTagEveryone($groupsList)) {
            return self::mentionAllUsers($chatId);
        }

        return GroupMember::select('nickname')
            ->whereHas('group', function ($query) use ($chatId, $groupsList) {
                $query->where('chat_id', $chatId)->whereIn('name', $groupsList);
            })
            ->pluck('nickname')
            ->implode(' ');
    }

    public static function mentionAllUsers($chatId)
    {
         return GroupMember::select('nickname')
            ->whereHas('group', function ($query) use ($chatId) {
                $query->where('chat_id', $chatId);
            })
            ->pluck('nickname')
            ->implode(' ');
    }

    public static function needTagEveryone($groupsList): bool
    {
        return in_array(self::ALL_TAG_KEYS, $groupsList);
    }
}
