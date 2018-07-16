var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$.validator.addMethod("anyDate", function(value, element) {
        if( value != '' )
         return value.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/);
        else
         return true;
    },
    "Entre com uma data válida"
);

$.validator.addMethod('validaCPF', function(value,element,param) {
   $return = true;

   // this is mostly not needed
   var invalidos = [
        '111.111.111-11',
        '222.222.222-22',
        '333.333.333-33',
        '444.444.444-44',
        '555.555.555-55',
        '666.666.666-66',
        '777.777.777-77',
        '888.888.888-88',
        '999.999.999-99',
        '000.000.000-00'
    ];
    for(i=0;i<invalidos.length;i++) {
        if( invalidos[i] == value) {
            $return = false;
        }
    }

    value = value.replace("-","");
    value = value.replace(/\./g,"");

    //validando primeiro digito
    add = 0;
    for ( i=0; i < 9; i++ ) {
        add += parseInt(value.charAt(i), 10) * (10-i);
    }
    rev = 11 - ( add % 11 );
    if( rev == 10 || rev == 11) {
        rev = 0;
    }
    if( rev != parseInt(value.charAt(9), 10) ) {
        $return = false;
    }

    //validando segundo digito
    add = 0;
    for ( i=0; i < 10; i++ ) {
        add += parseInt(value.charAt(i), 10) * (11-i);
    }
    rev = 11 - ( add % 11 );
    if( rev == 10 || rev == 11) {
        rev = 0;
    }
    if( rev != parseInt(value.charAt(10), 10) ) {
        $return = false;
    }

    return $return;
});

$("[data-esconder]").on("click", function(){
    $("." + $(this).attr("data-esconder") ).hide();
});


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});


$(function(){

    //$('.fields.contato').mask(SPMaskBehavior, spOptions);

    //$('.fields.valor').maskMoney(); 

    //$('.fields.senha').hidePassword(true);
    //$('.fields.csenha').hidePassword(true);    

});