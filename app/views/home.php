        <style>
            @media (max-width: 450px) {
                .cd-hero-slider .solutions-video {
                    top: 27%;
                }
            }

            @media only screen and (min-width:768px) {
                .embed-responsive-16by9-video {
                    padding-bottom: 32% !important;
                }

                .embed-responsive-item-video {
                    width: 95% !important;
                }

                @media only screen and (max-height: 414px) {
                    .embed-responsive-16by9-video {
                        padding-bottom: 60% !important;
                    }
                }
            }
        </style>

        <section class="bg-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 animate fadeInLeft">
                        <div class="height-10"></div>

                        <p class="text-justify">A VAT é uma empresa de Tecnologia da Informação, especializada em elaborar e executar projetos de educação em massa e comunicação corporativa, desde os anos 2000 no mercado, com resultados expressivos premiados nacional e internacionalmente.</p>

                        <div class="height-10"></div>

                        <p class="text-justify">A VAT aplica a Plataforma de Software IP.TV em projetos educacionais nas áreas pública e privada.</p>

                        <div class="height-20"></div>
                        <a href="/grupo" class="btn btn-primary" data-text="Saiba mais">Saiba mais</a>
                        <div class="height-40"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="different-services text-center parallax">
            <div class="container">
                <div class="heading animate bounceIn">
                    <h1 class="color-white">Valores</h1>
                </div>
            </div>
        </section>

        <section class="bg-blue">
            <div class="container">
                <div class="services text-center">
                    <div class="three-items-carousel owl-carousel">
                        <div class="service-box animate fadeInUp">
                            <i class="icon-img-1"></i>
                            <h4>Missão</h4>
                            <p>Pacote de serviços focado em produções televisivas mais profissionais, visando conferir qualidade e eficiência em todos os processos</p>
                        </div>
                        <div class="service-box">
                            <i class="icon-img-2"></i>
                            <h4>Visão</h4>
                            <p>Conjunto de soluções de <span style="font-style: italic;">software</span> para atender a diversos tipos de necessidades no mercado de videoconferência, focadas no ensino a distância.</p>
                        </div>
                        <div class="service-box">
                            <i class="icon-img-3"></i>
                            <h4>Valores</h4>
                            <p>Conteúdos educacionais, AVA, LMS, Gerenciamento e <span style="font-style: italic;">outsourcing</span> de projetos educacionais</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="container">
                <div class="heading text-center animate bounceIn">
                    <h2>Parceiros</h2>
                    <p>Quem já utilizou em todo o Brasil</p>
                </div>
                <ul class="highlighted-sec clearfix">
                    <a href="/projeto-seduc-amazonas">
                        <li>
                            <div class="text-box animate bounceIn">
                            </div>
                        </li>
                    </a>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="100">
                        </div>
                    </li>
                    <li>

                        <div class="text-box animate bounceIn" data-delay="200">
                        </div>

                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="300">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="400">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="500">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="100">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="200">
                        </div>
                    </li>

                    <li class="hidden-md hidden-xs  hidden-lg">
                        <div class="text-box animate bounceIn" data-delay="200">
                        </div>
                    </li>
                </ul>

                <ul class="highlighted-sec clearfix select hidden">
                    <li class="hidden-md hidden-xs hidden-sm">
                        <div class="text-box animate bounceIn" data-delay="300">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="400">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="500">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="100">
                        </div>
                    </li>
                    <li>
                        <div class="text-box animate bounceIn" data-delay="100">
                        </div>
                    </li>
                </ul>

                <ul class="highlighted-sec clearfix">
                    <li class="text-right pull-right">
                        <a class="show-all-customers" data-text="Ver todos usuários">Ver mais usuários</a>
                    </li>
                </ul>
        </section>

        <div class="contact-us-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="animate fadeInLeft text-center">Quer nos contactar? Clique ao lado</h4>
                    </div>
                    <div class="col-md-3">
                        <div class="text-left">
                            <a href="/fale-conosco" class="btn get-in-touch animate fadeInRight" style="background-color: #e77242;" data-text="Fale Conosco"><i class="icon-telephone114"></i>Fale Conosco</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Função para formatar números
            function formatNumber(value, format) {
                if (format === "k") {
                    return (value / 1000).toFixed(1).replace('.0', '') + "k"; // Divide por 1000 e adiciona "k"
                }
                return value; // Retorna o número original se nenhum formato for especificado
            }

            // Função para animar os números
            function animateCounter(element, target, prefix = "", format = "") {
                let start = 0;
                const duration = 2000; // 2 segundos
                const increment = Math.ceil(target / (duration / 20)); // Define o incremento
                const updateCounter = () => {
                    start += increment;
                    if (start >= target) {
                        element.textContent = prefix + formatNumber(target, format); // Formata o valor final
                    } else {
                        element.textContent = prefix + formatNumber(start, format);
                        requestAnimationFrame(updateCounter); // Chama novamente
                    }
                };
                updateCounter();
            }

            // Detecta quando os números estão visíveis na tela
            const counters = document.querySelectorAll(".quantity-counter");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const target = +entry.target.getAttribute("data-target");
                        const prefix = entry.target.getAttribute("data-prefix") || "";
                        const format = entry.target.getAttribute("data-format") || "";
                        if (!entry.target.classList.contains("counted")) {
                            animateCounter(entry.target, target, prefix, format);
                            entry.target.classList.add("counted"); // Evita contar novamente
                        }
                    }
                });
            }, {
                threshold: 1.0
            });

            // Adiciona os observadores aos elementos
            counters.forEach((counter) => observer.observe(counter));
        </script>