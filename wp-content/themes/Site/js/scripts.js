// Tela de pagamento do curso
$(document).ready(function() {
    // Válida cpf
    function validarCPF() {
        //Executa a requisição quando o campo username perder o foco
        $('form .js-cpf').blur(function() {
            var cpf = $('form .js-cpf').val().replace(/[^0-9]/g, '').toString();

            if (cpf.length == 11 || cpf.length == 14) {
                var v = [];
                //Calcula o primeiro dígito de verificação.
                v[0] = 1 * cpf[0] + 2 * cpf[1] + 3 * cpf[2];
                v[0] += 4 * cpf[3] + 5 * cpf[4] + 6 * cpf[5];
                v[0] += 7 * cpf[6] + 8 * cpf[7] + 9 * cpf[8];
                v[0] = v[0] % 11;
                v[0] = v[0] % 10;
                //Calcula o segundo dígito de verificação.
                v[1] = 1 * cpf[1] + 2 * cpf[2] + 3 * cpf[3];
                v[1] += 4 * cpf[4] + 5 * cpf[5] + 6 * cpf[6];
                v[1] += 7 * cpf[7] + 8 * cpf[8] + 9 * v[0];
                v[1] = v[1] % 11;
                v[1] = v[1] % 10;
                //Retorna Verdadeiro se os dígitos de verificação são os esperados.
                if ((v[0] != cpf[9]) || (v[1] != cpf[10])) {
                    $('form .js-cpf').css("border", "2px solid #ed1915");
                } else {
                    $('form .js-cpf').css("border", "2px solid #17dd17");
                }
            } else {
                $('form .js-cpf').css("border", "2px solid #ed1915");
            }
        });
    };

    validarCPF();

    autenticadoParaCompra();

    $('#tenho-cadastro').click(function() {
        var url_atual = window.location.href+'?autenticado';
        $('#telaInicial').val(url_atual);
    });

    var $doc = $('html, body');
    $('.ancora').click(function() {
        // $doc.animate({
        //     scrollTop: $($.attr(this, 'href')).offset().top
        // }, 500);
        // return false;
    });

    $('.nav a').click(function() {
        $('.navbar-collapse').collapse('hide');
    });

    $(".btn-cadastro").click(function() {
        $("div.enter-login").css("display", "none");
        $("div.singUp").css("display", "block");
    });
    $(".btn-entrar").click(function() {
        $("div.singUp").css("display", "none");
        $("div.enter-login").css("display", "block");
    });

    $(".btn-recuperar").click(function() {
        $("#myModal").modal('hide');
    });

    $(".tel").click(function() {
        $(this).html($(this).attr('data-number'));
    });
});

$(document).ready(function(){
    // $("#js--foto-perfil").css("background","url("+items.foto_perfil+")");
    var usuario_logado = $("#formCadastroAluno").data("usuario");
    // console.log(usuario_logado);
    $.ajax({
        type: "POST",
        url: "http://localhost/wordpress/wp-content/themes/Site/php/check-user-compra.php",
        dataType: 'json',
        data: {email: usuario_logado},
        success: function(data) {

            for (var i = 0; i < data.length; i++) {
                var items = data[i];
                $(".js-codigo").val(items.codigo);
                $(".js-nome").val(items.nome);
                $(".js-email").val(items.email);
                $(".js-telefone").val(items.telefone);
                $(".js-cpf").val(items.cpf);
                $(".js-cidade").val(items.cidade);
                $(".js-cep").val(items.cep);
                $(".js-endereco").val(items.endereco);
                $(".js-estado").val(items.estado);
                $(".js-bairro").val(items.bairro);
                $(".js-numero").val(items.numero);
                $(".js-complemento").val(items.complemento);
            }
        }
    });
});

