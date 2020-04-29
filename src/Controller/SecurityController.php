<?php
/** 
 * The file is for security
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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\Constraints;
use Swagger\Annotations as SWG;

/** 
 * The class is for security
 * 
 * @Route("/api", name="api_") 
 * 
 * @category Controller
 * @package  Controller
 * @author   Clement <lionneclement@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost:8000
 */
class SecurityController extends AbstractFOSRestController
{
    /**
     * Login
     * 
     * @Rest\Post(
     *       path = "/login_check",
     *       name = "login_check"
     * )
     * @Rest\RequestParam(
     *       name="password",
     *       requirements="[^A-Za-z0-9]+",
     *       description="Password"
     * )
     * @Rest\RequestParam(
     *       name="email",
     *       requirements=@Constraints\Email,
     *       description="Email"
     * )
     * @Rest\View(statusCode=200)
     * 
     * @SWG\Response(
     *     response="200",
     *     description="Connected"
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Email and Password not be null"
     * )
     * @SWG\Response(
     *     response="401",
     *     description="Invalid credentials"
     * )
     * @SWG\Parameter(name="email", in="formData", type="string", required=true )
     * @SWG\Parameter(name="password", in="formData", type="string", required=true )
     * @SWG\Tag(name="Security")
     */
    public function login_check()
    {
    }
}
