<?php


namespace app\models;


use yii\db\ActiveRecord;

class TransferToCard extends ActiveRecord {
    public function attributeLabels() {

        return [
            'holder' => 'Владелец карты',
            'type' => 'Тип карты',
            'number' => 'Номер карты'
        ];
    }

    public function rules() {
        return [
            [['holder', 'type', 'number'], 'required'],
            ['number', 'match', 'pattern' => '/[0-9]{16}$/', 'message' => 'Некорректный номер карты'],
        ];
    }

    public static function getCardType($id = null) {

        $types = [
            1 => 'Visa',
            2 => 'MasterCard'
        ];

        if ($id) {
            return isset($types[$id]) ? $types[$id] : 'Undefined';
        }

        else {
            return $types;
        }
    }

    public static function setStatus($id, $status) {
        TransferToCard::updateAll(['status' =>$status], 'id ='. $id);
    }

}