$(document).ready(function() {
    

    function currencyFormatted(value) {
        return value.formatMoney(2, ',', '.');
    };

    Number.prototype.formatMoney = function(c, d, t) {
        var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    // Ativa item clicado
    $('.item_turma').click(function() {
        $.ajax({
            type: 'GET',
            url: 'http://localhost/wordpress/wp-content/themes/Site/pagseguro/get-session.php',
            cache: false,
            success: function(data) {
                PagSeguroDirectPayment.setSessionId(data);
                // console.log(data);
            }
        });
        $(".item_turma").removeClass("active_turma");
        var codigo_turma = $(this).data("cod");
        var lote_atual = $("#lote_atual").val();
        $(this).toggleClass("active_turma", "active_turma");
        $(".libera-compra").fadeIn('slow');

        // Seta o atributo data com o valor para tratamento dos formulários de pagamento
        var preco = $("#precoCurso").val();
        var preco_final = btoa(preco);
        $(".track-0").attr("data-track", preco_final);
        $(".js-info").val("Turma: " + codigo_turma + " Lote: " + lote_atual);
        
    });

    $(".item_turma").on('click', function(){
        // $(this).hide();

        var _codigo  = $('.js-codigo').val();
        var _produto = $('#js-curso-codigo').val();
        var _turma   = $(".item_turma").data("cod");

        $.ajax({
            url: '/wordpress/wp-content/themes/Site/php/verifica-compra.php',
            type: 'POST',
            data: {
                codUsuario:   _codigo,
                codProduto:   _produto,
                codTurma:     _turma,
            },
            success: function(response) {
                if(response == "false"){
                    $(".libera-continuar").fadeIn("slow");                   
                } else {
                    if(response == 1){
                        $(".item-turma").removeClass("active_turma");
                        $(".msg-conta").fadeIn("slow");
                        $(".msg-conta").html("Já existe uma compra desse curso em andamento. Situação: Aguardango pagamento");
                        console.log(response);    
                    } else if (response == 2){
                        $(".item-turma").removeClass("active_turma");
                        $(".msg-conta").fadeIn("slow");
                        $(".msg-conta").html("Já existe uma compra desse curso em andamento. Situação: Em análise");
                        console.log(response);    
                    } else if (response == 3){
                        $(".item-turma").removeClass("active_turma");
                        $(".msg-conta").fadeIn("slow");
                        $(".msg-conta").html("Você já está inscrito neste curso. Acesse o painel para acompanhar as aulas.");
                        console.log(response);    
                    } else {
                        $(".item-turma").removeClass("active_turma");
                        $(".msg-conta").fadeIn("slow");
                        $(".msg-conta").html("<b>Sua compra deste curso foi cancelada. Aguarde por mais informações do suporte.</b> <br>");
                        setTimeout(function(){ 
                            $(".msg-conta").append("<span onclick='liberaCompra()'>Deseja tentar novamente? clique aqui!</span>").delay(1000).fadeIn('slow');                             
                        }, 3000);
                    }
                }
            },
            error: function() {
                alert('Erro');
            }
        });

        // $("#formCadastroAluno").fadeIn('slow');
        // $(".payment_card").fadeIn('slow');
        // $(".payment_boleto").fadeIn('slow');
        // $(".cupom-desconto").fadeIn('slow');
    });
    $("#js-pagamento--libera").on('click', function(){
        $(this).hide();
        $("#formCadastroAluno").fadeIn('slow');
        $(".payment_card").fadeIn('slow');
        $(".payment_boleto").fadeIn('slow');
        $(".cupom-desconto").fadeIn('slow');
    });

    /*
        Nome: Validação e aplicação de cupom promocional
        Obs.: 
    */
    $("form.cupom-desconto").validate({
        rules: {
            cupomdesconto: {
                required: true
            }
        },
        messages: {
            cupomdesconto: {
                required: 'Informe o Cupom'
            }
        },
        submitHandler: function(form) {
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "/wp-content/themes/Site/php/check-cupom.php",
                data: dados,
                success: function(data) {
                    if (data == "0") {
                        $("form.cupom-desconto").find(".messenger").append("<label class='error'>Cupom Inválido</label>");
                    } else {
                        $("form.cupom-desconto").find("#msg_cupom").append("<label class='text-success' style='color: green'>Cupom de " + data + "% aplicado com sucesso</label>");
                        var atualPrice = parseFloat(atob($(".product-all-track").find("aside.track-0").attr("data-track")));
                        var percent = parseFloat(data) / 100;
                        atualPrice -= atualPrice * percent;
                        arredonPrice = atualPrice.toFixed(2);
                        price = parseFloat(arredonPrice);

                        $(".track-0").attr("data-track", btoa(price));
                        $(".track-1").attr("data-track", btoa(price * 3));
                        $(".track-4").attr("data-track", btoa(price * 12));
                        $("form.cupom-desconto").find("input").attr("disabled", "disabled");
                        $(".price").html("<span class='text-success'>" + currencyFormatted(price) + "</span>");
                    }
                }
            });
            return false;
        }
    });

    $("form.newsletter").validate({
        rules: {
            txtnome: {required: true},
            txtemail: {required: true, email:true}
        },
        messages: {
            txtnome: { required: 'Informe seu nome'},
            txtemail:{required:"informe seu email", email:'Digite um email válido'}
        },
        submitHandler: function(form) {
            $(".newsletter").css('opacity','0.5');
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "/wp-content/themes/Site/php/envia-news.php",
                data: dados,
                success: function(data) {
                    if (data == "0") {
                        $(".newsletter").css('opacity','1');
                        $(".form_news").append("<label class='error'>Ocorreu um erro no envio, tente mais tarde.</label>");
                    } else {
                        $(".newsletter").css('opacity','1');
                        $(".form_news").append("<label class='text-success' style='color: green'> Enviado com sucesso!</label>");
                    }
                }
            });
            return false;
        }
    });
});

