<?php
use yii\helpers\Html;
use yii\helpers\Url;
$out = "<div>";

if (json_decode($model->data)) {
    $out .= "<p><b>Тип продукции</b> - " . $listProducts[$model->product_id] . "</p>";
    foreach (json_decode($model->data) as $key => $value) {
        if (!is_array($value)) {
            $out .= "<p><b>" . $listCategories[$key] . '</b> - ' . $listSubCategories[$value] . "</p>";
        } else {
            $out .= "<p><b>" . $listCategories[$key] . '</b> - ';
            foreach ($value as $key2) {
                $out .= $listSubCategories[$key2] . ', ';
            }
            $out .= "</p>";
        }
    }
}

$out .= "</div>";

echo $out;
//var_dump(Url::to(['/file/download','id'=>$file_id]));
?>
<a href="<?= Url::to(['/main/file/show','id'=>$model->files]); ?>" download>Скачать файл</a>


