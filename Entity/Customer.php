<?php
namespace UnrLab\DomainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use UnrLab\DomainBundle\Model\HalBuilder;
use UnrLab\DomainBundle\Model\Serializable;

/**
 * Description of Customer
 * @ORM\Table(name="customer")
 * @ORM\Entity()
 */
class Customer implements Serializable{
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
     * @var string
     * 
     * @ORM\Column(name="denomination", type="string", length=100)
     * @JMS\Type("string")
     */
    private $denomination;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="phone", type="string", length=15)
     * @JMS\Type("string")
     */
    private $phone;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="mobile", type="string", length=15, nullable=true)
     * @JMS\Type("string")
     */
    private $mobile;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="mail", type="string", length=255)
     * @JMS\Type("string")
     */
    private $mail;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="siret", type="string", length=15)
     * @JMS\Type("string")
     */
    private $siret;
    
    /**
     * @var string
     * @ORM\Column(name="reference", nullable=true)
     * @JMS\Type("string")
     */
    protected $reference;
    
    /**
     * @var BaseBill
     * 
     * @ORM\OneToMany(targetEntity="UnrLab\DomainBundle\Entity\BaseBill", mappedBy="customer")
     * @JMS\Exclude
     */
    private $bills;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="address_1", type="string", length=255)
     * @JMS\Type("string")
     */
    private $address1;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="address_2", type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $address2;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="bp", type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $bp;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="cp", type="string", length=255)
     * @JMS\Type("string")
     */
    private $cp;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="city", type="string", length=255)
     * @JMS\Type("string")
     */
    private $city;
    
    /**
     * @var Country
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\Country")
     * @JMS\Exclude
     */
    private $country;
    
    /**
     * @var Company
     * 
     * @ORM\ManyToOne(targetEntity="UnrLab\DomainBundle\Entity\Company", inversedBy="customers")
     * @JMS\Exclude
     */
    private $company;

    private $links;
    
    public function __construct() {
        $this->bills = new ArrayCollection();
    }
    
    public function setId($id) {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * Get the id
     * 
     * @return integer
     */
    public function getId() {
        
        return $this->id;
    }
    
    /**
     * Set the denomination
     * 
     * @param string $denomination
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setDenomination($denomination) {
        $this->denomination = $denomination;
        
        return $this;
    }
    
    /**
     * Get the denomination
     * 
     * @return string
     */
    public function getDenomination() {
        
        return $this->denomination;
    }
    
    /**
     * Set the phone
     * 
     * @param string $phone
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        
        return $this;
    }
    
    /**
     * Get the phone
     * 
     * @return string
     */
    public function getPhone() {
        
        return $this->phone;
    }
    
    /**
     * Set the mobile
     * 
     * @param string $mobile
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;
        
        return $this;
    }
    
    /**
     * Get the mobile
     * 
     * @return string
     */
    public function getMobile() {
        
        return $this->mobile;
    }
    
    /**
     * Set the mail
     * 
     * @param string $mail
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setMail($mail) {
        $this->mail = $mail;
        
        return $this;
    }
    
    /**
     * Get the mail
     * 
     * @return string
     */
    public function getMail() {
        
        return $this->mail;
    }
    
    
    /**
     * Set siret
     *
     * @param string $siret
     * @return Customer
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    
        return $this;
    }

    /**
     * Get siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Customer
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
     * Set bills
     * 
     * @param ArrayCollection $bills
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setBills(\Doctrine\Common\Collections\ArrayCollection $bills) {
        $this->bills = $bills;
        
        return $this;
    }
    
    /**
     * Add bills
     *
     * @param BaseBill $bills
     * @return Customer
     */
    public function addBill(BaseBill $bill)
    {
        $bill->setCustomer($this);
        $this->bills->add($bill);
    
        return $this;
    }

    /**
     * Remove bills
     *
     * @param BaseBill $bill
     */
    public function removeBill(BaseBill $bill)
    {
        $bill->setCustomer(null);
        $this->bills->removeElement($bill);
    }

    /**
     * Get bills
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBills()
    {
        return $this->bills;
    }
    
    /**
     * Clear all bills
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function clearBills() {
        $this->bills->clear();
        
        return $this;
    }
    
    /**
     * Set address1
     * 
     * @param string $adr
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setAddress1($adr) {
        $this->address1 = $adr;
        
        return $this;
    }
    
    /**
     * Get address1
     * 
     * @return string
     */
    public function getAddress1() {
        
        return $this->address1;
    }
    
    /**
     * Set address2
     * 
     * @param string $adr
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setAddress2($adr) {
        $this->address2 = $adr;
        
        return $this;
    }
    
    /**
     * Get address2
     * 
     * @return string
     */
    public function getAddress2() {
        
        return $this->address2;
    }
    
    /**
     * Set BP
     * 
     * @param string $bp
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setBp($bp) {
        $this->bp = $bp;
        
        return $this;
    }
    
    /**
     * Get BP
     * 
     * @return string
     */
    public function getBp() {
        
        return $this->bp;
    }
    
    /**
     * Set CP
     * 
     * @param string $cp
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setCp($cp) {
        $this->cp = $cp;
        
        return $this;
    }
    
    /**
     * Get CP
     * 
     * @return string
     */
    public function getCp() {
        
        return $this->cp;
    }
    
    /**
     * Set city
     * 
     * @param string $city
     * 
     * @return \UnrLab\DomainBundle\Entity\Customer
     */
    public function setCity($city) {
        
        $this->city = $city;
        
        return $this;
    }
    
    /**
     * Get city
     * 
     * @return string
     */
    public function getCity() {
        
        return $this->city;
    }

    /**
     * Set country
     *
     * @param \UnrLab\DomainBundle\Entity\Country $country
     * 
     * @return Customer
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \UnrLab\DomainBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set company
     *
     * @param \UnrLab\DomainBundle\Entity\Company $company
     * 
     * @return Customer
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    public function __toString() {

        return $this->denomination;
    }

    /**
     * @JMS\PreSerialize
     */
    public function preSerialize()
    {
        if ($this->country) {
            $this->links['country'] = $this->buildLinks(array($this->country->getId()), '/countries/{id}', '{id}');
        }
        if ($this->company) {
            $this->links['company'] = $this->buildLinks(array($this->company->getId()), '/companies/{id}', '{id}');
        }
        if (count($this->bills) > 0) {
            $billIds = array();
            foreach ($this->bills as $bill) {
                $billIds[] = $bill->getId();
            }
            $this->links['bills'] = $this->buildLinks($billIds, '/bills/{id}', '{id}');
        }
    }

    public function getLinks()
    {
        return $this->links;
    }
}