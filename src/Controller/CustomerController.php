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

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Customer;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

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
     * Create customer
     * 
     * @Rest\Post(
     *       path = "/customer",
     *       name = "create_customer")
     * @Rest\RequestParam(
     *       name="name",
     *       requirements="[a-zA-Z]+",
     *       description="Name")
     * @Rest\RequestParam(
     *       name="email",
     *       requirements=@Constraints\Email,
     *       description="Email")
     * @Rest\View(statusCode=201)
     * 
     * @SWG\Response(
     *     response=201,
     *     description="Create customer"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Name and Email not be null"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Email already used"
     * )
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     */
    public function createCustomer(ParamFetcher $paramFetcher)
    {
        $customer = new Customer;
        $customer->setName($paramFetcher->get('name'));
        $customer->setEmail($paramFetcher->get('email'));
        $customer->setClientId($this->getUser());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush(); 
    }
    /**
     * Delete customer
     * 
     * @Rest\Delete(
     *      path = "/customer/{id}",
     *      name = "delete_customer",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode=204)
     * 
     * @SWG\Response(
     *     response=204,
     *     description="Delete customer"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Page not found"
     * )
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     */
    public function deleteCustomer(Customer $customer)
    {
        if ($this->getUser() != $customer->getClientId()) {
            throw new HttpException(404, 'Page not found');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($customer);
        $entityManager->flush();
    }
    /**
     * Find one customer
     * 
     * @Rest\Get(
     *      path = "/customer/{id}",
     *      name = "find_customer",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups = {"one"}, statusCode=200)
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Find one customer"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Page not found",
     *     @Model(type=Customer::class, groups={"one"})
     * )
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     */
    public function findCustomer(Customer $customer)
    {
        if ($this->getUser() != $customer->getClientId()) {
            throw new HttpException(404, 'Page not found');
        }
        return $customer;
    }
    /**
     * Find all customer
     * 
     * @Rest\Get(
     *      path = "/customer",
     *      name = "find_all_customer"
     * )
     * @Rest\QueryParam(
     *       name="page",
     *       requirements="\d+",
     *       default="1",
     *       description="page")
     * @Rest\QueryParam(
     *       name="limit",
     *       requirements="\d+",
     *       default="10",
     *       description="limit")
     * @Rest\View(serializerGroups = {"all"}, statusCode=200)
     * 
     * @SWG\Response(
     *       response=200,
     *       description="Find all customer",
     *       @Model(type=Customer::class, groups={"all"})
     * )
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     */
    public function findAllCustomer(PaginatorInterface $paginator, ParamFetcher $paramFetcher)
    {
        $pagination = $paginator->paginate(
            $this->getDoctrine()->getRepository(Customer::class)->findBy(['clientId'=> $this->getUser()]),
            $paramFetcher->get('page'),
            $paramFetcher->get('limit')
        );
        return [
            'items' => $pagination->getItems(),
            'currentPageNumber' => $pagination->getCurrentPageNumber(),
            'totalCount' => $pagination->getTotalItemCount()
        ];
    }
    /**
     * Update customer
     * 
     * @Rest\Patch(
     *      path = "/customer/{id}",
     *      name = "update_customer",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\RequestParam(
     *       name="name",
     *       requirements="[a-zA-Z]+",
     *       description="Name")
     * @Rest\RequestParam(
     *       name="email",
     *       requirements=@Constraints\Email,
     *       description="Email")
     * @Rest\View(statusCode=204)
     * 
     * @SWG\Response(
     *     response=204,
     *     description="Update customer"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Name and Email not be null"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Page not found"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Email already used"
     * )
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     */
    public function updateCustomer(Customer $customer, ParamFetcher $paramFetcher)
    {
        if ($this->getUser() != $customer->getClientId()) {
            throw new HttpException(404, 'Page not found');
        }
        $customer->setName($paramFetcher->get('name'));
        $customer->setEmail($paramFetcher->get('email'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush();

    }
}
