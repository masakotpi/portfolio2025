
$(function(){

    $('.ingredient').on('click', function() {
       
       ingredient =  $(this).html();
       data =  $.parseJSON($(this).attr('data'));
       var $delete = '<button type="button" class="badge btn-danger ml-5 delete" data="'+ingredient+'">削除</button>';
       var $input  = '<input type="hidden" form="form" name="mst_ingredient_id[]" value="'+data['id']+'"></input>';
       var $amount = '<input type="hidden" form="form" name="amount[]" value="0"></input>';
       let buttons = 
       `<button type="button" class="badge btn-warning amount" data="1">+1</button>
        <button type="button" class="badge btn-warning amount" data="10">+10</button>
        <button type="button" class="badge btn-warning amount" data="100">+100</button>
        <button type="button" class="badge btn-warning amount" data="-100">-100</button>
        <button type="button" class="badge btn-warning amount" data="-10">-10</button>`;

        $('.ingredient_body').append('<tr><td width="40%">'+ingredient+'</td><td class="unit text-right" data="0" data-unit="'+data['unit']+'">'+data['unit']+'</td><td>'+buttons +'</td><td>'+$delete+$input+$amount+'</td>');
    })

    //材料クリア
    $('.clear').on('click', function() {
        $('tbody').text('');
        $('.process_ing').text('');
    })
    //材料マスタ削除
    $('.delete_ingredient').on('click', function() {
        $(this).removeClass('btn-pink');
        $(this).addClass('btn-secondary');
        let id = $(this).attr('data');
        var $delete_ingredients = '<input type="hidden" form="form" name="ingredients[]" value='+id+'></input>';
        $('.input_data').append($delete_ingredients);
    })
    //分量追加
    $(document).on('click','.amount', function() {
        let add_amount = $(this).attr('data');
        let pre_amount = $(this).closest('tr').find('.unit').attr('data');
        let unit = $(this).closest('tr').find('.unit').attr('data-unit');
        let amount = Number(add_amount) + Number(pre_amount)
        if(amount < 0){
            amount = 0;
        }
        if(amount > 500){
            amount = 500;
        }
        $(this).closest('tr').find('.unit').attr('data',amount);
        $(this).closest('tr').find('[name="amount[]"]').val(amount);
        if(unit === "小さじ"){
            $(this).closest('tr').find('.unit').text(unit+amount).attr('data',amount);
        }else{
            $(this).closest('tr').find('.unit').text(amount+unit).attr('data',amount);
        }
    })
    //削除
    $(document).on('click','.delete', function() {
        $(this).closest('tr').remove();
        var delete_ingredient =$(this).attr('data');
        $('.process_ing :contains('+delete_ingredient+')').remove();
    })

    //工程変換
    // $(document).on('click','.process,.process_ing', function() {
    //     let process =  $(this).text();
    //     let is_process =  $(this).attr('data');
    //     if(is_process == 'process' &&  process.slice(-1) == 'る'){
    //        $(this).text(process.replace('る','て'))
    //     }
    //     if(is_process == 'process' &&  process.slice(-1) == 'て'){
    //        $(this).text(process.replace('て','る'))
    //     }
    //     if(is_process == 'ingredient' &&  process.slice(-1) !== 'と'){
    //        $(this).text(process+'と')
    //     }
    //     if(is_process == 'ingredient' &&  process.slice(-1) == 'と'){
    //        $(this).text(process.slice(0,-1))
    //     }
     
       
    //  })
     //工程追加
    $(document).on('click','.process,.process_ing', function() {
        let process =  $(this).text();
        let old_process = $('.textarea').val();
        let seleted_part = $('.textarea').get(0).selectionStart;
        if($('.textarea').val().length == seleted_part || seleted_part == 0){
            $('.textarea').val(old_process+process);
        }else{
            let text = $('.textarea').val().substr(0, $('.textarea').get(0).selectionStart)
            +process 
            +old_process.substr($('.textarea').get(0).selectionStart);
            $('.textarea').val(text);
        }
     })
    //工程クリア
    $('.process_clear').on('click', function() {
        $('.textarea').val('');
     })
    //1文字クリア
    $('.delete_one_letter').on('click', function() {
        textarea = $('.textarea').val();
        new_text= textarea.slice(0,-1);
        $('.textarea').val();
        $('.textarea').val(new_text);
     })
    //工程確定
    $('.confirm').on('click', function() {
        textarea = $('.textarea').val();
        if(!textarea){
            return;
        }
        $('.textarea').val('');
        $('.process_body').append('<tr><td>'+textarea+'</td></tr>');
        $('.process_body').append('<input type="hidden" name="process[]" value="'+textarea+'">');
     })

    //送信前チェック
    $('.submit').on('click', function() {
        amounts = $('[name="amount[]"]');
        amount_val =[];
        $.each(amounts,function(index,amount){
            amount_val [index] = $(amount).val();
        });
        if($.inArray('0', amount_val) !== -1){
            alert('分量は1以上の数字で送信してください。')
            return false;
        }else{
            return;
        }
     })

    
});

