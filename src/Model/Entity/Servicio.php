<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Servicio Entity
 *
 * @property int $servicio_id
 * @property \Cake\I18n\FrozenDate $fecha_solicitud
 * @property string $descripcion_corta
 * @property int $tipo_servicio_id
 * @property int $tipo_incidencia_id
 * @property string $problematica
 * @property string $no_inventario
 * @property int $prioridade_id
 * @property int $cat_adscripcione_id
 * @property string $nombre_solicitante
 * @property string $cargo_solicitante
 * @property string $telefono_solicitante
 * @property string $email_solicitante
 * @property \Cake\I18n\FrozenDate $fecha_limite_solucion
 * @property int $co_user_id
 * @property string $solucion
 * @property \Cake\I18n\FrozenDate $fecha_solucion
 * @property int $statu_id
 * @property string $notas
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 *
 * @property \App\Model\Entity\TipoServicio $tipo_servicio
 * @property \App\Model\Entity\TipoIncidencia $tipo_incidencia
 * @property \App\Model\Entity\Prioridade $prioridade
 * @property \App\Model\Entity\CatAdscripcione $cat_adscripcione
 * @property \App\Model\Entity\CoUser $co_user
 * @property \App\Model\Entity\Status $status
 */
class Servicio extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'fecha_solicitud' => true,
        'descripcion_corta' => true,
        'tipo_servicio_id' => true,
        'tipo_incidencia_id' => true,
        'problematica' => true,
        'no_inventario' => true,
        'prioridade_id' => true,
        'cat_institucione_id' => true,
        'cat_adscripcione_id' => true,
        'nombre_solicitante' => true,
        'cargo_solicitante' => true,
        'telefono_solicitante' => true,
        'email_solicitante' => true,
        'fecha_limite_solucion' => true,
        'co_user_id' => true,
        'solucion' => true,
        'fecha_solucion' => true,
        'statu_id' => true,
        'notas' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'tipo_servicio' => true,
        'tipo_incidencia' => true,
        'prioridade' => true,
        'cat_adscripcione' => true,
        'co_user' => true,
        'status' => true
    ];
}