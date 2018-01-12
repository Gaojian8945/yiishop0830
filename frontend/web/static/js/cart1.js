/*
@功能：购物车页面js
@作者：diamondwang
@时间：2013年11月14日
*/
function update(id,amount) {
    $.get("/goods/update-cart",{'id':id,'amount':amount},function (data) {
        console.dir(data);
    });
}
function del(id) {
    $.get("/goods/cart-del",{'id':id},function (data) {
        console.dir(data);
    });
	console.debug(id);
}
$(function(){
    //总计金额
    var total = 0;
    $(".col5 span").each(function(){
        total += parseFloat($(this).text());
    });

    $("#total").text(total.toFixed(2));

    //删除
	$('.del').click(function () {
        var id=$(this).parent().parent().attr('id');
        del(id);
        $(this).parent().parent().remove();
    });
	//减少
	$(".reduce_num").click(function(){
		var amount = $(this).parent().find(".amount");
        var id=$(this).parent().parent().attr('id');
		if (parseInt($(amount).val()) <= 1){
			alert("商品数量最少为1");
		} else{
			$(amount).val(parseInt($(amount).val()) - 1);
		}
		var num = $(this).next().val();
        console.log(id,num);
        update(id,num);
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
	});

	//增加
	$(".add_num").click(function(){
		var amount = $(this).parent().find(".amount");
		$(amount).val(parseInt($(amount).val()) + 1);
        var id=$(this).parent().parent().attr('id');
        var num=$(this).prev().val();
        //调用
        update(id,num);
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
	});

	//直接输入
	$(".amount").blur(function(){
		if (parseInt($(this).val()) < 1){
			alert("商品数量最少为1");
			$(this).val(1);
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(this).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));

	});
});