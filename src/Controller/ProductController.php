<?php
/** 
 * The file is for product
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

use App\Entity\Product;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/** 
 * The class is for product
 * 
 * @Route("/api", name="api_")
 * 
 * @category Controller
 * @package  Controller
 * @author   Clement <lionneclement@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost:8000
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * FInd one product
     * 
     * @Rest\Get(
     *      path = "/product/{id}",
     *      name = "find_one_product",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups = {"one"},statusCode=200)
     */
    public function findOneProduct(Product $product)
    {
        return $product;
    }
    /**
     * Find all products
     * 
     * @Rest\Get(
     *      path = "/products",
     *      name = "find_all_product"
     * )
     * @Rest\View(serializerGroups = {"all"},statusCode=200)
     */
    public function findAllProduct()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $products;
    }
}
