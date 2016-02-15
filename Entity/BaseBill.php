<?php

namespace UnrLab\DomainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use UnrLab\DomainBundle\Model\HalBuilder;
use UnrLab\DomainBundle\Model\Serializable;

/**
 * BaseBill
 *
 * @ORM\Table(name="base_bill")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")

 */
class BaseBill implements Serializable
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
     * @Gedmo\Slug(fields={"reference"}, updatable=false, separator="_")
     * @ORM\Column(name="slug")
     * @JMS\Type("string")
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="creationDate", type="datetime")
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $creationDate;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updateDate", type="datetime")
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10, unique=true)
     * @JMS\Type("string")
     */
    private $reference;
    
    /**
     * @var double
     *
     * @ORM\Column(name="taxes", type="float")
     * @JMS\Type("double")
     */
    private $taxes;
    
    /**
     * @var double
     *
     * @ORM\Column(name="total_ht", type="float")
     * @JMS\Type("double")
     */
    private $totalHt;

    /**
     * @var BillStatus
     *
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\BillStatus")
     * @JMS\Exclude
     */
    private $status;
    
    /**
     * @var Payment
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\Payment")
     * @JMS\Exclude
     */
    private $payment;
    
    /**
     * @var Customer
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\Customer", inversedBy="bills")
     * @JMS\Exclude
     */
    private $customer;
    
    /**
     * @var Company
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\Company", inversedBy="bills")
     * @JMS\Exclude
     */
    private $company;
    
    /**
     * @var BillLine
     * 
     * @ORM\OneToMany(targetEntity="UnrLab\DomainBundle\Entity\BillLine", mappedBy="bill")
     * @JMS\Exclude
     * @ORM\OrderBy({"rank" = "ASC"})
     */
    private $lines;

    /**
     * @var array
     * @JMS\Type("array")
     */
    private $links;
    
    public function __construct() {
        $this->lines = new ArrayCollection();
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
    
    public function setId($id) {
        $this->id = $id;
        
        return $this;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return BaseBill
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    
        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return BaseBill
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    
        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return BaseBill
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    
        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set status
     *
     * @param BillStatus $status
     * 
     * @return BaseBill
     */
    public function setStatus(BillStatus $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return BillStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return BaseBill
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set taxes
     *
     * @param float $taxes
     * @return BaseBill
     */
    public function setTaxes($taxes)
    {
        $this->taxes = $taxes;
    
        return $this;
    }

    /**
     * Get taxes
     *
     * @return float 
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * Set totalHt
     *
     * @param double $totalHt
     * @return BaseBill
     */
    public function setTotalHt($totalHt)
    {
        $this->totalHt = $totalHt;
    
        return $this;
    }

    /**
     * Get totalHt
     *
     * @return double
     */
    public function getTotalHt()
    {
        return $this->totalHt;
    }
    
    /**
     * Compute the total of the lines
     * 
     * @return \UnrLab\DomainBundle\Entity\BaseBill
     */
    public function computeTotalHt() {
        if (count($this->lines) > 0) {
            foreach ($this->lines as $line) {
                $tmpPrice = floatval($line->getUnitPrice()) * floatval($line->getQuantity());
                $this->totalHt +=  $tmpPrice - ($tmpPrice * floatval($line->getDiscount()));
            }
        }
        
        return $this;
    }

    /**
     * Set payment
     *
     * @param Payment $payment
     * @return BaseBill
     */
    public function setPayment(Payment $payment = null)
    {
        $this->payment = $payment;
    
        return $this;
    }

    /**
     * Get payment
     *
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set customer
     * 
     * @param Customer $customer
     * 
     * @return BaseBill
     */
    public function setCustomer(Customer $customer = null){
        $this->customer = $customer;
        
        return $this;
    }
    
    /**
     * Get customer
     * 
     * @return Customer
     */
    public function getCustomer() {
        
        return $this->customer;
    }

    /**
     * Set company
     * 
     * @param Company $company
     * 
     * @return BaseBill
     */
    public function setCompany(Company $company = null){
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
     * Set lines
     * 
     * @param ArrayCollection $lines
     * 
     * @return BaseBill
     */
    public function setLines(ArrayCollection $lines) {
        if (count($lines) > 0) {
            foreach ($lines as $line) {
                $this->addLine($line);
            }
        }
        
        return $this;
    }
    
    /**
     * Add one line
     * 
     * @param BillLine $line
     * 
     * @return BaseBill
     */
    public function addLine(BillLine $line) {
        $line->setBill($this);
        $this->totalHt+= $line->getUnitPrice() * $line->getQuantity() / (1 + ($line->getDiscount()/100));
        $this->lines->add($line);
        
        return $this;
    }
    
    /**
     * Remove one line
     * 
     * @param BillLine $line
     * 
     * @return BaseBill
     */
    public function removeLine(BillLine $line) {
        $this->lines->removeElement($line);
        $this->totalHt-= $line->getUnitPrice() * $line->getQuantity() / (1 + ($line->getDiscount()/100));
        
        return $this;
    }
    
    /**
     * Clear all lines
     * 
     * @return BaseBill
     */
    public function clearLines() {
        $this->lines->clear();
        
        return $this;
    }
    
    /**
     * Get all lines
     * 
     * @return ArrayCollection
     */
    public function getLines() {
        
        return $this->lines;
    }

    /**
     * @JMS\PreSerialize
     */
    public function preSerialize()
    {
        if ($this->status) {
            $this->links['status'] = $this->buildLinks(array($this->status->getId()), '/status/{id}', '{id}');
        }
        if ($this->company) {
            $this->links['company'] = $this->buildLinks(array($this->company->getId()), '/companies/{id}', '{id}');
        }
        if ($this->customer) {
            $this->links['customer'] = $this->buildLinks(array($this->customer->getId()), '/customers/{id}', '{id}');
        }
        if (count($this->lines) > 0) {
            $lineIds = array();
            foreach ($this->lines as $line) {
                $lineIds[] = $line->getId();
            }
            $this->links['lines'] = $this->buildLinks($lineIds, '/lines/{id}', '{id}');
        }
    }

    public function getLinks()
    {
        return $this->links;
    }
}