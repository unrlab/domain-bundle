<?php
namespace UnrLab\DomainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use UnrLab\SecurityBundle\Entity\BaseUser;

/**
 * Description of super admin
 * @ORM\Table(name="user_super_admin")
 * @ORM\Entity()
 */
class SuperAdmin extends BaseUser {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("integer")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}