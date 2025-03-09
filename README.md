# 🌍 Backend - Travel App  

Este backend en **Laravel 10** gestiona la información de ciudades, presupuestos y servicios API externos como clima y cambio de moneda.  

## 📌 Características  
✅ API REST para manejar ciudades y presupuestos.  
✅ Integración con API de clima y conversión de moneda.  
✅ Migraciones y seeders para poblar la base de datos.  
✅ Arquitectura Modelo-Vista-Controlador (MVC).  
✅ Documentación de endpoints con Postman.  

---

## 🚀 Instalación y Configuración  

### 1️⃣ Clonar el Repositorio  
```bash
git clone https://github.com/tuusuario/travel-backend.git
cd travel-backend
2️⃣ Instalar Dependencias
bash
Copiar
Editar
composer install
3️⃣ Configurar Variables de Entorno
Copia el archivo de ejemplo:

bash
Copiar
Editar
cp .env.example .env
Edita .env y configura la base de datos:

ini
Copiar
Editar
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=travel_db  
DB_USERNAME=root  
DB_PASSWORD=  
También agrega las claves de API para los servicios externos:

ini
Copiar
Editar
API_CLIMA_KEY=tu_api_key
API_MONEDA_KEY=tu_api_key
4️⃣ Generar la Clave de Aplicación
bash
Copiar
Editar
php artisan key:generate
5️⃣ Ejecutar Migraciones y Seeders
bash
Copiar
Editar
php artisan migrate --seed
6️⃣ Iniciar el Servidor
bash
Copiar
Editar
php artisan serve
La API estará disponible en http://127.0.0.1:8000/api.

🛠️ Estructura del Proyecto
bash
Copiar
Editar
📂 travel-backend
 ├── 📂 app
 │    ├── 📂 Http
 │    │    ├── 📂 Controllers
 │    │    │    ├── CityController.php
 │    │    │    ├── BudgetController.php
 │    │    │    ├── AuthController.php
 │    ├── 📂 Models
 │    │    ├── City.php
 │    │    ├── Budget.php
 ├── 📂 database
 │    ├── 📂 migrations
 │    ├── 📂 seeders
 │    │    ├── CitySeeder.php
 ├── 📂 routes
 │    ├── api.php
 │    ├── web.php
 ├── .env
 ├── composer.json
 ├── README.md
🛠️ Modelo-Vista-Controlador (MVC)
📌 Modelo - City.php
Representa la tabla cities en la base de datos.

php
Copiar
Editar
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['country', 'currency_name', 'currency_symbol', 'currency_code'];
}
📌 Migración - 2024_03_07_create_cities_table.php
php
Copiar
Editar
public function up()
{
    Schema::create('cities', function (Blueprint $table) {
        $table->id();
        $table->string('country');
        $table->string('currency_name');
        $table->string('currency_symbol', 10);
        $table->string('currency_code', 5);
        $table->timestamps();
    });
}
📌 Seeder - CitySeeder.php
php
Copiar
Editar
public function run()
{
    City::create([
        'country' => 'Colombia',
        'currency_name' => 'Peso Colombiano',
        'currency_symbol' => '$',
        'currency_code' => 'COP'
    ]);
}
📌 Controlador - CityController.php
php
Copiar
Editar
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index() {
        return response()->json(City::select('country', 'currency_name', 'currency_symbol', 'currency_code')->get());
    }
}
🌐 Rutas en Laravel
📌 Archivo routes/api.php
php
Copiar
Editar
use App\Http\Controllers\CityController;

Route::get('/cities', [CityController::class, 'index']);
🔥 Servicios API Externos
📌 Clima - WeatherController.php
php
Copiar
Editar
public function getWeather($city) {
    $apiKey = env('API_CLIMA_KEY');
    $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey");
    return $response->json();
}
📌 Ruta en api.php

php
Copiar
Editar
Route::get('/weather/{city}', [WeatherController::class, 'getWeather']);
🔑 Autenticación con Laravel Sanctum
📌 Instalación de Sanctum

bash
Copiar
Editar
composer require laravel/sanctum
php artisan migrate
📌 Protección de rutas

php
Copiar
Editar
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
📂 Documentación de la API en Postman
Se incluye una colección de Postman con los endpoints:
📌 Postman Collection

Ejemplo de Endpoints
Método	Endpoint	Descripción
GET	/api/cities	Lista las ciudades
GET	/api/weather/{city}	Obtiene el clima de una ciudad
