<?php

namespace UnrLab\DomainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use UnrLab\DomainBundle\Model\HalBuilder;
use UnrLab\DomainBundle\Model\Serializable;

/**
 * BillLine
 *
 * @ORM\Table(name="bill_line")
 * @ORM\Entity
 */
class BillLine implements Serializable
{
    use HalBuilder;
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
     * @var int
     * 
     * @ORM\Column(name="rank", type="integer", nullable=false)
     * @JMS\Type("integer")
     */
    private $rank;
    
    /**
     * @ORM\Column(name="service", type="string", length=255)
     * @JMS\Type("string")
     *
     * @var string
     */
    private $service;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="float")
     * @JMS\Type("double")
     */
    private $quantity;
    
    /**
     * @var double
     * 
     * @ORM\Column(name="unit_price", type="float")
     * @JMS\Type("double")
     */
    private $unitPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float")
     * @JMS\Type("double")
     */
    private $discount;
    
    /**
     * @var BaseBill
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\BaseBill", inversedBy="lines")
     * @JMS\Exclude
     */
    private $bill;

    /**
     * @var array
     * @JMS\Type("array")
     */
    private $links;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }
    
    /**
     * Set the rank of the line
     * 
     * @param int $rank
     * 
     * @return \UnrLab\DomainBundle\Entity\BillLine
     */
    public function setRank($rank) {
        $this->rank = $rank;
        
        return $this;
    }
    
    /**
     * set service
     * 
     * @param string $service
     * 
     * @return \UnrLab\DomainBundle\Entity\BillLine
     */
    public function setService($service) {
        $this->service = $service;
        
        return $this;
    }
    
    /**
     * get service
     * 
     * @return string
     */
    public function getService() {
        
        return $this->service;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return BillLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    /**
     * set unit price
     * 
     * @param double $p
     * 
     * @return \UnrLab\DomainBundle\Entity\BillLine
     */
    public function setUnitPrice($p) {
        $this->unitPrice = $p;
        
        return $this;
    }
    
    /**
     * get unit price
     * 
     * @return double
     */
    public function getUnitPrice() {
        
        return $this->unitPrice;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return BillLine
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    
        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }
    
    /**
     * Set bill
     * 
     * @param BaseBill $bill
     * 
     * @return BillLine
     */
    public function setBill(BaseBill $bill) {
        $this->bill = $bill;
        
        return $this;
    }
    
    /**
     * Get the bill
     * 
     * @return BaseBill
     */
    public function getBill() {
        
        return $this->bill;
    }

    /**
     * @JMS\PreSerialize
     */
    public function preSerialize()
    {
        if ($this->bill) {
            $this->links['bill'] = $this->buildLinks(array($this->bill->getId()), '/bills/{id}', '{id}');
        }
    }

    public function getLinks()
    {
        return $this->links;
    }
}