$(document).ready(function() {

    $("#owl-banner").owlCarousel({
        items: 1,
        autoPlay: true,
        nav: true,
        lazyLoad: true,
        lazyContent: true,
        autoplayTimeout: 500,
        slideSpeed: 2000,
        paginationSpeed: 2000,
        rewindSpeed: 2000,
        itemsTablet: [768, 1],
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [992, 1],
        itemsMobile: [479, 1],
        smartSpeed: 2000
    });

    $("#owl-quem-somos").owlCarousel({
        items: 1,
        autoPlay: true,
        nav: true,
        lazyLoad: true,
        lazyContent: true,
        autoplayTimeout: 500,
        slideSpeed: 2000,
        paginationSpeed: 2000,
        rewindSpeed: 2000,
        itemsTablet: [768, 1],
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [992, 1],
        itemsMobile: [479, 1],
        smartSpeed: 2000
    });

    jQuery.validator.addMethod("ddd", function(value, element) {
        var i = 0,
            acert = 0;
        var codigosDDD = [
            11, 12, 13, 14, 15, 16, 17, 18, 19,
            21, 22, 24, 27, 28, 31, 32, 33, 34,
            35, 37, 38, 41, 42, 43, 44, 45, 46,
            47, 48, 49, 51, 53, 54, 55, 61, 62,
            64, 63, 65, 66, 67, 68, 69, 71, 73,
            74, 75, 77, 79, 81, 82, 83, 84, 85,
            86, 87, 88, 89, 91, 92, 93, 94, 95,
            96, 97, 98, 99
        ];
        var str = value;
        var res = parseInt(str.slice(1, 3));
        for (i = 0; i < codigosDDD.length; i++) {
            if (codigosDDD[i] == res) {
                acert++;
            }
        }
        return (acert > 0) ? true : false;
    }, "Digite DDD valido");


    $("form.formContato").validate({
        rules: {
            txt_nome: {
                required: true
            },
            txt_email: {
                required: true,
                email: true
            },
            txt_telefone: {
                required: true
            },
            txt_mensagem: {
                required: true
            }
        },
        messages: {
            txt_nome: {
                required: 'Informe o seu nome'
            },
            txt_email: {
                required: 'Informe seu e-mail',
                email: 'Informe um e-mail válido'
            },
            txt_telefone: {
                required: 'Informe um número de telefone'
            },
            txt_mensagem: {
                required: 'Deixe uma mensagem'
            }
        },
        submitHandler: function(form) {
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "/wp-content/themes/Site/php/send.php",
                data: dados,
                success: function(data) {

                    msgAlerta("Mensagem enviada com sucesso!");
                    $("form.formContato")[0].reset();

                }
            });
        }
    });

    $('form.enter-login').validate({
        rules: {
            log_email: {
                required: true
            },
            log_senha: {
                required: true
            }
        },
        messages: {
            log_email: {
                required: 'Informe seu email'
            },
            log_senha: {
                required: 'Informe sua senha'
            }
        },
        submitHandler: function(form) {
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Site/php/checkuser.php",
                data: dados,
                success: function(response) {

                    console.log(response);

                    var data = $.parseJSON(response);
                    console.log(data);
                    if (data.return == "true") {

                        var username = $("input[name=log_email]").val();
                        var pagina = $("input[name=telaInicial]").val();
                        console.log(data.return);
                        // $.redirect("http://cursos.lisieuxtreinamento.com.br/authentic/", {
                        $.redirect("/wordpress/autenticar/", {
                            email: username,
                            tipo: data.type,
                            tela:pagina,
                            permission: true,
                        });
                        msgAlerta("Bem-vindo! Carregando...");
                        console.log(username);
                        console.log(data);

                    } else {
                        msgAlerta("Usuário e/ou Senha incorreto");
                    }
                }
            });
            return false;
        }
    });

    $('form.singUp').validate({
        rules: {
            nome: {
                required: true,
                minlength: 2,
                number: false
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "http://localhost/wordpress/wp-content/themes/Site/php/check-exists-mail.php",
                    type: "post",
                    complete: function(data) {
                        console.log(data);
                    }
                },
            },
            confirmaEmail: {
                equalTo: '#verifyEmail'
            },
            telefone: {
                required: true,
                ddd: true
            },
            dataNascimento: {
                required: true
            },
            genero: {
                required: true
            },
            senha: {
                required: true,
                minlength: 8
            },
            confirmaSenha: {
                equalTo: '#senha'
            }
        },
        messages: {
            nome: {
                required: 'Preencha o campo nome',
                minlength: 'No mínimo 2 letras',
                number: 'Apenas letras'
            },
            email: {
                required: 'Informe o seu e-mail',
                email: 'Informe um e-mail válido',
                remote: jQuery.format("Este e-mail já foi cadastrado")
            },
            confirmaEmail: {
                equalTo: 'Os campos não sào iguais'
            },
            telefone: {
                required: 'Informe seu Telefone'
            },
            dataNascimento: {
                required: 'Informe sua data de nascimento'
            },
            genero: {
                required: 'Selecione um gênero'
            },
            senha: {
                required: 'Digite uma senha',
                minlength: 'Por favor, insira ao menos 8 caracteres'
            },
            confirmaSenha: {
                equalTo: 'Os campos não sào iguais'
            }

        },
        submitHandler: function(form) {
            var dados = $(form).serialize();
            $(".submitSingUp").attr("disabled", "disabled");
            $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Site/php/cadastrar-aluno.php",
                data: dados,
                success: function(data) {
                    if(data==false){
                        alert("Um erro ocorreu, tente novamente mais tarde");
                    }
                    $("#myModal").modal('hide');
                    $(".btn-modal-final").trigger("click");
                }
            });
            return false;
        }
    });

    $("form.recuperar-senha").validate({
        rules: {
            rec_email: {
                required: true,
                email: true
            }
        },
        messages: {
            rec_email: {
                required: 'Informe um email',
                email: 'Informe um email valido'
            }
        },
        submitHandler: function(form) {
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Site/php/recover-password.php",
                data: dados,
                success: function(data) {
                    $("#myModal3").modal('hide');
                    alert("Verifique suas caixa de email");
                }
            });
            return false;
        }
    });

    $("form.redefinir-senha").validate({
        rules: {
            red_senha: {
                required: true,
                minlength: 8
            },
            red_confirmaSenha: {
                equalTo: '#red_senha'
            }
        },
        messages: {
            red_senha: {
                required: 'Digite uma senha',
                minlength: 'Por favor, insira ao menos 8 caracteres'
            },
            red_confirmaSenha: {
                equalTo: 'Os campos não sào iguais'
            }
        },
        submitHandler: function(form) {
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Site/php/reset-password.php",
                data: dados,
                success: function(data) {
                    if (data == "true") {
                        alert("Senha redefinida com sucesso");
                        window.location.href = "http://lisieuxtreinamento.com.br/";
                    } else {
                        alert("Desculpe, ocorreu algum problema. Tente mais tarde");
                    }
                }
            });
            return false;
        }
    });

    $(".inpt label").on("click", function() {
        var name = $(this).attr("for");
        $("input[name=" + name + "]").focus();
    });
});

