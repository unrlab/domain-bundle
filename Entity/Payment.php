<?php
/**
 * Created by IntelliJ IDEA.
 * User: dj3
 * Date: 28/12/15
 * Time: 09:46
 */

namespace UnrLab\DomainBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity
 */
class Payment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10)
     * @JMS\Type("string")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @JMS\Type("string")
     */
    private $name;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Payment
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Payment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString() {

        return $this->name;
    }
}