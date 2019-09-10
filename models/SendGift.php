<?php


namespace app\models;


use yii\db\ActiveRecord;

class SendGift extends ActiveRecord {

    public function attributeLabels()
    {
        return [
            'name' => 'Имя получателя',
            'country' => 'Страна',
            'state' => 'Область',
            'city' => 'Город',
            'zip' => 'Почтовый индекс',
            'address' => 'Адрес'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'country', 'city', 'zip', 'address'], 'required'],
            ['zip', 'match', 'pattern' => '/[0-9]+/', 'message' => 'Индекс должен содержать только числа'],
            ['state', 'trim']
        ];
    }

    public static function setStatus ($id, $status) {
        SendGift::updateAll(['status' => $status], 'id =' . $id);
    }

    public static function getStatus($id) {
        if ($id !== null) {
            // запрос в БД
        } else {
            return false;
        }
    }

}