$("#submitSingUp").click(function() {
    var $form = $(' #formCadastroAluno ');//singUp
    $($form).validate({
        rules: {
            nome: {
                required: true,
                minlength: 2,
                number: false
            },
            email: {
                required: true,
                email: true
                
            },
            confirmaremail: {
                required: true,
                equalTo: '#verificaEmail'
            },
            telefone: {
                required: true,
                ddd: true
            },
            dataNascimento: {
                required: true
            },
            genero: {
                required: true
            },
            senha: {
                required: true,
                minlength: 8
            },
            confirmarsenha: {
                required: true,
                equalTo: '#verificaSenha'
            },
            cpf: {
                required: true,
                minlength: 9
            },
            telefone: {
                required: true
            },
            cep: {
                required: true
            },
            endereco: {
                required: true
            },
            numero: {
                required: true
            },
            bairro: {
                required: true
            },
            cidade: {
                required: true
            },
            estado: {
                required: true
            },
        },
        messages: {
            nome: {
                required: 'Preencha o campo nome',
                minlength: 'No mínimo 2 letras',
                number: 'Apenas letras'
            },
            email: {
                required: 'Informe o seu e-mail',
                email: 'Informe um e-mail válido'
                // remote: jQuery.format("Este e-mail já foi cadastrado")
            },
            confirmaremail: {
                equalTo: 'Os campos não são iguais',
                required: 'Confirme o seu email',
            },
            telefone: {
                required: 'Informe seu Telefone'
            },
            dataNascimento: {
                required: 'Informe sua data de nascimento'
            },
            genero: {
                required: 'Selecione um gênero'
            },
            senha: {
                required: 'Digite uma senha',
                minlength: 'Por favor, insira ao menos 8 caracteres'
            },
            confirmarsenha: {
                equalTo: 'Os campos não sào iguais',
                required: 'Confirme a senha',
            },
            cpf: {
                required: 'Informe seu cpf',
                minlength: 'Insira um cpf válido'
            },
            telefone: {
                required: 'Informe seu telefone'
            },
            cep: {
                required: 'Informe seu cep'
            },
            endereco: {
                required: 'Informe seu endereco'
            },
            numero: {
                required: 'Informe seu numero'
            },
            bairro: {
                required: 'Informe seu bairro'
            },
            cidade: {
                required: 'Informe seu cidade'
            },
            estado: {
                required: 'Informe seu estado'
            },
        },
        submitHandler: function(form) {
            var dados = $(' #formCadastroAluno ').serialize();
            $.ajax({
                type: 'POST',
                url: 'http://localhost/wordpress/wp-content/themes/Site/php/cadastrar-aluno.php',
                async: true,
                data: dados,
                beforeSend: function() {
                    $('.cupom-desconto').append('\
                      <div id="alert-msg" class="alert alert-dark before-send" role="alert" style="position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                          <p style="margin-bottom: 0;">Processando... Aguarde um instante.</p>\
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                      </div>\
                  ');
                },
                success: function(response) {
                    if (response == false || response == 'false') {
                        $(".before-send").hide();
                        chamaAlerta("Preencha os campos corretamente.", "alert-danger");
                    } else {
                        // Seta o atributo data com o valor para tratamento dos formulários de pagamento
                        $(".js-codigo").val(atob(response));
                        $(".before-send").hide();
                        $form.fadeOut('slow');
                        $form.attr("data-cadastrado","sucesso");
                        $('.cupom-desconto').append('\
                            <div id="alert-msg" class="alert alert-dark" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                                <p style="margin-bottom: 0;">Cadastro realizado com sucesso! Continue a compra.</p>\
                            </div>\
                        ');
                    }
                }
            });
        }
    });
});

