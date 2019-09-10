<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<div class="prize">
    <?php if (!empty($prize)): ?>
        <?php
        $prizeStr = "Вы выиграли ";
        $prizeId = $prize->id;
        $prizeType = $prize->type;
        $prizeName = $prize->name;

        switch ($prizeType) {
            case 1: // деньги
                echo '<h1>' . $prizeStr . 'денежный приз в сумме ' . $sum . ' руб. !</h1>';
                echo Html::a('Отправить деньги на счет', ['/transfer/transfer-to-card', 'prize_id' => $prize->id,  'sum' => $sum], ['class' => 'btn btn-primary sf_r10']);
                echo Html::a('Пересчитать в баллы', ['/quiz/convert-to-bonus', 'prize_id' => $prize->id,  'money_sum' => $sum], ['class' => 'btn btn-primary sf_r10']);
                echo Html::a('Отмена', ['/quiz/play'], ['class'=>'btn btn-primary']) ;
                break;
            case 2: // бонусы
                echo '<h1>' . $prizeStr . 'бонусы в количестве ' . $sum .  ' баллов!</h1>';
                echo Html::a('Получить бонусы', ['/quiz/bonus', 'sum' => $sum], ['class' => 'btn btn-primary sf_r10']);
                echo Html::a('Отмена', ['/quiz/play'], ['class'=>'btn btn-primary']) ;
                break;
            case 3: // вещь
                echo '<h1>' . $prizeStr . 'подарок! ' . 'Это ' . $prizeName . '!</h1>';
                echo Html::a('Получить подарок', ['/quiz/send-gift', 'id' => $prize->id], ['class' => 'btn btn-primary sf_r10']);
                echo Html::a('Отмена', ['/quiz/play'], ['class'=>'btn btn-primary']) ;
                break;
            default:
                echo "Не удалось получить приз. Попробуйте позже.";
        }
        ?>
    <?php else:?>
        <h1>Призов больше нет!</h1>
    <?php endif;?>
</div>