<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMember extends Model
{
    use HasFactory;
    use SoftDeletes; // todo, restore group with members in future

    protected $table = 'group_members';
    protected $primaryKey = 'group_member_id';

    protected $guarded = [];

    public function group(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Group::class, 'group_id', 'group_id');
    }
}
