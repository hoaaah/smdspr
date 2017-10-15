<?php
// THE VIEW
use kartik\widgets\DepDrop;

// Top most parent
echo $form->field($account, 'lev0')->widget(Select2::classname(), [
'data' => ArrayHelper::map(Account::find()->where('parent IS NULL')->asArray()->all(), 'id', 'name')
]);

//ADDITIONAL PARAM ID YOU MAY USE TO SELECT A DEFAULT VALUE OF YOUR MODEL IN YOUR DEPDROP WHEN YOU WANT TO UPDATE:
echo Html::hiddenInput('model_id1', $model->id, ['id'=>'model_id1' ]);

// Child level 1
echo $form->field($account, 'lev1')->widget(DepDrop::classname(), [
'data'=> [6 =>'Bank'],
'options' => ['placeholder' => 'Select ...'],
'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
    'depends'=>['account-lev0'],
    'url' => Url::to(['/account/child-account']),
    'loadingText' => 'Loading child level 1 ...',
    'params'=>['model_id1'] ///SPECIFYING THE PARAM
]
]);

// CONTROLLER
public function actionChildAccount() {
$out = [];
if (isset($_POST['depdrop_parents'])) {
    $id = end($_POST['depdrop_parents']);
    $list = Account::find()->andWhere(['parent'=>$id])->asArray()->all();
    $selected  = null;
    if ($id != null && count($list) > 0) {
        //EXACTLY THIS IS THE PART YOU NEED TO IMPLEMENT:
        $selected = '';
        if (!empty($_POST['depdrop_params'])) {
            $params = $_POST['depdrop_params'];
            $id1 = $params[0]; // get the value of model_id1

            foreach ($list as $i => $account) {
                $out[] = ['id' => $account['id'], 'name' => $account['name']];
                if ($i == 0){
                    $aux = $account['id'];
                }

                ($account['id'] == $id1) ? $selected = $id1 : $selected = $aux;
            }
        }
        // Shows how you can preselect a value
        echo Json::encode(['output' => $out, 'selected'=>$selected]);
        return;
    }
}
echo Json::encode(['output' => '', 'selected'=>'']);
}