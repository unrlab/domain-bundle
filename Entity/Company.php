<?php
namespace UnrLab\DomainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use UnrLab\DomainBundle\Model\HalBuilder;
use UnrLab\DomainBundle\Model\Serializable;

/**
 * Description of Customer
 * @ORM\Table(name="company")
 * @ORM\Entity()
 *
 */
class Company implements Serializable {
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
     * @ORM\Column(name="name")
     * @JMS\Type("string")
     */
    private $name;
    
    /**
     * @var string
     * @ORM\Column(name="siren")
     * @JMS\Type("string")
     */
    private $siren;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="activity", type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $activity;
    
    /**
     * @var string
     * @ORM\Column(name="reference")
     * @JMS\Type("string")
     */
    private $reference;
    
    /**
     * @Gedmo\Slug(fields={"name", "siren", "reference"})
     * @ORM\Column(name="slug")
     * @JMS\Type("string")
     * @var string
     */
    private $slug;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="logo", type="string", length=10,  nullable=true)
     * @JMS\Type("string")
     */
    private $logo;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="logo64", type="text", nullable=true)
     * @JMS\Type("string")
     */
    private $logo64;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="logo_type", type="text", length=50,  nullable=true)
     * @JMS\Type("string")
     */
    private $logoType;
    
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
     * @JMS\Type("UnrLab\DomainBundle\Entity\Country")
     */
    private $country;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="UnrLab\DomainBundle\Entity\BillUser", mappedBy="company")
     * @JMS\Exclude
     */
    private $users;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="UnrLab\DomainBundle\Entity\BaseBill", mappedBy="company")
     * @JMS\Exclude
     */
    private $bills;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="UnrLab\DomainBundle\Entity\Customer", mappedBy="company")
     * @JMS\Exclude
     */
    private $customers;

    /**
     * @var string
     * @JMS\Type("array")
     */
    protected $links;
    
    public function __construct() {
        $this->users = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->customers = new ArrayCollection();
    }

    public function setId($id) {
        $this->id = $id;
        
        return $this;
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
     * Set name
     *
     * @param string $name
     * @return Company
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

    /**
     * Set siren
     *
     * @param string $siren
     * @return Company
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
    
        return $this;
    }

    /**
     * Get siren
     *
     * @return string 
     */
    public function getSiren()
    {
        return $this->siren;
    }
    
    public function setActivity($activity) {
        $this->activity = $activity;
        
        return $this;
    }
    
    public function getActivity() {
        
        return $this->activity;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Company
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
     * Set slug
     *
     * @param string $slug
     * @return Company
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
    
    public function setLogo($logo) {
        $this->logo = $logo;
        
        return $this;
    }
    
    public function getLogo() {
        
        return $this->logo;
    }
    
    public function setLogoType($type) {
        $this->logoType = $type;
        
        return $this;
    }
    
    public function getLogoType() {
        
        return $this->logoType;
    }
    
    public function setLogo64($logo) {
        $this->logo64 = $logo;
        
        return $this;
    }
    
    public function getLogo64() {
        
        return $this->logo64;
    }
    
    /**
     * Set address1
     * 
     * @param string $adr
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
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
     * @return \UnrLab\DomainBundle\Entity\Company
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
     * @return \UnrLab\DomainBundle\Entity\Company
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
     * @return \UnrLab\DomainBundle\Entity\Company
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
     * @return \UnrLab\DomainBundle\Entity\Company
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
     * @param Country $country
     * 
     * @return Company
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Set users
     * 
     * @param ArrayCollection $users
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function setUsers($users) {
        if (count($users) > 0) {
            foreach ($users as $user) {
                $this->addUser($user);
            }
        }
        
        return $this;
    }
    
    /**
     * Add one user
     * 
     * @param \UnrLab\DomainBundle\Entity\BillUser $user
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function addUser(BillUser $user) {
        $user->setCompany($this);
        $this->users->add($user);
        
        return $this;
    }
    
    /**
     * Remove one user
     * 
     * @param \UnrLab\DomainBundle\Entity\BillUser $user
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function removeUSer(BillUser $user) {
        $this->users->removeElement($user);
        
        return $this;
    }
    
    /**
     * Clear all users
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function clearUSers() {
        $this->users->clear();
        
        return $this;
    }
    
    /**
     * Get all users
     * 
     * @return ArrayCollection
     */
    public function getUsers() {
        
        return $this->users;
    }
    
    /**
     * Set bills
     * 
     * @param ArrayCollection $bills
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function setBills($bills) {
        if (count($bills) > 0) {
            foreach ($bills as $bill) {
                $this->addBill($bill);
            }
        }
        
        return $this;
    }
    
    /**
     * Add one bill
     * 
     * @param \UnrLab\DomainBundle\Entity\BaseBill $bill
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function addBill(BaseBill $bill) {
        $bill->setCompany($this);
        $this->bills->add($bill);
        
        return $this;
    }
    
    /**
     * Remove one bill
     * 
     * @param \UnrLab\DomainBundle\Entity\BaseBill $bill
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function removeBill(BaseBill $bill) {
        $bill->setCompany(null);
        $this->bills->removeElement($bill);
        
        return $this;
    }
    
    /**
     * Clear all bills
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function clearBills() {
        $this->bills->clear();
        
        return $this;
    }
    
    /**
     * Get all bills
     * 
     * @return ArrayCollection
     */
    public function getBills() {
        
        return $this->bills;
    }
    
    /**
     * Set customer
     * 
     * @param ArrayCollection $customers
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function setCustomers($customers) {
        if (count($customers) > 0) {
            foreach ($customers as $customer) {
                $this->addCustomer($customer);
            }
        }
        
        return $this;
    }
    
    /**
     * Add one customer
     * 
     * @param \UnrLab\DomainBundle\Entity\Customer $customer
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function addCustomer(Customer $customer) {
        $customer->setCompany($this);
        $this->customers->add($customer);
        
        return $this;
    }
    
    /**
     * Remove one customer
     * 
     * @param \UnrLab\DomainBundle\Entity\Customer $customer
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function removeCustomer(Customer $customer) {
        $this->customers->removeElement($customer);
        
        return $this;
    }
    
    /**
     * Clear all customers
     * 
     * @return \UnrLab\DomainBundle\Entity\Company
     */
    public function clearCustomers() {
        $this->customers->clear();
        
        return $this;
    }
    
    /**
     * Get all customers
     * 
     * @return ArrayCollection
     */
    public function getCustomers() {
        
        return $this->customers;
    }
    
    public function __toString() {
        
        return $this->getName();
    }

    /**
     * @JMS\PreSerialize
     */
    public function preSerialize()
    {
        $userIds     = array();
        $billIds     = array();
        $customerIds = array();
        if ($this->users->count() > 0) {
            foreach ($this->users as $user) {
                $userIds[] = $user->getId();
            }
            $this->links['users'] = $this->buildLinks($userIds, '/users/{id}', '{id}');
        }
        if ($this->bills->count() > 0) {
            foreach ($this->bills as $bill) {
                $billIds[] = $bill->getId();
            }
            $this->links['bills'] = $this->buildLinks($billIds, '/bills/{id}', '{id}');
        }
        if ($this->customers->count() > 0) {
            foreach ($this->customers as $customer) {
                $customerIds[] = $customer->getId();
            }
            $this->links['customers'] = $this->buildLinks($customerIds, '/customers/{id}', '{id}');
        }
    }

    public function getLinks()
    {
        return $this->links;
    }
}