$(".js-mostra").click(function() {
    var boleto = ".pagamento_boleto";
    var credito = ".pagamento_credito";
    var submit = "#js-btn_finaliza";

    var mostra = $(this).data("mostra");
    if (mostra == boleto) {
        $(credito).slideUp('slow');
        $(mostra).slideDown('slow');
        $(submit).html("Gerar Boleto");
    }
    if (mostra == credito) {
        $(boleto).slideUp('slow');
        $(mostra).slideDown('slow');
        $(submit).html("Finalizar");
    }
});

$("#go-painel").on("click", function(){
    var email   = $(this).data("email");
    var tipo    = $(this).data("tipo");
    $.redirect('http://cursos.lisieuxtreinamento.com.br/authentic/', { 
        email: email,
        tipo: tipo,
    });
});

$("#frmLogin").submit(function(e){
    e.preventDefault();
    var url_Cursos  = 'http://cursos.lisieuxtreinamento.com.br/authentic/'; 
    var url_Publica = 'http://lisieuxtreinamento.com.br/autenticar/';
    // Verificando se o usuário existe para gerar o token
    $.post('http://localhost/wordpress/wp-content/themes/Site/php/checkuser.php', $("#frmLogin").serialize(), function(data){
        // Enviando para gerar o token
        var json = $.parseJSON(data);
        var _codigo = json.codigo;
        var _tipo = json.type;

        // Pega do JSON o valor.ID do usuário que logou
        $.ajax({
            url: 'http://localhost/wordpress/wp-content/themes/Site/php/jwt-test/public/0auth.php',
            type: 'POST',
            data: {
                codigo:     _codigo,
                username:   $("input[name='log_email']").val(),
                tipo:       _tipo,
            },
            success: function(response) {
                // Caso o TOKEN seja gerado, cadastra no banco
                // console.log(response);
                // Verifica se é um Token válido
                
                // startaSession(response, url_Publica);

                $.redirect(url_Publica, { 
                    token: response
                });
            },
            error: function() {
                alert('Erro de autenticação de crendencial.');
            }
        });
    }).fail(function(){
        console.log('erro ao buscar usuário');
    });
});

$(".payment_card").on('submit', function() {

    return false;
});

$(".payment_boleto").on('submit', function() {

    return false;
});

function liberaCompra() {
    $(".msg-conta").remove();
    $(".libera-continuar").fadeIn("slow");
    $(".item-turma").addClass("active_turma");
};

/* ---- Funções ----*/
function chamaAlerta(msg, classe) {
    var alerta = $('.alert');
    alerta.addClass(classe);
    alerta.html(msg);
    alerta.fadeIn('slow');

    setTimeout(function() {
        alerta.fadeOut('slow');
        alerta.removeClass(classe);
    }, 1500);
};

function brandCard() {
    var numcard = $("#numero").val();
    var bin = numcard.substr(0, 6);
    var brandID;
    PagSeguroDirectPayment.setSessionId($('#sessionId').val());
    PagSeguroDirectPayment.getBrand({
        cardBin: bin,
        success: function(response) {
            brandID = response.brand.name;
            console.log(brandID);
            console.log(response.brand.name);
            $("#creditCardBrand").val(response.brand.name);
            $("#bandeira").attr('src', ' https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/' + response.brand.name + '.png');
        },
        error: function(response) {
            //tratamento do erro
            console.log(response);
        },
        complete: function(response) {
            //tratamento comum para todas chamadas
        }
    });
};

