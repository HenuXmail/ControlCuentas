<?php

namespace ControlCuentas\ControlBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CuotaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CuotaRepository extends EntityRepository
{
    /**
     * Devuelve un array de cuotas ordenadas por fecha
     * 
     * @param integer $id: Id de la cuenta
     * @return array $arrCuotas
     */
    public function findAllOrdered( $id )
    {
        $em = $this->getEntityManager();
        $arrCuotas = array();
        
        $cuotas = $em->createQueryBuilder()
                ->select('cuota')
                ->from('ControlBundle:Cuota', 'cuota')
                ->where('cuota.cuenta = :id')
                ->orderBy('cuota.fecha_vencimiento','ASC')
                ->setParameters(array('id'=>$id))
                ->getQuery()
                ->getResult();
        
        foreach ($cuotas as $key => $cuota) {
            $arrCuotas[$cuota->getFechaVencimiento()->format('Y')][] = $cuota;
        }

        return $arrCuotas;
    }
    
    /**
     * Devuelve el estado de la cuota
     * 
     * @param int $id id de la cuota
     * @return string
     */
    public function findEstado()
    {
        $estado = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, quaerat autem sequi ratione soluta optio fuga! Facilis, amet, dolor velit alias eum nam necessitatibus nostrum voluptates architecto incidunt voluptas veniam!";
        
        return $estado;
    }
}