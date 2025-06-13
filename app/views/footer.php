			<footer id="footer">
				<div class="container">
					<div class="footer-top clearfix">

						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="footer-logo animate fadeInLeft"><a href="/"><img src="/assets/images/logo-vat.png" width="172" alt=""></a></div>
							</div>
							<div class="col-md-9 col-sm-9">
								<p class="text-justify">A VAT é uma empresa de Tecnologia da Informação e produção de conteúdo televisivo criada no ano de 2000, especializada em educação em massa e comunicação corporativa, aplicando a plataforma de <i>software</i> IP.TV, já utilizada no Brasil por mais de 2 milhões de alunos, em mais de 7.000 salas de aula/polos.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<ul class="social text-center">
								<li class="animate bounceIn" data-delay="300">
									<a href="mailto:comercial@vat.com.br" target="_blank" class="twitter"><i class="icon-mail"></i></a>
								</li>
								<li class="animate bounceIn" data-delay="300">
									<a href="https://goo.gl/maps/vCQUMFfrMUokrXB66" target="_blank" class="google"><i class="icon-map"></i></a>
								</li>
							</ul>
							<br />
							<div class="col-md-12 col-sm-12 text-center">
								<p>
									Comercial <a href="tel:+5592985291529">+55 92 98529-1529</a> · Suporte <a href="tel:08000464632">0800 046 4632</a>
								</p>
								<p>Coyright © <?= date('Y'); ?> <strong>VAT Tecnologia da Informação</strong> Todos os direitos reservados.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<div class="div-privacy-policy hide">
				<p class="text-justify">Este site usa cookies para garantir que você obtenha a melhor experiência. Ao continuar, você concorda com nossa <a href="/politica-privacidade" target="_blank">política de privacidade</a>. <span class="label label-primary cursor-pointer" id="accept-privacy-policy">Aceitar</span></p>
			</div>
			<script src="/assets/js/scripts.min.js?v=1.0.1"></script>
			<script>
				if (!localStorage.pureJavaScriptCookies) {
					document.querySelector(".div-privacy-policy").classList.remove('hide');
				}

				const acceptCookies = () => {
					document.querySelector(".div-privacy-policy").classList.add('hide');
					localStorage.setItem("pureJavaScriptCookies", "accept");
				};

				const btnCookies = document.querySelector("#accept-privacy-policy");

				btnCookies.addEventListener('click', acceptCookies);
			</script>

			<!-- <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-80522056-1', 'auto');
		  ga('send', 'pageview');

		</script> -->
			</body>

			</html>