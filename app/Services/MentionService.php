<?php

namespace App\Services;

use App\Models\GroupMember;

class MentionService
{
    public static function mention($chatId, array $groupsList): string
    {
        if (in_array('@all', $groupsList)) {
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
}
