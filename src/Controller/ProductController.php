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

/** 
 * The class is for product
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
     * Get one product
     * 
     * @Rest\Get(
     *      path = "/product/{id}",
     *      name = "get_one_product",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode=200)
     */
    public function getOneProduct(Product $product)
    {
        return $product;
    }
    /**
     * Get all products
     * 
     * @Rest\Get(
     *      path = "/products",
     *      name = "get_all_product"
     * )
     * @Rest\View(statusCode=200)
     */
    public function getAllProduct()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $products;
    }
}
