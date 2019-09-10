<?php
    use yii\bootstrap\Html;
?>
<h1><?= $this->title; ?></h1>
<div class="quiz-play">
    <div class="row">
        <div class="col-lg-12">
            <?= Html::a('Получить приз', ['/quiz/prize/'], ['class'=>'btn btn-danger btn-lg']) ?>
        </div>
    </div>
</div>

