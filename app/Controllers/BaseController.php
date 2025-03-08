<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\SettingsModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $servicesModel;
    protected $settingsModel;
    protected $courseModel;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Common data array to be used in all controllers.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $settingsModel = new SettingsModel();
        $servicesModel = new ServicesModel();
        $courseModel = new CourseModel();


        // Load the URI service
        $uri = service('uri');
        // Check if the second segment exists before accessing it
        if ($uri->getTotalSegments() >= 2) {
            $segment2 = $uri->getSegment(2);
            $this->data['segment2'] = $segment2;
            $segment3 = $uri->getSegment(3);
            $this->data['segment3'] = $segment3;
        } elseif ($uri->getTotalSegments() >= 3) {
            $segment3 = $uri->getSegment(3);
            $this->data['segment3'] = $segment3;
        } else {
            $this->data['segment2'] = null; // or set a default value
            $this->data['segment3'] = null; // or set a default value
        }
        $this->data['settings'] = $settingsModel->getAllSettings();
        $this->data['services'] = $servicesModel->getServiceHierarchy();
        $this->data['courses'] = $courseModel->getAllCourses();
    }
}
