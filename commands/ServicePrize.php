<?php


namespace app\commands;
use yii\console\Controller;
use app\models\TransferToCard;


class ServicePrize extends Controller {

    // Консольная команда  отправки денежных призов на счет пользователей

    public function actionTrasferMoney($num) {
        $money_transfers = TransferToCard::find()->where(['=', 'status', '0'])->orderBy(['id' => SORT_ASC])->limit($num)->all();

        if (sizeof($money_transfers)) {
            foreach ($money_transfers as $money_transfer) {
                TransferToCard::setStatus($money_transfer->id, 1);
                echo 'Владелец:' . TransferToCard::getCardType($money_transfer->type) .' Номер карты: ' . $money_transfer->number .' Сумма: ' .$money_transfer->sum .' руб. \n';
            }
        }
        else {
            echo 'Все переводы выполнены.' ."\n";
        }
        return 0;
    }
}