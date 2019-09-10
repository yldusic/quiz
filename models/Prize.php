<?php


namespace app\models;


use yii\db\ActiveRecord;

class Prize extends ActiveRecord {
    public static function reduceCountPrize($prize_id, $count= 0) {
        $prize = Prize::findOne($prize_id);
        Prize::updateAll(['count' => $prize->count-$count], 'id =' . $prize_id);
    }
}