<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-sasaran',
    'widgetItem' => '.sasaran-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-sasaran',
    'deleteButton' => '.remove-sasaran',
    'model' => $sasaran[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'Ur_Sasaran'
    ],
]); ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sasaran</th>
            <th class="text-center">
                <button type="button" class="add-sasaran btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
    </thead>
    <tbody class="container-sasaran">
    <?php foreach ($sasaran as $indexSasaran => $sasaran): ?>
        <tr class="sasaran-item">
            <td class="vcenter">
                <?php
                    // necessary for update action.
                    if (! $sasaran->isNewRecord) {
                        echo Html::activeHiddenInput($sasaran, "[{$indexTujuan}][{$indexSasaran}]id");
                    }
                ?>
                <?= $form->field($sasaran, "[{$indexTujuan}][{$indexSasaran}]Ur_Sasaran")->label(false)->textInput(['maxlength' => true]) ?>
            </td>
            <td class="text-center vcenter" style="width: 90px;">
                <button type="button" class="remove-sasaran btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
            </td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>
<?php DynamicFormWidget::end(); ?>