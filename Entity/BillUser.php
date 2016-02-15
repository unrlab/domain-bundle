<?php
namespace UnrLab\DomainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use UnrLab\DomainBundle\Model\Serializable;
use UnrLab\SecurityBundle\Entity\BaseUser;

/**
 * Description of BillUser
 * @ORM\Table(name="user_bill_user")
 * @ORM\Entity()
 */
class BillUser extends BaseUser implements Serializable {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("integer")
     */
    protected $id;
    
    /**
     * @var Company
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\Company", inversedBy="users")
     * @JMS\Exclude
     */
    protected $company;

    /**
     * @var string
     * @JMS\Type("array")
     */
    protected $links;

    /**
     * @JMS\PreSerialize
     */
    public function preSerialize()
    {
        if ($this->company) {
            $this->links['company'] = $this->buildLinks([$this->company->getId()], '/companies/{id}', '{id}');
        }
    }



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
     * Set company
     * 
     * @param \UnrLab\DomainBundle\Entity\Company $company
     * 
     * @return $this
     */
    public function setCompany(Company $company) {
        $this->company = $company;
        
        return $this;
    }
    
    /**
     * Get company
     * 
     * @return Company
     */
    public function getCompany() {
        
        return $this->company;
    }

    /**
     * @return string
     */
    public function getLinks()
    {
        return $this->links;
    }
}