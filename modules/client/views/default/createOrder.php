<?php

?>
<?= $this->render('_formOrder', ['model' => $model, 'listProducts' => $listProducts]) ?>

<script>
    $( "#order-product_id" ).change(function() {
        var valueSelect = $("#order-product_id option:selected").val();
        $.ajax({
            type: "POST",
            url: "show-info-product",
            data: "id="+valueSelect,
            success: function(msg){
              $("#info").html(msg);
            }
        });
    });
</script>
