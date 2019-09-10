<?php


namespace app\controllers;

use app\models\sendGift;
use app\models\Prize;
use yii;
use yii\web\Controller;

class QuizController extends Controller {

    private $bonusToМoneyRate = 10;

    public function convertMoneyToBonus($money_sum) {
        $bonus_sum = $money_sum * $this->bonusToМoneyRate;
        return $bonus_sum;
    }

    public function actionPlay() {
        if (yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->view->title = 'Розыгрыш приза!';
        return $this->render('play');
    }

    public function actionPrize() {

        if (yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $prize = null;
        $h = 0;
        $sum = 0;

        $prizes = Prize::find()->where(['>', 'count', 0])->all();
        if (sizeof($prizes)) {
            $prize_num = rand(0,sizeof($prizes) - 1);
            $prize = $prizes[$prize_num];

            $type_prize = $prize->type;
            $cnt_prize = $prize->count;

            switch( $type_prize ) {
                case 1: // деньги,
                case 2: // бонусы
                    $sum = rand (0, $cnt_prize);
                    break;
                case 3: // вещь
                    break;
                default:
                    break;
            }
        }

        return $this->render('prize', ['prize' => $prize, 'sum' => $sum ]);
    }

    public function actionBonus($sum) {
        if (yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('bonus', ['sum'=>$sum]);
    }

    public function actionSendGift() {
        $this->view->title = 'Отправка подарка';
        $model = new SendGift();

        $prize_id = Yii::$app->request->get('id');
        $prize_count = 1;

        if(!$prize_id || is_null($prize_id)) {
            Yii::$app->session->setFlash('sendGiftFormNoPrizeId');
        }
        else {
            if ($model->load(Yii::$app->request->post())) {

                $model->user_id = Yii::$app->user->id;
                $model->prize_id = Yii::$app->request->get('id');
                $model->status = 0; // не отправлен

                if ($model->save()) {
                    Prize::reduceCountPrize($prize_id, $prize_count);
                    Yii::$app->session->setFlash('sendGiftFormSubmitted');

                    return $this->redirect(['quiz/play']);
                }
            }
        }
        return $this->render('sendGiftForm', [
            'model' => $model,
        ]);
    }

    public function actionConvertToBonus($money_sum) {
        $bonus_sum = $this->convertMoneyToBonus($money_sum);

        return $this->redirect(['quiz/bonus', 'sum'=> $money_sum]);
    }
}