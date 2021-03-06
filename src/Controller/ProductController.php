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
use Symfony\Contracts\Cache\CacheInterface;
use Knp\Component\Pager\PaginatorInterface;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

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
     * Find one product
     * 
     * @Rest\Get(
     *      path = "/product/{id}",
     *      name = "find_product",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups = {"one"},statusCode=200)
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Find one product",
     * @Model(type=Product::class, groups={"one"})
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Page not found"
     * )
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function findProduct(Product $product)
    {
        return $product;
    }
    /**
     * Find all products
     * 
     * @Rest\Get(
     *      path = "/product",
     *      name = "find_all_product"
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
     * @Rest\View(serializerGroups = {"all"},statusCode=200)
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Find all product",
     * @Model(type=Product::class, groups={"all"})
     * )
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function findAllProduct(CacheInterface $cache, PaginatorInterface $paginator,ParamFetcher $paramFetcher)
    {
        $productCache = $cache->getItem('productPage'.$paramFetcher->get('page'));
        if (!$productCache->isHit()) {
            $pagination = $paginator->paginate(
                $this->getDoctrine()->getRepository(Product::class)->findAll(),
                $paramFetcher->get('page'),
                $paramFetcher->get('limit')
            );
            $product = [
                'items' => $pagination->getItems(),
                'currentPageNumber' => $pagination->getCurrentPageNumber(),
                'totalCount' => $pagination->getTotalItemCount()
            ];
            $productCache->set($product)->expiresAfter(300);
            $cache->save($productCache);
        }
        return $productCache->get();
    }
}
