<?php
/** 
 * The file is for customer
 * 
 * PHP version 7.3.5
 * 
 * @category Controller
 * @package  Controller
 * @author   Clement <lionneclement@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost:8000
 */
namespace App\Controller;

use App\Entity\Customer;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/** 
 * The class is for customer
 * 
 * @Route("/api", name="api_") 
 * 
 * @category Controller
 * @package  Controller
 * @author   Clement <lionneclement@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost:8000
 */
class CustomerController extends AbstractFOSRestController
{
    /**
     * Add one customer
     * 
     * @Rest\Post(
     *       path = "/customer",
     *       name = "customer_add"
     * )
     * @Rest\View(statusCode=201)
     */
    public function addOneCustomer(Request $request)
    {
        $customer = new Customer;
        $customer->setName($request->request->get('name'));
        $customer->setEmail($request->request->get('email'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush(); 
    }
    /**
     * Delete one customer
     * 
     * @Rest\Delete(
     *      path = "/customer/{id}",
     *      name = "customer_delete",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode=200)
     */
    public function deleteOneCustomer(Customer $customer)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($customer);
        $entityManager->flush();
    }
    /**
     * Find one customer
     * 
     * @Rest\Get(
     *      path = "/customer/{id}",
     *      name = "find_one_customer",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode=200)
     */
    public function findOneCustomer(Customer $customer)
    {
        return $customer;
    }
    /**
     * Find all customers
     * 
     * @Rest\Get(
     *      path = "/customers",
     *      name = "find_all_customer"
     * )
     * @Rest\View(statusCode=200)
     */
    public function findAllCustomer()
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        return $customers;
    }
}