function validarCartao(senderHash) {

    var cardTokenId = "";
    PagSeguroDirectPayment.setSessionId($('#sessionId').val());
    PagSeguroDirectPayment.createCardToken({

        cardNumber: $("#numero").val(),
        brand: $("#creditCardBrand").val(),
        cvv: $("#cvv").val(),
        expirationMonth: $("#mes").val(),
        expirationYear: $("#ano").val(),

        success: function(response) {
            $("#creditCardToken").val(response.card.token);
            cardTokenId = response.card.token;
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        }
    });
};

function fecharPedido(senderHash) {
    var formAluno = $("#formCadastroAluno");
    
    if(formAluno.data("cadastrado") == "sucesso") {
        if ($("#creditCardToken").val() == null || $("#creditCardToken").val() == "") {
            alert("Informe Corretamente os dados do seu cartão de crédito");
        } else {

            var parcelas, valorCurso, valorParcela;

            parcelas = parseInt($("#parcelas").val());
            valorCurso = parseFloat(atob($(".product-all-track").find("aside.track-0").attr("data-track")).replace('.','').replace(',','.'));

            valorParcela = valorCurso / parcelas;

            // console.log(valorParcela);
            $.ajax({
                type: 'POST',
                url: 'http://localhost/wordpress/wp-content/themes/Site/pagseguro/pagamentoCartao.php',
                cache: false,
                data: {
                    usuario: $('.js-codigo').val(),
                    email: $('.js-email').val(),
                    email: 'c07591213297083290802@sandbox.pagseguro.com.br',
                    nome: $('.js-nome').val(),
                    cpf: $('.js-cpf').val(),
                    telefone: $('.js-telefone').val(),
                    cep: $('.js-cep').val(),
                    endereco: $('.js-endereco').val(),
                    numero: $('.js-numero').val(),
                    complemento: $('.js-complemento').val(),
                    bairro: $('.js-bairro').val(),
                    cidade: $('.js-cidade').val(),
                    estado:   $('.js-estado').val(),
                    // estado: 'SP',
                    pais: "BRA",
                    id: $('.js-produto').val(),
                    produto: $('#js--sigla-curso').val()+$(".item_turma").data("cod"),
                    info: $(".js-info").val(),
                    senderHash: senderHash,

                    enderecoPagamento: "Rua Frei Gaspar",
                    numeroPagamento: "931",
                    complementoPagamento: "conj. 45",
                    bairroPagamento: "Centro",
                    cepPagamento: "11310-061",
                    cidadePagamento: "São Vicente",
                    estadoPagamento: "SP",

                    cardToken: $("#creditCardToken").val(),
                    cardNome: $("#cardnome").val(),
                    cardNasc: $("#nascimento").val(),
                    cardCPF: $("#cpf").val(),

                    numParcelas: $("#parcelas").val(),
                    valorParcelas: valorParcela,
                    maxQuantidadeParcelas: 5

                },
                beforeSend: function() {
                    $('.content_contas').append('\
                        <div id="alert-msg--carregando" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                            <p style="margin-bottom: 0;">Aguarde um instante...</p>\
                        </div>\
                    ');
                },
                success: function(data) {
                    $("#alert-msg--carregando").remove();
                    console.log(data);
                    if (data.error) {
                        // Tratamento de erros
                        var error_falha = "";
                        if(data.error.code == "53017") {
                            error_falha = "CPF inválido, por segurança esta ação de compra foi bloqueada.";
                        }
                        if(data.error.code == "53122") {
                            error_falha = "Email inválido.";
                        }

                        $("#alert-msg--carregando").hide();
                        $(".item_turma").hide();
                        $(".before-send").hide();
                        $(".cupom-desconto").hide();
                        $(".formCad").hide(); 
                        $(".payment_card").hide();
                        $(".payment_boleto").hide();
                        $(".situacao-cadastro").fadeIn('slow');
                        $('#js-situacao_titulo').html("Inscrição não concluída");
                        $('#js-situacao_descricao').html("Erro ao processar o seu pagamento <br> "+error_falha);
                        $('#js-situacao_imagem').attr("src", "http://lisieuxtreinamento.com.br/wp-content/themes/Site/images/icon_falha.png");
                    } else {
                        var i_inscricao = data.reference;
                        var i_vl_parcelas = (data.grossAmount / data.installmentCount);
                        var i_qt_parcelas = data.installmentCount;
                        var i_pago = data.grossAmount;
                        var i_total = data.grossAmount;
                        var i_codigo = data.code;
                        var i_info = data.items.item.description;

                        // console.log(i_vl_parcelas);
                        $.ajax({
                            type: 'POST',
                            url: 'http://localhost/wordpress/wp-content/themes/Site/php/cadastrar-compra.php',
                            cache: false,
                            data: {
                                codProduto: $('#js-curso-codigo').val(),
                                inscricao: i_inscricao,
                                patrocinador: 'NULL',
                                status: 1,
                                vl_parcelas: i_vl_parcelas,
                                qt_parcelas: i_qt_parcelas,
                                pago: i_pago,
                                total: i_total,
                                forma: 'PagSeguro',
                                codigo: i_codigo,
                                info: i_info,
                                usuario: $('.js-codigo').val(),
                                email: $('.js-email').val(),
                                nome: $('.js-nome').val(),
                                cpf: $('.js-cpf').val(),
                                telefone: $('.js-telefone').val(),
                                cep: $('.js-cep').val(),
                                endereco: $('.js-endereco').val(),
                                numero: $('.js-numero').val(),
                                complemento: $('.js-complemento').val(),
                                bairro: $('.js-bairro').val(),
                                cidade: $('.js-cidade').val(),
                                estado: $('.js-estado').val(),
                                curso: $('#js--sigla-curso').val()+$(".item_turma").data("cod"),
                                pais: "BRA",
                                turma: $(".item_turma").data("cod")
                            },
                            success: function(response) {
                                if (response == false || response == "false") {} else {
                                    console.log("Cadastrado com sucesso");
                                    $("#alert-msg--carregando").hide();
                                    $(".item_turma").hide();
                                    $(".cupom-desconto").hide();
                                    $(".formCad").hide();
                                    $(".payment_card").hide();
                                    $(".payment_boleto").hide();
                                    $(".situacao-cadastro").fadeIn('slow');
                                } 
                            }
                        });
                        // $.ajax({
                        //     type: 'POST',
                        //     url: '/wp-content/themes/Site/pagseguro/get-status.php',
                        //     cache: false,
                        //     data: {
                        //         data: data.code
                        //     },
                        //     success: function(status) {
                        //         console.log(status);
                        //         if (status == "7" || status == 7) {
                                    // alert("Erro ao processar o seu pagamento");
                                    //console.log(data.paymentLink);
                        //             $(".before-send").hide();
                        //             $(".item_turma").hide();
                        //             $(".cupom-desconto").hide();
                        //             $(".formCad").hide();
                        //             $(".payment_card").hide();
                        //             $(".payment_boleto").hide();
                        //             $('js-situacao_titulo').html("Inscrição não concluída");
                        //             $('js-situacao_descricao').html("Erro ao processar o seu pagamento");
                        //             $('js-situacao_imagem').attr("src", "http://lisieuxtreinamento.com.br/wp-content/themes/Site/images/icon_falha.png");
                        //             $(".situacao-cadastro").fadeIn('slow');
                        //         } else {
                                    
                        //         }
                        //     }
                        // });
                    }
                }
            });
        }  
    } else {
        formAluno.append('\
            <div id="alert-msg" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                <p style="margin-bottom: 0;">Verifique se o formulário está preenchido corretamento.</p>\
            </div>\
        ');
    }
};

