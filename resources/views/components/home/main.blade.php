<main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4   align-items-stretch">
                    <div class="content">
                        <h4>
                            <b>
                               Hospital 
                               Isidro Ayora
                            </b>
                        </h4>
                        <p>
                        Nuestro compromiso es servir a nuestros clientes con honestidad, integridad y calor humano, ofreciendo servicios de excelencia de manera rápida y eficiente. Trabajamos en equipo con entusiasmo y dedicación, siempre dando el máximo para cumplir nuestro compromiso con la excelencia.
                
                        </p>
                       
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-6 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Misión</h4>
                                    <p>
                                    Ofrecer servicios de excelencia en el campo médico, con la 
más avanzada tecnología, para lograr la satisfacción total de 
nuestros clientes. 
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Visión</h4>
                                    <p>
                                    Ser una institución conocida y respetada por su compromiso 
                                    continuo con la excelencia. 
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container-fluid">

            <div class="row">
                <div
                    class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                    <a href="https://www.youtube.com/watch?v=92ePBC9SHYc" class="glightbox play-btn mb-4"></a>
                </div>

                <div
                    class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                    <h3>Especialidades</h3>
                    <p>Los servicios que ofrecemos en nuestra clínica son:</p>
                 
                    @if (isset($dataEspecialidades) and count($dataEspecialidades) > 0)
                      <div class="row">
                      @foreach ($dataEspecialidades as $esp)
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                        <a href="">
                        <div class="icon-box">
                            <div class="icon"><i class='bx bx-street-view'></i></div>
                            <h5 class="title my-4">  {{$esp->nombre_esp}} </h5>
                          </div>
                        </a>
                      </div>
                      @endforeach
                      </div>
                      @else 
                      <div class="alert alert-danger">
                        <b>No hay especialidades aún....</b>
                      </div>
                    @endif
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    

</main><!-- End #main -->
 
