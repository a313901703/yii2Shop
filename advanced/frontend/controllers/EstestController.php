<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\esmodels\Book; 
/**
 * Site controller
 */
class EstestController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $res = Book::mget([1,2,4]);
        print_r($res);
    }

    public function actionCreate()
    {
        $book = new Book;
        $book->primaryKey = 5; // in this case equivalent to $customer->id = 1;
        $book->name = 'name_test';
        $book->type = '1';
        //$book->attributes = ['name'=>'name_test_1'];
        $book->save();
    }

}
