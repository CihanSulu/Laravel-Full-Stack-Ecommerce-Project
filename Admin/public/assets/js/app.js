$(".multiurun ul li").click(function(){
    var id = $(this).attr("id");
    var text = $(this).attr("data-name");
    var sayac = 0;

    $("#multiurunler option[data-id='"+id+"']").each(function() {
        sayac = $(this).attr("adet");
    });
    sayac++;
    if(sayac == 1){
        $("#multiurunler").append("<option value='"+id+"_"+sayac+"' data-id='"+id+"' adet='"+sayac+"' data-name='"+text+"' selected>"+text+" - ["+sayac+" Adet]"+"</option>");
    }
    else{
        $("#multiurunler option[data-id='"+id+"']").html(text+" - ["+sayac+" Adet]");
        $("#multiurunler option[data-id='"+id+"']").attr("adet",sayac)
        $("#multiurunler option[data-id='"+id+"']").attr("value",id+"_"+sayac);
    }
});

$('#multiurunler').click(function(){
    var value = $(this).find('option:selected').attr("data-id");
    var text = $("#multiurunler option[data-id='"+value+"']").attr("data-name");
    var adet = $("#multiurunler option[data-id='"+value+"']").attr("adet");
    if(adet != 1){
        $("#multiurunler option[data-id='"+value+"']").attr("adet",(adet-1));
        $("#multiurunler option[data-id='"+value+"']").html(text+" - ["+(adet-1)+" Adet]");
        $("#multiurunler option[data-id='"+value+"']").attr("value",(value+"_"+(adet-1)));
    }
    else{
        $("#multiurunler option").filter("[data-id='"+value+"']").remove();
    }

    $('#multiurunler option').prop('selected', true);

});

