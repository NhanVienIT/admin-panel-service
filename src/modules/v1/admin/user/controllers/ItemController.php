<?php

namespace app\modules\v1\admin\user\controllers;

use Yii;
use yii\db\Exception;
use yii\rest\Controller;
use yii\web\HttpException;
use app\helpers\ApiConstant;
use app\helpers\ResponseBuilder;
use yii\web\NotFoundHttpException;
use app\modules\v1\admin\user\models\User;
use app\modules\v1\admin\user\models\form\UserForm;
use app\modules\v1\admin\user\models\form\UserLoginForm;

class ItemController extends Controller
{

    public function verbs()
    {
        return array_merge(parent::verbs(), [
            "index" => ["GET"],
            "view" => ["GET"],
            "create" => ["POST"],
            "update" => ["POST"],
        ]);
    }

    /**
     * @throws HttpException
     * @throws Exception
     * @throws \Exception
     */
    public function actionLogin()
    {
        $user = new UserLoginForm();
        $user->load(Yii::$app->request->post(), '');
        $userLogged = $user->login();
        if ($user->hasErrors() || !$user->validate()) {
            return ResponseBuilder::json(false, ["errors" => $user->getErrors()], "Can't login", ApiConstant::SC_BAD_REQUEST);
        }
        $user = $userLogged;
        $user->logged_at = date("Y-m-d H:i:s");
        $user->save(false);
        return ResponseBuilder::json(true, ["user" => $user], "Login Successfully");
    }

    /**
     * @throws Exception
     */
    public function actionCreate()
    {
        $user = new UserForm();
        $user->load(Yii::$app->request->post());
        $user->status = User::STATUS_ACTIVE;
        if ($user->validate() && $user->save()) {
            return ResponseBuilder::json(true, ["user" => $user], "Create User successfully", ApiConstant::SC_OK);
        }
        return ResponseBuilder::json(false, ["errors" => $user->getErrors()], "Can't Create User", ApiConstant::SC_BAD_REQUEST);
    }

    /**
     * @throws NotFoundHttpException
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $user = UserForm::find()->where(["id" => $id])->one();
        if (!empty($user)) {
            $user->load(Yii::$app->request->post());
            $password = Yii::$app->request->post('password');
            if ($password !== null) {
                $user->setPassword($password);
            }
            if ($user->validate() && $user->save()) {
                return ResponseBuilder::json(true, ["user" => $user], "Update user successfully", ApiConstant::SC_OK);
            }
            return ResponseBuilder::json(false, ["errors" => $user->getErrors()], "Can't update user", ApiConstant::SC_BAD_REQUEST);
        }
        return ResponseBuilder::json(false, ["errors" => $user->getErrors()], "User not found", ApiConstant::SC_BAD_REQUEST);
    }


    /**
     * @throws NotFoundHttpException
     * @throws HttpException|\yii\db\Exception
     */
    public function actionDelete(int $id)
    {
        $user = User::find()->where(["id" => $id])->one();
        if (!empty($user)) {
            $user->status = User::STATUS_DELETED;
            if ($user->save()) {
                return ResponseBuilder::json(true, [], "Delete user successfully");
            }
            return ResponseBuilder::json(false, [], "Can't Delete user", ApiConstant::SC_BAD_REQUEST);
        }
        return ResponseBuilder::json(false, [], "User not found", ApiConstant::SC_BAD_REQUEST);
    }

    /**
     * @throws NotFoundHttpException
     * @throws HttpException
     */
    public function actionView(int $id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("user not found");
        }
        return ResponseBuilder::json(true, ["user" => $user]);
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        return ResponseBuilder::json(true, (new UserSearch())->search(Yii::$app->request->queryParams));
    }
}
