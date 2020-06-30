<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Run controller
 */
class RunController extends Controller
{

    /**
     * @throws Exception
     */
    public function actionIndex()
    {



    }


    /**
     * @throws Exception
     */
    public function actionAdd()
    {
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', 1200);

        for ($num = 1; $num < 29; ++$num) {


            for ($a=0; $a < 20; ++$a) {

                $sql = "INSERT INTO visits (datetime, status) VALUES ";
                for ($i = 0; $i < 50000; ++$i) {
                    $sql .= "('2020-06-".$num."' + INTERVAL ".rand(0, 86400)." SECOND, ".rand(1, 2)."),";
                }
                $sql = rtrim($sql, ',');
                Yii::$app->db->createCommand($sql)->execute();
            }
        }

    }





}
