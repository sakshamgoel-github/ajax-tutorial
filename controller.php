<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex()
    {
        return $this->render("index.php");
    }

    public function actionComment($postId)
    {
        // URL to fetch comments
        $url = "https://jsonplaceholder.typicode.com/posts/{$postId}/comments";

        // Fetch comments using file_get_contents
        $response = file_get_contents($url);

        // Return the response as JSON
        return $this->asJson(json_decode($response, true));
    }

    public function actionEmail($commentId)
    {
        // URL to fetch comments
        $url = "https://jsonplaceholder.typicode.com/comments/{$commentId}/";

        // Fetch comments using file_get_contents
        $response = file_get_contents($url);

        // Return the response as JSON
        return $this->asJson(json_decode($response, true));
    }

}
