<?php

namespace app\controllers;

use Yii;
use yii\db\IntegrityException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ImportForm;
use app\models\Practice;
use app\models\Customer;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'import'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],

                    ],
                    // Give the access to the import page to a specified role
                    [
                        'actions' => ['import'],
                        'allow' => true,
                        'roles' => ['uploadPractices'],

                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['practice/index']);
        } else {
            return self::actionLogin();
        }

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->goBack();
            } else {
                // If invalid login details throw error message
                Yii::$app->session->setFlash('error', 'Invalid login details.');
            }
            return $this->refresh();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays import page.
     *
     * @return string
     */
    public function actionImport()
    {
        $model = new ImportForm();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($file->tempName) {
                $file = $file->tempName;
                $filecsv = array_map('str_getcsv', file($file));
                if (!empty($filecsv)) {
                    unset($filecsv[0]);
                    // Check if the filetype is 'Customer'
                    if ($model->attributes = $_POST['type'] == 'C') {
                        foreach ($filecsv as $data) {
                            $customer = new Customer;
                            $customer->id = $data[0];
                            $customer->first_name = $data[1];
                            $customer->last_name = $data[2];
                            $customer->fiscal_code = $data[3];
                            $customer->note = $data[4];
                            try {
                                $customer->save();
                            } catch (IntegrityException $e) {
                                $customer->addError(null, $e->getMessage());
                            }
                        }
                        // Check if the filetype is 'Practices'
                    } elseif ($model->attributes = $_POST['type'] == 'P') {
                        foreach ($filecsv as $data) {
                            $practice = new Practice;
                            $practice->id = $data[0];
                            $practice->practice_id = $data[1];
                            $practice->creation_date = $data[2];
                            $practice->practice_status = $data[3];
                            $practice->note = $data[4];
                            $practice->customer_id = $data[5];
                            try {
                                $practice->save();
                            } catch (IntegrityException $e) {
                                $practice->addError(null, $e->getMessage());
                            }
                        }
                    }
                }
                return $this->redirect(['site/index']);
            }
        } else {
            return $this->render('import', ['model' => $model]);
        }
    }

}
