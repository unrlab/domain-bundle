<?php

namespace UnrLab\DomainBundle\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UnrLab\DomainBundle\Entity\BaseBill;
use UnrLab\DomainBundle\Entity\BillLine;
use UnrLab\DomainBundle\Entity\BillStatus;
use UnrLab\DomainBundle\Entity\Customer;
use UnrLab\DomainBundle\Entity\Payment;


/**
 * Description of StatusFixtures
 *
 * @author jeremy
 */
class LoadBillData extends AbstractFixture implements OrderedFixtureInterface {

    private $arrStatus = array(
        'CREATE' => 'Created',
        'SENT' => 'Sent',
        'PAY' => 'Payed',
    );
    private $arrPayment = array(
        'CB' => 'Carte de crédit',
        'VIR' => 'Virement',
        'ESP' => 'Espèce',
        'CHE' => 'Chèque',
    );
    private $customers;
    private $companies;

    public function load(ObjectManager $manager) {
        $this->companies = $manager->getRepository('UnrLabDomainBundle:Company')->findAll();
        
        $country = $manager->getRepository('UnrLabDomainBundle:Country')->findOneBy(array('code' => 'FR'));
        
        foreach (range(1, 10) as $a) {
            $company = $this->companies[mt_rand(0, count($this->companies)-1)];
            $customer = new Customer();
            $customer
                    ->setReference('ref-123-'.$a)
                    ->setDenomination('customer-'.$a)
                    ->SetPhone('0494949494')
                    ->SetMobile('0606060606')
                    ->setMail('customer'.$a.'@mail.fr')
                    ->setSiret('12345678900011')
                    ->setAddress1($a.', rue x')
                    ->setAddress2('le truc')
                    ->setCp('06400')
                    ->setCity('Cannes')
                    ->setCountry($country);
            
            $manager->persist($customer);
            $company->addCustomer($customer);
        }
        
        foreach ($this->arrStatus as $code => $name) {
            $status = new BillStatus();
            $status
                    ->setCode($code)
                    ->setName($name);

            $manager->persist($status);
        }
        foreach ($this->arrPayment as $code => $name) {
            $payment = new Payment();
            $payment
                    ->setCode($code)
                    ->setName($name);
            $manager->persist($payment);
        }

        $manager->flush();

        $this->arrStatus = $manager->getRepository('UnrLabDomainBundle:BillStatus')->findAll();
        $this->arrPayment = $manager->getRepository('UnrLabDomainBundle:Payment')->findAll();
        $this->customers = $manager->getRepository('UnrLabDomainBundle:Customer')->findAll();
        
        foreach (range(0, 10) as $i) {
            $company = $this->companies[mt_rand(0, count($this->companies)-1)];
            $customer = $this->customers[mt_rand(0, count($this->customers)-1)];
            $bill = new BaseBill();
            $bill
                    ->setCustomer($customer)
                    ->setCompany($company)
                    ->setPayment($this->arrPayment[mt_rand(0, count($this->arrPayment)-1)])
                    ->setReference('1234-'.$i)
                    ->setStatus($this->arrStatus[mt_rand(0, count($this->arrStatus)-1)])
                    ->setTaxes(0.196)
                    ->setTotalHt(0);
            
            $manager->persist($bill);
            
            $company
                    ->addBill($bill);
            foreach (range(0, 10) as $j) {
                $qty = mt_rand(1, 10);
                $unity = mt_rand(10, 200);
                $discount = mt_rand(0, 100)/100;
                $billLine = new BillLine();
                $billLine
                        ->setRank($j)
                        ->setService('service-'.$i.'-'.$j)
                        ->setQuantity($qty)
                        ->setUnitPrice($unity)
                        ->setDiscount($discount);

                $manager->persist($billLine);
                
                $bill->addLine($billLine);
            }
            $bill->computeTotalHt();
        }
        
        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}

?>
