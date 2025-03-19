<?php

namespace app\helpers;

use BadMethodCallException;
use yii\base\BaseObject;

class ResponseGciBuilder extends BaseObject
{
    public $status;
    public $data = null;
    public $error = null;
    public $message = null;
    public $ok_status = null;

    /**
     * @return array
     * @throws BadMethodCallException
     */
    public function build()
    {
        if ($this->status == ApiConstant::STATUS_OK) {
            return [
                'result' => [
                    'status' => $this->status,
                    'data' => $this->data,
                    'error' => $this->error,
                    'message' => $this->message
                ],
                'error' => null, 'message' => null,
                'data' => null,
                'status' => ApiConstant::STATUS_OK
            ];
        } else if ($this->status == ApiConstant::STATUS_FAIL) {
            return [
                'result' => null,
                'status' => $this->status,
                'error' => $this->error,
                'message' => $this->message
            ];
        }
        throw new BadMethodCallException();
    }

    public function error()
    {
        if ($this->status != ApiConstant::STATUS_OK) {
            return [
                'result' => null,
                'status' => ApiConstant::STATUS_FAIL,
                'error' => $this->error,
                'message' => $this->message
            ];
        } else {
            throw new BadMethodCallException();
        }
    }
}