$(function(){

	$("#login").validate({

		submitHandler: function(form) {
	        return true;
	    },
	    rules: {
	        email: {
	            required:true,
	            email: true
	        },
	        senha: {
	            required:true
	        }
	    },
	    messages:{
	        email: {
	            required: "Insira seu email",
	            email: "Insira um email válido"
	        },
	        senha: {
	            required: "Insira sua senha"
	        }
	    }

	});

	$("#recurepar_senha").validate({

		submitHandler: function(form) {
	        return true;
	    },
	    rules: {
	        email: {
	            required:true,
	            email: true
	        }
	    },
	    messages:{
	        email: {
	            required: "Insira seu email",
	            email: "Insira um email válido"
	        }
	    }

	});

});