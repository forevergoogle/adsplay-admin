<?php
/**
 * Created by PhpStorm.
 * User: mith
 * Date: 5/10/2016
 * Time: 3:41 PM
 */
?>
<div class="block-area">
    <div class="row m-container">
        <div class="row">
            <!--Management Campaign-->
            <?php echo $view_campaign;?>
            <div class="col-lg-6">
                <div class="tile">
                    <h2 class="tile-title"> ELEMENTS INFORMATION</h2>
                    <div class="p-10">
                        <iframe src="<?php echo site_url("/admin_metadata/upload/upload_iframe"); ?>"
                                style="overflow: hidden; border: hidden" width="100%" height="320"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--    Delivery Setting-->
            <?php echo $view_delivery; ?>
        </div>
    </div>
</div>
<input id="userid" name="userid" type="hidden">
<script>
    $(document).ready(function(){
        $("button#add-brand").click(function(){
            $.ajax({
                type: "POST",
                url: "/advertiser/metadata/addCampaign",
                data: $('form.form-management').serialize(),
                success: function(result){
                    console.log(result);
                    if(result == 0) {
                        $('.check-error-campaign').show();
                        $('.fa-check-campaign').hide();
                    }else if(result == 1){
                        $('.fa-check-campaign').show();
                        $('.check-error-campaign').hide();
                        alert("You added a Campaign Successfully!");
                        $("#form-management")[0].reset();
                        $('.check-error-campaign').hide();
                        $('.fa-check-campaign').hide();

                    }else{
                        $('.error-campaign').html(result);
                    }
                },
                error: function(){
                    alert("failure");
                }
            });
        });
        $("#choose-brand").change(function(){
            var brandId = $(this).val();
            $.ajax({
                type: "POST",
                dataType:"json",
                url: "/advertiser/metadata/getProductByBrandId",
                data: {brandId :brandId },
                success: function(result){
                    var items = [];
//                    var productIds = [];
                    $.each(result, function(i, item) {
                        items.push("<option value='"+result[i].id+"'>"+result[i].product_name+"</option>");
                    });
                    $('.product-name').html(items);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/advertiser/metadata/getSectorByProductId",
                        data: {productId: result[0].id},
                        success: function (data) {
                            var sectors = [];
                            $.each(data, function(i, item) {
                                sectors.push("<option value='"+data[i].id+"'>"+data[i].sector_name+"</option>");

                            });
                            $('.sector-name').html(sectors);
                        }
                    });
                }
            });
        });
        $("#choose-product").change(function(){
            var productId = $(this).val();
            $.ajax({
                type: "POST",
                dataType:"json",
                url: "/advertiser/metadata/getSectorByProductId",
                data: {productId :productId },
                success: function(result){
                    var items = [];
                    $.each(result, function(i, item) {
                        items.push("<option value='"+result[i].id+"'>"+result[i].sector_name+"</option>");
                    });
                    $('.sector-name').html(items);


                }
            });
        });
    });
</script>
<script type="application/javascript">
    $(document).ready(function(){
        $('#optionsRadios1').click(function() {
            $('.disabled-campaign').prop("disabled", false);
            $('.disable-text-campaign').prop("disabled", true);
        });
        $('#optionsRadios2').click(function() {
            $('.disabled-campaign').prop("disabled", true);
            $('.disable-text-campaign').prop("disabled", false);
        });
    });
</script>
