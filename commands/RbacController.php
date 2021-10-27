<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "uploadPractices" permission
        $uploadPractices = $auth->createPermission('uploadPractices');
        $uploadPractices->description = 'Upload Practices';
        $auth->add($uploadPractices);

        // add "admin" role and give this role the "uploadPractices" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $uploadPractices);

        $user = $auth->createRole('user');
        $auth->add($user);

        // Assign role to admin user
        $auth->assign($admin, 100);
    }
}