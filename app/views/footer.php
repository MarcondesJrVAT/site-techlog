			<footer id="footer" style="background-color: #e77242; color: #fff;">
				<div class="container">
					<div class="footer-top clearfix">

						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="footer-logo animate fadeInLeft"><a href="/"><img src="/assets/images/logos/logo-techlog.png" width="172" alt=""></a></div>
							</div>
							<div class="col-md-9 col-sm-9">
								<div class="footer-info text-left">
									<p><strong>TECHLOG SERVIÇOS DE GESTÃO E SISTEMAS INFORMATIZADOS LTDA</strong> – CNPJ: 03.613.289/0001-02</p>
									<p>R PEDRARIAS DE AVILAR, 26 - CONJ 31 DE MARÇO TÉRREO SALA 01</p>
									<p>Manaus - AM - CEP 69.077-450</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="footer-bottom" style="background-color: #e77242; border-color: #d05e2a; color: #fff;">
					<div class="container">
						<div class="row">
							<ul class="social text-center">
								<li class="animate bounceIn" data-delay="300">
									<a href="mailto:comercial@techlog.com.br" target="_blank" class="twitter"><i class="icon-mail"></i></a>
								</li>
								<li class="animate bounceIn" data-delay="300">
									<a href="https://maps.app.goo.gl/pMWj1X8TryAgQApj8" target="_blank" class="google"><i class="icon-map"></i></a>
								</li>
							</ul>
							<br />
							<div class="col-md-12 col-sm-12 text-center">
								<p>
									Comercial <a href="#" style="color: #fff;">(92) 3306-4410 / (92) 3306-4405</a>
								</p>
								<p>Copyright © <?= date('Y'); ?> <strong>Techlog Serviços Informatizados</strong> Todos os direitos reservados.</p>
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