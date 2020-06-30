<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\VisitsForm */
/* @var $data array */

use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->title = 'Visits';

?>
<div class="visits-index">

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'visits-search-form']);?>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'datetimeBegin')->widget(DateTimePicker::classname(), [
                        'name' => 'VisitsForm[datetimeBegin]',
                        'type' => DateTimePicker::TYPE_INPUT,
                        'attribute' => 'datetime',
                        'options' => ['placeholder' => 'Time of begin ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd HH:ii:ss',
                            'autoclose' => false
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'datetimeEnd')->widget(DateTimePicker::classname(), [
                        'name' => 'VisitsForm[datetimeEnd]',
                        'type' => DateTimePicker::TYPE_INPUT,
                        'attribute' => 'datetime',
                        'options' => ['placeholder' => 'Time of end ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd HH:ii:ss',
                            'autoclose' => false
                        ]
                    ]);
                    ?>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?= yii\bootstrap\Button::widget([
                            'label' => 'search',
                            'options' => ['class' => 'btn btn-primary']
                    ])?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php

    if (isset($data['maxOnlineUsers'])) {
        echo '<div class="row mt-3">
                <div class="col-6 well">
                    MaxOnlineUsers = ' . $data['maxOnlineUsers'] . '
                </div>
            </div>';

    }
    ?>
</div>