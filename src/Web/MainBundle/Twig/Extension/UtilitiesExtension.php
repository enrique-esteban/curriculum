<?php
    namespace Web\MainBundle\Twig\Extension;
    
    /**
     * Extensiones de Twig para toda la aplicación
     *
     * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
     */
    class UtilitiesExtension extends \Twig_Extension
    {
        public function getFilters()
        {
            return array(
                'formatted_date' => new \Twig_SimpleFilter('formattedDate', array($this, 'formattedDateFilter')),
                'phone' => new \Twig_SimpleFilter('phone', array($this, 'phoneFilter')),
            );

        }

        public function formattedDateFilter (\DateTime $date)
        {
            // Se calcula en número de segundos trasncurridos desde la fecha dada a la actual
            $passTime = time() - $date->getTimestamp();

            if ($passTime < 0) { // El tiempo trasncurrido no puede ser negativo
                throw new \Exception("formatedDate is unable to handle dates.");
            }
            elseif ($passTime < 60) { // Ha transcurrido segundos (entre 1 y 59 segundos)
                $formattedDate = "Hace $passTime segundos.";
            }
            elseif ($passTime < 3600) { // Han trascurrido minutos (entre 1 y 59 minutos)
                $passTime = floor($passTime / 60);
                $formattedDate = "Hace $passTime minutos.";
            }
            elseif ($passTime < 86400) { // Han transcurrido horas (entre 1 y 23 horas)
                $passTime = floor($passTime / 3600);
                $formattedDate = "Hace $passTime horas.";
            }
            else { // Ha trascurrido al menos un día
                $formattedDate = $date->format("d-m-Y");
            }

            return $formattedDate;
        }

        public function phoneFilter($phone)
        {
            if (!$phone) {
                return $phone;
            }
            
            $phone_f = substr($phone, 0, 3) . " " . substr($phone, 3, 3) . " " . substr($phone, 6, 3);


            return  $phone_f;
        }

        public function getName()
        {
            return 'utilities';
        }
    }