function pagarBoleto(senderHash) {
    var valorCurso = parseFloat(atob($(".product-all-track").find("aside.track-0").attr("data-track")).replace('.','').replace(',','.'));
    var formAluno = $("#formCadastroAluno");
    var titulo = $('.js-desc_produto').val();
    var nome_curso = titulo.replace('&', 'e');
    if(formAluno.data("cadastrado") == "sucesso") {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/wordpress/wp-content/themes/Site/pagseguro/pagamentoBoleto.php',
            cache: false,
            data: {
                usuario: $('.js-codigo').val(),
                email: $('.js-email').val(),
                // email: 'c07591213297083290802@sandbox.pagseguro.com.br',
                nome: $('.js-nome').val(),
                cpf: $('.js-cpf').val(),
                telefone: $('.js-telefone').val(),
                cep: $('.js-cep').val(),
                endereco: $('.js-endereco').val(),
                numero: $('.js-numero').val(),
                complemento: $('.js-complemento').val(),
                bairro: $('.js-bairro').val(),
                cidade: $('.js-cidade').val(),
                estado:   $('.js-estado').val(),
                // estado: 'SP',
                pais: "BRA",
                id: $('.js-produto').val(),
                produto: nome_curso,
                info: $(".js-info").val(),
                valor: valorCurso,
                senderHash: senderHash
            },
            beforeSend: function() {
                $('.content_contas').append('\
                    <div id="alert-msg--carregando" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                        <p style="margin-bottom: 0;">Aguarde um instante...</p>\
                    </div>\
                ');
            },
            success: function(data) {
                $("#alert-msg--carregando").fadeOut('slow');
                if (!(data.paymentLink)) {
                    console.log(data);
                    $.each(data.error, function(index, value) {
                        if (value.code) {
                            // console.log(value.code);
                        } else {
                            console.log(data.error.code);
                            if (data.error.code == "53017") {
                                $('.content_contas').append('\
                                    <div id="alert-msg" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                                        <p style="margin-bottom: 0;">CPF inválido...</p>\
                                    </div>\
                                ');
                            }
                            if (data.error.code == "53122") {
                                $('.content_contas').append('\
                                    <div id="alert-msg" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                                        <p style="margin-bottom: 0;">Versão sandbox...</p>\
                                    </div>\
                                ');
                            }

                        }
                    });
                } else {
                    //console.log(data.paymentLink);
                    $(".before-send").fadeOut('slow');
                    $(".content_turmas").hide();
                    $(".item_turma").hide();
                    $(".cupom-desconto").hide();
                    $(".formCad").hide();
                    $(".payment_card").hide();
                    $(".payment_boleto").hide();

                    $(".situacao-cadastro").fadeIn('slow');

                    var i_inscricao = data.reference;
                    var i_vl_parcelas = data.grossAmount;
                    var i_qt_parcelas = data.installmentCount;
                    var i_pago = data.grossAmount;
                    var i_total = data.grossAmount;
                    var i_codigo = data.code;
                    var i_info = data.items.item.description;

                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/wordpress/wp-content/themes/Site/php/cadastrar-compra.php',
                        cache: false,
                        data: {
                            codProduto: $('#js-curso-codigo').val(),
                            inscricao: i_inscricao,
                            patrocinador: 'NULL',
                            status: 1,
                            vl_parcelas: i_vl_parcelas,
                            qt_parcelas: i_qt_parcelas,
                            pago: i_pago,
                            total: i_total,
                            forma: 'PagSeguro',
                            codigo: i_codigo,
                            info: i_info,
                            usuario: $('.js-codigo').val(),
                            email: $('.js-email').val(),
                            nome: $('.js-nome').val(),
                            cpf: $('.js-cpf').val(),
                            telefone: $('.js-telefone').val(),
                            cep: $('.js-cep').val(),
                            endereco: $('.js-endereco').val(),
                            numero: $('.js-numero').val(),
                            complemento: $('.js-complemento').val(),
                            bairro: $('.js-bairro').val(),
                            cidade: $('.js-cidade').val(),
                            estado: $('.js-estado').val(),
                            curso: nome_curso,
                            pais: "BRA",
                            turma: $("#js--turma").val()
                        },
                        success: function(response) {
                            if (response == false || response == "false") {
                                console.log(response);
                            } else {
                                $(".payment_boleto").append('\
                                    <div id="alert-msg" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                                        <p style="margin-bottom: 0;">Cadastro realizado com sucesso.</p>\
                                    </div>\
                                ');

                                $(".box_boleto").append('\ <iframe src=" '+data.paymentLink+' \" height="680px" width="100%"></iframe>\ ');
                                $('#myModal4').modal();
                                // window.open(data.paymentLink);
                            }
                        }
                    });
                }
            }
        });
    } else {
        formAluno.append('\
            <div id="alert-msg" class="alert alert-dark before-send" role="alert" style="display:block;position: fixed;top: 10%;left: 5%;width: 90%;background:#f4f4f4;color: #fff;border: none;text-align: center;padding-bottom: 20px;box-shadow: 0 0 27px 3px #334d4d45;">\
                <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 21px;font-weight: bolder;line-height: 1;color: #339966;position: relative;top: 10px;">&times;</a>\
                <p style="margin-bottom: 0;">Verifique se o formulário está preenchido corretamento.</p>\
            </div>\
        ');
    }
};

function autenticadoParaCompra(){
    var url = location.href;        
    if(url.includes("?autenticado")){   
        $('html, body').animate({scrollTop: $('#content_compra').offset().top }, 700);
        $('.item_turma').addClass('active_turma');
        $(".libera-continuar").fadeIn("slow"); 
        return false;       
    }
}

function thank() {

    alert("Mensagem Enviada com sucesso");
};

function msgAlerta(msg) {
    $("body").append('\
        <div id="alert-entrou" class="alert alert-dark" role="alert" style="">\
            <a href="#" class="close" data-dismiss="alert" aria-label="close" style="">&times;</a>\
            <p>'+msg+'</p>\
        </div>\
    ');
};

function startaSession(response, url) {
    var _token = response;
    if( _token != '' ) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                token: _token,
            },
            success: function(data) {
                // console.log(data);
                if(data == true) {
                    console.log("Sessão já existe.",url);
                    // location.reload();
                } else {
                    console.log("Sessão criada.",url);
                    // location.reload();
                }
                
            },
            error: function() {
                alert('Faça o login novamente!');
            }
        });
    }  
};
