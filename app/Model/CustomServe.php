<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * 客服正在服务的的 客户
 * Class CustomServe
 * @package App\Model
 */
class CustomServe extends Model
{
    //
    protected  $guarded = []; #不被批量赋值 空为全部可以赋值

    /**
     * @param $ausers_id 客服ID
     * @param $person_id  客户id
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function add($ausers_id, $person_id)
    {
        return static::query()->create([
            'ausers_id' => $ausers_id,
            'person_id' => $person_id
        ]);
    }
}
