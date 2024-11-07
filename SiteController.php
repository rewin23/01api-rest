<?php

include_once 'config.php';

class SiteController {
    private $site = [
        "title" => "Mi sitio web",
        "descripcion" => "Bienvenido a mi sitio web. Aquí encontrarás información sobre nuestros servicios y nuestra empresa.",
    ];

    private $about = [
        [
            "titulo" => "Misión",
            "descripcion" => "Nuestra misión es ofrecer soluciones digitales innovadoras y de alta calidad que impulsen el éxito de nuestros clientes, ayudándolos a alcanzar sus objetivos empresariales a través de la tecnología y la creatividad."
        ],
        [
            "titulo" => "Visión",
            "descripcion" => "Nos visualizamos como líderes en el campo de la consultoría y desarrollo de software, reconocidos por nuestra excelencia en el servicio al cliente, nuestra capacidad para adaptarnos a las necesidades cambiantes del mercado y nuestra contribución al crecimiento y la transformación digital de las empresas."
        ]
    ];
    

    public function getMetadata() {
        return $this->site;
    }

    public function getAbout() {
        return $this->about;
    }
}