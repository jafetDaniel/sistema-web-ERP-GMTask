$(document).ready(function(){
    $('#select').on('change', function(){
        var selectValor = '#'+$(this).val();

        if(selectValor == "#abierto"){
            document.querySelector('#archivo1').required = false;
            document.querySelector('#archivo2').required = false;
           }else{
            document.querySelector('#archivo1').required = true;
            document.querySelector('#archivo2').required = true;
           }

        $('#pai').children('div').hide();
        $('#pai').children(selectValor).show();
    })
})