<?php
include_once 'config.php';

class ServicesController {
    private $servicios = [
        [
            "id" => 1,
            "titulo" => "Consultoría digital",
            "descripcion" => "Identificamos las fallas y conectamos los puntos entre tu negocio y tu estrategia digital. Nuestro equipo experto cuenta con años de experiencia en la definición de estrategias y hojas de ruta en función de tus objetivos específicos.",
            "activo" => true
        ],
        [
            "id" => 2,
            "titulo" => "Soluciones multiexperiencia",
            "descripcion" => "Deleitamos a las personas usuarias con experiencias interconectadas a través de aplicaciones web, móviles, interfaces conversacionales, digital twin, IoT y AR. Su arquitectura puede adaptarse y evolucionar para adaptarse a los cambios de tu organización.",
            "activo" => true
        ],
        [
            "id" => 3,
            "titulo" => "Evolución de ecosistemas",
            "descripcion" => "Ayudamos a las empresas a evolucionar y ejecutar sus aplicaciones de forma eficiente, desplegando equipos especializados en la modernización y el mantenimiento de ecosistemas técnicos. Creando soluciones robustas en tecnologías de vanguardia.",
            "activo" => true
        ],
        [
            "id" => 4,
            "titulo" => "Soluciones Low-Code",
            "descripcion" => "Traemos el poder de las soluciones low-code y no-code para ayudar a nuestros clientes a acelerar su salida al mercado y añadir valor. Aumentamos la productividad y la calidad, reduciendo los requisitos de cualificación de los desarrolladores.",
            "activo" => true
        ]
    ];
    

    public function show($id) {
        return isset($this->servicios[$id]) ? $this->servicios[$id] : null;
    }

    public function index() {
        return array_values($this->servicios);
    }
}
?>
