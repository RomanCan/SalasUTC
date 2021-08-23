<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class CrearMiBaseDeDatos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database {nombrebd} {tipo?} {cotejamiento?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando crea una Base de Datos.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $nombrebd = $this->argument('nombrebd'); 
            $tipo = $this->hasArgument('tipo') && $this->argument('tipo') ? $this->argument('tipo'): DB::connection()->getPDO->getAttribute(PDO::ATTR_DRIVER_NAME); 
            $cotejamiento = $this->argument('cotejamiento');

            switch ($cotejamiento) {
                case 'utf8':
                    $cot = "CHARACTER SET utf8 COLLATE utf8_general_ci";
                    break;
                case 'utf8-unicode':
                    $cot = "CHARACTER SET utf8 COLLATE utf8_unicode_ci";
                    break;
                case 'utf8mb4':
                    $cot = "CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
                    break;
                case 'utf8mb4-unicode':
                    $cot = "CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
                    break;
                            
                default:
                    $cot = "CHARACTER SET utf8 COLLATE utf8_general_ci";
                    break;
            
            }

            $crearbd = DB::connection($tipo)->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "."'".$nombrebd."'");
 
            if(empty($crearbd)) {
                DB::connection($tipo)->select('CREATE DATABASE '. $nombrebd .' '.$cot);
                $this->info("La Base de Datos '$nombrebd' de tipo '$tipo' con Cotejamiento '$cot' ha sido creada Correctamente ! ");
            }
            else {
                $this->info("La Base de Datos con el nombre '$nombrebd' ya existe ! ");
            }



        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
