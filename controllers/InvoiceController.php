<?php

namespace app\controllers;

use Yii;
use app\models\Invoice;
use app\models\InvoiceSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class InvoiceController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Invoice();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '添加发票成功！');
            return $this->redirect(['create']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGetSuggestOpenTime($term)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $arr = [];
        $year = date('Y');
        for ($i = 1; $i <= 12; $i++)
            $arr[$year . '/' . $i . '/' . $term] = $year . '/' . $i . '/' . $term;
        return $arr;
    }

    public function actionGetSuggestCompany($term)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $companys = (new Query())->from('{{%company}}')->select(['name'])->where(['like', 'initial', $term])->all();
        foreach ($companys as $c)
            $arr[$c['name']] = $c['name'];
        return $arr;
    }
}
