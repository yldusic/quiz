<?php


namespace app\controllers;

use yii;
use app\models\Prize;
use app\models\TransferToCard;
use yii\web\Controller;

class TransferController extends Controller {
    public function actionTransferToCard() {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        $model = new TransferToCard();
        $prize_id = Yii::$app->request->get('prize_id');
        $sum = Yii::$app->request->get('sum');

        $model->sum = $sum;

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->id;
            $model->status = 0; // не отправлен

            if ($model->save()) {
                Prize::reduceCountPrize($prize_id, $sum);
                Yii::$app->session->setFlash('transferToCardOn');
                return $this->redirect(['quiz/play']);
            }
        }

        $model->type = 1;

        $this->view->title = 'Получить деньги на карту';

        return $this->render('transferToCardForm', compact('model'));

    }

}