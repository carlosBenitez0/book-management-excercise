<?php

// Clase Libro
class Libro {
    private $titulo;
    private $autor;
    private $categoria;
    private $estado; // disponible o prestado

    public function __construct($titulo, $autor, $categoria) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->estado = 'disponible';
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}

class Biblioteca {
    private $libros = [];

    // Método para agregar un libro
    public function agregarLibro(Libro $libro) {
        $this->libros[] = $libro;
    }

    // Método para buscar libros por título, autor o categoría
    public function buscarLibro($criterio, $valor) {
        $resultados = [];
        foreach ($this->libros as $libro) {
            if (($criterio === 'titulo' && $libro->getTitulo() === $valor) ||
                ($criterio === 'autor' && $libro->getAutor() === $valor) ||
                ($criterio === 'categoria' && $libro->getCategoria() === $valor)) {
                $resultados[] = $libro;
            }
        }
        return $resultados;
    }

    // Método para registrar préstamo de un libro
    public function prestarLibro($titulo) {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && $libro->getEstado() === 'disponible') {
                $libro->setEstado('prestado');
                return "El libro '{$titulo}' ha sido prestado con éxito.";
            }
        }
        return "El libro '{$titulo}' no está disponible o no existe.";
    }

    // Método para listar todos los libros
    public function listarLibros() {
        return $this->libros;
    }
}

// Uso del sistema
$biblioteca = new Biblioteca();

// Crear libros
$libro1 = new Libro("Cien años de soledad", "Gabriel García Márquez", "Novela");
$libro2 = new Libro("El principito", "Antoine de Saint-Exupéry", "Infantil");
$libro3 = new Libro("1984", "George Orwell", "Ficción");

// Agregar libros a la biblioteca
$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);
$biblioteca->agregarLibro($libro3);

// Buscar un libro por autor
$resultados = $biblioteca->buscarLibro('autor', "George Orwell");
foreach ($resultados as $libro) {
    echo "Encontrado: " . $libro->getTitulo() . "\n";
}

// Prestar un libro
echo $biblioteca->prestarLibro("1984") . "\n";

// Intentar prestar un libro que ya está prestado
echo $biblioteca->prestarLibro("1984") . "\n";

// Listar todos los libros
foreach ($biblioteca->listarLibros() as $libro) {
    echo "Título: " . $libro->getTitulo() . ", Estado: " . $libro->getEstado() . "\n";
}
