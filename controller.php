<?php

namespace app\controllers;

use app\models\Srv;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class PostController extends Controller
{
    public function actionIndex()
    {
        return $this->render("index.php");
    }

    public function actionSrv($itemId)
    {
        // Use parameterized query to avoid SQL injection
        $response = Srv::find()->where(['itemId' => $itemId])->all();

        // Set the response format to JSON
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Return the response as JSON
        return $response;
    }

    public function actionQuantity($srvId, $itemId)
    {
        // Use parameterized query to avoid SQL injection
        $response = Srv::find()
            ->where(['id' => $srvId, 'itemId' => $itemId])
            ->one();

        // Set the response format to JSON
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Return the response as JSON
        return $response;
    }
}
