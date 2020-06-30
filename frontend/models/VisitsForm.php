<?php
namespace frontend\models;

use common\models\Visits;
use yii\base\Model;

/**
 * VisitsForm form
 */
class VisitsForm extends Model
{
    public $datetimeBegin;
    public $datetimeEnd;
    protected $dateDiffAllowed = 86400; // 1 day

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datetimeBegin', 'datetimeEnd'], 'trim'],
            [['datetimeBegin', 'datetimeEnd'], 'required'],
            [['datetimeBegin', 'datetimeEnd'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['datetimeBegin', function (){
                try {
                    if ($this->datetimeBegin >= $this->datetimeEnd) {
                        throw new \Exception('datetimeEnd should be greater than datetimeBegin');
                    }

                    $diff = ((new \DateTime($this->datetimeEnd))->format('U') - (new \DateTime($this->datetimeBegin))->format('U'));
                    if ($diff > $this->dateDiffAllowed) {
                        throw new \Exception('Max period = 1 day');
                    }

                } catch (\Exception $exception){
                    $this->addError('datetimeBegin', $exception->getMessage());
                    $this->addError('datetimeEnd', $exception->getMessage());
                }
                return false;
            }]
        ];
    }

    /**
     * Calculate max visitors for period.
     *
     * @return int
     */
    public function getMaxOnlineUsers()
    {
        // 1. Calculate online users on $datetimeBegin moment
        $expressionStatusToInt =  new \yii\db\Expression('(status -1.5) * 2');
        //$maxOnlineUsers = (int)Visits::find()->where(['<=', 'datetime', $this->datetimeBegin])->sum($expressionStatusToInt);
        $maxOnlineUsers = Visits::find()->where(['<=', 'datetime', $this->datetimeBegin])->sum($expressionStatusToInt);

        // 2. Calculate max online users for period
        $visitsPeriod = Visits::find()->select($expressionStatusToInt)
            ->where(['>', 'datetime', $this->datetimeBegin])
            ->andWhere(['<=', 'datetime', $this->datetimeEnd])
            ->orderBy('datetime')
            ->column();

        $currentOnlineUsers = $maxOnlineUsers;
        foreach ($visitsPeriod as $moveInt) {
            $currentOnlineUsers += $moveInt;
            if ($currentOnlineUsers > $maxOnlineUsers) {
                $maxOnlineUsers = $currentOnlineUsers;
            }

        }
        return $maxOnlineUsers;
    }

}
