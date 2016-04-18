$(document).ready(function(){
	
	$(".nano").nanoScroller();

	$("nav").attr("data-initial-postion", $("nav").position().top);

	$("section").each(function(){
		$(this).attr("data-initial-postion", $(this).position().top - 100);
	});

	$(".nano-content").scroll(function(){
		var posScroll = $(this).scrollTop();
		var posMenu   = parseInt($("nav").attr('data-initial-postion'));

		if(posScroll > posMenu && ! $("nav").hasClass("fixed")){
			$("nav").addClass("fixed");
			$("#about").addClass("fixed");
		}else if(posScroll <= posMenu){
			$("nav").removeClass("fixed")
			$("#about").removeClass("fixed");
		}
	});

	$("#presentation .btn").click(function(){
		scrollToSection("#about");
	});

	var scrollToSection = function(section){
		var pos    = $(section).attr("data-initial-postion");
		var scroll = $('.nano-content').scrollTop();

		var step = (pos - scroll)/36;

		var animator = setInterval(function(){
			scroll += step;
			$(".nano").nanoScroller({scrollTop: scroll});
		},16);

		setTimeout(function(){
			clearInterval(animator);
		},600);
	}

	$("nav a").click(function(e){
		scrollToSection($(this).attr("data-section"));
	});


	$(".contact-form button").click(function(e){
		e.stopPropagation();
		e.preventDefault();

		var nome     = $("#input-name").val();
		var email    = $("#input-email").val();
		var mensagem = $("#input-message").val();

		$("#returnMessage").removeClass("active")

		if(nome.length <= 0)
			return contactError(0);
		if(email.length <= 0)
			return contactError(1);
		if(mensagem.length <= 0)
			return contactError(2);

		var request = $.post("message.php",{
			"name" : nome,
			"email" : email,
			"message" : mensagem
		});

		request.done(function(data){
			if(data.substr(0,1) == '1')
				$("#returnMessage").html("Ok, obrigado pelo contato.").addClass("active");
			else
				$("#returnMessage").html("Ops, algo de errado aconteceu.").addClass("active");
		});

		request.fail(function(){
			$("#returnMessage").html("Ops, algo de errado aconteceu.").addClass("active");
				$("#returnMessage").html("Ops, algo de errado").addClass("active");
		});

		request.fail(function(){
			$("#returnMessage").html("Ops, algo de errado").addClass("active");
		});
	});


	var contactError = function(errorCode){

		switch(errorCode){
			case 0:
				$("#returnMessage").html("Ops, o nome é obrigatório").addClass("active");
				$("#input-name").focus();
				break;
			case 1:
				$("#returnMessage").html("Ops, o email é obrigatório").addClass("active");
				$("#input-email").focus();
				break;
			case 2:
				$("#returnMessage").html("Ops, a mensagem é obrigatória").addClass("active");
				$("#returnMessage").html("Ops, o nome é obrigadtório").addClass("active");
				$("#input-name").focus();
				break;
			case 1:
				$("#returnMessage").html("Ops, o email é obrigadtório").addClass("active");
				$("#input-email").focus();
				break;
			case 2:
				$("#returnMessage").html("Ops, a mensagem é obrigadtória").addClass("active");
				$("#input-message").focus();
				break;
		}
	};

});