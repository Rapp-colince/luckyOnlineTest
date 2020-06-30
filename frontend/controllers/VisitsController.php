<?php
namespace frontend\controllers;

use frontend\models\VisitsForm;
use Yii;
use yii\web\Controller;


/**
 * Visits controller
 */
class VisitsController extends Controller
{
    public function actionIndex()
    {

        $data = [];

        $model = new VisitsForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data['maxOnlineUsers'] = $model->getMaxOnlineUsers();
        }
        return $this->render('index', ['model' => $model, 'data' => $data]);
    }

}
