<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['options' => ['id' => 'transerToCardForm']]); ?>
<label>Сумма</label>: <?= $model->sum; ?>

<?= $form->field($model, 'holder'); ?>
<?= $form->field($model, 'type')->radioList($model->getCardType()); ?>
<?= $form->field($model, 'number'); ?>
<?= HTML::submitButton('Отправить', ['class' => 'btn btn-success'])  ?>
<?php ActiveForm::end(); ?>
