<?php
namespace Http\controllers;
use lib\BaseController;
use models\Distrito;
use report\implementacion\Model;

class DistritoController extends BaseController
{
/// propiedades
private static Model $ModelDistrito;
/// método que realiza el registro de un nuevo distrito
public static function save()
{

 self::NoAuth();
 /// validamos el token
 if(self::ValidateToken(self::post("token_")))
 {
    self::$ModelDistrito = new Distrito;
    /// verificamos que no exista duplicidad antes de registrar

    $Distrito = self::$ModelDistrito->query()->Where("name_distrito","=",self::post("name_distrito"))->first();

    if($Distrito)
    {
        self::json(["response"=>"existe"]);
    }
    else
    {
        $Respuesta = self::$ModelDistrito->Insert([
            "name_distrito"=>self::post("name_distrito"),
            "id_provincia"=>self::post("provincia_select_dis")
        ]);

        self::json(["response"=>$Respuesta]);
    }
 }
}

/// método para mostrar los distritos deacuerdo a la provincia
public static function showDistritos_provincia($Id_provincia)
{
    self::NoAuth();
    /// validamos el token
    if(self::ValidateToken(self::get("token_")))
    {
        /// mostramos los distritos
        self::$ModelDistrito = new Distrito;

        $Distritos = self::$ModelDistrito->query()->Join("provincia as pr","dis.id_provincia","=","pr.id_provincia")
        ->Where("dis.id_provincia","=",$Id_provincia)
        ->And("dis.deleted_at","=","1")
        ->Or("pr.name_provincia","=",$Id_provincia)->get();

        self::json(["response"=>$Distritos]);
    }
}

/// mostrar provincias existentes
public static function showDistritosAll()
{
    self::NoAuth();
    /// validamos el token
    if(self::ValidateToken(self::get("token_")))
    {
        /// mostramos los distritos
        self::$ModelDistrito = new Distrito;

        $Distritos = self::$ModelDistrito->query()->Join("provincia as pr","dis.id_provincia","=","pr.id_provincia")
        ->Join("departamento as dep","pr.id_departamento","=","dep.id_departamento")->get();

        self::json(["response"=>$Distritos]);
    }
}
}